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

		$this->RESTClient = $this->core("RESTClient");
	}
	
	public function index() {
		$token = GET("code");

		$this->RESTClient->setURL("https://api.bufferapp.com/1/profiles.json?access_token=$token");

		$data = $this->RESTClient->GET();

		die(var_dump($data));
	}

}