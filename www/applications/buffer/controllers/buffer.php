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

	public function create($app = "all") {
		if($app === "blog") {
			$this->Blog_Model = $this->model("Blog_Model");

			$posts = $this->Blog_Model->getBufferPosts();			

			foreach($posts as $post) {
				$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"], FALSE, $post["Language"]);

				$data = array(
					"text" 			=> $post["Title"] ." ". $URL ." ". _bufferVia,
					"profile_ids[]" => _bufferProfile
				);					

				$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

				$this->RESTClient->POST($data);
			}					
		} elseif($app === "bookmarks") {
			$this->Bookmarks_Model = $this->model("Bookmarks_Model");

			$bookmarks = $this->Bookmarks_Model->getBufferBookmarks();			
			
			foreach($bookmarks as $bookmark) {
				$URL = path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], FALSE, $bookmark["Language"]);

				$data = array(
					"text" 			=> $bookmark["Title"] ." ". $URL ." ". _bufferVia,
					"profile_ids[]" => _bufferProfile
				);				

				$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

				$this->RESTClient->POST($data);
			}			
		} elseif($app === "codes") {
			$this->Codes_Model = $this->model("Codes_Model");

			$codes = $this->Codes_Model->getBufferCodes();			
			
			foreach($codes as $code) {
				$URL = path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);

				$data = array(
					"text" 			=> $code["Title"] ." ". $URL ." ". _bufferVia,
					"profile_ids[]" => _bufferProfile
				);				

				$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

				$this->RESTClient->POST($data);
			}			
		} else {
			$this->Blog_Model 	   = $this->model("Blog_Model");
			$this->Bookmarks_Model = $this->model("Bookmarks_Model");
			$this->Codes_Model     = $this->model("Codes_Model");

			$posts 	   = $this->Blog_Model->getBufferPosts();
			$bookmarks = $this->Bookmarks_Model->getBufferBookmarks();
			$codes     = $this->Codes_Model->getBufferCodes();
			
			$records = array_merge($posts, $bookmarks);
			$records = array_merge($codes, $records);

			shuffle($records);

			foreach($records as $record) {
				if(isset($record["ID_Post"])) {
					$URL = path("blog/". $record["Year"] ."/". $record["Month"] ."/". $record["Day"] ."/". $record["Slug"], FALSE, $record["Language"]);

					$data = array(
						"text" 			=> $record["Title"] ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => _bufferProfile
					);					
				} elseif(isset($record["ID_Bookmark"])) {
					$URL = path("bookmarks/". $record["ID_Bookmark"] ."/". $record["Slug"], FALSE, $record["Language"]);

					$data = array(
						"text" 			=> $record["Title"] ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => _bufferProfile
					);				
				} elseif(isset($record["ID_Code"])) {
					$URL = path("codes/". $record["ID_Code"] ."/". $record["Slug"], FALSE, $record["Language"]);

					$data = array(
						"text" 			=> $record["Title"] ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => _bufferProfile
					);				
				}

				$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

				$this->RESTClient->POST($data);
			}	
		}

		echo "Buffer complete";
	}

}
