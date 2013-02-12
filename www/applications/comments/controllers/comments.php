C<?php
/**
 * Access from index.php:
 */
if(!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Comments_Controller extends ZP_Load {
	
	private $pagination = NULL;
	
	public function __construct() {		
		$this->Templates  = $this->core("Templates");		
		$this->Comments_Model = $this->model("Comments_Model");
		
		$helpers = array("router", "time");
		$this->helper($helpers);
		
		$this->application = "comments";	
		
		$this->Templates->theme(WEB_THEME);
	}
	
	public function index() {
		
	}
	
}
