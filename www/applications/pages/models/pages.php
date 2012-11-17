<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Pages_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table    = "pages";
		$this->fields   = "ID_Page, Title, Language, Content, Principal, Views, Start_Date, Situation";
		$this->language = whichLanguage(); 

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);

		$this->helper("alerts");
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
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);
		}	
	}

	private function search($search, $field) {
		if($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);	      
		} else {
			return FALSE;
		}
	}
	
	private function editOrSave($action) {
		if($action === "save") {
			$validations = array(
				"exists"  => array(
					"Slug" 	   => slug(POST("title", "clean")), 
					"Language" => POST("language")
				),
				"title"   => "required",
				"content" => "required"
			);
		} else {
			$validations = array(
				"title"   => "required",
				"content" => "required"
			);
		}

		$this->helper("time");

		$data = array(
			"ID_User"	 => SESSION("ZanUserID"),
			"Slug"    	 => slug(POST("title", "clean")),
			"Content" 	 => decode(POST("content", "clean")),
			"Start_Date" => now(4),
			"Text_Date"	 => decode(now(2))
		);
		
		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
		
		return FALSE;
	}
	
	private function save() {
		if(POST("principal") > 0) {
			$this->Db->update($this->table, array("Principal" => 0), "Language = '". POST("language") ."'");
		}
		
		$this->Cache = $this->core("Cache");
			
		$this->Cache->removeAll("pages");

		$this->Db->insert($this->table, $this->data);
		
		return getAlert(__("The page has been saved correctly"), "success");
	}
	
	private function edit() {
		$this->Cache = $this->core("Cache");
			
		$this->Cache->removeAll("pages");

		$this->Db->update($this->table, $this->data, POST("ID")); 
			
		return getAlert(__("The page has been edit correctly"), "success");
	}
	
	public function getByDefault() {
		return $this->Db->findBySQL("Language = '$this->language' AND Principal = 1 AND Situation = 'Active'", $this->table, $this->fields);
	}
			
	
	public function getBySlug($slug) {		
		$data = $this->Db->findBySQL("Slug = '$slug' AND Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields);

		if($data) {
			$this->Db->updateBySQL("pages", "Views = (Views) + 1 WHERE ID_Page = '". $data[0]["ID_Page"] ."'");
		}

		return $data;
	}
	
	public function getID($slug) {		
		$data = $this->Db->findBy("Slug", $slug, $this->table, $this->fields);
		
		return (is_array($data)) ? $data[0][$this->primaryKey] : FALSE;
	}
	
	public function getByID($ID) {		
		return $this->Db->find($ID, $this->table, $this->fields);
	}
}