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
			"title"     => "required",
			"miniature" => "required",
			"large"     => "required",
			"URL"       => "ping"
		);

		if (POST("principal") === "0" or $action === "edit") {
			unset($validations["large"]);
		}

		if (POST("code")) {
			unset($validations["URL"]);
		}

		$this->helper(array("alerts", "time", "files"));

		if (POST("date") === "never") {
			$end_date = 0;
		} else {
			$date_parts = explode("/", POST("end_date"));
			$end_date = mktime(23, 59, 59, $date_parts[1], $date_parts[0], $date_parts[2]);
		}

		$data = array(
			"ID_User"    => SESSION("ZanUserID"),
			"Start_Date" => now(4),
			"End_Date"   => $end_date
		);

		if ($action === "edit") {
			$this->Data->ignore("banner");

			unset($validations["miniature"]);
		}

		$this->Data->ignore(array("date", "large", "miniature", "MAX_FILE_SIZE"));

		$this->data = $this->Data->process($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}

		if (POST("large") or POST("miniature")) {
			$this->Files = $this->core("Files");

			$dir  = "www/lib/files/images/ads";
			$name = slug(POST("title", "clean"));

			if (POST("large")) {
				if (POST("banner")) {
					@unlink(POST("banner") .".png");
				}

				if (!$this->Files->createFileFromBase64(POST("large", "clean"), "$dir/$name.png")) {
					return getAlert(__("Upload error"));
				}
			}

			if (POST("miniature")) {
				if (POST("banner")) {
					@unlink(POST("banner") ."_small.png");
				}

				if (!$this->Files->createFileFromBase64(POST("miniature", "clean"), "$dir/{$name}_small.png")) {
					return getAlert(__("Upload error"));
				}
			}

			if (POST("principal") === "0" and POST("banner")) {
				@unlink(POST("banner") .".png");
			}

			$this->data["Banner"] = "$dir/$name";
		}

		$this->Cache = $this->core("Cache");
		$this->Cache->removeAll("ads");
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
	
	public function getAds($principal = 0)
	{		
		$date = now(4);

		if ($principal === 1) {
			return $this->Db->findBySQL("Situation = 'Active' AND (End_Date >= $date OR End_Date = 0) AND Principal = 1", $this->table, $this->fields);
		} else {
			return $this->Db->findBySQL("Situation = 'Active' AND (End_Date >= $date OR End_Date = 0)", $this->table, $this->fields);
		}
	}
}