<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Users_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->Templates   = $this->core("Templates");
		$this->Users_Model = $this->model("Users_Model");
				
		$this->application = $this->app("users");
		$this->language = whichLanguage();
		$this->Templates->theme();

		$this->helper("router");
		$this->CSS("forms");
	}
	
	public function index() {	
		redirect();
	}
	
	public function logout() {
		unsetSessions(path());
	}
	
	public function activate($user = NULL, $code = FALSE) {
		$this->helper("alerts");
		
		if(!$user or !$code) {
			redirect();
		} else {
			$data = $this->Users_Model->activate($user, $code);
			
			if($data) {
				SESSION("ZanUser", $data[0]["Username"]);
				SESSION("ZanUserName", $data[0]["Name"]);
				SESSION("ZanUserPwd", $data[0]["Pwd"]);
				SESSION("ZanUserAvatar", $data[0]["Avatar"]);
				SESSION("ZanUserID", $data[0]["ID_User"]);
				SESSION("ZanUserPrivilegeID", $data[0]["ID_Privilege"]);
				SESSION("ZanUserBookmarks", $data[0]["Bookmarks"]);
				SESSION("ZanUserCodes", $data[0]["Codes"]);
				SESSION("ZanUserPosts", $data[0]["Posts"]);
				SESSION("ZanUserRecommendation", $data[0]["Recommendation"]);
					 
				showAlert("Your account has been activated correctly!", path());
			} else {
				showAlert("An error occurred when attempting to activate your account!", path());
			}
		}
	}

	public function deactivate() {
		isConnected();

		if(POST("option") and POST("username") and POST("password")) {
			$this->helper("alerts");

			if($this->Users_Model->isMember()) {
				switch(POST("option")) {
					case "deactivate": case "delete":
						if($this->Users_Model->deactivateOrDelete(POST("option"))) {
							showAlert(__("Your account has been ". POST("option") ."d"), "users/logout/");
							break;
						}
					
					default:
						showAlert(__("Something went wrong! Try again later"), "users/logout/");
				}
			} else {
				showAlert(__("Incorrect password. Try again later"), "users/logout/");
			}
		} else {
			$this->title(__("Deactivate my account"));
			$this->CSS("deactivate", $this->application);
			$this->js("bootstrap");
			$this->js("deactivate", $this->application);

			$this->config("deactivate", $this->application);

			$vars["view"] 	  = $this->view("deactivate", TRUE);
			$vars["username"] = SESSION("ZanUser");
				
			$this->render("content", $vars);
		}
	}
	
	public function login() {
		$this->CSS("login", $this->application);
		
		$this->title("Login");
		
		$data = FALSE;

		$vars["href"] = path("users/login");

		if(POST("login")) {
			if($this->Users_Model->isAdmin() or $this->Users_Model->isMember()) {
				$data = $this->Users_Model->getUserData();
			} 
			
			if($data) {
				SESSION("ZanUser", $data[0]["Username"]);
				SESSION("ZanUserName", $data[0]["Name"]);
				SESSION("ZanUserPwd", $data[0]["Pwd"]);
				SESSION("ZanUserAvatar", $data[0]["Avatar"]);
				SESSION("ZanUserID", $data[0]["ID_User"]);
				SESSION("ZanUserPrivilegeID", $data[0]["ID_Privilege"]);
				SESSION("ZanUserBookmarks", $data[0]["Bookmarks"]);
				SESSION("ZanUserCodes", $data[0]["Codes"]);
				SESSION("ZanUserPosts", $data[0]["Posts"]);
				SESSION("ZanUserRecommendation", $data[0]["Recommendation"]);

				redirect();
			} else { 
				$this->helper("alerts");
				showAlert(__("Incorrect Login"), path());
			}		
		} else {
			redirect();
		} 
	}
	
	public function recover($token = FALSE) {	
		$this->title(decode(__("Recover Password")));
		
		if(POST("change")) {			
			$vars["alert"] 	 = $this->Users_Model->change();
			$vars["tokenID"] = $token;
		} elseif(POST("recover")) {
			$status = $this->Users_Model->recover();
			
			$vars["alert"] = $status;	
		} elseif($token) {			
			$tokenID = $this->Users_Model->isToken($token, "Recover");
			
			if($tokenID > 0) {
				$vars["tokenID"] = $tokenID;
			} else {
				redirect();
			}
		} 

		$this->helper(array("forms", "html"));

		$vars["view"] = $this->view("recover", TRUE);
		
		$this->render("content", $vars);
	}
	
	public function register() {	
		$this->helper(array("html", "alerts"));
				
		if(!SESSION("ZanUser")) {
			$this->title(decode(__("Register")));

			$this->helper("forms");

			if(POST("register")) {
				$vars["name"]     = POST("name")  	 ? POST("name")     : NULL;
				$vars["email"]    = POST("email") 	 ? POST("email")    : NULL;
				$vars["pwd"]      = POST("password") ? POST("password") : NULL;

				if(POST("username")) {
					$status = $this->Users_Model->addUser();
				
					$vars["inserted"] = $status["inserted"];
					$vars["alert"]    = $status["alert"];	
					$vars["first"]    = TRUE;
				}			
			}

			$vars["view"] = $this->view("new", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function about() {
		isConnected();

		$data = $this->Users_Model->getInformation();

		if($data) {
			$this->helper(array("forms", "html"));
			$this->config("users", $this->application);
			$this->css("forms", "cpanel");
			$this->css("users", $this->application);

			if(POST("save")) {
				$this->helper("alerts");
				$vars["alert"] = $this->Users_Model->setInformation();
			}

			$this->js("about", $this->application);
			$this->js("jquery.jdpicker.js");

			$this->Configuration_Model  = $this->model("Configuration_Model");
			$this->Cache   				= $this->core("Cache");
			$list_of_countries 			= $this->Cache->data("countries", "world", $this->Configuration_Model, "getCountries", array(), 86400);

			foreach($list_of_countries as $country) {
				$countries[] = array(
					"option" => $country["Country"],
					"value"  => $country["Country"]
				);
			}

			$this->title(__("About me"));

			$vars["countries"]  = $countries;
			$vars["view"] 		= $this->view("about", TRUE);
			$vars["href"]  		= path("users/about/");
			$vars["data"]  		= $data;

			if($country = recoverPOST("country", encode($vars["data"][0]["Country"]))) {
				$list_of_cities = $this->Cache->data("$country-cities", "world", $this->Configuration_Model, "getCities", array($country), 86400);

				foreach($list_of_cities as $city) {
					$cities[] = array(
						"option" => $city["District"],
						"value"  => $city["District"]
					);
				}

				$vars["cities"] = $cities;
			}
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function password() {
		isConnected();
		
		$this->helper(array("forms", "html"));
		$this->config("users", $this->application);
		$this->css("forms", "cpanel");
		$this->css("users", $this->application);

		if(POST("save")) {
			$this->helper("alerts");
			$vars["alert"] = $this->Users_Model->changePassword();
		}

		$this->js("bootstrap");
		$this->js("www/lib/themes/newcodejobs/js/requestpassword.js");

		$this->title(htmlentities(__("Change password")));

		$vars["view"] = $this->view("password", TRUE);
		$vars["href"] = path("users/password/");

		$this->render("content", $vars);
	}

	public function email() {
		isConnected();

		$data = $this->Users_Model->getEmail();
		
		if($data) {
			$this->helper(array("forms", "html"));
			$this->config("users", $this->application);
			$this->css("forms", "cpanel");
			$this->css("users", $this->application);

			if(POST("save")) {
				$this->helper("alerts");
				$vars["alert"] = $this->Users_Model->changeEmail();
			}

			$this->js("bootstrap");
			$this->js("www/lib/themes/newcodejobs/js/requestpassword.js");

			$this->title(htmlentities(__("Change e-mail")));

			$vars["view"] = $this->view("email", TRUE);
			$vars["href"] = path("users/email/");
			$vars["data"] = $data;

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function avatar() {
		isConnected();

		$data = $this->Users_Model->getAvatar();
		
		if($data) {
			$this->helper(array("forms", "html"));
			$this->config("users", $this->application);
			$this->css("forms", "cpanel");
			$this->css("users", $this->application);
			$this->css("avatar", $this->application);
			$this->js("jquery.jcrop.js");
			$this->js("avatar", $this->application);

			$this->title(__("Avatar"));

			$vars["view"] = $this->view("avatar", TRUE);
			$vars["href"] = path("users/avatar/");
			$vars["data"] = $data;

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function social() {
		isConnected();

		if(POST("save")) {
			$this->helper("alerts");

			$vars["alert"] = $this->Users_Model->saveSocial();
		}

		$data = $this->Users_Model->getSocial();

		if($data) {
			$this->helper(array("forms", "html"));
			$this->config("users", $this->application);
			$this->css("forms", "cpanel");
			$this->css("users", $this->application);

			$this->title(__("Social Networks"));

			$vars["view"] = $this->view("social", TRUE);
			$vars["href"] = path("users/social/");
			$vars["data"] = $data;

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
}
