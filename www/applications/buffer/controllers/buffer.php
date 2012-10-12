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

			$posts = $this->Blog_Model->getBufferPosts();

			$i = 0;

			foreach($posts as $post) {
				$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"], FALSE, $post["Language"]);

				$data = array(
					"text" 			=> encode($post["Title"]) ." ". $URL ." ". encode(_bufferVia),
					"profile_ids[]" => _bufferProfile
				);					

				$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

				$this->RESTClient->POST($data);
			}			

			

			echo "Buffer complete";
		}
	}

}