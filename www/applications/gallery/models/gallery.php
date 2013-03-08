<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Gallery_Model extends ZP_Load
{
	public function __construct()
	{
		$this->Db = $this->db();
		$this->table = "gallery";
		$this->fields = "*";
		$this->language = whichLanguage(); 
	}

	public function cpanel($action, $limit = null, $order = "ID_Image DESC", $search = null, $field = null, $trash = false)
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
		if (!$trash) { 
			if (SESSION("ZanUserPrivilegeID") == 1) {
				return $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit);
			} else {
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit);
			}
		} else {
			if (SESSION("ZanUserPrivilegeID") == 1) {
				return $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, null, $order, $limit);
			} else { 
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, null, $order, $limit);
			}
		}
	}

	private function editOrSave($action)
	{
		$this->helper(array("alerts", "files"));

		$this->Files = $this->core("Files");
		$this->Images = $this->core("Images");

		if (!POST("category")) {
			$dir = "www/lib/files/images/gallery/unknown/";
		} else {
			$dir = "www/lib/files/images/gallery/". POST("category") ."/";
		}

		if (!file_exists($dir)) {
			mkdir($dir, 0777);
		}

		$original = array();
		$medium = array();
		$small = array();

		if (is_array(FILES("images", "name"))) {
			$total = count(FILES("images", "name")) - 1;

			for ($i = 0; $i <= $total; $i++) {		
				$ext = getExtension(FILES("images", "name", $i));
				
				$this->Files->filename  = code(10, false) .".". $ext;
				$this->Files->fileType  = FILES("images", "type", $i);
				$this->Files->fileSize  = FILES("images", "size", $i);
				$this->Files->fileError = FILES("images", "error", $i);
				$this->Files->fileTmp   = FILES("images", "tmp_name", $i);

				$upload = $this->Files->upload($dir);				

				if ($upload["upload"]) {					
					$original[] = $this->Images->getResize("original", $dir, $upload["filename"], MIN_ORIGINAL, MAX_ORIGINAL);					
					$medium[]   = $this->Images->getResize("medium", $dir, $upload["filename"], MIN_ORIGINAL, MAX_ORIGINAL);
					$small[]    = $this->Images->getResize("small", $dir, $upload["filename"], MIN_ORIGINAL, MAX_ORIGINAL);
				}
			}
		}
		
		die(var_dump($original));
	}

	private function save()
	{

	}

	private function edit()
	{

	}

	public function getByID($ID, $mode = false)
	{

	}
}