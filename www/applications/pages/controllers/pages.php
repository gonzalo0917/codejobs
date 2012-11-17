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
		
		$this->view("tv", NULL, "pages");
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