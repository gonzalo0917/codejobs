<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Works_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();			
		
		$this->language = whichLanguage();
		$this->table = "works";
		$this->fields   = "ID_Work, Title, Slug, Preview1, Preview2, Image, URL, Description, Situation";

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Work DESC", $search = NULL, $field = NULL, $trash = FALSE) {		
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
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, "ID_Work, Title, Description, URL, Image, Preview1, Preview2, Situation", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, "ID_Work, Title, Description, URL, Image, Preview1, Preview2, Situation", NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, "ID_Work, Title, Description, URL, Image, Preview1, Preview2, Situation", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, "ID_Work, Title, Description, URL, Image, Preview1, Preview2, Situation", NULL, $order, $limit);
		}
	}
	
	private function editOrSave($action) {		
		$validations = array(
			"title" 		   => "required",
			"description"	   => "required",
			"URL"              => "required"
		);

		$this->helper(array("alerts", "time", "files"));
		
		$date = now(4);

		$data = array(
			"ID_User" 	 => SESSION("ZanUserID"),
			"Slug"    	 => slug(POST("title", "clean")),
 		);

 		$this->Data->ignore(array("image_last", "preview1_last", "preview2_last"));

 		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}

		if(FILES("image", "name")) {
			if(POST("image_last")) {
				@unlink(POST("image_last"));
			}
			
			$dir = "www/lib/files/images/works/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Image"] = $this->Files->uploadImage($dir, "image", "normal");

			if(!$this->data["Image"]) {
				return getAlert(__("Upload error"));
			}
		}

		if(FILES("preview1", "name")) {
			if(POST("preview1_last")) {
				@unlink(POST("preview1_last"));
			}
			
			$dir = "www/lib/files/images/works/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Preview1"] = $this->Files->uploadImage($dir, "preview1", "normal");

			if(!$this->data["Preview1"]) {
				return getAlert(__("Upload error"));
			}
		}

		if(FILES("preview2", "name")) {
			if(POST("preview2_last")) {
				@unlink(POST("preview2_last"));
			}
			
			$dir = "www/lib/files/images/works/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Preview2"] = $this->Files->uploadImage($dir, "preview2", "normal");

			if(!$this->data["Preview2"]) {
				return getAlert(__("Upload error"));
			}
		}

	}
	
	private function save() {
		if($this->Db->insert($this->table, $this->data)) {
		 	return getAlert(__("The work has been saved correctly"), "success");
		}

		return getAlert(__("Insert Error"));
	}
	
	private function edit() {
		if($this->Db->update($this->table, $this->data, POST("ID"))) {
            return getAlert(__("The work has been edit correctly"), "success");
        }
        
        return getAlert(__("Update error"));
	}
	
	public function getByID($ID) {
		return $this->Db->findBySQL("ID_Work = '$ID' AND Situation != 'Deleted'", $this->table, $this->fields);
	}

	public function getImg1($ID) {
		return $this->Db->findBySQL("ID_Work = '$ID' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, "Image");
	}

	private function search($search, $field) {
		if($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);	      
		} else {
			return FALSE;
		}
	}

	public function getAll($limit) {		
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, NULL, "ID_Work DESC", $limit);
	}

	public function getAllByUser() {
		return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, "ID_Work DESC");
	}

	public function updateViews($workID) {
		$this->Cache = $this->core("Cache");

		$views = $this->Cache->getValue($workID, "works", "Views", TRUE);

		return $this->Cache->setValue($workID, $views + 1, "works", "Views", 86400);
	}

	public function getWorks($position = NULL) {			
		$this->Db->select("Title, Slug, Preview1, Preview2, Image, URL, Description");	
		
		return $this->Db->findBySQL("Situation = 'Active'", $this->table);
	}
	
}