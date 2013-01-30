<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Users_Model extends ZP_Load {

	public function __construct() {
		$this->Db = $this->db();
				
		$this->Email = $this->core("Email");
		
		$this->Email->fromName  = _get("webName");
		$this->Email->fromEmail = _get("webEmailSend");
		
		$this->Data = $this->core("Data");
		
		$this->Data->table("users");

		$this->table  = "users";
		$this->fields = "ID_User, ID_Privilege, Username, Email, Website, Situation";

		$this->application = whichApplication();
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_User DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			$order = (is_null($order)) ? "ID_User DESC" : $order;

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
			return ((int) SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanuserID") ."' AND Situation != 'Deleted'", $this->table, $fields, NULL, $order, $limit);
		} else {
			return ((int) SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", $this->table, $fields, NULL, $order, $limit);
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
		$this->helper(array("alerts", "time", "files"));
		
		if($action === "save") {
			$validations = array(
				"username" => "required",
				"email"	   => "email?",
				"pwd"	   => "length:6",
				"exists"   => array(
					"Username" => POST("username"),
					"or"       => TRUE,
					"Email"    => POST("email"),
				),
			);


		} else {
			$validations = array(
				"username" => "required",
				"email"	   => "email?"
			);
		}

		if((int) POST("privilege") === 1) {
			$privilege = "Super Admin";
		} elseif((int) POST("privielge") === 2) {
			$privilege = "Admin";
		} elseif((int) POST("privilege") === 3) {
			$privilege = "Moderator";
 		} else {
 			$privilege = "Member";
 		}
		
		if(!POST("pwd")) {
			$data = array(
				"Username"     	=> POST("username"),
				"Start_Date"   	=> now(4),
				"Code"		   	=> code(),
				"ID_Privilege" 	=> POST("privilege")
			);
		} else {
			$data = array(
				"Username"   	=> POST("username"),
				"Pwd"		 	=> encrypt(POST("pwd")),
				"Start_Date" 	=> now(4),
				"Code"		 	=> code(),
				"ID_Privilege"  => POST("privilege")
			);

		}
		
		$this->Data->ignore(array("pwd", "privilege"));

		$this->data = $this->Data->proccess($data, $validations);
	
		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {
		$insertID = $this->Db->insert($this->table, $this->data);
	
		$data = array(
			"ID_Privilege" => POST("privilege"),
			"ID_User"	   => $insertID
		);

		$this->Db->insert("re_privileges_users", $data);

		return getAlert(__("The user has been saved correctly"), "success");	
	}
	
	private function edit() {
		$this->Db->update($this->table, $this->data, POST("ID"));
		
		return getAlert(__("The user has been edit correctly"), "success");
	}

	public function checkUserService($serviceID, $service = "Facebook") {
		return $this->Db->query("SELECT muu_users.ID_User, ID_Privilege, muu_users_services.ID_Service, Service, Username, Name, Avatar, Bookmarks, Codes, Posts, Recommendation
								 FROM muu_users_services 
								 INNER JOIN muu_users ON muu_users.ID_User = muu_users_services.ID_User
								 WHERE muu_users_services.ID_Service = '$serviceID' AND Service = '$service' AND muu_users.Situation = 'Active'");
	}

	public function addUser($service = FALSE) {
		$this->helper(array("alerts", "time"));

		if(SESSION("UserRegistered")) {
			return array("inserted" => FALSE, "alert" => getAlert(__("You can't register many times a day")));
		}

		$validations = array(
			"exists"   => array(
				"Username" => POST("username"),
				"or"       => TRUE,
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
			"Code"		 => $code,
			"Situation"  => "Inactive"
		);

		if(!$service) {
			$validations["password"] = "length:6";

			$data["Pwd"] = POST("password", "encrypt");
		} else {
			$data["Pwd"] = NULL;
		}
	
		$this->Data->ignore(array("password", "register", "name", "serviceID"));

		$data = $this->Data->proccess($data, $validations);
		
		if(isset($data["error"])) {
			return array("inserted" => FALSE, "alert" => $data["error"]);
		}
		
		$ID_User = $this->Db->insert($this->table, $data);
	
		if($ID_User) {
			if($service === "facebook" or $service === "twitter") {
				$this->Db->insert("users_services", array("ID_User" => $ID_User, "ID_Service" => POST("serviceID"), "Service" => ucfirst($service)));
			} 
			
			$message = $this->view("register_email", array("code" => $code), "users", TRUE);

			$this->Email->email   = POST("email");
			$this->Email->subject = __("Account Activation") ." - ". _get("webName");
			$this->Email->message = $this->view("register_email", array("user" => POST("username"), "code" => $code), "users", TRUE);
			
			$this->Email->send();

			SESSION("UserRegistered", TRUE);

			return array(
				"inserted" => TRUE,
				"alert"    => getAlert(__("The account has been created correctly, we will send you an email so you can activate your account"), "success")
			);
		} else {
			return array("inserted" => FALSE, "alert" => getAlert(__("Insert error")));
		}
	}
	
	public function activate($user, $code) {
		$data = $this->Db->findBySQL("Username = '$user' AND Code = '$code' AND Situation = 'Inactive'", $this->table, "ID_User, ID_Privilege, ID_Service, Username, Email, Pwd, Name, Avatar, Bookmarks, Codes, Posts, Recommendation");
		
		if($data) {
			$this->Db->update($this->table, array("Situation" => "Active"), $data[0]["ID_User"]);

			return $data;
		} 
		
		return FALSE;
	}
	
	public function change() {
		if(POST("change")) {
			$tokenID   = POST("tokenID");
			$password1 = POST("password1", "decode-encrypt");
			$password2 = POST("password2", "decode-encrypt");
			
			if(POST("password1") === "" or POST("password2") === "") {
				return getAlert(__("You need to write the two passwords"));
			} elseif(strlen(POST("password1")) < 6 or strlen(POST("password2")) < 6) {
				return getAlert(__("Your password must contain at least 6 characters"));
			} elseif($password1 === $password2) {
				$data = $this->Db->find($tokenID, "tokens");
				
				$this->Db->update("tokens", array("Situation" => "Inactive"), $data[0]["ID_Token"]);
					
				if(!$data) {
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
	
	public function deactivateOrDelete($action, $username = NULL) {
		$username = $username ? $username : POST("username");
		$data 	  = $this->Db->findBySQL("Username = '$username' AND Situation = 'Active'", $this->table, "ID_User");
		
		if($data) {
			$situation = $action === "deactivate" ? "Inactive" : "Deleted";

			$this->Db->update($this->table, array("Situation" => $situation), $data[0]["ID_User"]);

			return $data;
		}

		return FALSE;
	}

	public function isAdmin($sessions = FALSE) {
		if(SESSION("ZanUserServiceID") and SESSION("ZanUserPrivilegeID") <= 2) {
			return TRUE;
		}

		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");	
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}		

		return $this->Db->findBySQL("ID_Privilege <= 2 AND (Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'", $this->table, "ID_User");
	}
	
	public function isMember($sessions = FALSE) {
		if(SESSION("ZanUserServiceID")) {
			return TRUE;
		}

		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");					
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}

		$this->Db->select("ID_User");
		
		return $this->Db->findBySQL("(Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'", $this->table);
	}
	
	public function getUserData($sessions = FALSE) {		
		if($sessions) {		
			$username = SESSION("ZanUser");
			$password = SESSION("ZanUserPwd");						
		} else {			
			$username = POST("username");
			$password = POST("password", "encrypt");
		}

		$fields  = "ID_User, ID_Privilege, Username, Pwd, Email, Website, Avatar, Recommendation, Credits, Sign, Messages, Recieve_Messages, Topics, Replies, ";
		$fields .= "Comments, Bookmarks, Codes, Bookmarks, Posts, Jobs, Suscribed, Start_Date, Code, CURP, RFC, Name, Age, Title, Address, Zip, Phone, Mobile, ";
		$fields .= "Gender, Relationship, Birthday, Country, District, City, Technologies, Twitter, Facebook, Linkedin, Viadeo, Situation";

		$this->Db->select($fields);
		
		$data = $this->Db->findBySQL("(Username = '$username' OR Email = '$username') AND Pwd = '$password' AND Situation = 'Active'", $this->table);	
			
		return $data;
	}

	public function getOnlineUsers() {	
		$date = time();
		$time = 10;
		$time = $date - $time * 60;
		$IP   = getIP();		
		$user = SESSION("ZanUser");
				
		$this->Db->deleteBySQL("Start_Date < $time", "users_online_anonymous");
		$this->Db->deleteBySQL("Start_Date < $time", "users_online");

		if($user !== "") {		
			$this->Db->select("User, Start_Date");

			$users = $this->Db->findBy("User", $user, "users_online");
			
			if(!$users) {			
				$this->Db->insert("users_online", array("User" => $user, "Start_Date" => $date));
			} else {			
				$this->Db->updateBySQL("users_online", "Start_Date = '$date' WHERE User = '$user'");						
			}		
		} else {
			$this->Db->select("IP, Start_Date");

			$users = $this->Db->findBy("IP", $IP, "users_online_anonymous");
									
			if(!$users) {						
				$this->Db->insert("users_online_anonymous", array("IP" => $IP, "Start_Date" => $date));	
			} else {			
				$this->Db->updateBySQL("users_online_anonymous", "Start_Date = '$date' WHERE IP = '$IP'");		
			}	
		}
	}
	
	public function isAllow($permission = "view", $application = NULL) {			
		if(SESSION("ZanUserPrivilegeID") and !SESSION("ZanUserApplication")) {	
			$this->Applications_Model = $this->model("Applications_Model");
			
			if(is_null($application)) {
				$application = whichApplication();		
			}
			
			$privilegeID   = SESSION("ZanUserPrivilegeID");
			$applicationID = $this->Applications_Model->getID($application);
			
			if($this->getPermissions($privilegeID, $applicationID, $permission)) {
				return TRUE;
			} 

			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function getPermissions($ID_Privilege, $ID_Application, $permission) {		
		$data = $this->Db->findBySQL("ID_Privilege = '$ID_Privilege' AND ID_Application = '$ID_Application'", "re_permissions_privileges", "ID_Privilege, ID_Application, Adding, Deleting, Editing, Viewing");

		if($permission === "add") { 
			return ($data[0]["Adding"])   ? TRUE : FALSE;
		} elseif($permission === "delete") {
			return ($data[0]["Deleting"]) ? TRUE : FALSE;
		} elseif($permission === "edit") {
			return ($data[0]["Editing"])  ? TRUE : FALSE;
		} elseif($permission === "view") {
			return ($data[0]["Viewing"])  ? TRUE : FALSE;
		}
	}
	
	public function recover() {		
		if(POST("recover")) {
			$this->helper(array("alerts", "time"));

			$username = POST("username");
			$email	  = POST("email");
			
			if($username or isEmail($email)) { 
				if($username) {
					$data = $this->Db->findBy("Username", $username, $this->table, "ID_User");
				
					if(!$data) {
						return getAlert(__("There was an error while processing your request, verifies that the information provided is correct"));
					} else {
						$userID    = $data[0]["ID_User"];
						$token     = encrypt(code());
						$startDate = now(4);
						$endDate   = $startDate + 86400;

						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens", "ID_Token");
						
						if(!$data) {
							$data = array(
								"ID_User" 	 => $userID,
								"Token"		 => $token,
								"Action"     => "Recover",
								"Start_Date" => $startDate,
								"End_Date"	 => $endDate
							);
							
							$this->Db->insert("tokens", $data);
							
							$this->Email->email	  = $email;
							$this->Email->subject = __("Recover Password") ." - ". _get("webName");
							$this->Email->message = $this->view("recovering_email", array("token" => $token), "users", TRUE);

							$this->Email->send();							

							return getAlert(__("We've sent you an email with instructions to retrieve your password"), "success");							
						} else {
							return getAlert(__("You can't apply for two password resets in less than 24 hours"));
						}
					}
				} elseif(isEmail($email)) {
					$data = $this->Db->findBy("Email", $email, $this->table, "ID_User");
					
					if(!$data) {
						return getAlert(__("This e-mail does not exists in our database"));
					} else {
						$userID    = $data[0]["ID_User"];
						$token     = encrypt(code());
						$startDate = now(4);
						$endDate   = $startDate + 86400;
						
						$data = $this->Db->findBySQL("ID_User = '$userID' AND Action = 'Recover' AND Situation = 'Active'", "tokens", "ID_Token");
						
						if(!$data) { 
							$data = array(
								"ID_User" 	 => $userID,
								"Token"		 => $token,
								"Action"     => "Recover",
								"Start_Date" => $startDate,
								"End_Date"	 => $endDate
							);
							
							$this->Db->insert("tokens", $data);
							
							$this->Email->email	  = $email;
							$this->Email->subject = __("Recover Password") ." - ". _get("webName");
							$this->Email->message = $this->view("recovering_email", array("token" => $token), "users", TRUE);

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
			return FALSE;
		}
	}
	
	public function last() {
		$last = $this->Db->findLast($this->table, "Username");
		
		return ($last) ? $last[0] : NULL;
	}
	
	public function registered() {		
		$registered = $this->Db->countAll($this->table);
		
		return $registered;
	}
	
	public function online($all = TRUE) {		
		$registered = $this->Db->countAll("users_online");
		
		$anonymous = $this->Db->countAll("users_online_anonymous");
		
		$total = $registered + $anonymous;
		
		return ($all) ? $total : $anonymous;	
	}	
	
	public function isToken($token = FALSE, $action = NULL) {
		if($token and isset($action)) {
			$data = $this->Db->findBySQL("Token = '$token' AND Action = '$action' AND Situation = 'Active'", "tokens", "ID_Token");
		
			if(!$data) {
				showAlert(__("Invalid Token"), path());
			} else {
				return $data[0]["ID_Token"];
			}
		} else {
			showAlert(__("Invalid Token"), path());
		}
	}
	
	public function getByID($ID) {
		return $this->Db->find($ID, $this->table, $this->fields);
	}

	public function getByUsername($username) {
		return $this->Db->findBy("Username", $username, $this->table, $this->fields);
	}
	
	public function getPrivileges() {
		return $this->Db->findAll("privileges");
	}
	
	public function setLike($ID, $table, $application) {
		if($this->Db->find($ID, $table)) {
			if($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "likes")) {
				showAlert(__("Already You like this"), path("$table/go/$ID"));
			} elseif($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "dislikes")) {
				showAlert(__("Already You dislike this"), path("$table/go/$ID"));
			}

			$this->helper("time");

			$this->Db->insert("likes", array("ID_User" => SESSION("ZanUserID"), "ID_Application" => $application, "ID_Record" => $ID, "Start_Date" => now(4)));
			
			$primaryKey = $this->Db->table($table);

			$this->Db->updateBySQL($table, "Likes = (Likes) + 1 WHERE $primaryKey = '$ID'");
			
			showAlert(__("Thanks for your like"), path("$table/go/$ID"));
		} 

		showAlert(__("The record doesn't exists"), path());
	}

	public function setDislike($ID, $table, $application) {
		if($this->Db->find($ID, $table)) {
			$this->helper(array("alerts", "time"));

			if($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "dislikes")) {
				showAlert(__("Already You dislike this"), path("$table/go/$ID"));
			} elseif($this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Application = '$application' AND ID_Record = '$ID'", "likes")) {
				showAlert(__("Already You like this"), path("$table/go/$ID"));
			}

			$this->helper("time");

			$this->Db->insert("dislikes", array("ID_User" => SESSION("ZanUserID"), "ID_Application" => $application, "ID_Record" => $ID, "Start_Date" => now(4)));
			
			$primaryKey = $this->Db->table($table);

			$this->Db->updateBySQL($table, "Dislikes = (Dislikes) + 1 WHERE $primaryKey = '$ID'");

			showAlert(__("Thanks for your dislike"), path("$table/go/$ID"));
		} 

		showAlert(__("The record doesn't exists"), path());
	}

	public function setCredits($factor, $application) {
		$this->config("scores", "users");

		$prefix = $factor > 0 ? "+" : "";
		$sign 	= $prefix . $factor;

		switch($application) {
			case 9: case "bookmarks":
				SESSION("ZanUserBookmarks", SESSION("ZanUserBookmarks") + $factor);
				
				$additional 	= ", Bookmarks = (Bookmarks) $sign";
				$credits 		= $prefix . (_bookmarksCredits * $factor);
				$recommendation = $prefix . (_bookmarksRecommendations * $factor);
			break;
			
			case 17: case "codes":
				SESSION("ZanUserCodes", SESSION("ZanUserCodes") + $factor);

				$additional 	= ", Codes = (Codes) $sign";
				$credits 		= $prefix . (_codesCredits * $factor);
				$recommendation = $prefix . (_codesRecommendations * $factor);
			break;
			
			case 3: case "blog":
				SESSION("ZanUserPosts", SESSION("ZanUserPosts") + $factor);

				$additional 	= ", Posts = (Posts) $sign";
				$credits 		= $prefix . (_blogCredits * $factor);
				$recommendation = $prefix . (_blogRecommendations * $factor);
			break;
			
			default:
				$additional 	= "";
				$credits 		= "";
				$recommendation = "";
		}

		$this->Db->updateBySQL("users", "Credits = (Credits) $credits, Recommendation = (Recommendation) $recommendation $additional WHERE ID_User = '". SESSION("ZanUserID") ."'");

		return FALSE;
	}

	public function getInformation() {
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Name, Gender, Birthday, Country, City, District, Phone, Mobile, Website");
	}

	public function setInformation() {
		$validations = array(
			"name" 	  	=> "required",
			"gender" 	=> "required",
			"birthday" 	=> "required",
			"country" 	=> "required",
			"city"	 	=> "required"
		);

		$this->data = $this->Data->proccess(NULL, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}

		if($this->Db->update($this->table, $this->data, SESSION("ZanUserID"))) {
			return getAlert(__("The information has been saved correctly"), "success");	
		}
		
		return getAlert(__("Update error"));
	}

	public function changePassword() {
		$this->data = $this->Data->proccess(NULL, array(
			"password" 		  => "required",
			"new_password" 	  => "length:6",
			"re_new_password" => "length:6"
		));

		if(isset($this->data["error"])) {
			return $this->data["error"];
		} else{
			$this->helper("alerts");

			if(POST("new_password", "clean") !== POST("re_new_password", "clean")) {
				return getAlert(__("The password does not match the confirm password"));
			} elseif(!$this->isMember()) {
				return getAlert(__("Incorrect password"));
			}

			if($this->Db->update($this->table, array("Pwd" => POST("new_password", "encrypt")), SESSION("ZanUserID"))) {
				return getAlert(__("The password has been changed correctly"), "success");	
			}

			return getAlert(__("Update error"));
		}
	}

	public function changeEmail() {
		$this->data = $this->Data->proccess(NULL, array(
			"password" 		  => "required",
			"email" 	  	  => "email?"
		));

		if(isset($this->data["error"])) {
			return $this->data["error"];
		} else{
			$this->helper("alerts");

			if(!$this->isMember()) {
				return getAlert(__("Incorrect password"));
			}

			if($this->Db->update($this->table, array("Email" => POST("email"), "Subscribed" => (int)(POST("subscribed") === "on")), SESSION("ZanUserID"))) {
				return getAlert(__("The email has been changed correctly"), "success");	
			}

			return getAlert(__("Update error"));
		}
	}

	public function getEmail() {
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Email, Subscribed");
	}

	public function getAvatar() {
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Avatar, Avatar_Coordinate");
	}

	public function saveAvatar() {
		if(POST("file")) {
			$this->Files = $this->core("Files");

			$files = $this->Files->createFiles(array(POST("name")), array(POST("file")), array(POST("type")), array(POST("size")));

			if(is_array($files)) {
				
			} else {
				return getAlert(__("Error while tried to upload the files"));
			}
		}
	}

	public function deleteAvatar() {
		if($this->Db->update($this->table, array("Avatar" => NULL, "Avatar_Coordinate" => NULL), SESSION("ZanUserID"))) {
			return getAlert(__("The avatar has been deleted successfully"), "success");
		}

		return getAlert(__("Update error"));
	}

	public function getSocial() {
		return $this->Db->findBy("ID_User", SESSION("ZanUserID"), $this->table, "Twitter, Facebook, Linkedin, Google, Viadeo");
	}

	public function saveSocial() {
		$data = array(
			"Twitter"  => POST("twitter"),
			"Facebook" => POST("facebook"),
			"Linkedin" => POST("linkedin"),
			"Google"   => POST("google"),
			"Viadeo"   => POST("viadeo")
		);

		if($this->Db->update($this->table, $data, SESSION("ZanUserID"))) {
			return getAlert(__("Data have been saved correctly"), "success");	
		}
		
		return getAlert(__("Update error"));
	}

	public function records($only = FALSE, $start = 0, $order = NULL, $search = FALSE) {
		$application = segment(0, isLang());
		$Model 		 = ucfirst($application) ."_Model";

		$this->$Model = $this->model($Model);

		if(!$search) {
			$data = $this->$Model->records(!$only ? "all" : "records", $start, _maxLimit, $order);
		} else {
			$data = $this->$Model->records($search, $start, _maxLimit, $order);
		}

		return $data;
	}

	public function delete($records, $start = 0, $order = NULL, $search = FALSE) {
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

		foreach($records as $record) {
			$this->Db->updateBySQL($this->application, "Situation = 'Deleted' WHERE $ID_Column = ". $record ." AND ID_User = ". SESSION("ZanUserID"));
		}

		$Model = ucfirst($this->application) ."_Model";

		$this->$Model = $this->model($Model);

		$this->setCredits(-$count, $this->application);

		if(!$search) {
			$data = $this->$Model->records("records", $start - $count, $count, $order);
		} else {
			$data = $this->$Model->records($search, $start - $count, $count, $order);
		}

		return $data;
	}

}