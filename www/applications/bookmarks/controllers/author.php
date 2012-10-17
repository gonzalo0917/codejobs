<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Author_Controller extends ZP_Controller {
	
	private $vars = array();
	
	public function __construct() {		
		$this->app("bookmarks");
		
		$this->Controller 	= ucfirst($this->application) ."_Controller";
			
		$this->{"$this->Controller"} = $this->controller($this->Controller);		
	}
	
	public function index($user, $year = NULL, $month = NULL, $day = NULL, $slug = NULL) { 
		$this->Bookmarks_Controller->index($year, $month, $day, $slug);
	}
}
