<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Pages_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->Templates   = $this->core("Templates");
		$this->Pages_Model = $this->model("Pages_Model");
		
		$this->application = $this->app("pages");
		
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

	private function getView($view = NULL) {
		$view = segment(1, isLang());
		$vars["view"] = $this->view("$view", TRUE);
		
		$this->render("content", $vars);			
	}
		
	public function getBySlug($slug = NULL) {		
		$data = ($slug) ? $this->Pages_Model->getBySlug($slug) : $this->Pages_Model->getByDefault();			
		
		$this->title($data[0]["Title"]);		
		
		if(is_array($data)) {
			$vars["title"]	 = $data[0]["Title"];
			$vars["content"] = $data[0]["Content"];
			$vars["view"]    = $this->view("page", TRUE, "pages");
			
			$this->render("content", $vars);			
		} else {
			redirect();
		}
	}
	
	private function getByDefault() {		
		$data = $this->Pages_Model->getByDefault();		
		
		$this->title($data[0]["Title"]);
		
		if(is_array($data)) {
			$vars["title"]	 = $data[0]["Title"];
			$vars["content"] = $data[0]["Content"];
			$vars["view"]    = $this->view("page", TRUE);
			
			$this->render("content", $vars);
		} else {
			$this->render("error404");
		}
	}
}