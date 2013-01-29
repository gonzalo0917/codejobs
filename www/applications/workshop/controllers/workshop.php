<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Workshop_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->application = $this->app("workshop");
		$this->config($this->application);
		
		$this->Templates  = $this->core("Templates");
		$this->Cache 	  = $this->core("Cache");
		
		$this->Workshop_Model = $this->model("Workshop_Model");
				
		$this->Templates->theme();

		$this->config("workshop");

		$this->language = whichLanguage();
		$this->helper(array("forms", "html", "time"));
	}

	public function index() {
		$this->meta("language", whichLanguage(FALSE));

		$this->newProposal();
	}

	public function newProposal() {
		$this->title(__("Workshop"));
		$this->CSS(_corePath ."/vendors/css/frameworks/bootstrap/bootstrap-codejobs.css", NULL, FALSE, TRUE);
		$this->CSS("new", $this->application);


		$vars["view"] = $this->view("new", TRUE);

		if(POST("send") and SESSION("ZanUser")) {
			$vars["alert"] = $this->Workshop_Model->newProposal();
		}
		
		$this->render("content", $vars); 
	}
}
