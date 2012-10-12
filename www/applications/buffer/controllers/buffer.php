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

		$this->config($this->application);

		$this->RESTClient = $this->core("RESTClient");
	}
	
	public function index() {	
		$this->RESTClient->setURL("https://api.bufferapp.com/1/profiles.json?access_token=". _bufferToken);

		$data = $this->RESTClient->GET();

		die(var_dump($data));
	}

	public function create($app) {
		if($app === "blog") {
			$this->Blog_Model = $this->model("Blog_Model");

			$data = $this->Blog_Model->getBufferPosts();

			die(var_dump($data));

			$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

			$data = array(
				"text" => "Cómo posicionar tu marca en Internet http://www.codejobs.biz/es/blog/2012/08/24/como-posicionar-tu-marca-en-internet#.UHhfIqq13mc.twitter vía @codejobs",
				"profile_ids[]" => "504fea9d6ffb363e53000031",
				"shorten" => TRUE
			);

			$this->RESTClient->POST($data);

			echo "Posteado";
		}
	}

}