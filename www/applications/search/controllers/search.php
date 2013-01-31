<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Search_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->application = $this->app("blog");
		$this->config($this->application);
		
		$this->Templates  = $this->core("Templates");
		$this->Cache 	  = $this->core("Cache");
		
		$this->Search_Model = $this->model("Search_Model");
				
		$this->Templates->theme();

		$this->language = whichLanguage();

		$this->helper("router");

		setURL();
	}
	
	public function index() { 
		if(POST("app") and POST("term")) {			
			$app  = POST("app");
			$term = POST("term");

			$apps = array("blog", "codes", "bookmarks");

			if(in_array($app, $apps)) {
				$this->Search_Model->search($term);
			}

			$term = slug($term);

			if($app === "codes") {
				echo path("$app/language/". $term);
			} else {
				echo path("$app/tag/". $term);
			}
		}
	}

}