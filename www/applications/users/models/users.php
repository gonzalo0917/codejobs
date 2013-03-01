<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Users_Model extends ZP_Load
{

	public function __construct()
	{
		$this->Db = $this->db();
		$this->Email = $this->core("Email");
		
		$this->Email->fromName = _get("webName");
		$this->Email->fromEmail = _get("webEmailSend");
		
		$this->Data = $this->core("Data");		
		$this->Data->table("users");

		$this->table = "users";
		$this->tableCv = "users_cv";
		$this->fields = "ID_User, ID_Privilege, ID_Service, Username, Email, Website, Name, Start_Date, Subscribed, Code, Situation";
		$this->fieldsCv = "";
		$this->application = whichApplication();
		$this->helper("debugging");
	}
	
	public function cpanel($action, $limit = null, $order = "ID_User DESC", $search = null, $field = null, $trash = false)
	{
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);

			if ($validation) {
				return $validation;
			}
		}
		
		if ($action === "all") {
			$order = (is_null($order)) ? "ID_User DESC" : $order;

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
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanuserID") ."' AND Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		} else {
			if (SESSION("ZanUserPrivilegeID") === 1) {
				return $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, null, $order, $limit);
			} else {
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		}
	}

	private function search($search, $field)
	{
		if ($search and $field) {
			if ($field === "ID") {
				return $this->Db->find($search, $this->table); 
			} else {
				return $this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);
			}
		} else {
			return false;
		}
	}
	
	private function editOrSave($action)
	{
		$this->helper(array("alerts", "time", "files"));
		
		if ($action === "save") {
			$validations = array(
				"username" => "required",
				"email"    => "email?",
				"pwd" 	   => "length:6",
				"exists"   => array(
				"Username" => POST("username"),
				"or" 	   => true,
				"Email"    => POST("email"),
				),
			);


		} else {
			$validations = array(
				"username" => "required",
				"email"    => "email?"
			);
		}

		if (POST("privilege") == 1) {
			$privilege = "Super Admin";
		} elseif (POST("privielge") == 2) {
			$privilege = "Admin";
		} elseif (POST("privilege") == 3) {
			$privilege = "Moderator";
 		} else {
 			$privilege = "Member";
 		}
		
		if (!POST("pwd")) {
			$data = array(
				"Username"     => POST("username"),
				"Start_Date"   => now(4),
				"Code" 		   => code(),
				"ID_Privilege" => POST("privilege")
			);
		} else {
			$data = array(
				"Username"     => POST("username"),
				"Pwd" 		   => encrypt(POST("pwd")),
				"Start_Date"   => now(4),
				"Code" 		   => code(),
				"ID_Privilege" => POST("privilege")
			);

		}

		$this->Data->ignore(array("pwd", "privilege"));

		$this->data = $this->Data->process($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save()
	{
		$insertID = $this->Db->insert($this->table, $this->data);

		$data = array(
			"ID_Privilege" => POST("privilege"),
			"ID_User" => $insertID
		);

		$this->Db->insert("re_privileges_users", $data);

		return getAlert(__("The user has been saved correctly"), "success");
	}

	private function edit()
	{
		$this->Db->update($this->table, $this->data, POST("ID"));
		
		return getAlert(__("The user has been edit correctly"), "success");
	}

	public function checkUserService($serviceID, $service = "Facebook")
	{
		$fields  = "". DB_PREFIX ."users.ID_User, ID_Privilege, ". DB_PREFIX ."users_services.ID_Service, Service, Username, Name, Avatar, ";
		$fields .= "Bookmarks, Codes, Posts, Recommendation";
		
		return $this->Db->query("SELECT $fields
								 FROM ". DB_PREFIX ."users_services 
								 INNER JOIN ". DB_PREFIX ."users ON ". DB_PREFIX ."users.ID_User = ". DB_PREFIX ."users_services.ID_User
								 WHERE ". DB_PREFIX ."users_services.ID_Service = '$serviceID' AND Service = '$service' AND ". DB_PREFIX ."users.Situation = 'Active'");
	}

	public function addUser($service = false)
	{
		$this->helper(array("alerts", "time"));

		if (SESSION("UserRegistered")) {
			return array("inserted" => false, "alert" => getAlert(__("You can't register many times a day")));
		}

		$validations = array(
			"exists" => array(
				"Username" => POST("username"),
				"or" 	   => true,
				"Email"    => POST("email"),
			),
			"username" => "required",
			"name" 	   => "required",
			"email"    => "email?"
		);

		$code = code(10);

		$data = array(
			"ID_Service" => POST("serviceID") ? POST("serviceID") : "0",
			"Name" 		 => POST("name"),
			"Start_Date" => now(4),
			"Subscribed" => 1,
			"Code" 		 => $code,
			"Situation"  => "Inactive"
		);

		if (!$service) {
			$validations["password"] = "length:6";

			$data["Pwd"] = POST("password", "encrypt");
		} else {
			$data["Pwd"] = null;
		}

		$this->Data->ignore(array("password", "register", "name", "serviceID"));

		$data = $this->Data->process($data, $validations);
		
		if (isset($data["error"])) {
			return array("inserted" => false, "alert" => $data["error"]);
		}

		$ID_User = $this->Db->insert($this->table, $data);
		
		if ($ID_User) {
			if ($service === "facebook" or $service === "twitter") {
				$this->Db->insert("users_services", array("ID_User" => $ID_User, "ID_Service" => POST("serviceID"), "Service" => ucfirst($service)));
			} 
			
			$message = $this->view("register_email", array("code" => $code), "users", true);

			$this->Email->email = POST("email");
			$this->Email->subject = __("Account Activation") ." - ". _get("webName");
			$this->Email->message = $this->view("register_email", array("user" => POST("username"), "code" => $code), "users", true);
			
			$this->Email->send();

		   	SESSION("UserRegistered", true);

			return array(
				"inserted" => true,
				"alert"    => getAlert(__("The account has been created correctly, we will send you an email so you can activate your account"), "success")
			);
		} else {
			return array("inserted" => false, "alert" => getAlert(__("Insert error")));
		}
	}
	
	public function activate($user, $code)
	{
		$fields = "ID_User, ID_Privilege, ID_Service, Username, Email, Pwd, Name, Avatar, Bookmarks, Codes, Posts, Recommendation";
		$data = $this->Db->findBySQL("Username = '$user' AND Code = '$code' AND Situation = 'Inactive'", $this->table, $fields);

		if ($data) {
			$this->Db->update($this->table, array("Situation" => "Active"), $data[0]["ID_User"]);

			return $data;
		} 

		return false;
	}

	public function change()
	{
		if (POST("change")) {
			$tokenID = POST("tokenID");
			$password1 = POST("password1", "decode-encrypt");
			$password2 = POST("password2", "decode-encrypt");

			if (POST("password1") === "" or POST("password2") === "") {
				return getAlert(__("You need to write the two passwords"));
			} elseif (strlen(POST("password1")) < 6 or strlen(POST("password2")) < 6) {
				return getAlert(__("Your password must contain at least 6 characters"));
			} elseif ($password1 === $password2) {
				$data = $this->Db->find($tokenID, "tokens");
				
				$this->Db->update("tokens", array("Situation" => "Inactive"), $data[0]["ID_Token"]);
					
				if (!$data) {
					showAlert(__("Invalid Token"), path());
				} else {
					$this->Db->update("users", array("Pwd" => "$password1"), $data[0]["ID_User"]);
					
					showAlert(__("Your password has been changed successfully!"), path());
				}
			} else {
				return getAlert(__("The two passwords do not match"));
			}
		} else {
			redirect();
		}
	}
	
	public function deactivateOrDelete($action, $username = null)
	{
		$username = $username ? $username : POST("username");
		$data = $this->Db->findBySQL("Username = '$username' AND Situation = 'Active'", $this->table, "ID_User");

		if ($data) {
			$situation = $action === "deactivate" ? "Inactive" : "Deleted";

			$this->Db->update($this->table, array("Situation" => $situation), $data[0]["ID_User"]);

			return $data;
		}

		return false;
	}

	public function isAdmin($sessions = false)
	{
		if (SESSION("ZanUserServiceID") and SESSION("ZanUserPrivilegeID") <= 2) {
			return true;
		}

		if ($sessions) {
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");
		} else {
			$username = POST("username");
			$password = POST("password", "encrypt");
		}

		$query = "ID_Privilege <= 2 AND (Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'";

		return $this->Db->findBySQL($query, $this->table, "ID_User");
	}
	
	public function isMember($sessions = false)
	{
		if (SESSION("ZanUserServiceID")) {
			return true;
		}

		if ($sessions) {
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");
		} else {
			$username = POST("username");
			$password = POST("password", "encrypt");
		}
		
		$query = "(Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'";

		return $this->Db->findBySQL($query, $this->table, "ID_User");
	}
	
	public function getUserData($sessions = false) 
	{
		if ($sessions) {
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");
		} else {
			$username = POST("username");
			$password = POST("password", "encrypt");
		}

		$fields  = "ID_User, ID_Privilege, Username, Pwd, Email, Website, Avatar, Recommendation, Credits, Sign, Messages, Recieve_Messages,";
		$fields .= "Topics, Replies, Comments, Bookmarks, Codes, Posts, Jobs, Subscribed, Start_Date, Code, Name, Age,";
		$fields .= "Title, Address, Zip, Phone, Mobile, Gender, Relationship, Birthday, Country, District, City, Technologies, Twitter,";
		$fields .= "Facebook, Linkedin, Viadeo, Situation";

		$query = "(Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'";

		return $this->Db->findBySQL($query, $this->table, $fields);
	}

	public function getOnlineUsers()
	{
		$date = time();
		$time = 10;
		$time = $date - $time * 60;
		$IP = getIP();
		$user = SESSION("ZanUser");

		$this->Db->deleteBySQL("Start_Date < $time", "users_online_anonymous");
		$this->Db->deleteBySQL("Start_Date < $time", "users_online");

		if ($user !== "") {
			$users = $this->Db->findBy("User", $user, "users_online", "User, Start_Date");
			
			if (!$users) {
				$this->Db->insert("users_online", array("User" => $user, "Start_Date" => $date));
			} else {
				$this->Db->updateBySQL("users_online", "Start_Date = '$date' WHERE User = '$user'");
			}
		} else {
			$users = $this->Db->findBy("IP", $IP, "users_online_anonymous", "IP, Start_Date");

			if (!$users) {
				$this->Db->insert("users_online_anonymous", array("IP" => $IP, "Start_Date" => $date));
			} else {
				$this->Db->updateBySQL("users_online_anonymous", "Start_Date = '$date' WHERE IP = '$IP'");
			}
		}
	}

	public function isAllow($permission = "view", $application = null)
	{
		if (SESSION("ZanUserPrivilegeID") and !SESSION("ZanUserApplication")) {
			$this->Applications_Model = $this->model("Applications_Model");

			if (is_null($application)) {
				$application = whichApplication();
			}

			$privilegeID = SESSION("ZanUserPrivilegeID");
			$applicationID = $this->Applications_Model->getID($application);

			if ($this->getPermissions($privilegeID, $applicationID, $permission)) {
				return true;
			} 

			return false;
		} else {
			return true;
		}
	}
	
	public function getPermissions($ID_Privilege, $ID_Application, $permission)
	{
		$fields = "ID_Privilege, ID_Application, Adding, Deleting, Editing, Viewing";
		$data = $this->Db->findBySQL("ID_Privilege = '$ID_Privilege' AND ID_Application = '$ID_Application'", "re_permissions_privileges", $fields);

		if ($permission === "add") { 
			return ($data[0]["Adding"]) ? true : false;
		} elseif ($permission === "delete") {
			return ($data[0]["Deleting"]) ? true : false;
		} elseif ($permission === "edit") {
			return ($data[0]["Editing"]) ? true : false;
		} elseif ($permission === "view") {
			return ($data[0]["Viewing"]) ? true : false;
		}
	}

	public function recover()
	{
		if (POST("recover")) {
			$this->helper(array("alerts", "time"));

			$username = POST("username");
			$email = POST("email");

			if ($username or isEmail($email)) { 
				if ($username) {
					$data = $this->Db->findBy("Username", $username, $this->table, "ID_User");
				
					if (!$data) {
						return getAlert(__("There was an error while processing your request, verifies that the information provided is correct"));
					} else {
						$userID = $data[0]["ID_User"];
						$token = encrypt(code());
						$startDate = now(4);
						$endDate = $startDate + 86400;

						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens", "ID_Token");

						if (!$data) {
							$data = array(
								"ID_User" 	 => $userID,
								"Token" 	 => $token,
								"Action" 	 => "Recover",
								"Start_Date" => $startDate,
								"End_Date"   => $endDate
							);

							$this->Db->insert("tokens", $data);

							$this->Email->email = $email;
							$this->Email->subject = __("Recover Password") ." - ". _get("webName");
							$this->Email->message = $this->view("recovering_email", array("token" => $token), "users", true);

							$this->Email->send();

							return getAlert(__("We've sent you an email with instructions to retrieve your password"), "success");
						} else {
							return getAlert(__("You can't apply for two password resets in less than 24 hours"));
						}
					}
				} elseif (isEmail($email)) {
					$data = $this->Db->findBy("Email", $email, $this->table, "ID_User");

					if (!$data) {
						return getAlert(__("This e-mail does not exists in our database"));
					} else {
						$userID = $data[0]["ID_User"];
						$token = encrypt(code());
						$startDate = now(4);
						$endDate = $startDate + 86400;

						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens", "ID_Token");

						if (!$data) { 
							$data = array(
								"ID_User" 	 => $userID,
								"Token" 	 => $token,
								"Action" 	 => "Recover",
								"Start_Date" => $startDate,
								"End_Date" 	 => $endDate
							);

							$this->Db->insert("tokens", $data);

							$this->Email->email = $email;
							$this->Email->subject = __("Recover Password") ." - ". _get("webName");
							$this->Email->message = $this->view("recovering_email", array("token" => $token), "users", true);

							$this->Email->send();
						} else {
							return getAlert(__("You can not apply for two password resets in less than 24 hours"));
						}
					}
				}

				return getAlert(__("We will send you an e-mail so you can recover your password"), "success");
			} else {
				return getAlert(__("You must enter a username or e-mail at least"));
			}
		} else {
			return false;
		}
	}

	public function last()
	{
		$last = $this->Db->findLast($this->table, "Username");
		
		return ($last) ? $last[0] : null;
	}
	
	public function registered()
	{
		$registered = $this->Db->countAll($this->table);
		
		return $registered;
	}
	
	public function online($all = true)
	{
		$registered = $this->Db->countAll("users_online");
		$anonymous = $this->Db->countAll("users_online_anonymous");
		$total = $registered + $anonymous;

		return ($all) ? $total : $anonymous;
	}

	public function isToken($token = false, $action = null)
	{
		if ($token and isset($action)) {
			$data = $this->Db->findBySQL("Token = '$token' AND Action = '$action' AND Situation = 'Active'", "tokens", "ID_Token");

			if (!$data) {
				showAlert(__("Invalid Token"), path());
			} else {
				return $data[0]["ID_Token"];
			}
		} else {
			showAlert(__("Invalid Token"), path());
		}
	}
	
	public function getByID($ID)
	{
		return $this->Db->find($ID, $this->table, $this->fields);
	}

	public function getByUsername($username)
	{
		return $this->Db->findBy("Username", $username, $this->table, $this->fields);
	}

	public function getPrivileges()
	{
		return $this->Db->findAll("privileges");
	}

	public function setLike($ID, $table, $application)
	{
		if ($this->Db->find($ID, $table)) {
			$userID = SESSION("ZanUserID");

			if ($this->Db->findBySQL("ID_User = '$userID' AND ID_Application = '$application' AND ID_Record = '$ID'", "likes")) {
				showAlert(__("Already You like this"), path("$table/go/$ID"));
			} elseif ($this->Db->findBySQL("ID_User = '$userID' AND ID_Application = '$application' AND ID_Record = '$ID'", "dislikes")) {
				showAlert(__("Already You dislike this"), path("$table/go/$ID"));
			}

			$this->helper("time");

			$data = array(
				"ID_User" => SESSION("ZanUserID"), 
				"ID_Application" => $application, 
				"ID_Record" => $ID, 
				"Start_Date" => now(4)
			);
			
			$this->Db->insert("likes", $data);
			
			$primaryKey = $this->Db->table($table);

			$this->Db->updateBySQL($table, "Likes = (Likes) + 1 WHERE $primaryKey = '$ID'");
			
			showAlert(__("Thanks for your like"), path("$table/go/$ID"));
		} 

		showAlert(__("The record doesn't exists"), path());
	}

	public function setDislike($ID, $table, $application)
	{
		if ($this->Db->find($ID, $table)) {
			$this->helper(array("alerts", "time"));

			if ($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "dislikes")) {
				showAlert(__("Already You dislike this"), path("$table/go/$ID"));
			} elseif ($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "likes")) {
				showAlert(__("Already You like this"), path("$table/go/$ID"));
			}

			$this->helper("time");

			$data = array(
				"ID_User" => SESSION("ZanUserID"), 
				"ID_Application" => $application, 
				"ID_Record" => $ID, 
				"Start_Date" => now(4)
			);

			$this->Db->insert("dislikes", $data);
			
			$primaryKey = $this->Db->table($table);

			$this->Db->updateBySQL($table, "Dislikes = (Dislikes) + 1 WHERE $primaryKey = '$ID'");

			showAlert(__("Thanks for your dislike"), path("$table/go/$ID"));
		} 

		showAlert(__("The record doesn't exists"), path());
	}

	public function setCredits($factor, $application)
	{
		$this->config("scores", "users");

		$prefix = $factor > 0 ? "+" : "";
		$sign = $prefix . $factor;

		switch ($application) {
			case 9: case "bookmarks":
				SESSION("ZanUserBookmarks", SESSION("ZanUserBookmarks") + $factor);

				$additional = ", Bookmarks = (Bookmarks) $sign";
				$credits = $prefix . (BOOKMARKS_CREDITS * $factor);
				$recommendation = $prefix . (BOOKMARKS_RECOMMENDATIONS * $factor);
			break;

			case 17: case "codes":
				SESSION("ZanUserCodes", SESSION("ZanUserCodes") + $factor);

				$additional = ", Codes = (Codes) $sign";
				$credits = $prefix . (CODES_CREDITS * $factor);
				$recommendation = $prefix . (CODES_RECOMMENDATIONS * $factor);
			break;
			
			case 3: case "blog":
				SESSION("ZanUserPosts", SESSION("ZanUserPosts") + $factor);

				$additional = ", Posts = (Posts) $sign";
				$credits = $prefix . (BLOG_CREDITS * $factor);
				$recommendation = $prefix . (BLOG_RECOMMENDATIONS * $factor);
			break;
			
			default:
				$additional = "";
				$credits = "";
				$recommendation = "";
		}

		$userID = SESSION("ZanUserID");
		$query = "Credits = (Credits) $credits, Recommendation = (Recommendation) $recommendation $additional WHERE ID_User = '$userID'";

		$this->Db->updateBySQL("users", $query);

		return false;
	}

	public function getInformation()
	{
		$fields = "Name, Gender, Birthday, Country, City, District, Phone, Mobile, Website";

		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, $fields);
	}

	public function saveInformation()
	{
		$validations = array(
			"name" 	   => "required",
			"gender"   => "required",
			"birthday" => "required",
			"country"  => "required",
			"city"     => "required"
		);

		$this->data = $this->Data->process(null, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}

		if ($this->Db->update($this->table, $this->data, SESSION("ZanUserID"))) {
			return getAlert(__("The information has been saved correctly"), "success");	
		}
		
		return getAlert(__("Update error"));
	}

	public function changePassword()
	{
		$this->data = $this->Data->process(null, array(
			"password" 		  => "required",
			"new_password" 	  => "length:6",
			"re_new_password" => "length:6"
		));

		if (isset($this->data["error"])) {
			return $this->data["error"];
		} else{
			$this->helper("alerts");

			if (POST("new_password", "clean") !== POST("re_new_password", "clean")) {
				return getAlert(__("The password does not match the confirm password"));
			} elseif (!$this->isMember()) {
				return getAlert(__("Incorrect password"));
			}

			if ($this->Db->update($this->table, array("Pwd" => POST("new_password", "encrypt")), SESSION("ZanUserID"))) {
				return getAlert(__("The password has been changed correctly"), "success");
			}

			return getAlert(__("Update error"));
		}
	}

	public function changeEmail()
	{
		$this->data = $this->Data->process(null, array(
			"password" => "required",
			"email"    => "email?"
		));

		if (isset($this->data["error"])) {
			return $this->data["error"];
		} else{
			$this->helper("alerts");

			if (!$this->isMember()) {
				return getAlert(__("Incorrect password"));
			}

			$data = array(
				"Email" => POST("email"), 
				"Subscribed" => POST("subscribed") == "on" ? 1 : 0
			);

			if ($this->Db->update($this->table, $data, SESSION("ZanUserID"))) {
				return getAlert(__("The email has been changed correctly"), "success");
			}

			return getAlert(__("Update error"));
		}
	}

	public function getEmail()
	{
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Email, Subscribed");
	}

	public function getAvatar()
	{
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Avatar, Avatar_Coordinate");
	}

	public function saveAvatar()
	{
		if (POST("file") or POST("coordinate")) {
			$avatar = $this->createAvatar();
			$data = $this->Db->find(SESSION("ZanUserID"), $this->table, "Avatar");

			if (is_array($avatar) and $data) {
				if (strtolower(current($avatar)) !== strtolower($data[0]["Avatar"])) {
					$this->removeAvatar($data[0]["Avatar"]);
				}

				if ($this->setAvatar($avatar)) {
					SESSION("ZanUserAvatar", prev($avatar) ."?". time());

					return getAlert(__("The avatar has been saved correctly"), "success");
				}
			}

			return getAlert(__("Error while tried to upload the files"));
		}
	}

	public function setAvatar($avatar, $coordinates = null)
	{
		if (is_null($coordinates)) {
			$data = array(
				"Avatar" => current($avatar),
				"Avatar_Coordinate" => next($avatar)
			);
		} else {
			$data = array(
				"Avatar" => $avatar,
				"Avatar_Coordinate" => $coordinates
			);
		}

		if (is_array($data["Avatar_Coordinate"])) {
			$data["Avatar_Coordinate"] = implode(",", $data["Avatar_Coordinate"]);
		}

		return $this->Db->update($this->table, $data, SESSION("ZanUserID"));
	}

	public function deleteAvatar()
	{
		$data = $this->Db->find(SESSION("ZanUserID"), $this->table, "Avatar");

		if ($this->Db->update($this->table, array("Avatar" => null, "Avatar_Coordinate" => null), SESSION("ZanUserID"))) {

			SESSION("ZanUserAvatar", "default.png");

			if ($data) {
				$this->removeAvatar($data[0]["Avatar"]);
			}

			return getAlert(__("The avatar has been deleted successfully"), "success");
		}

		return getAlert(__("Update error"));
	}

	public function getSocial()
	{
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Twitter, Facebook, Linkedin, Google, Viadeo");
	}

	public function saveSocial()
	{
		$data = array(
			"Twitter"  => POST("twitter"),
			"Facebook" => POST("facebook"),
			"Linkedin" => POST("linkedin"),
			"Google"   => POST("google"),
			"Viadeo"   => POST("viadeo")
		);

		if ($this->Db->update($this->table, $data, SESSION("ZanUserID"))) {
			return getAlert(__("Data have been saved correctly"), "success");
		}
		
		return getAlert(__("Update error"));
	}

	public function records($only = false, $start = 0, $order = null, $search = false)
	{
		$application = segment(0, isLang());
		$Model = ucfirst($application) ."_Model";

		$this->$Model = $this->model($Model);

		if (!$search) {
			$data = $this->$Model->records(!$only ? "all" : "records", $start, MAX_LIMIT, $order);
		} else {
			$data = $this->$Model->records($search, $start, MAX_LIMIT, $order);
		}

		return $data;
	}

	public function delete($records, $start = 0, $order = null, $search = false)
	{
		switch ($this->application) {
			case "blog":
				$ID_Column = "ID_Post";
				break;
			case "bookmarks":
				$ID_Column = "ID_Bookmark";
				break;
			case "codes":
				$ID_Column = "ID_Code";
				break;
		}

		$count = count($records);

		foreach ($records as $record) {
			$this->Db->updateBySQL($this->application, "Situation = 'Deleted' WHERE $ID_Column = ". $record ." AND ID_User = ". SESSION("ZanUserID"));
		}

		$Model = ucfirst($this->application) ."_Model";

		$this->$Model = $this->model($Model);

		$this->setCredits(-$count, $this->application);

		if (!$search) {
			$data = $this->$Model->records("records", $start - $count, $count, $order);
		} else {
			$data = $this->$Model->records($search, $start - $count, $count, $order);
		}

		return $data;
	}

	private function createAvatar()
	{
		$username = SESSION("ZanUser");
		$filename = POST("name");
		$file = POST("file");
		$resized = POST("resized");
		$coordinate = POST("coordinate");

		if (!preg_match('/^\d+,\d+,\d+,\d+$/', $coordinate)) {
			$coordinate = "0,0,90,90";
		}

		$this->Files = $this->core("Files");

		if ($file) {
			if (!is_string($username) or !is_string($resized)) {
				return false;
			}

	        $path = "www/lib/files/images/users/";
	        $fileO = $path . sha1($username ."_O") .".png";
	        $nameR = sha1($username) .".png";
	        $fileR = $path . $nameR;

	        if ($this->Files->createFileFromBase64($file, $fileO) and $this->Files->createFileFromBase64($resized, $fileR)) {
	        	return array(
	        		$nameR,
	        		$coordinate
	        	);
	        } else {
	        	return false;
	        }
		} else {
			if (!is_string($resized)) {
				return false;
			}

	        $path = "www/lib/files/images/users/";
	        $name = sha1($username) .".png";
	        $file = $path . $name;

	        if ($this->Files->createFileFromBase64($resized, $file)) {
	        	return array(
					$name,
					$coordinate
				);
	        } else {
	        	return false;
	        }
		}
	}

	private function removeAvatar($filename)
	{
		if ($filename !== "default.png") {
			@unlink("www/lib/files/images/users/". sha1(SESSION("ZanUser")) .".png");
			@unlink("www/lib/files/images/users/". sha1(SESSION("ZanUser") ."_O") .".png");
		}
	}

	public function addCv($action = "save")
    {
		$error = $this->editOrSave($action);

		if ($error) {
			return $error;
		}
		
		$this->data["Situation"] = (SESSION("ZanUserPrivilegeID") == 1 OR SESSION("ZanUserRecommendation") > 100) ?
		 "Active" : "Pending";
		
		if ($this->data["Situation"] === "Active") {
			$this->Cache = $this->core("Cache");
			$this->Cache->removeAll("codes");
		}

		if ($action === "save") {
			$lastID = $this->Db->insert($this->table, $this->data);
			
			if ($lastID) {
	            $this->data = $this->proccessExperiences($lastID);
	                        
	            if (isset($this->data["error"])) {
	                $this->Db->delete($lastID, $this->table);
	                return $this->data["error"];
	            }
	                        
	            if ($this->Db->insertBatch("codes_files", $this->data)) {
					$this->Users_Model = $this->model("Users_Model");
					$this->Users_Model->setCredits(1, 17);

	                return getAlert(__("The code has been saved correctly"), "success");	
	            }
			}
		} elseif ($action === "edit") {
			return $this->edit();
		}

		return getAlert(__("Insert error"));
	}

	private function saveCv()
	{
		if (($ID = $this->Db->insert($this->table, $this->data)) !== false) {
            $this->data = $this->proccessExperiences($ID);
                        
            if (isset($this->data["error"])) {
                $this->Db->delete($ID, $this->table);
                return $this->data["error"];
            }
                        
            if ($this->Db->insertBatch("codes_files", $this->data)) {
            	$this->Cache = $this->core("Cache");	
				$this->Cache->removeAll("codes");
            	$this->Users_Model = $this->model("Users_Model");
				$this->Users_Model->setCredits(1, 17);
                return getAlert(__("The code has been saved correctly"), "success");	
            }
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function editCv()
	{
		if ($this->Db->update($this->table, $this->data, POST("ID"))) {
            $this->data = $this->proccessExperiences(POST("ID"));
            
            if (isset($this->data["error"])) {
                return $this->data["error"];
            }
            
            $filesDB = $this->getFilesBy(POST("ID"));
            $filesPOST = POST("file");
            
            foreach ($filesPOST as $iFile => $fileID) {
                if ((int)$fileID > 0) {
                    $this->Db->update("codes_files", $this->data[$iFile], $fileID);
                    array_splice($filesDB, array_search($fileID, $filesDB), 1);
                } else { 
                    $this->Db->insert("codes_files", $this->data[$iFile]);
                }
            }
            
            if (count($filesDB) > 0) {
                foreach ($filesDB as $fileDB) {
                    $this->Db->delete($fileDB, "codes_files");
                }
            }
            
            $this->Cache = $this->core("Cache");	
			$this->Cache->removeAll("codes");

            return getAlert(__("The code has been edit correctly"), "success");
        }
        
        return getAlert(__("Update error"));
	}
	
	private function proccessExperiences($ID)
    {
        $files = POST("file");
        $syntax = POST("syntax");
        $name = POST("name");
        $code = POST("code");
        $total = count($files);
            
        if ($total == 0) {
        	return array("error" => getAlert(__("Files are required")));
        } elseif (count(array_filter($syntax)) != $total) {
        	return array("error" => getAlert(__("Syntax is required")));
        } elseif (count(array_filter($name)) != $total) {
        	return array("error" => getAlert(__("Filename is required")));
        } elseif (count(array_filter($code)) != $total) {
        	return array("error" => getAlert(__("Code is required")));
        }
         
        $data = array();
            
        for ($i = 0; $i < $total; $i++) {
            $data[] = array(
                "ID_Code" => $ID,
                "Name" => decode(addslashes($name[$i])),
                "ID_Syntax" => decode(addslashes($syntax[$i])),
                "Code" => decode(addslashes($code[$i]))
            );
        }
            
        return $data;
    }

}