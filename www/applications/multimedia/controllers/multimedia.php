<?php
/**
 * Access from index.php:
 */
if(!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Multimedia_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->application = $this->app("multimedia");
	}

}