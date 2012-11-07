<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Multimedia_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->application = $this->app("multimedia");
	}
	
	public function upload($type = "image") {
		$this->helper("files");

		$this->Files = $this->core("Files");

		if($type === "image") {
			$this->uploadImage
		} else {

		}
	}
}