<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Feedback_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->Feedback_Model = $this->model("Feedback_Model");
		$this->Templates 	  = $this->core("Templates");
		
		$this->application = "feedback";
		
		$this->Templates->theme();
	}
	
	public function index() {
		$this->feedback();
	}
	
	private function feedback() {
		$this->CSS("new", "users");
		$this->title("Feedback");

		$this->helper(array("forms", "html"));
		
		$vars["inserted"] = FALSE;

		$vars["view"] = $this->view("send", TRUE);
		
		if(POST("send")) {						
			$vars["alert"] = $this->Feedback_Model->send();			
		} 
		
		$this->render("content", $vars);
	}
}
