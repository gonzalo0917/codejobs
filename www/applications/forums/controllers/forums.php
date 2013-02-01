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
		$this->Cache        = $this->core("Cache");

		$this->Forums_Model = $this->model("Forums_Model");

		$this->Templates->theme();

		$this->language = whichLanguage();

		$this->helper("debugging");

		$this->helper("pagination");

		setURL();
	}
	
	public function index() { 
		$this->title("Forums");				
		
		if(segment(1, isLang()) and segment(2, isLang()) == "edit" and segment(3, isLang())) {
			$postID = segment(3, isLang());
			$forum  = segment(1, isLang()); 

			$this->getEditPost($postID, $forum);
		} elseif(segment(1, isLang()) and segment(2, isLang()) === "tag" and segment(3, isLang())) {	
			$tag = segment(3, isLang());

			$this->tag($tag);
		} elseif(segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "tag" and segment(5, isLang())) {
			$author = segment(3, isLang());
			$tag = segment(5, isLang());

			$this->author($author, $tag);
		} elseif(segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
			$author = segment(3, isLang());

			$this->author($author);
		} elseif(segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang())) {
			$author = segment(3, isLang());

			$this->author($author);
		} elseif(segment(1, isLang()) and segment(2, isLang()) > 0 and segment(3, isLang())) {
			$postID = segment(2, isLang());

			$this->getPost($postID);
		} elseif(segment(1, isLang())) {
			$forum = segment(1, isLang());

			$this->getForum($forum);
		} else {
			$this->getForums();
		}		
	}

	public function tag($tag) {
		$this->CSS("pagination");

		$limit = $this->limit("tag");

		$data = $this->Cache->data("tag-$tag-$limit-". $this->language, "forums", $this->Forums_Model, "getByTag", array($tag, $limit));

		if($data) {
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] 	 = segment(1, isLang());
			$vars["posts"]   = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]    = $this->view("forum", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function author($author, $tag = NULL) {	
		$this->CSS("pagination");
		
		if($tag !== NULL) {
			$limit = $this->limit("author-tag");
			$data = $this->Cache->data("author-$author-tag-$tag-$limit", "forums", $this->Forums_Model, "getByAuthorTag", array($author, $tag, $limit));

		} else {
			$limit = $this->limit("author");
			$data = $this->Cache->data("author-$author-$limit-". $this->language, "forums", $this->Forums_Model, "getByAuthor", array($author, $limit));	
		}

		if($data) {
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] 	 = segment(1, isLang());
			$vars["posts"]   = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]    = $this->view("forum", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function limit($type = "posts") {
		$start = 0;

		if($type === "author") {
			if(segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5, isLang()) * _maxLimit) - _maxLimit;
			}

			$count = $this->Forums_Model->count("author");

			$URL   = path("forums/". segment(1, isLang()). "/author/". segment(3, isLang()) ."/page/");
		} elseif($type === "tag") {	
			if(segment(2, isLang()) === "tag" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5, isLang()) * _maxLimit) - _maxLimit;
			}

			$count = $this->Forums_Model->count("tag");

			$URL = path("forums/". segment(1, isLang()). "/tag/". segment(3, isLang()) ."/page/");
		} elseif($type === "author-tag") { 
			$user  = segment(3, isLang());
			$tag   = segment(5, isLang());
			$start = (segment(6, isLang()) === "page" and segment(7, isLang()) > 0) ? (segment(7, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("forums/". segment(1, isLang()). "/author/$user/tag/$tag/page/");
			$count = $this->Forums_Model->count("author-tag");
		} elseif($type === "posts") { 
			$start = (segment(2, isLang()) === "page" and segment(3, isLang()) > 0) ? (segment(3, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("forums/". segment(1, isLang()). "/page/");
			$count = $this->Forums_Model->count();
		}

		$limit = $start .", ". _maxLimit;
		$this->helper("pagination");
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		
		return $limit;
	}

	public function publish() {
		if(POST("title") and POST("content")) {
			$data = $this->Forums_Model->savePost();

			if($data) {
				echo $data;
			} else {
				echo path();
			}
		}
	}

	public function updatePost() {

		if(POST("title") and POST("content")) {
			$data = $this->Forums_Model->updatePost();

			if($data) {
				echo $data;
			} else {
				echo path();
			}
		}
	}
	
	public function getForums() {
		$data = $this->Forums_Model->getForums($this->language);

		if($data) {
			$vars["forums"] = $data;
			$vars["view"]   = $this->view("forums", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function getForum($forum) {

		$this->CSS("pagination");

		$limit = $this->limit();

		$data = $this->Forums_Model->getByForum($forum, $this->language, $limit);

		if($data) { 
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] 	 = segment(1, isLang());
			$vars["posts"]   = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]    = $this->view("forum", TRUE);

			$this->render("content", $vars);
		} else {
			$data = $this->Forums_Model->getIDByForum($forum);

			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] 	 = segment(1, isLang());
			$vars["view"]    = $this->view("forum", TRUE);

			$this->render("content", $vars);
		}
	}

	public function getPost($postID) {
		$data = $this->Forums_Model->getPost($postID);

		if($data) {
			$this->helper("time");
			$this->css("posts", "blog");
			$this->js("forums", "forums");

			$vars["posts"] = $data;
			$vars["view"]  = $this->view("posts", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function getEditPost($postID, $forum) {
		$data = $this->Forums_Model->getPostToEdit($postID);

		if($data) {
			$this->helper("time");
			$this->css("posts", "blog");
			$this->js("forums", "forums");

			$vars["forum"] = $forum;
			$vars["data"]  = $data; 
			$vars["view"]  = $this->view("edit", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function publishComment() {
		$this->Forums_Model->saveComment(POST("fid"), POST("content"));
	}
}