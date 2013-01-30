<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Bookmarks_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table  = "bookmarks";
		$this->fields = "ID_Bookmark, Title, Slug, URL, Description, Tags, Author, Views, Likes, Dislikes, Reported, Language, Start_Date, Situation";
		$this->language = whichLanguage();

		$this->Data = $this->core("Data");

		$this->Data->table("bookmarks");

		$this->helper("alerts");
	}

	public function getRSS() {	
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Bookmark DESC", _maxLimit);
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Bookmark DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
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

	private function search($search, $field) {
		if($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);	      
		} else {
			return FALSE;
		}
	}
	
	private function all($trash, $order, $limit, $own = FALSE) {
		$fields = "ID_Bookmark, ID_User, Title, Slug, URL, Author, Views, Reported, Language, Start_Date, Situation";

		if(!$trash) {			
			return (SESSION("ZanUserPrivilegeID") == 1 and !$own) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit);
		} else {	
			return (SESSION("ZanUserPrivilegeID") == 1 and !$own) ? $this->Db->findBy("Situation", "Deleted", $this->table, $fields, NULL, $order, $limit) 	   : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $fields, NULL, $order, $limit);	
		}				
	}
	
	private function editOrSave($action) {
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
			return getAlert(__("Author is not a valid user"));
		}

		$data = array(
			"ID_User" 	 => $ID_User,
			"Author"  	 => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Slug"    	 => slug(POST("title", "clean")),
			"Title"		 => stripslashes(POST("title"))
		);

		if($action === "save") {
			$validations = array(
				"exists"  => array(
					"URL" => POST("URL")
				),
				"title" 	  => "required",
				"description" => "required"
			);

			$data["Start_Date"] = now(4);
		} else {
			$validations = array(
				"title" 	  => "required",
				"description" => "required"
			);			

			$data["Modified_Date"] = now(4);
		}

		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function add($action = "save") {
		$error = $this->editOrSave($action);

		if($error) {
			return $error;
		}
		
		$this->data["Situation"] = (SESSION("ZanUserPrivilegeID") == 1 OR SESSION("ZanUserRecommendation") > 100) ? "Active" : "Pending";

		if($action === "save") {
			$return = $this->Db->insert($this->table, $this->data);

			$this->Users_Model = $this->model("Users_Model");
			$this->Users_Model->setCredits(1, 9);
		} elseif($action === "edit") {
			$return = $this->Db->update($this->table, $this->data, POST("ID"));
		}

		if($this->data["Situation"] === "Active") {
			$this->Cache = $this->core("Cache");

			$this->Cache->removeAll("bookmarks");
		}
		
		if($return) {
			return getAlert(__("The bookmark has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}

	public function preview() {
		if(POST("description") AND POST("language") AND POST("title") AND POST("URL")) {
			return array(
				"ID"			=> POST("ID"),
				"Author"  		=> SESSION("ZanUser"),
				"Description" 	=> stripslashes(encode(POST("description", "decode", NULL))),
				"Language" 		=> POST("language"),
				"Start_Date"	=> now(4),
				"Tags" 			=> stripslashes(encode(POST("tags", "decode", NULL))),
				"Title" 		=> stripslashes(encode(POST("title", "decode", NULL))),
				"URL" 			=> stripslashes(encode(POST("URL", "decode", NULL)))
			);
		} else {
			return FALSE;
		}
	}
	
	private function save() {
		if($this->Db->insert($this->table, $this->data)) {
			$this->Cache = $this->core("Cache");	

			$this->Cache->removeAll("bookmarks");

			$this->Users_Model = $this->model("Users_Model");
			
			$this->Users_Model->setCredits(1, 9);

			return getAlert(__("The bookmark has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function edit() {
		$this->Db->update($this->table, $this->data, POST("ID"));

		$this->Cache = $this->core("Cache");	
		$this->Cache->removeAll("bookmarks");
		
		return getAlert(__("The bookmark has been edit correctly"), "success");
	}

	public function count($type = NULL) {
		if(is_null($type)) {
			return $this->Db->countBySQL("Situation = 'Active'", $this->table);
		} elseif($type === "tag") {
			$tag = str_replace("-", " ", segment(2, isLang()));

			return $this->Db->countBySQL("Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table);
		} elseif($type === "author") {
			$user = segment(2, isLang());
			
			return $this->Db->countBySQL("Author LIKE '$user' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		} elseif($type === "author-tag") {
			$user = segment(2, isLang());
			$tag  = str_replace("-", " ", segment(4, isLang()));
			
			return $this->Db->countBySQL("Author LIKE '$user' AND (Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%') AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		}
	}

	public function getBufferBookmarks($language = "all") {
		return ($language === "all") ? $this->Db->findBySQL("Buffer = 1 AND Situation = 'Active'", $this->table, "ID_Bookmark, Title, Slug, Language", NULL, "rand()", 25) : $this->Db->findBySQL("Buffer = 1 AND Language = '$language' AND Situation = 'Active'", $this->table, "ID_Bookmark, Title, Slug, Language", NULL, "rand()", 25);
	}

	public function getByTag($tag, $limit) {
		$tag = str_replace("-", " ", $tag);
		
		return $this->Db->findBySQL("Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Bookmark DESC", $limit);
	}
	
	public function getByID($ID) {
		return $this->Db->findBySQL("ID_Bookmark = '$ID' AND Situation = 'Active' OR Situation = 'Pending'", $this->table, $this->fields);
	}
	
	public function getBookmarkByID($ID) {
		return $this->Db->findBySQL("Situation != 'Deleted' AND ID_User = ". SESSION("ZanUserID") ." AND ID_Bookmark = ". $ID, $this->table, $this->fields);
	}
	
	public function getAll($limit) {		
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Bookmark DESC", $limit);
	}
	
	public function getAllByAuthor($author, $limit) {		
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author'", $this->table, $this->fields, NULL, "ID_Bookmark DESC", $limit);
	}
	
	public function getAllByTag($author, $tag, $limit) {
		$tag = str_replace("-", " ", $tag);

		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author' AND (Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%')", $this->table, $this->fields, NULL, "ID_Bookmark DESC", $limit);
	}

	public function getAllByUser() {
		return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, "ID_Bookmark DESC");
	}

	public function updateViews($bookmarkID) {
		$this->Cache = $this->core("Cache");

		$views = $this->Cache->getValue($bookmarkID, "bookmarks", "Views", TRUE);

		return $this->Cache->setValue($bookmarkID, $views + 1, "bookmarks", "Views", 86400);
	}

	public function setReport($ID) {
		if($this->Db->find($ID, "bookmarks")) {
			$this->Db->updateBySQL("bookmarks", "Reported = (Reported) + 1 WHERE ID_Bookmark = '$ID'");

			showAlert(__("Thanks for reporting this bookmark"), path("bookmarks/go/$ID"));
		} else {
			redirect();
		}
	}

	public function activate($ID) {
		return $this->Db->update($this->table, array("Situation" => "Active"), $ID);
	}

	public function find($query, $order, $limit, $own = FALSE) {
		$fields = "ID_Bookmark, ID_User, Title, Slug, URL, Author, Views, Reported, Language, Start_Date, Situation";

		return (SESSION("ZanUserPrivilegeID") === 1 and !$own) ? $this->Db->findBySQL("Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, $fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, $fields, NULL, $order, $limit);
	}

	public function found($query, $order, $own = FALSE) {
		return (SESSION("ZanUserPrivilegeID") === 1 and !$own) ? $this->Db->findBySQL("Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, "COUNT(1) AS Total", NULL, $order) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, "COUNT(1) AS Total", NULL, $order);
	}

	public function records($action, $start = 0, $end = _maxLimit, $order = NULL, $search = FALSE) {
		if(is_null($order)) {
			$order = "ID_Bookmark DESC";
		}

		if($action === "all") {
			return $this->all(FALSE, $order, "$start, $end", TRUE);
		} elseif($action === "records") {
			$data = $this->all(FALSE, $order, "$start, $end", TRUE);

			return $this->processRecords($data);
		} else {
			$data = $this->find($action, $order, "$start, $end", TRUE);
			$data = $this->processRecords($data);

			if($start === 0) {
				$total = $this->found($action, $order, TRUE);

				if($data) {
					array_unshift($data, $total[0]);
				} else {
					$data = array("0");
				}
			}

			return $data;
		}
	}

	private function processRecords($data) {
		if(is_array($data)) {
			foreach($data as $key => $record) {
				if(isset($record["Language"])) {
					$data[$key]["Language"] = getLanguage($record["Language"], TRUE);
				}

				if(isset($record["Start_Date"])) {
					$this->helper("time");

					$data[$key]["Start_Date"] = ucfirst(howLong($record["Start_Date"]));
				}

				if(isset($record["End_Date"])) {
					$this->helper("time");

					$data[$key]["End_Date"] = ucfirst(howLong($record["End_Date"]));
				}

				if(isset($record["Modified_Date"])) {
					$this->helper("time");

					$data[$key]["Modified_Date"] = ucfirst(howLong($record["Modified_Date"]));
				}

				if(isset($record["Situation"])) {
					$data[$key]["Situation"] = __($record["Situation"]);
				}

				if(isset($record["Views"])) {
					$data[$key]["Views"] = (int)$record["Views"];
				}
			}
		}

		return $data;
	}
}