<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Multimedia_Model extends ZP_Load
{
	public function __construct()
	{
		$this->Db = $this->db();

		$this->language = whichLanguage();
		
		$this->table = "multimedia";
		$this->fields = "ID_File, Filename, URL, Category, Size, Author, Start_Date, Downloads, Situation";
		
		$this->Data = $this->core("Data");
		$this->Data->table($this->table);
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
		$this->helper("alerts");

		$this->Files = $this->core("Files");
		
		$files = $this->Files->createFiles(POST("names"), POST("files"), POST("types"), POST("sizes"), POST("filenames"));
		
		$this->helper("time");

		if (is_array($files)) {
			for ($i = 0; $i <= count($files) - 1; $i++) {
				$this->data[] = array(
					"ID_User"  	 => SESSION("ZanUserID"),
					"Filename" 	 => isset($files[$i]["filename"]) ? decode($files[$i]["filename"]) : null,
					"URL" 	   	 => isset($files[$i]["url"]) ? $files[$i]["url"] : null,
					"Category" 	 => isset($files[$i]["category"]) ? $files[$i]["category"] : null,
					"Size" 		 => isset($files[$i]["size"]) ? $files[$i]["size"] : null,
					"Author" 	 => SESSION("ZanUser"),
					"Start_Date" => now(4)
				);
			}
		} else {
			return getAlert(__("Error while tried to upload the files"));
		}
	}

	private function save()
	{
		if ($this->Db->insertBatch($this->table, $this->data)) {
			return getAlert(__("The files has been saved correctly"), "success");
		}

		return getAlert(__("Error while tried to upload the files"), "success");
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

	public function getMultimedia($category = "all")
	{
		if ($category === "all") {
			return $this->Db->findAll($this->table, $this->fields);
		} else { 
			return $this->Db->findBy("Category", $category, $this->table, $this->fields);
		}
	}
}