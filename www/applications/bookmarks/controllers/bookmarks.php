<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Bookmarks_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("bookmarks");
		
		$this->Templates->theme();

		$this->config("bookmarks");
		
		$this->Bookmarks_Model = $this->model("Bookmarks_Model");

		$this->helper("pagination");

		setURL();
	}
	
	public function index($bookmarkID = 0) {
		$this->meta("language", whichLanguage(FALSE));		
                
		if($bookmarkID !== "add") {
			if($bookmarkID > 0) {
				$this->go($bookmarkID);
			} else {
				$this->getBookmarks();
			}
		}
	}

	public function rss() {
		$this->helper("time");

		$data = $this->Cache->data("rss", "bookmarks", $this->Bookmarks_Model, "getRSS", array(), 86400);
		
		if($data) {
			$vars["bookmarks"]= $data;	

			$this->view("rss", $vars, $this->application);
		} else {
			redirect();
		}

	}

	public function add($ID = 0) {
		isConnected();
		
		if(POST("save")) {
			$action = ((int) POST("ID") !== 0) ? "edit" : "save";

			$vars["alert"] = $this->Bookmarks_Model->add($action);
		} 

		if(POST("preview")) {
			$this->helper("time");

			$this->title(__("Bookmarks") ." - ". htmlentities(encode(POST("title", "decode", NULL)), ENT_QUOTES, "UTF-8"));

			$data = $this->Bookmarks_Model->preview();

			if($data) {
				$this->CSS("bookmarks", $this->application);
				$this->js("preview", $this->application);
				
				$this->config("user", "bookmarks");

				$vars["bookmark"] = $data;
				$vars["view"] 	  = $this->view("preview", TRUE);
			
				$this->render("content", $vars);
			} else {
				redirect();
			}
		} else {
			if((int) $ID !== 0) {
				$data = $this->Bookmarks_Model->getBookmarkByID($ID);
				
				if(!$data) {
					redirect();
				}

				$vars["data"] = $data[0];
			}

			$this->CSS("forms", "cpanel");
			$this->CSS("add", "bookmarks");
			$this->js("add", "bookmarks");

			$this->helper(array("html", "forms"));

			$this->config("user", "bookmarks");

			$vars["view"] = $this->view("new", TRUE);

			$this->render("content", $vars);
		}

	}

	public function author($user = NULL, $tagLabel = NULL, $tag = NULL) {
		if($user === NULL) {
			redirect($this->application);
		} elseif($tagLabel === NULL or $tagLabel === "page") {
			$this->getBookmarksByAuthor($user);
		} elseif($tagLabel === "tag" and $tag !== NULL) {
			$this->getBookmarksByTag($user, $tag);
		} else {
			redirect("$this->application/author/$user");
		}
	}

	public function like($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setLike($ID, "bookmarks", 10);
	}

	public function dislike($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setDislike($ID, "bookmarks", 10);
	}

	public function report($ID) {
		$this->Bookmarks_Model->setReport($ID, "bookmarks", 10);
	}	

	public function tag($tag) {
		$this->title(__("Bookmarks"));
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("tag");

		$data = $this->Cache->data("tag-$tag-$limit", "bookmarks", $this->Bookmarks_Model, "getByTag", array($tag, $limit));

		if($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$this->helper("time");

			$vars["bookmarks"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("bookmarks", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function go($bookmarkID = 0) {
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");

		$data = $this->Cache->data("bookmark-$bookmarkID", "bookmarks", $this->Bookmarks_Model, "getByID", array($bookmarkID));

		if($data) {
			$this->helper("time");

			$this->title(__("Bookmarks") ." - ". decode($data[0]["Title"]), FALSE);
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
                        
			$vars["views"]    = $this->Bookmarks_Model->updateViews($bookmarkID);
			$vars["bookmark"] = $data[0];
			$vars["view"]     = $this->view("bookmark", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	public function visit($bookmarkID = 0) {
		$data = $this->Cache->data("bookmark-$bookmarkID", "bookmarks", $this->Bookmarks_Model, "getByID", array($bookmarkID));

		if($data) {
			$this->Bookmarks_Model->updateViews($bookmarkID);

			redirect($data[0]["URL"]);
		} else {
			redirect();
		}
	}

	private function getBookmarks() { 
		$this->title(__("Bookmarks"));
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		
		$data = $this->Cache->data("bookmarks-$limit", "bookmarks", $this->Bookmarks_Model, "getAll", array($limit));
	
		$this->helper("time");
		
		if($data) {	
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
                        
			$vars["bookmarks"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("bookmarks", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}

	private function getBookmarksByAuthor($author) {
		$this->title(__("Bookmarks of") ." ". $author);
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("author");
		
		$data = $this->Cache->data("author-$author-$limit", "bookmarks", $this->Bookmarks_Model, "getAllByAuthor", array($author, $limit));
	
		$this->helper("time");
		
		if($data) {	
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
                        
			$vars["bookmarks"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("bookmarks", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect($this->application);	
		} 
	}

	private function getBookmarksByTag($author, $tag) {
		$this->title(__("Bookmarks of") ." ". $author);
		$this->CSS("bookmarks", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("author-tag");
		
		$data = $this->Cache->data("author-$author-tag-$tag-$limit", "bookmarks", $this->Bookmarks_Model, "getAllByTag", array($author, $tag, $limit));
	
		$this->helper("time");
		
		if($data) {	
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
                        
			$vars["bookmarks"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("bookmarks", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}

	function request() {
		setURL(path());

		$URL = GET("url");

		if(!is_null($URL) and in_array("curl", get_loaded_extensions()) and SESSION("ZanUser")) {
			$title 		 = "";
			$description = "";
			$keywords 	 = "";

		    $ch = curl_init();

		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_URL, $URL);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		    $html = curl_exec($ch);
		    curl_close($ch);

		    $doc = new DOMDocument();
			@$doc->loadHTML($html);

			$nodes = $doc->getElementsByTagName('title');
			$title = @$nodes->item(0)->nodeValue;

			$metas = $doc->getElementsByTagName('meta');

			for($i = 0; $i < $metas->length; $i++) {
			    $meta = $metas->item($i);

			    if($meta->getAttribute('name') == 'description') {
			        $description = $meta->getAttribute('content');
			    }

			    if($meta->getAttribute('name') == 'keywords') {
			        $keywords = $meta->getAttribute('content');
			    }
			}

			$data = array(
				"Title" 	  => $title,
				"Description" => $description,
				"Keywords" 	  => $keywords
			);

			exit(json($data));
		}

		exit('{"Title": "", "Description": "", "Keywords": ""}');
	}

	private function limit($type = NULL) {
		$count = $this->Bookmarks_Model->count($type);	
		
		if(is_null($type)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("bookmarks/page/");
		} elseif($type === "tag") { 
			$tag   = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("bookmarks/tag/$tag/page/");
		} elseif($type === "author") { 
			$user  = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("bookmarks/author/$user/page/");
		} elseif($type === "author-tag") { 
			$user  = segment(2, isLang());
			$tag   = segment(4, isLang());
			$start = (segment(5, isLang()) === "page" and segment(6, isLang()) > 0) ? (segment(6, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("bookmarks/author/$user/tag/$tag/page/");
		}

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}
}