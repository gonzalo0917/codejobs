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
	}
	
	public function index() {
		$this->title("Forums");		

		if(segment(1, isLang()) and segment(2, isLang()) === "tag" and segment(3, isLang())) {
			
			$tag = segment(3, isLang());

			$this->tag($tag);

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
			$vars["forum"] 	 = $data[0]["Forum"];
			$vars["posts"]   = $data;
			$vars["view"]    = $this->view("forum", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function limit($type = "posts") {
		$start = 0;

		if($type === "tag") {	
			if(segment(2, isLang()) === "tag" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5, isLang()) * _maxLimit) - _maxLimit;
			}

			$count = $this->Forums_Model->count("tag");
			$URL = path("forums/". segment(1, isLang()). "/tag/". segment(3, isLang()) ."/page/");
		}

		$limit = $start .", ". _maxLimit;
		$this->helper("pagination");
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}

	public function publish() {
		if(POST("title") and POST("content")) {
			$this->Forums_Model->savePost();
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
		$data = $this->Forums_Model->getByForum($forum, $this->language);

		if($data) {
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] 	 = $data[0]["Forum"];
			$vars["posts"]   = $data;
			$vars["view"]    = $this->view("forum", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function getPost($postID) {
		$data = $this->Forums_Model->getPost($postID);

		if($data) {
			$this->helper("time");
			$this->css("posts", "blog");

			$vars["posts"] = $data;
			$vars["view"]  = $this->view("posts", TRUE);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
}