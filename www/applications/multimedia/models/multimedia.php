<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Multimedia_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();

		$this->language = whichLanguage();
		$this->table 	= "multimedia";
		$this->fields   = "ID_File, Filename, URL, Category, Size, Author, Start_Date, Downloads, Situation";

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit) {	
		if(!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit);
		}
	}
	
	private function editOrSave($action) {	
		$this->helper("alerts");
		
		$this->Files = $this->core("Files");

		$files = $this->Files->createFiles(POST("names"), POST("files"), POST("types"), POST("sizes"), POST("filenames"));

		$this->helper("time");

		if(is_array($files)) {
			for($i = 0; $i <= count($files) - 1; $i++) {
				$this->data[] = array(
					"ID_User"  	 => SESSION("ZanUserID"),
					"Filename" 	 => isset($files[$i]["filename"]) ? $files[$i]["filename"] : NULL,
					"URL" 	   	 => isset($files[$i]["url"]) ? $files[$i]["url"] : NULL,
					"Category"   => isset($files[$i]["category"]) ? $files[$i]["category"] : NULL,
					"Size"		 => isset($files[$i]["size"]) ? $files[$i]["size"] : NULL,
					"Author"	 => SESSION("ZanUser"),
					"Start_Date" => now(4)
				);
			}
		} else {
			return getAlert(__("Error while tried to upload the files"));
		}
	}
	
	private function save() {			
		if($this->Db->insertBatch($this->table, $this->data)) {
			return getAlert(__("The files has been saved correctly"), "success");
		}

		return getAlert(__("Error while tried to upload the files"), "success");
	}
	
	private function edit() {	
		$this->update("url", array("URL" => $this->URL), POST("ID_URL"));		
		
		$this->Db->update($this->table, $this->data, POST("ID"));				
		
		$purge = $this->Db->deleteBySQL("ID_Record = '". POST("ID") ."'", "re_categories_records");

		if(is_array($this->categories)) {						
			foreach($this->categories as $category) {
				$categories[] = $this->Db->findBy("ID_Category", $category, "re_categories_applications");
			}						
			
			foreach($categories as $category) {
				$category = $category[0]["ID_Category2Application"];
				$exist    = $this->Db->findBySQL("ID_Category2Application = '$category' AND ID_Record = '". POST("ID") ."'", "re_categories_records");
				
				if(!$exist) {
					$data = array(
							"ID_Category2Application" => $category,
							"ID_Record"		  => POST("ID")
						);
						
					$insert = $this->Db->insert($this->table, $data);					
				}
			}
		}
		
		$this->Tags_Model = $this->model("Tags_Model");
		
		$this->Tags_Model->setTagsByRecord(3, $this->tags, POST("ID"));
	
		if(!is_array($this->mural) and !$this->muralExist) {
			$values = array(
				"ID_Post" => POST("ID"),
				"Title"	  => $this->data["Title"],
				"URL"	  => $this->URL, 
				"Image"	  => $this->mural
			);
		
			$this->Db->insert("mural", $values);	
		} elseif(!is_array($this->mural) and $this->muralExist) {
			unlink($this->muralExist);
						
			$this->Db->deleteBy("ID_Post", POST("ID"), "mural");
			
			$values = array(
				"ID_Post" => POST("ID"),
				"Title"	  => $this->title,
				"URL"	  => $this->URL, 
				"Image"	  => $this->mural
			);
			
			$this->Db->insert("mural", $values);	
		}
		
		return getAlert("The post has been edited correctly", "success", $this->URL);
	}
	
	private function search($search, $field) {
		if($search and $field) {
			if($field === "ID") {
				$data = $this->Db->find($search, $this->table);	
			} else {
				$data = $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);
			}
		} else {
			return FALSE;
		}
		
		return $data;
	}
	
	public function getByID($ID) {			
		$data = $this->Db->find($ID, $this->table, $this->fields);
		
		return $data;
	}
	
}
