<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Bookmarks_Model extends ZP_Load 
{
	
	public function __construct() 
	{
		$this->Db = $this->db();

		$this->table = "bookmarks";
		$this->fields = "ID_Bookmark, Title, Slug, URL, Description, Tags, Author, Views, Likes, Dislikes, Reported, Language, Start_Date, Situation";
		$this->language = whichLanguage();
		
		$this->Data = $this->core("Data");
		$this->Data->table("bookmarks");
		
		$this->helper("alerts");
	}

	public function getRSS() 
	{	
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, null, "ID_Bookmark DESC", MAX_LIMIT);
	}
	
	public function cpanel($action, $limit = null, $order = "ID_Bookmark DESC", $search = null, $field = null, $trash = false) 
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

	private function search($search, $field) 
	{
		if ($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table);	      
		} else {
			return false;
		}
	}
	
	private function all($trash, $order, $limit, $own = false) 
	{
		$fields = "ID_Bookmark, ID_User, Title, Slug, URL, Author, Views, Reported, Language, Start_Date, Situation";

		if (!$trash) {
			if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
				return  $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			} else {
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		} else {
			if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {	
				return $this->Db->findBy("Situation", "Deleted", $this->table, $fields, null, $order, $limit);
			} else {
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		}				
	}
	
	private function editOrSave($action) 
	{
		$this->helper(array("time", "alerts"));

		if (POST("author")) {
			$this->Users_Model = $this->model("Users_Model");
			$data = $this->Users_Model->getByUsername(POST("author"));

			$ID_User = isset($data[0]["ID_User"]) ? $data[0]["ID_User"] : false;			
		} else {
			$ID_User = SESSION("ZanUserID");
		}
		
		if (!$ID_User) {
			return getAlert(__("Author is not a valid user"));
		}

		$data = array(
			"ID_User" => $ID_User,
			"Author"  => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Slug" 	  => slug(POST("title", "clean")),
			"Title"	  => stripslashes(POST("title"))
		);

		if ($action === "save") {
			$validations = array(
				"exists" => array(
					"URL" => POST("URL")
				),
				"title" => "required",
				"description" => "required"
			);

			$data["Start_Date"] = now(4);
		} else {
			$validations = array(
				"title" => "required",
				"description" => "required"
			);			

			$data["Modified_Date"] = now(4);
		}

		$this->data = $this->Data->process($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function add($action = "save") 
	{
		$error = $this->editOrSave($action);

		if ($error) {
			return $error;
		}
		
		$this->data["Situation"] = (SESSION("ZanUserPrivilegeID") == 1 or SESSION("ZanUserRecommendation") > 100) ? "Active" : "Pending";

		if ($action === "save") {
			$return = $this->Db->insert($this->table, $this->data);

			$this->Users_Model = $this->model("Users_Model");
			$this->Users_Model->setCredits(1, 9);
		} elseif ($action === "edit") {
			$return = $this->Db->update($this->table, $this->data, POST("ID"));
		}

		if ($this->data["Situation"] === "Active") {
			$this->Cache = $this->core("Cache");
			$this->Cache->removeAll("bookmarks");
			$this->Cache->remove("profile-". $this->data["Author"], "users");
		}
		
		if ($return) {
			return getAlert(__("The bookmark has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}

	public function preview() 
	{
		if (POST("description") and POST("language") and POST("title") and POST("URL")) {
			return array(
				"ID" 		  => POST("ID"),
				"Author" 	  => SESSION("ZanUser"),
				"Description" => stripslashes(encode(POST("description", "decode", null))),
				"Language" 	  => POST("language"),
				"Start_Date"  => now(4),
				"Tags" 		  => stripslashes(encode(POST("tags", "decode", null))),
				"Title" 	  => stripslashes(encode(POST("title", "decode", null))),
				"URL" 		  => stripslashes(encode(POST("URL", "decode", null)))
			);
		} else {
			return false;
		}
	}
	
	private function save() 
	{
		if ($this->Db->insert($this->table, $this->data)) {
			$this->Cache = $this->core("Cache");
			$this->Cache->removeAll("bookmarks");
			$this->Cache->remove("profile-". $this->data["Author"], "users");

			$this->Users_Model = $this->model("Users_Model");
			$this->Users_Model->setCredits(1, 9);

			return getAlert(__("The bookmark has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function edit() 
	{
		$this->Db->update($this->table, $this->data, POST("ID"));

		$this->Cache = $this->core("Cache");	
		$this->Cache->removeAll("bookmarks");
		$this->Cache->remove("profile-". $this->data["Author"], "users");
		
		return getAlert(__("The bookmark has been edit correctly"), "success");
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

	public function getBufferBookmarks($language = "all") 
	{
		if ($language === "all") {
			return $this->Db->findBySQL("Buffer = 1 AND Situation = 'Active'", $this->table, "ID_Bookmark, Title, Slug, Language", null, "rand()", 25);
		} else {
			return $this->Db->findBySQL("Buffer = 1 AND Language = '$language' AND Situation = 'Active'", $this->table, "ID_Bookmark, Title, Slug, Language", null, "rand()", 25);
		}
	}

	public function getByTag($tag, $limit) 
	{
		$tag = str_replace("-", " ", $tag);
		
		return $this->Db->findBySQL("Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%' AND Situation = 'Active'", $this->table, $this->fields, null, "ID_Bookmark DESC", $limit);
	}
	
	public function getByID($ID) 
	{
		return $this->Db->findBySQL("ID_Bookmark = '$ID' AND Situation = 'Active' OR Situation = 'Pending'", $this->table, $this->fields);
	}
	
	public function getBookmarkByID($ID) 
	{
		return $this->Db->findBySQL("Situation != 'Deleted' AND ID_User = ". SESSION("ZanUserID") ." AND ID_Bookmark = ". $ID, $this->table, $this->fields);
	}
	
	public function getAll($limit) 
	{		
		return $this->Db->findBySQL("Situation = 'Active'", $this->table, $this->fields, null, "ID_Bookmark DESC", $limit);
	}
	
	public function getAllByAuthor($author, $limit) 
	{		
		return $this->Db->findBySQL("(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author'", $this->table, $this->fields, null, "ID_Bookmark DESC", $limit);
	}
	
	public function getAllByTag($author, $tag, $limit) 
	{
		$tag = str_replace("-", " ", $tag);
		$query = "(Situation = 'Active' OR Situation = 'Pending') AND Author = '$author' AND (Title LIKE '%$tag%' OR Description LIKE '%$tag%' OR Tags LIKE '%$tag%')";

		return $this->Db->findBySQL($query, $this->table, $this->fields, null, "ID_Bookmark DESC", $limit);
	}

	public function getAllByUser() 
	{
		return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, null, "ID_Bookmark DESC");
	}

	public function updateViews($bookmarkID) 
	{
		$this->Cache = $this->core("Cache");
		$views = $this->Cache->getValue($bookmarkID, "bookmarks", "Views", true);

		return $this->Cache->setValue($bookmarkID, $views + 1, "bookmarks", "Views", 86400);
	}

	public function setReport($ID) 
	{
		if ($this->Db->find($ID, "bookmarks")) {
			$this->Db->updateBySQL("bookmarks", "Reported = (Reported) + 1 WHERE ID_Bookmark = '$ID'");

			showAlert(__("Thanks for reporting this bookmark"), path("bookmarks/go/$ID"));
		} else {
			redirect();
		}
	}

	public function activate($ID) 
	{
		return $this->Db->update($this->table, array("Situation" => "Active"), $ID);
	}

	public function find($query, $order, $limit, $own = false) 
	{
		$fields = "ID_Bookmark, ID_User, Title, Slug, URL, Author, Views, Reported, Language, Start_Date, Situation";

		if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
			return $this->Db->findBySQL("Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, $fields, null, $order, $limit);
		} else {
			return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, $fields, null, $order, $limit);
		}
	}

	public function found($query, $order, $own = false) 
	{
		if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
			return $this->Db->findBySQL("Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, "COUNT(1) AS Total", null, $order);
		} else {
			return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, "COUNT(1) AS Total", null, $order);
		}
	}

	public function records($action, $start = 0, $end = MAX_LIMIT, $order = null, $search = false) 
	{
		if (is_null($order)) {
			$order = "ID_Bookmark DESC";
		}

		if ($action === "all") {
			return $this->all(false, $order, "$start, $end", true);
		} elseif ($action === "records") {
			$data = $this->all(false, $order, "$start, $end", true);

			return $this->processRecords($data);
		} else {
			$data = $this->find($action, $order, "$start, $end", true);
			$data = $this->processRecords($data);

			if ($start === 0) {
				$total = $this->found($action, $order, true);

				if ($data) {
					array_unshift($data, $total[0]);
				} else {
					$data = array("0");
				}
			}

			return $data;
		}
	}

	private function processRecords($data) 
	{
		if (is_array($data)) {
			foreach ($data as $key => $record) {
				if (isset($record["Language"])) {
					$data[$key]["Language"] = getLanguage($record["Language"], true);
				}

				if (isset($record["Start_Date"])) {
					$this->helper("time");

					$data[$key]["Start_Date"] = ucfirst(howLong($record["Start_Date"]));
				}

				if (isset($record["End_Date"])) {
					$this->helper("time");

					$data[$key]["End_Date"] = ucfirst(howLong($record["End_Date"]));
				}

				if (isset($record["Modified_Date"])) {
					$this->helper("time");

					$data[$key]["Modified_Date"] = ucfirst(howLong($record["Modified_Date"]));
				}

				if (isset($record["Situation"])) {
					$data[$key]["Situation"] = __($record["Situation"]);
				}

				if (isset($record["Views"])) {
					$data[$key]["Views"] = (int)$record["Views"];
				}
			}
		}

		return $data;
	}

	public function getByUser($ID_User, $limit)
	{
		return $this->Db->findBySQL("ID_User = '$ID_User' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table, $this->fields, null, "ID_Bookmark DESC", "0, $limit");
	}
}