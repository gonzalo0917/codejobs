<?php
<<<<<<< HEAD
=======
/**
 * Access from index.php:
 */
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Model extends ZP_Load 
{
	public function __construct()
	{
		$this->Db = $this->db();
		$this->Users_Model = $this->model("Users_Model");
		$this->Email = $this->core("Email");
		$this->Email->setLibrary("PHPMailer");
		$this->Email->fromName = _get("webName");
		$this->Email->fromEmail = _get("webEmailSend");
		$this->application = whichApplication();
	}
<<<<<<< HEAD

	public function delete($ID)
	{
		if (!is_array($ID)) {	
			if ($this->application === "users" and SESSION("ZanUserID") === $ID) {
				return false;
			}

			if (segment(2, isLang()) === "languages") {
				$this->Db->delete($ID, "codes_syntax");
=======
	
	public function delete($ID) {
		if (!is_array($ID)) {	
			if ($this->application === "users" and SESSION("ZanUserID") === $ID) {
				return false;	
			} 

			if (segment(2, isLang()) === "languages") {
				$this->Db->delete($ID, "codes_syntax");

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				return true;
			}

			$data = $this->Db->find($ID, $this->application);
<<<<<<< HEAD

=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($data[0]["Situation"] === "Deleted") {
				if ($this->application === "workshop") {
					@unlink($data[0]["File"]);
				}
				$this->Db->delete($ID, $this->application);
				$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
<<<<<<< HEAD

=======
				
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				if ($count > 0) {
					return true;
				}
			}
<<<<<<< HEAD
				return false;
=======

			return false;
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		} else {
			for ($i = 0; $i <= count($ID) - 1; $i++) {
				$data = $this->Db->find($ID, $this->application);

				if ($data[0]["Situation"] === "Deleted") {
					$this->Db->delete($ID[$i], $this->application);
				}
			}

			$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			
			if ($count > 0) {
				return true;
			}
<<<<<<< HEAD
				return false;
		}
	}

	public function deletedRecords($table)
	{
=======
			
			return false;			
		}
	}

	public function deletedRecords($table) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (SESSION("ZanUserPrivilegeID") === 1) {
			return $this->Db->countBySQL("Situation = 'Deleted'", $table);
		} else {
			return	$this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $table);
		}
	}

<<<<<<< HEAD
	public function pendingRecords($table)
	{
=======
	public function pendingRecords($table) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (SESSION("ZanUserPrivilegeID") === 1) {
			return $this->Db->countBySQL("Situation = 'Pending'", $table);
		} else {
			return	$this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Pending'", $table);
		}
	}
<<<<<<< HEAD

	public function home($application)
	{
=======
	
	public function home($application) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($application === "users") {
			$fields = "Username";
		} elseif ($application === "blog") {
			$fields = "Title, Slug, Year, Month, Day, Language";
		} elseif ($application === "pages") {
			$fields = "Title, Slug, Language";
		} elseif ($application === "bookmarks") {
			$fields = "ID_Bookmark, Title, Slug, Language";
		}

		$data = $this->Db->findAll($application, $fields, null, "DESC", MAX_LIMIT);
<<<<<<< HEAD

		if ($data) {
			$i = 1;

			foreach ($data as $record) {
				switch ($application) {
					case "pages":
						$list[] = li(a(getLanguage($record["Language"], true) ." $i. ". stripslashes($record["Title"]), 
							path("pages/". $record["Slug"], false, $record["Language"]), stripslashes($record["Title"]), true));
					break;

					case "blog":
						$URL = path("blog/". $record["Year"] ."/". $record["Month"] ."/". $record["Day"] ."/". $record["Slug"],
						 false, $record["Language"]);

						$list[] = li(a(getLanguage($record["Language"], true) .' '. $i .'. '. stripslashes($record["Title"]), $URL ,
						 stripslashes($record["Title"]), true));	
=======

		if ($data) {
			$i = 1;	
							
			foreach ($data as $record) {
				switch ($application) {
					case "pages":
						$list[] = li(a(getLanguage($record["Language"], true) ." $i. ". stripslashes($record["Title"]), path("pages/". $record["Slug"], false, $record["Language"]), stripslashes($record["Title"]), true));
					break;

					case "blog":						
						$URL = path("blog/". $record["Year"] ."/". $record["Month"] ."/". $record["Day"] ."/". $record["Slug"], false, $record["Language"]);

						$list[] = li(a(getLanguage($record["Language"], true) .' '. $i .'. '. stripslashes($record["Title"]), $URL , stripslashes($record["Title"]), true));	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
					break;

					case "bookmarks":
<<<<<<< HEAD
						$list[] = li(a(getLanguage($record["Language"], true) .' '. $i .". ". stripslashes($record["Title"]),
						 path("bookmarks/go/". $record["ID_Bookmark"] ."/". $record["Slug"], false, $record["Language"]), 
						 stripslashes($record["Title"]), true));
=======
						$list[] = li(a(getLanguage($record["Language"], true) .' '. $i .". ". stripslashes($record["Title"]), path("bookmarks/go/". $record["ID_Bookmark"] ."/". $record["Slug"], false, $record["Language"]), stripslashes($record["Title"]), true));
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
					break;

					case "users":
						$list[] = li(a($i .". ". $record["Username"], path("users/". $record["Username"]), $record["Username"], true));
					break;
				}

				$i++;
			}
		} else {
			$list = "<p>&nbsp&nbsp&nbsp". __("There are no new records") ."</p>";
		}
		return $list;
	}
<<<<<<< HEAD
=======
	
	public function getPagination($trash = false) {
		$primaryKey = $this->Db->table($this->application);	
		
		$application = whichApplication();
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63

	public function getPagination($trash = false)
	{
		$primaryKey = $this->Db->table($this->application);
		$application = whichApplication();
		$start = 0;
<<<<<<< HEAD

		if ($trash) {
=======
		
		if ($trash) {	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$start = (segment(4, isLang()) === "page" and segment(5, isLang()) > 0) ? (segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
		} else {
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
		}

<<<<<<< HEAD
		$limit = $start .", ". MAX_LIMIT;

=======
		$limit = $start .", ". MAX_LIMIT;			
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (POST("seek")) {
			if (POST("field") === "ID") {
				if (SESSION("ZanUserPrivilegeID") === 1) {
					$count = $this->Db->countBySQL("$primaryKey = '". POST("search") ."' AND Situation != 'Deleted'", $this->application);
				} else {
					$query = "ID_User = '". SESSION("ZanUserID") ."' AND $primaryKey = '". POST("search") ."' AND Situation != 'Deleted'";
					$count = $this->Db->countBySQL($query, $this->application);
				}
			} else {
				if (SESSION("ZanUserPrivilegeID") === 1) {
					$count = $this->Db->countBySQL("". POST("field") ." LIKE '%". POST("search") ."%' AND Situation != 'Deleted'", $this->application);
				} else {
					$query = "ID_User = '". SESSION("ZanUserID") ."' AND ". POST("field") ." LIKE '%". POST("search") ."%' AND Situation != 'Deleted'";
					$count = $this->Db->countBySQL($query, $this->application);
				}
			}
		} elseif (!$trash) {
			if (SESSION("ZanUserPrivilegeID") === 1) {
				$count = $this->Db->countBySQL("Situation != 'Deleted'", $this->application);
			} else {
				$count = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->application);
			}

			$URL = path("$application/cpanel/results/page/");
		} else {
			if (SESSION("ZanUserPrivilegeID") === 1) {
				$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			} else {
				$count = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->application);
			}

			$URL = path("$application/cpanel/results/trash/page/");
		}

		$this->helper("pagination");
<<<<<<< HEAD
		$pagination = ($count > MAX_LIMIT) ? paginate($count, MAX_LIMIT, $start, $URL) : null;
		return $pagination;
	}

	public function records($trash = false, $order = null)
	{
=======
					
		$pagination = ($count > MAX_LIMIT) ? paginate($count, MAX_LIMIT, $start, $URL) : null;				
		
		return $pagination;		
	}
	
	public function records($trash = false, $order = null) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$application = segment(0, isLang());
		$Model 		 = ucfirst(segment(0, isLang())) ."_Model";
		$this->$Model = $this->model($Model);
<<<<<<< HEAD

		if (isset($this->$Model)) {
			if (POST("seek")) {
				$data = $this->$Model->cpanel("search", null, POST("field") ." ". POST("order"), POST("search"), POST("field"));

=======
		
		if (isset($this->$Model)) {
			if (POST("seek")) {
				$data = $this->$Model->cpanel("search", null, POST("field") ." ". POST("order"), POST("search"), POST("field"));
				
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				if (!$data) {
					$this->helper("alerts");
					showAlert(__("Results not found"), path(whichApplication() ."/cpanel/results"));
				}
			} else {
				$start = 0;
<<<<<<< HEAD

				if ($trash) {
					$start = (segment(4, isLang()) === "page" and segment(5, isLang()) > 0) ? 
					(segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
=======
				
				if ($trash) {		
					$start = (segment(4, isLang()) === "page" and segment(5, isLang()) > 0) ? (segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				} else {	 
					$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? 
					(segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
				}

				$limit = $start .", ". MAX_LIMIT;
<<<<<<< HEAD

				if (segment(3, isLang()) === "order") {
					$i = (segment(4)) ? 3 : 4; 
					$j = (segment(4)) ? 4 : 5;

=======
				
				if (segment(3, isLang()) === "order") {
					$i = (segment(4)) ? 3 : 4; 
					$j = (segment(4)) ? 4 : 5;
					
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
					if (segment($i) === "id") {
						$field = "ID";
					} elseif (segment($i) === "end-date") {
						$field = "End_Date";
					} elseif (segment($i) === "start-date") {
						$field = "Start_Date";
					} elseif (segment($i) === "text-date") {
						$field = "Text_Date";
					} else {
						$field = ucfirst(segment($i));
					}
<<<<<<< HEAD

					if (segment($j) === "asc") {
=======
					
					if (segment($j) === "asc") {		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
						$data = $this->$Model->cpanel("all", $limit, "$field ASC", null, null, $trash);
					} elseif (segment($j) === "desc") {
						$data = $this->$Model->cpanel("all", $limit, "$field DESC", null, null, $trash);
					}
				} else {
					$data = $this->$Model->cpanel("all", $limit, $order, null, null, $trash);
				}
			}

			if ($data) {
				return $data;
			} else {
				redirect(path("$application/cpanel/add"));
			}
		}
<<<<<<< HEAD
		return false;
	}

	public function restore($ID)
	{
		if (!is_array($ID)) {
			$this->Db->update($this->application, array("Situation" => "Active"), $ID);

=======
		
		return false;
	}
	
	public function restore($ID) {
		if (!is_array($ID)) {
			$this->Db->update($this->application, array("Situation" => "Active"), $ID);
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($this->application === "blog" or $this->application === "codes" or $this->application === "bookmarks") {
				$this->Applications_Model = $this->model("Applications_Model");
				$this->Users_Model->setCredits(1, $this->Applications_Model->getID($this->application));
			}

			$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
<<<<<<< HEAD
=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			return ($count > 0) ? true : false;
		} else {
			for ($i = 0; $i < count($ID); $i++) {
				$this->Db->update($this->application, array("Situation" => "Active"), $ID[$i]);
<<<<<<< HEAD
			}

=======
			}	
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($this->application === "blog" or $this->application === "codes" or $this->application === "bookmarks") {
				$this->Applications_Model = $this->model("Applications_Model");
				$this->Users_Model->setCredits(count($ID), $this->Applications_Model->getID($this->application));
			}

			$count = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
<<<<<<< HEAD
			return ($count > 0) ? true : false;
		}
	}

	public function thead($positions, $trash = false)
	{
		$positions = str_replace(", ", ",", $positions);
		$parts = explode(",", $positions);

		if (count($parts) > 0) {
			for ($i = 0; $i <= count($parts) - 1; $i++) {
				if ($parts[$i] != "checkbox") {
=======
			
			return ($count > 0) ? true : false;		
		}
	}
	
	public function thead($positions, $trash = false) {
		$positions = str_replace(", ", ",", $positions);
		$parts     = explode(",", $positions);
		
		if (count($parts) > 0) {
			for ($i = 0; $i <= count($parts) - 1; $i++) {
				if ($parts[$i] != "checkbox") {					
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
					if ($parts[$i] === "Action") {
						$thead[$i] = __($parts[$i]);
					} else {
						$thead[$i] = __($parts[$i]);
					}
				} else {
<<<<<<< HEAD
					$thead[$i] = null;
=======
					$thead[$i] = null;	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				}
			}
		} else {
			$thead[0] = __($positions);
		}
		
		$return = $thead;
		unset($thead);
		return $return;
	}
<<<<<<< HEAD

	public function total($trash = false, $singular = "record", $plural = "records", $comments = false)
	{
=======
	
	public function total($trash = false, $singular = "record", $plural = "records", $comments = false) {		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$primaryKey = $this->Db->table($this->application);
		
		if (POST("seek")) {
			if (POST("field") === "ID") {
				if ((int) SESSION("ZanUserPrivilegeID") === 1) {
					$total = $this->Db->countBySQL("$primaryKey = '". POST("search") ."'", $this->application);
				} else {
					$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND $primaryKey = '". POST("search") ."'", 
						$this->application);
				}
			} else {
				if ((int) SESSION("ZanUserPrivilegeID") === 1) {
					$total = $this->Db->countBySQL("". POST("field") ." LIKE '%". POST("search") ."%'", $this->application);
				} else {
					$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ". POST("field") ." LIKE '%". 
						POST("search") ."%'", $this->application);
				}
			}
<<<<<<< HEAD

=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($total === 0) {
				$total = "0 ". __("Records founded");
			} elseif ($total === 1) {
				$total = "1 ". __("Record found");
			} else {
				$total = $total . " " .__("Records founded");
			}

			return $total;
<<<<<<< HEAD
		} elseif (!$trash) {
=======
		} elseif (!$trash) { 
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ((int) SESSION("ZanUserPrivilegeID") === 1) {
				$total = $this->Db->countBySQL("Situation != 'Deleted'", $this->application);
			} else {
				$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", 
					$this->application);
			}
		} else {
			if ((int) SESSION("ZanUserPrivilegeID") === 1) {
				$total = $this->Db->countBySQL("Situation = 'Deleted'", $this->application);
			} else {
				$total = $this->Db->countBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", 
					$this->application);
			}
		}
<<<<<<< HEAD

=======
		 
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($comments) {
			if (whichApplication() === "blog") {
				$total = $this->Db->countBySQL("ID_Application = '3'", "comments");
			}
		}
<<<<<<< HEAD

		if ($total === 0) {
			$total = "0 " . __($plural);
		} elseif ((int) $total === 1) {
=======
		
		if ($total === 0) {
			$total = "0 " . __($plural);
		} elseif ((int) $total === 1) { 
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$total = "1 " . __($singular);
		} else { 
			$total = $total . " " . __($plural);
		}

		return $total;
	}
<<<<<<< HEAD

	public function trash($ID)
	{
		if ($this->application === "users" and SESSION("ZanUserID") === $ID) {
			return true;
		}

		$data = array("Situation" => "Deleted");

=======
	
	public function trash($ID) {
		if ($this->application === "users" and SESSION("ZanUserID") === $ID) {
			return true;	
		}

		$data = array("Situation" => "Deleted");
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (!is_array($ID)) {
			$this->Db->update($this->application, $data, $ID);

			if ($this->application === "blog" or $this->application === "codes" or $this->application === "bookmarks") {
				$this->Applications_Model = $this->model("Applications_Model");
				$this->Users_Model->setCredits(-1, $this->Applications_Model->getID($this->application));
			}

			$count = $this->Db->countBySQL("Situation = 'Active'", $this->application);
<<<<<<< HEAD
=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			return ($count > 0) ? true : false;
		} else {
			for ($i = 0; $i < count($ID); $i++) {
				$this->Db->update($this->application, $data, $ID[$i]);
			}
<<<<<<< HEAD

=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($this->application === "blog" or $this->application === "codes" or $this->application === "bookmarks") {
				$this->Applications_Model = $this->model("Applications_Model");
				$this->Users_Model->setCredits(-count($ID), $this->Applications_Model->getID($this->application));
			}
			
			$count = $this->Db->countBySQL("Situation = 'Active'", $this->application);
<<<<<<< HEAD
=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			return ($count > 0) ? true : false;
		}
	}

	public function validate($ID)
	{
		$data = array("Situation" => "Active");
		
		if (!is_array($ID)) {
			$this->Db->update($this->application, $data, $ID);
			$count = $this->Db->countBySQL("Situation = 'Inactive'", $this->application);
<<<<<<< HEAD
=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			return ($count > 0) ? true : false;
		} else {
			for ($i = 0; $i <= count($ID) -1; $i++) {
				$this->Db->update($this->application, $data, $ID[$i]);
			}

			$count = $this->Db->countBySQL("Situation = 'Inactive'", $this->application);
<<<<<<< HEAD
=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			return ($count > 0) ? true : false;
		}
	}

	public function totalLanguages($singular = "record", $plural = "records")
	{
		$total = $this->Db->countAll("codes_syntax");

		if ($total === 0) {
			$total = "0 " . __($plural);
		} elseif ((int) $total === 1) { 
			$total = "1 " . __($singular);
		} else { 
			$total = $total . " " . __($plural);
		}

		return $total;
	}
}
