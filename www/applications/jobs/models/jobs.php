<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Jobs_Model extends ZP_Load
{

	public function __construct()
	{
		$this->Db = $this->db();
		$this->language = whichLanguage();
		$this->table = "jobs";
		$this->fields = "ID_Job, ID_User, Company, Title, Slug, Author, Email, Address1, Address2, Logo, Phone, Company_Information, Country, City, Salary, Salary_Currency, Allocation_Time, Requirements, Technologies, Language, Situation";
		$this->Data = $this->core("Data");
		$this->Data->table($this->table);
	}

	public function getRSS()
	{
		return $this->Db->findBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields, null, "ID_Post DESC");
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
		if (!$trash) { 
			return (SESSION("ZanUserPrivilegeID") == 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, "ID_Job, Company, Title, Country, Language, Situation", null, $order, $limit) : 
			$this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, "ID_Job, Title, Country, Situation", null, $order, $limit);
		} else {

			return (SESSION("ZanUserPrivilegeID") == 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, "ID_Job, Company, Title, Country, Language, Situation", null, $order, $limit) : 
			$this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, "D_Job, Title, Country, Situation", null, $order, $limit);
		}
	}

	private function editOrSave($action)
	{
		$validations = array(
			"company" => "required",
			"title" => "required",
			"email" => "email?",
			"address1" => "required",
			"phone" => "required",
			"cinformation" => "required",
			"country" => "required",
			"city" => "required",
			"salary" => "required",
			"salary_currency" => "required",
			"requirements" => "required",
			"technologies" => "required",
		);

		$this->helper(array("alerts", "time", "files"));
		$date = now(4);
		$data = array(
			"ID_User" => SESSION("ZanUserID"),
			"Author" => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Slug" => slug(POST("title", "clean")),
			"Start_Date" => $date,
			"End_Date" => $date + (3600 * 24 * 30)
 		);

 		if (FILES("image", "name")) {
			$dir = "www/lib/files/images/companies/";
			$this->Files = $this->core("Files");
			$data["Logo"] = $this->Files->uploadImage($dir, "image", "normal");

			if (!$data["Logo"]) {
				return getAlert(__("Upload error"));
			}
		}

		$this->Data->change("cinformation", "Company_Information");
		$this->Data->change("allocation", "Allocation_Time");
		$this->Data->change("ccontact", "Company_Contact");
		$this->data = $this->Data->proccess($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function preview()
	{
		if (POST("title") AND POST("email") AND POST("address1") AND POST("logo") AND POST("phone") 
			AND POST("company") AND POST("cinformation") AND POST("country") AND POST("city") AND POST("salary") 
			AND POST("salary_currency") AND POST("allocation") AND POST("requirements") AND POST("technologies") AND POST("language")) {
			return array(
				"Address1" => POST("address1"),
				"Address2" => POST("address2"),
				"Logo" => POST("logo"),
				"Allocation_Time" => POST("allocation"),
				"Author" => SESSION("ZanUser"),
				"Company" => POST("company"),
				"Company_Information" => POST("cinformation"),
				"Country" => POST("country"),
				"City" => POST("city"),
				"Email" => POST("email"),
				"Salary" => POST("salary"),
				"Salary_Currency"=> POST("salary_currency"),
				"Requirements" => stripslashes(encode(POST("requirements", "decode", null))),
				"Language" => POST("language"),
				"Phone" => POST("phone"),
				"Start_Date" => now(4),
				"Technologies" => stripslashes(encode(POST("technologies", "decode", null))),
				"Title" => stripslashes(encode(POST("title", "decode", null))),
			);
		} else {
			return false;
		}
	}

	public function save()
	{
		____($this->data);
		if ($this->Db->insert($this->table, $this->data)) {
		 	return getAlert(__("The job has been saved correctly"), "success");
		}

		return getAlert(__("Insert Error"));
	}

	private function search($search, $field)
	{
		if ($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : 
			$this->Db->findBySQL("$field LIKE '%$search%'", $this->table);
		} else {
			return false;
		}
	}

	public function count($type = null)
	{
		if (is_null($type)) {
			return $this->Db->countBySQL("Situation = 'Active'", $this->table);
		} elseif ($type === "tag") {
			$tag = str_replace("-", " ", segment(2, isLang()));
			return $this->Db->countBySQL("Title LIKE '%$tag%' OR Requirements LIKE '%$tag%' OR Technologies LIKE '%$tag%' AND Situation = 'Active'", $this->table);
		} elseif ($type === "author") {
			$user = segment(2, isLang());
			
			return $this->Db->countBySQL("Author LIKE '$user' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		} elseif ($type === "author-tag") {
			$user = segment(2, isLang());
			$tag = str_replace("-", " ", segment(4, isLang()));
			return $this->Db->countBySQL("Author LIKE '$user' AND (Title LIKE '%$tag%' OR Requirements LIKE '%$tag%' OR Technologies LIKE '%$tag%') 
				AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		}
	}

	public function getBufferJobs($language = "all")
	{
		return ($language === "all") ? $this->Db->findBySQL("Buffer = 1 AND Situation = 'Active'", $this->table, "ID_Job, Title, Slug, Language", null, "rand()", 85) : 
		$this->Db->findBySQL("Buffer = 1 AND Language = '$language' AND Situation = 'Active'", $this->table, "ID_Job, Title, Slug, Language", null, "rand()", 85);
	}

	public function getByTag($tag, $limit)
	{
		$tag = str_replace("-", " ", $tag);
		return $this->Db->findBySQL("Title LIKE '%$tag%' OR Requirements LIKE '%$tag%' OR Technologies LIKE '%$tag%' 
			AND Situation = 'Active'", $this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getByID($ID)
	{
		return $this->Db->findBySQL("ID_Job = '$ID' AND Situation = 'Active' OR Situation = 'Pending'", $this->table, $this->fields);
	}

	public function getAll($limit) {
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getAllByAuthor($author, $limit)
	{
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author'", 
			$this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getAllByTag($author, $tag, $limit)
	{
		$tag = str_replace("-", " ", $tag);
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author' AND (Title LIKE '%$tag%' OR 
			Requirements LIKE '%$tag%' OR Technologies LIKE '%$tag%')", $this->table, $this->fields, null, "ID_Bookmark DESC", $limit);
	}

	public function getAllByUser()
	{
		return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, null, "ID_Job DESC");
	}

	public function updateViews($jobID)
	{
		$this->Cache = $this->core("Cache");
		$views = $this->Cache->getValue($jobID, "jobs", "Views", true);
		return $this->Cache->setValue($jobID, $views + 1, "jobs", "Views", 86400);
	}

	public function removePassword($ID)
	{
		$this->Db->update($this->table, array("Pwd" => ""), $ID);
	}

	private function edit()
	{
		if ($this->Db->update($this->table, $this->data, POST("ID"))) {
            return getAlert(__("The job has been edit correctly"), "success");
        }

        return getAlert(__("Update error"));
	}

	public function getCountries()
	{
		$data = $this->Db->findAll("world", "Country", "Country","Country ASC");
		$i = 0;
		foreach ($data as $country) {
			$countries[$i]["Country"] = __($country["Country"]);
			$i++;
		}

		sort($countries);
		return $countries;
	}
}