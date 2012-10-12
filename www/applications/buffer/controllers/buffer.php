<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Buffer_Controller extends ZP_Controller {
	
	public function __construct() {		
		$this->application = $this->app("buffer");	
	}
	
	public function index() {
		die("SI");
	}

}