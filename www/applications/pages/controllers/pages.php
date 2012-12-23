<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Pages_Controller extends ZP_Load {
	
	public function __construct() {
		$this->Cache 	   = $this->core("Cache");
		$this->Templates   = $this->core("Templates");
		$this->Pages_Model = $this->model("Pages_Model");
		
		$this->application = $this->app("pages");
		$this->language    = whichApplication();
		
		$this->Templates->theme();
	}
	
	public function index($slug = NULL) {
		$this->CSS("style", $this->application);
		
		if(!is_null($slug)) {
			$this->getBySlug($slug);		
		} else {
			$this->getByDefault();			
		}		
	}

	public function tv() {
		$this->CSS("style", "pages");
		
		$this->Configuration_Model = $this->model("Configuration_Model");
		$this->Cache 			   = $this->core("Cache");

		$data = $this->Cache->data("settings", "tv", $this->Configuration_Model, "getTV", array(), 86400);

		if($data) {
			$this->vars["tv"] 	= '<iframe width="850" height="420" src="'. $data[0]["TV"] .'" frameborder="0" allowfullscreen></iframe>';
			$this->vars["chat"] = $data[0]["Enable_Chat"];
		} else {
			$this->vars["tv"] 	= '<iframe width="850" height="420" src="http://www.youtube.com/embed/aLlcRw9vEjM" frameborder="0" allowfullscreen></iframe>';
			$this->vars["chat"] = FALSE;
		}

		$this->view("tv", $this->vars, "pages");

	}
		
	public function getBySlug($slug = NULL) {	
		if($slug) {
			$data = $this->Cache->data("$slug". $this->language, "pages", $this->Pages_Model, "getBySlug", array($slug));	
		} else {
			$data = $this->Cache->data("default". $this->language, "pages", $this->Pages_Model, "getByDefault", array());
		}
	
		$this->title($data[0]["Title"]);		
		
		if($data) {
			$vars["title"]	 = $data[0]["Title"];
			$vars["content"] = $data[0]["Content"];
			$vars["view"]    = $this->view("page", TRUE, "pages");
			
			$this->render("content", $vars);			
		} else {
			redirect();
		}
	}
	
	private function getByDefault() {		
		$data = $this->Cache->data("default". $this->language, "pages", $this->Pages_Model, "getByDefault", array());
		
		$this->title($data[0]["Title"]);
		
		if($data) {
			$vars["title"]	 = $data[0]["Title"];
			$vars["content"] = $data[0]["Content"];
			$vars["view"]    = $this->view("page", TRUE);
			
			$this->render("content", $vars);
		} else {
			$this->render("error404");
		}
	}
}