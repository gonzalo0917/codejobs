<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Codes_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table  = "codes";
		$this->fields = "ID_Code, Title, Description, Slug, Languages, Author, Start_Date, Text_Date, Views, Likes, Dislikes, Language, Situation";

		$this->Data = $this->core("Data");
		$this->Data->table("codes");
                
        $this->language = whichLanguage();
                
		$this->helper("alerts");
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Code DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
			
			if($validation) {
				return $validation;
			}
		} elseif($action === "editLanguage" or $action === "saveLanguage") {
			$validation = $this->editOrSaveLanguage();

			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, "ID_Code DESC", $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		} elseif($action === "editLanguage") {
			return $this->editLanguage();
		} elseif($action === "saveLanguage") {
			return $this->saveLanguage();
		}
	}
	
	private function all($trash, $order, $limit) {
		if(segment(2, isLang()) !== "languages") {
			$fields = "ID_Code, Title, Slug, Author, Text_Date, Views, Likes, Dislikes, Language, Reported, Situation";

			if(!$trash) {			
				return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit);
			} else {	
				return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $fields, NULL, $order, $limit) 	   : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $fields, NULL, $order, $limit);	
			}				
		} else {
			return $this->Db->findAll("codes_syntax", "ID_Syntax, Name, MIME, Filename, Extension");
		}
	}
	
	private function editOrSave($action) {
		$validations = array(
			"exists"  => array(
				"URL" => POST("URL")
			),
			"title" => "required"
		);

		$this->id = POST("ID");

		$this->helper(array("time", "alerts"));

		if(POST("author")) {
			$this->Users_Model = $this->model("Users_Model");

			$data = $this->Users_Model->getByUsername(POST("author"));
			if(isset($data[0]["ID_User"])) {
				$ID_User = $data[0]["ID_User"];
			} else {
				$ID_User = FALSE;
			}
		} else {
			$ID_User = SESSION("ZanUserID");
		}

		if(!$ID_User) {
			return getAlert("Author is not a valid user");
		}
		
		$data = array(
			"ID_User" 	 => $ID_User,
			"Author"  	 => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Slug"    	 => slug(POST("title", "clean")),
            "Languages"  => $this->implode(POST("syntaxname", "clean"))
		);

		if($action === "save") {
			$data["Start_Date"] = now(4);
            $data["Text_Date"]  = decode(now(2));
		} else {
			$data["Modified_Date"] = now(4);
		}
        
		$this->Data->ignore(array("file", "programming", "syntax", "syntaxname", "name", "code"));
		
		$this->data = $this->Data->proccess($data, $validations);
                
        if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function editOrSaveLanguage() {
		$validations = array(
			"name" => "required",
			"mime" => "required"
		);

		$data = array();

		$this->Data->ignore(array("editLanguage"));
		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
    public function add() {
		$error = $this->editOrSave("save");

		if($error) {
			return $error;
		}
		
		$this->data["Situation"] = (SESSION("ZanUserPrivilegeID") == 1 OR SESSION("ZanUserRecommendation") > 100) ? "Active" : "Pending";
		
		if(($lastID = $this->Db->insert($this->table, $this->data)) !== FALSE) {
            $this->data = $this->proccessFiles($lastID);
                        
            if(isset($this->data["error"])) {
                $this->Db->delete($lastID, $this->table);
                
                return $this->data["error"];
            }
                        
            if($this->Db->insertBatch("codes_files", $this->data)) {
				$this->Users_Model = $this->model("Users_Model");

				$this->Users_Model->setCredits(1, 17);

                return getAlert(__("The code has been saved correctly"), "success");	
            }
		}
		
		return getAlert(__("Insert error"));
	}
		
	private function save() {
		if(($ID = $this->Db->insert($this->table, $this->data)) !== FALSE) {
            $this->data = $this->proccessFiles($ID);
                        
            if(isset($this->data["error"])) {
                $this->Db->delete($ID, $this->table);
                
                return $this->data["error"];
            }
                        
            if($this->Db->insertBatch("codes_files", $this->data)) {
            	$this->Cache = $this->core("Cache");	
				$this->Cache->removeAll("codes");

            	$this->Users_Model = $this->model("Users_Model");
				$this->Users_Model->setCredits(1, 17);
				
                return getAlert(__("The code has been saved correctly"), "success");	
            }
		}
		
		return getAlert(__("Insert error"));
	}

	private function saveLanguage() {
		if($this->Db->insert("codes_syntax", $this->data)) {
			return getAlert(__("The language has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function edit() {
		if($this->Db->update($this->table, $this->data, POST("ID"))) {
            $this->data = $this->proccessFiles(POST("ID"));
                    
            if(isset($this->data["error"])) {
                return $this->data["error"];
            }
            
            $filesDB   = $this->getFilesBy(POST("ID"));
            $filesPOST = POST("file");
            
            foreach($filesPOST as $iFile => $fileID) {
                if((int)$fileID > 0) {
                    $this->Db->update("codes_files", $this->data[$iFile], $fileID);
                    
                    array_splice($filesDB, array_search($fileID, $filesDB), 1);
                } else { 
                    $this->Db->insert("codes_files", $this->data[$iFile]);
                }
            }
            
            if(count($filesDB) > 0) {
                foreach ($filesDB as $fileDB) {
                    $this->Db->delete($fileDB, "codes_files");
                }
            }
            
            $this->Cache = $this->core("Cache");	
			$this->Cache->removeAll("codes");

            return getAlert(__("The code has been edit correctly"), "success");
        }
        
        return getAlert(__("Update error"));
	}

	private function editLanguage() {
		$this->Db->update("codes_syntax", $this->data, POST("ID"));
		
		return getAlert(__("The language has been edit correctly"), "success");
	}
        
    public function getRSS() {	
        return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Code DESC", _maxLimit);
	}

	public function getBufferCodes($language = "all") {
		return ($language === "all") ? $this->Db->findBySQL("Buffer = 1 AND Situation = 'Active'", $this->table, "ID_Code, Title, Slug, Language", NULL, "rand()", 85) : $this->Db->findBySQL("Buffer = 1 AND Language = '$language' AND Situation = 'Active'", $this->table, "ID_Code, Title, Slug, Language", NULL, "rand()", 85);
	}
        
    private function proccessFiles($ID) {
        $files  = POST("file");
        $syntax = POST("syntax");
        $name   = POST("name");
        $code   = POST("code");
        $total  = count($files);
            
        if($total == 0) {
        	return array("error" => getAlert("Files are required"));
        } elseif(count(array_filter($syntax)) != $total) {
        	return array("error" => getAlert("Syntax is required"));
        } elseif(count(array_filter($name)) != $total) {
        	return array("error" => getAlert("Filename is required"));
        } elseif(count(array_filter($code)) != $total) {
        	return array("error" => getAlert("Code is required"));
        }
         
        $data = array();
            
        for($i = 0; $i < $total; $i++) {
            $data[] = array(
                "ID_Code"   => $ID,
                "Name"      => decode(addslashes($name[$i])),
                "ID_Syntax" => decode(addslashes($syntax[$i])),
                "Code"      => decode(addslashes($code[$i]))
            );
        }
            
        return $data;
    }
        
    private function getFilesBy($ID) {
       	$this->Db->select("ID_File");
        $this->Db->from("codes_files");
        $this->Db->where("ID_Code = '$ID'");
            
        $IDs = array();
        
        foreach($this->Db->get() as $value) {
        	$IDs[] = $value["ID_File"];
        }
        
        return $IDs;
    }
        
    private function search($search, $field) {
		if($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);	      
		} else {
			return FALSE;
		}
	}
        
	public function count($type = NULL) {
		if(is_null($type)) {
			return $this->Db->countBySQL("Situation = 'Active'", $this->table);
		} elseif($type === "language") {
			$language = str_replace("-", " ", segment(2, isLang()));

			return $this->Db->countBySQL("(Title LIKE '%$language%' OR Description LIKE '%$language%' OR Languages LIKE '%$language%') AND Situation = 'Active'", $this->table);
		} elseif($type === "author") {
			$user = segment(2, isLang());

			return $this->Db->countBySQL("Author = '$user' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		} elseif($type === "author-language") {
			$user = segment(2, isLang());
			$language = str_replace("-", " ", segment(4, isLang()));

			return $this->Db->countBySQL("Author LIKE '$user' AND (Title LIKE '%$language%' OR Description LIKE '%$language%' OR Languages LIKE '%$language%') AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		}
	}

	public function getByLanguage($language, $limit) {
		$language = str_replace("-", " ", $language);
		return $this->Db->findBySQL("(Title LIKE '%$language%' OR Description LIKE '%$language%' OR Languages LIKE '%$language%') AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Code DESC", $limit);
	}
	
	public function getByID($ID) {
		return $this->Db->find($ID, $this->table, $this->fields);
	}
	
	public function getAll($limit) {		
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Code DESC", $limit);
	}

	public function getAllByAuthor($author, $limit) {		
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author'", $this->table, $this->fields, NULL, "ID_Code DESC", $limit);
	}
	
	public function getAllByLanguage($author, $language, $limit) {
		$language = str_replace("-", " ", $language);

		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author' AND (Title LIKE '%$language%' OR Description LIKE '%$language%' OR Languages LIKE '%$language%')", $this->table, $this->fields, NULL, "ID_Code DESC", $limit);
	}

	public function getCodesByUser($userID) {
		return $this->Db->findBySQL("ID_User = '$userID' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, "ID_Code DESC");
	}

	public function getLanguage($languageID) {
		return $this->Db->findBySQL("ID_Syntax = $languageID", "codes_syntax", "ID_Syntax, Name, MIME, Filename, Extension", NULL, NULL);	
	}

	public function updateViews($codeID) {
		$this->Cache = $this->core("Cache");

		$views = $this->Cache->getValue($codeID, "codes", "Views", TRUE);

		return $this->Cache->setValue($codeID, $views + 1, "codes", "Views", 86400);
	}

    public function setReport($ID) {
        if($this->Db->find($ID, "codes")) {
            $this->Db->updateBySQL("codes", "Reported = (Reported) + 1 WHERE ID_Code = '$ID'");

            showAlert(__("Thanks for reporting this code"), path("codes/go/$ID"));
        } else {
            redirect();
        }
    }
        
    private function implode($array = array(), $glue = ", ") {
        $array = array_filter(array_unique($array));
    
        sort($array);

       	return implode($glue, $array);
    }

    public function activate($ID) {
		return $this->Db->update($this->table, array("Situation" => "Active"), $ID);
	}
}