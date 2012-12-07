<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Controller extends ZP_Load {
		
	public function __construct() {		
		$this->app("cpanel");
		
		$this->application = whichApplication();
		
		$this->CPanel = $this->classes("cpanel", "CPanel", NULL, "cpanel");
		
		$this->isAdmin = $this->CPanel->load();
		
		$this->vars = $this->CPanel->notifications();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme("cpanel");
	}
	
	public function index() {
		if($this->isAdmin) {
			redirect("cpanel");
		} else {
			$this->login();
		}
	}
	
	public function edit() {
		if(!$this->isAdmin) {
			$this->login();
		}

		$this->helper("forms");		
		$this->title("Edit");
		
		$this->CSS("forms", "cpanel");
		
		$Model = ucfirst($this->application) ."_Model";
		
		$this->$Model = $this->model($Model);
		
		if(POST("edit")) {
			$this->vars["alert"] = $this->$Model->cpanel("edit");
		} elseif(POST("cancel")) {
			redirect("cpanel");
		} elseif(POST("minify") or POST("minify_css") or POST("minify_js")) {
			$this->helper("minify", $this->application);
			$this->helper("alerts");
			
			if(POST("minify_css")) {
				minify("css");
			} elseif(POST("minify_js")) {
				minify("js");
			} else {
				minify();
			}

			$this->vars["alert"] = getAlert("Updated successfully", "success");
		} elseif(POST("delete_cache")) {
			$this->Cache = $this->core("Cache");
			$this->helper("alerts");

			switch(POST("cache")) {
				case "blog": case "bookmarks": case "codes": case "pages": case "world":
					$this->Cache->removeAll(POST("cache"));
					$this->vars["alert"] = getAlert("The cache files were removed", "success");
				break;
				default:
					$this->vars["alert"] = getAlert("Does not exist cache group specified");
			}
		}
		
		$data = $this->$Model->getByID(1);
	
		if($data) {
			$this->Applications_Model = $this->model("Applications_Model");
			
			$this->vars["themes"]		   = $this->Templates->getThemes($data[0]["Theme"]);
			$this->vars["defaultApplications"] = $this->Applications_Model->getDefaultApplications($data[0]["Application"]);
			$this->vars["data"]		   = $data;
		
			$this->vars["view"] = $this->view("edit", TRUE, $this->application);
			
			$this->render("content", $this->vars);
		} else {
			redirect(path($this->application ."/cpanel/results"));
		}
	}

	public function minifier() {
		if(!$this->isAdmin) {
			$this->login();
		}

		$this->helper("forms");		
		$this->title(__("Minifier"));
		
		$this->CSS("forms", "cpanel");
		
		if(POST("minify") and POST("code") and POST("type")) {
			$this->helper(array("html", "alerts"));

			$type = POST("type");
			$code = POST("code", "clean");

   			$this->vars["code"]  = compress($code, $type);
	   		$this->vars["type"]  = $type;
	   		$this->vars["alert"] = getAlert("The code has been minified", "success");
		}

		$this->vars["view"] = $this->view("minifier", TRUE, $this->application);	
		
		$this->render("content", $this->vars);
	}

	public function tv() {
		if(!$this->isAdmin) {
			$this->login();
		}

		$this->helper(array("forms", "html"));		
		$this->title(__("TV"));
		
		$this->CSS("forms", "cpanel");
		
		$Model = ucfirst($this->application) ."_Model";
		
		$this->$Model = $this->model($Model);
		$this->Cache  = $this->core("Cache");
		
		if(POST("save")) {
			$this->Cache->removeAll("tv");
			
			$this->vars["alert"] = $this->$Model->cpanel("tv");
		}

		$data = $this->Cache->data("settings", "tv", $this->$Model, "getTV", array(), 86400);
	
		if($data) {
			$this->vars["data"] = $data;		
			$this->vars["view"] = $this->view("tv", TRUE, $this->application);	
			
			$this->render("content", $this->vars);
		} else {
			redirect(path($this->application ."/cpanel/edit"));
		}
	}
	
	public function login() {
		
		$this->title("Login");
		$this->CSS("login", "users");
		
		if(POST("connect")) {	
			$this->Users_Controller = $this->controller("Users_Controller");
			
			$this->Users_Controller->login("cpanel");
		} else {
			$this->vars["URL"]  = getURL();
			$this->vars["view"] = $this->view("login", TRUE, "cpanel");
		}
		
		$this->render("include", $this->vars);
		$this->rendering("header", "footer");
		
		exit;
	}
}