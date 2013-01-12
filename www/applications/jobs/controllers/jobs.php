<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Jobs_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("jobs");

		$this->Templates->theme();
		
		$this->Jobs_Model = $this->model("Jobs_Model");
	}
	
	public function add() {
		isConnected();
		
		if(POST("save")) {
			$vars["alert"] = $this->Jobs_Model->save();
		} 

		$vars["countries"]   = $this->Jobs_Model->getCountries();

		if(POST("preview")) {
			$this->helper("time");

			$this->title(__("Jobs") ." - ". htmlentities(encode(POST("title", "decode", NULL)), ENT_QUOTES, "UTF-8"));

			$data = $this->Jobs_Model->preview();

			if($data) {
				$this->CSS("jobs", $this->application);
				$this->js("preview", $this->application);
				
				$this->config("user", "jobs");

				$vars["jobs"] = $data;
				$vars["view"] = $this->view("preview", TRUE);
				
				$this->render("content", $vars);
			} else {
				redirect();
			}
		} else {
			$this->CSS("forms", "cpanel");

			$this->helper(array("html", "forms"));

			$this->config("user", "jobs");

			$vars["view"] = $this->view("new", TRUE);

			$this->render("content", $vars);
		}

	}

}