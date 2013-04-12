<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Ads_Model extends ZP_Load
{
	
	public function __construct()
	{
		$this->Db = $this->db();
			
		$this->table  = "ads";
		$this->fields = "ID_Ad, Title, Banner, Time, URL, Principal, End_Date, Situation";
		
		$this->Data = $this->core("Data");
	}

	public function cpanel($action, $limit = null, $order = "Language DESC", $search = null, $field = null, $trash = false)
	{
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if ($validation) {
				return $validation;
			}
		}
		
		if ($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif ($action === "edit") {
			return $this->edit();															
		} elseif ($action === "save") {
			return $this->save();
		} elseif ($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit)
	{	
		$userID = SESSION("ZanUserID");

		if (!$trash) {
			if (SESSION("ZanUserPrivilegeID") == 1) {
				return $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit);
			} else {
				return $this->Db->findBySQL("ID_User = '". $userID ."' AND Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit);
			}
		} else {
			if (SESSION("ZanUserPrivilegeID") == 1) {
				return $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, null, $order, $limit);
			} else {
				return $this->Db->findBySQL("ID_User = '". $userID ."' AND Situation = 'Deleted'", $this->table, $this->fields, null, $order, $limit);
			}
		}	
	}
	
	private function editOrSave($action)
	{
		$validations = array(
			"title" => "required",
			"URL"   => "ping"
		);

		if (POST("code")) {
			unset($validations["URL"]);
		}

		$this->helper(array("alerts", "time", "files"));

		$date_parts = explode("/", POST("end_date"));

		$data = array(
			"ID_User"    => SESSION("ZanUserID"),
			"Start_Date" => now(4),
			"End_Date"   => mktime(23, 59, 59, $date_parts[1], $date_parts[0], $date_parts[2])
		);

		if ($action === "edit") {
			$this->Data->ignore("banner");
		}

		$this->data = $this->Data->process($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}

		if (FILES("image", "name")) {
			if (POST("banner")) {
				@unlink(POST("banner"));
			}
			
			$dir = "www/lib/files/images/ads/";
			
			$this->Files = $this->core("Files");									
			
			$this->data["Banner"] = $this->Files->uploadImage($dir, "image", "normal");
			
			if (!$this->data["Banner"]) {
				return getAlert(__("Upload error")); 
			}
		}
	}
	
	private function save()
	{		
		$this->Db->insert($this->table, $this->data);
					
		return getAlert(__("The ad has been saved correctly"), "success");	
	}
	
	private function edit()
	{	
		$this->Db->update($this->table, $this->data, POST("ID"));
	
		return getAlert(__("The ad has been edited correctly"), "success");
	}
	
	private function search($search, $field)
	{
		if ($search and $field) {
			if ($field === "ID") {
				$data = $this->Db->find($search, $this->table, $this->fields);	
			} else {
				$data = $this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);
			}
		} else {
			return false;
		}
		
		return $data;		
	}
	
	public function getByID($ID)
	{		
		return $this->Db->find($ID, $this->table, $this->fields);
	}
	
	public function getAds($tag = null)
	{		
		$date = now(4);
		return $this->Db->findBySQL("Tag = '$tag' AND Situation = 'Active' AND End_Date >= $date", $this->table, $this->fields);
	}
}