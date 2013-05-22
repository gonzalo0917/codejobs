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
		$this->fields = "ID_Job, ID_User, Title, Company, Slug, Author, Country, City, City_Slug, Salary, Salary_Currency, Allocation_Time, Description, Tags, Email, Type, Type_Url, Language, Start_Date, Situation, Counter";
		$this->Data = $this->core("Data");
		$this->Data->table($this->table);
		$this->Email = $this->core("Email");
 	 	$this->Email->fromName = _get("webName");
 		$this->Email->fromEmail = _get("webEmailSend");
 		$this->helper(array("time", "alerts"));
 		$date = now(4);
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
			"country" => "required",
			"city" => "required",
			"salary" => "required",
			"salary_currency" => "required",
			"description" => "required",
			"tags" => "required",
		);

		$this->helper(array("alerts", "time", "files"));
		$date = now(4);
		$data = array(
			"ID_User" => SESSION("ZanUserID"),
			"Author" => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Slug" => slug(POST("title", "clean")),
			"City_Slug" => slug(POST("city", "clean")),
			"Start_Date" => $date,
			"End_Date" => $date + (3600 * 24 * 30)
 		);

		$this->Data->change("allocation", "Allocation_Time");
		$this->data = $this->Data->process($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function preview()
	{
		if (POST("title") AND POST("email") AND POST("type") AND POST("typeurl")  AND POST("phone") AND POST("company") AND POST("country") AND POST("city") AND POST("salary") 
			AND POST("salary_currency") AND POST("allocation") AND POST("description") AND POST("language") AND POST("counter")) {
			return array(
				"Allocation_Time" => POST("allocation"),
				"Author" => SESSION("ZanUser"),
				"Company" => POST("company"),
				"Country" => POST("country"),
				"City" => POST("city"),
				"Tags" => stripslashes(encode(POST("tags", "decode", null))),
				"Email" => POST("email"),
				"Type" => POST("type"),
				"Type_Url" => POST("typeurl"),
				"Salary" => POST("salary"),
				"Salary_Currency"=> POST("salary_currency"),
				"Description" => stripslashes(encode(POST("requirements", "decode", null))),
				"Language" => POST("language"),
				"Phone" => POST("phone"),
				"Start_Date" => now(4),
				"End_Date" => $date + (3600 * 24 * 30),
				"Title" => stripslashes(encode(POST("title", "decode", null))),
			);
		} else {
			return false;
		}
	}

	public function save()
	{
		if ($this->Db->insert($this->table, $this->data)) {
		 	return getAlert(__("The job has been saved correctly"), "success");
		}

		return getAlert(__("Insert Error"));
	}

	public function searching()
	{
		$this->helper("alerts");
		$find = POST("find");
		$type = POST("type");

		if ($find == "") {
			redirect(path("jobs/"));
		} elseif ($type == "Tag") {
			redirect(path("jobs/tag/". POST("find")));
		} elseif ($type == "Author") {
			redirect(path("jobs/author/". POST("find")));
		} elseif ($type == "Company") {
			redirect(path("jobs/company/". POST("find")));
		} elseif ($type == "City") {
			$find = str_replace(" ", "-", POST("find"));
			redirect(path("jobs/city/". $find));
		}
	}

	public function saveVacancy()
	{
		$jname = POST("jname");
		$jauthor = POST("jauthor");
		$message = POST("message");
		$jid = POST("jid");
		$email2 = $this->Db->query("SELECT Email FROM ". DB_PREFIX ."jobs WHERE ID_Job = '$jid' ORDER BY ID_Job DESC");

		$this->Files = $this->core("Files");
		$this->helper(array("alerts", "forms", "files"));
		$this->Users_Model = $this->model("Users_Model");
		$getcounter = $this->Db->query("SELECT Counter FROM ". DB_PREFIX ."jobs WHERE ID_Job = '$jid' ORDER BY ID_Job DESC");
		$vtype = $this->Db->query("SELECT Type FROM ". DB_PREFIX ."jobs WHERE ID_Job = '$jid' ORDER BY ID_Job DESC");
		$query = "SELECT Counter FROM ". DB_PREFIX ."jobs WHERE ID_Job = '$jid' ORDER BY ID_Job DESC";

		if ($vtype[0]["Type"] == "External") {
			$url = $this->Db->query("SELECT Type_Url FROM ". DB_PREFIX ."jobs WHERE ID_Job = '$jid' ORDER BY ID_Job DESC");
			$counter = $getcounter[0]["Counter"] + 1;
			
			$data = array(
				"Counter" => $counter,
			);

			$this->Db->update("jobs", $data, $jid);

			$data2 = array(
					"Job_Name"	 	 => $jname,
					"ID_Job"		 => $jid,
					"Job_Author" 	 => decode($jauthor),
					"ID_User" 		 => SESSION("ZanUserID"),
					);

			$this->Db->insert("vacancy", $data2);
			redirect($url[0]["Type_Url"], true);
		} else {
			$counter = $getcounter[0]["Counter"] + 1;
			$data2 = array(
				"Counter" => $counter,
			);

			$this->Db->update("jobs", $data2, $jid);
			$data = $this->Users_Model->getUserData(true);
			if (isset($data[0]["Email"])) {
				$email = $data[0]["Email"];
			}

			$dir = "www/lib/files/documents/cv/";

			if (!file_exists($dir)) {
				mkdir($dir, 0777);
			}

			if (FILES("cv", "name")) {
				$ext = getExtension(FILES("cv", "name"));

				$this->Files->filename  = "cv_". slug(SESSION("ZanUser")) .".". $ext;
				$this->Files->fileType  = FILES("cv", "type");
				$this->Files->fileSize  = FILES("cv", "size");
				$this->Files->fileError = FILES("cv", "error");
				$this->Files->fileTmp   = FILES("cv", "tmp_name");
				$upload = $this->Files->upload($dir, "document");
				if (isset($upload["filename"])) {
					$cv = $dir . $upload["filename"];
				} else {
					return getAlert(__("Error uploading file"));
				}
			}

			if ($jid and $jname and $jauthor and $message) {
				$data = array(
					"Job_Name"	 	 => $jname,
					"ID_Job"		 => $jid,
					"Job_Author" 	 => decode($jauthor),
					"ID_User" 		 => SESSION("ZanUserID"),
					"Cv" 			 => $cv,
					"Vacancy" 	 	 => decode(SESSION("ZanUserName")),
					"Vacancy_Email"  => $email,
					"Message" 	 	 => $message,
				);
				$this->Db->insert("vacancy", $data);
				$this->Email->email = $email2[0]["Email"];
				$this->Email->subject = __("An user has applied to your job")." - ". _get("webName");
				$this->Email->message = $this->view("apply_email", array(), "jobs", true);
				$this->Email->send();
				return showAlert(__("An email has been sent to the recluiter"), path("jobs/". POST("jid")));
			} else {
				return false;
			}
		}
	}

	public function getVacancy()
	{
		$author = SESSION("ZanUser");
		return $this->Db->query("SELECT Job_Name, ID_Job, Job_Author, ID_User, Vacancy, Cv, Vacancy_Email, Message FROM ". DB_PREFIX ."vacancy WHERE Job_Author = '$author' ORDER BY ID_Vacancy DESC");
	}

	public function downloadCv()
	{
		$user = segment(2, isLang());
		$job = segment(3, isLang());
		$email = $this->Db->query("SELECT Email FROM ". DB_PREFIX ."users WHERE ID_User = '$user' ORDER BY ID_User DESC");
		$cv = $this->Db->query("SELECT Cv FROM ". DB_PREFIX ."vacancy WHERE ID_Job = '$job' AND ID_User = '$user' ORDER BY ID_Vacancy DESC");

		$this->Email->email = $email[0]["Email"];
		$this->Email->subject = __("A recluiter has downloaded your cv");
		$this->Email->message = $this->view("download_cv", array(), "jobs", true);
		$this->Email->send();
		redirect(path($cv[0]["Cv"], true));
	}

	public function isVacancy()
	{
		$jid = segment(1, isLang());
		$user = SESSION("ZanUserID");
		$data = $this->Db->query("SELECT ID_Job, ID_User FROM ". DB_PREFIX ."vacancy WHERE ID_Job = '$jid' AND ID_User = '$user' ORDER BY ID_Vacancy DESC");
		return $data;
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
			return $this->Db->countBySQL("Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table);
		} elseif ($type === "author") {
			$user = segment(2, isLang());
			return $this->Db->countBySQL("Author LIKE '$user' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		} elseif ($type === "author-tag") {
			$user = segment(2, isLang());
			$tag  = str_replace("-", " ", segment(4, isLang()));
			$query = "Author LIKE '$user' AND (Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%') AND (Situation = 'Active' OR Situation = 'Pending')";
			return $this->Db->countBySQL($query, $this->table);
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
		return $this->Db->findBySQL("Title LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table, $this->fields, null, "ID_Job DESC", $limit);

	}

	public function getByID($ID)
	{
		return $this->Db->findBySQL("ID_Job = '$ID' AND Situation = 'Active' OR Situation = 'Pending'", $this->table, $this->fields);
	}

	public function getAll($limit) 
	{
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getAllByAuthor($author, $limit)
	{
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author'", $this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getAllByCity($city, $limit)
	{	
		$city = str_replace("-", " ", $city);
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND City = '$city'", $this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getAllByCompany($company, $limit)
	{
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Company = '$company'", $this->table, $this->fields, null, "ID_Job DESC", $limit);
	}

	public function getCities() {
		return $this->Db->query("SELECT City, City_Slug, Country, COUNT(*) AS Total FROM ". DB_PREFIX ."jobs GROUP BY City ORDER BY Total DESC");
	}

	public function getAllByTag($author, $tag, $limit)
	{
		$tag = str_replace("-", " ", $tag);
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author' AND (Title LIKE '%$tag%' OR 
			Tags LIKE '%$tag%')", $this->table, $this->fields, null, "ID_Job DESC", $limit);
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