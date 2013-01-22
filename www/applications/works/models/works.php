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
		$this->fields   = "ID_Work, Slug, Preview1, Preview2, Image, URL, Description, Situation";

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
		$this->Db->select("ID_Post, Title, Author, Views, Language, Situation");
		
		if(!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, NULL, $order, $limit);
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
			#"Author"  	 => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Slug"    	 => slug(POST("title", "clean")),
 		);

 		$this->data = $this->Data->proccess($data, $validations);
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}

		if(FILES("image", "name")) {
 
			if(POST("image")) {
				@unlink(POST("image"));
			}
			
			$dir = "www/lib/files/images/works/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Image"] = $this->Files->uploadImage($dir, "image", "normal");
			if(!$this->data["Image"]) {
				return getAlert(__("Upload error"));
			}
		}

		if(FILES("preview1", "name")) {
 
			if(POST("preview1")) {
				@unlink(POST("preview1"));
			}
			
			$dir = "www/lib/files/images/works/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Preview1"] = $this->Files->uploadImage($dir, "preview1", "normal");
			if(!$this->data["Preview1"]) {
				return getAlert(__("Upload error"));
			}
		}

		if(FILES("preview2", "name")) {
 
			if(POST("preview2")) {
				@unlink(POST("preview2"));
			}
			
			$dir = "www/lib/files/images/works/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Preview2"] = $this->Files->uploadImage($dir, "preview2", "normal");
			if(!$this->data["Preview2"]) {
				return getAlert(__("Upload error"));
			}
		}

		____($data);

	}
	
	private function save() {
		
		if($this->Db->insert($this->table, $this->data)) {
		 	return getAlert(__("The work has been saved correctly"), "success");
		}

		return getAlert(__("Insert Error"));
	}
	
	private function edit() {
		if($this->Db->update($this->table, $this->data, POST("ID"))) {
            return getAlert(__("The job has been edit correctly"), "success");
        }
        
        return getAlert(__("Update error"));
	}
	
	public function getByID($ID) {
		$thid->Db->select("ID_Work, Title, Slug, Preview1, Preview2, Image, URL, Description, Situation");

		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
}