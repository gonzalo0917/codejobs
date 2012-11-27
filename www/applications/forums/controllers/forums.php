<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Controller extends ZP_Load {
	
	private $pagination = NULL;
	
	public function __construct() {
		$this->config("forums");

		$this->Templates    = $this->core("Templates");
		$this->Forums_Model = $this->model("Forums_Model");

		$this->Templates->theme();

		$this->language = whichLanguage();
	}
	
	public function index() {
		$this->title("Forums");		
	}
	
	public function getForums() {
		$data = $this->Forums_Model->getForums($this->language);

		die(var_dump($data));
	}
}