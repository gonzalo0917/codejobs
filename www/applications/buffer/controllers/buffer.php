<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Buffer_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->application = $this->app("buffer");			

		$this->RESTClient = $this->core("RESTClient");

		$this->bufferProfiles = array("504fea9d6ffb363e53000031");
	}
	
	public function index() {}

	public function create($app = "all", $profile = "all", $language = "Spanish") {
		$this->config($this->application);
		
		$count = count($this->bufferProfiles) - 1;

		if($app === "sabio") {
			$this->Blog_Model = $this->model("Blog_Model");

			$tweets = $this->Blog_Model->getBufferSabio();

			if(strlen($profile) === 24) {
				foreach($tweets as $tweet) {
					if(strlen($tweet["Phrase"]) <= 140) {
						$data = array(
							"text" 			=> stripslashes($tweet["Phrase"]),
							"profile_ids[]" => $profile
						);					

						$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

						$this->RESTClient->POST($data);
					}
				}
			}
		} elseif($app === "blog") {
			$this->Blog_Model = $this->model("Blog_Model");

			$posts = $this->Blog_Model->getBufferPosts($language);			

			if($profile === "all") {
				for($i = 0; $i <= $count; $i++) {
					foreach($posts as $post) {
						$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"], FALSE, $post["Language"]);					
		
						$data = array(
							"text" 			=> stripslashes($post["Title"]) ." ". $URL ." ". _bufferVia,
							"profile_ids[]" => $this->bufferProfiles[$i]
						);		

						echo $data["text"] ."<br />";			

						$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

						$this->RESTClient->POST($data);	
					}	
				}
			} elseif(strlen($profile) === 24) {
				foreach($posts as $post) {
					$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"], FALSE, $post["Language"]);					
	
					$data = array(
						"text" 			=> stripslashes($post["Title"]) ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => $profile
					);					

					echo $data["text"] ."<br />";

					$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

					$this->RESTClient->POST($data);
				}
			} 				
		} elseif($app === "bookmarks") {
			$this->Bookmarks_Model = $this->model("Bookmarks_Model");

			$bookmarks = $this->Bookmarks_Model->getBufferBookmarks();			
			
			if($profile === "all") {
				for($i = 0; $i <= $count; $i++) {
					foreach($bookmarks as $bookmark) {
						$URL = path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], FALSE, $bookmark["Language"]);

						$count = count($this->bufferProfiles) - 1;

						$data = array(
							"text" 			=> stripslashes($bookmark["Title"]) ." ". $URL ." ". _bufferVia,
							"profile_ids[]" => $this->bufferProfiles[$i]
						);				

						echo $data["text"] ."<br />";

						$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

						$this->RESTClient->POST($data);					
					}
				}	
			} elseif(strlen($profile) === 24) {
				foreach($bookmarks as $bookmark) {
					$URL = path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], FALSE, $bookmark["Language"]);

					$count = count($this->bufferProfiles) - 1;

					$data = array(
						"text" 			=> stripslashes($bookmark["Title"]) ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => $profile
					);				

					echo $data["text"] ."<br />";

					$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

					$this->RESTClient->POST($data);					
				}
			}		
		} elseif($app === "codes") {
			$this->Codes_Model = $this->model("Codes_Model");

			$codes = $this->Codes_Model->getBufferCodes();			
			
			if($profile === "all") {
				for($i = 0; $i <= $count; $i++) {
					foreach($codes as $code) {
						$URL = path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);

						$count = count($this->bufferProfiles) - 1;

						$data = array(
							"text" 			=> stripslashes($code["Title"]) ." ". $URL ." ". _bufferVia,
							"profile_ids[]" => $this->bufferProfiles[$i]
						);				

						echo $data["text"] ."<br />";

						$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

						$this->RESTClient->POST($data);
					}
				}	
			} elseif(strlen($profile) === 24) {
				foreach($codes as $code) {
					$URL = path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);

					$count = count($this->bufferProfiles) - 1;

					$data = array(
						"text" 			=> stripslashes($code["Title"]) ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => $profile
					);				

					echo $data["text"] ."<br />";

					$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

					$this->RESTClient->POST($data);
				}
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
						"text" 			=> stripslashes($record["Title"]) ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => _bufferProfile
					);					
				} elseif(isset($record["ID_Bookmark"])) {
					$URL = path("bookmarks/". $record["ID_Bookmark"] ."/". $record["Slug"], FALSE, $record["Language"]);

					$data = array(
						"text" 			=> stripslashes($record["Title"]) ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => _bufferProfile
					);				
				} elseif(isset($record["ID_Code"])) {
					$URL = path("codes/". $record["ID_Code"] ."/". $record["Slug"], FALSE, $record["Language"]);

					$data = array(
						"text" 			=> stripslashes($record["Title"]) ." ". $URL ." ". _bufferVia,
						"profile_ids[]" => _bufferProfile
					);				
				}

				echo $data["text"] ."<br />";

				$this->RESTClient->setURL("https://api.bufferapp.com/1/updates/create.json?access_token=". _bufferToken);

				$this->RESTClient->POST($data);
			}	
		}

		echo "Buffer complete";
	}

}
