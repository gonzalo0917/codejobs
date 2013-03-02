<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Controller extends ZP_Load 
{	
	private $pagination = null;

	public function __construct() 
	{
		$this->config("forums");
		
		$this->Templates = $this->core("Templates");
		$this->Cache = $this->core("Cache");
		$this->Forums_Model = $this->model("Forums_Model");
		
		$this->Templates->theme();
		$this->language = whichLanguage();
		
		$this->helper("debugging");
		$this->helper("pagination");
		
		setURL();
	}

	public function index()
	{ 
		$this->title("Forums");

		if (segment(1, isLang()) and segment(2, isLang()) == "delete" and segment(3, isLang())) {
			$forum = segment(1, isLang());
			$idPost = segment(3, isLang());
			$this->deletePost($idPost, $forum);
		} elseif (segment(1, isLang()) and segment(2, isLang()) == "edit" and segment(3, isLang())) {
			$postID = segment(3, isLang());
			$forum = segment(1, isLang()); 

			$this->getEditPost($postID, $forum);
		} elseif (segment(1, isLang()) and segment(2, isLang()) == "editComment" and segment(3, isLang())) {
			$postID = segment(3, isLang());
			$forum = segment(1, isLang()); 

			$this->getEditComment($postID, $forum);
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "tag" and segment(3, isLang())) {	
			$tag = segment(3, isLang());

			$this->tag($tag);
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "tag" and segment(5, isLang())) {
			$author = segment(3, isLang());
			$tag = segment(5, isLang());

			$this->author($author, $tag);
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
			$author = segment(3, isLang());

			$this->author($author);
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang())) {
			$author = segment(3, isLang());

			$this->author($author);
		} elseif (segment(1, isLang()) and segment(2, isLang()) > 0) {
			$postID = segment(2, isLang());

			$this->getPost($postID);
		} elseif (segment(1, isLang())) {
			$forum = segment(1, isLang());

			$this->getForum($forum);
		} else {
			$this->getForums();
		}
	}

	public function tag($tag)
	{
		$this->CSS("pagination");

		$limit = $this->limit("tag");
		$data = $this->Cache->data("tag-$tag-$limit-". $this->language, "forums", $this->Forums_Model, "getByTag", array($tag, $limit));

		if ($data) {
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] = segment(1, isLang());
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("forum", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function author($author, $tag = null)
	{
		$this->CSS("pagination");

		if ($tag !== null) {
			$limit = $this->limit("author-tag");
			$data = $this->Cache->data("author-$author-tag-$tag-$limit", "forums", $this->Forums_Model, "getByAuthorTag", array($author, $tag, $limit));

		} else {
			$limit = $this->limit("author");
			$data = $this->Cache->data("author-$author-$limit-". $this->language, "forums", $this->Forums_Model, "getByAuthor", array($author, $limit));
		}

		if ($data) {
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] = segment(1, isLang());
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("forum", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function limit($type = "posts")
	{
		$start = 0;

		if ($type === "author") {
			if (segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}

			$count = $this->Forums_Model->count("author");
			$URL = path("forums/". segment(1, isLang()). "/author/". segment(3, isLang()) ."/page/");
		} elseif ($type === "tag") {
			if (segment(2, isLang()) === "tag" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}

			$count = $this->Forums_Model->count("tag");
			$URL = path("forums/". segment(1, isLang()). "/tag/". segment(3, isLang()) ."/page/");
		} elseif ($type === "author-tag") { 
			$user = segment(3, isLang());
			$tag = segment(5, isLang());
			$start = (segment(6, isLang()) === "page" and segment(7, isLang()) > 0) ? (segment(7, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("forums/". segment(1, isLang()). "/author/$user/tag/$tag/page/");
			$count = $this->Forums_Model->count("author-tag");
		} elseif ($type === "posts") { 
			$start = (segment(2, isLang()) === "page" and segment(3, isLang()) > 0) ? (segment(3, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("forums/". segment(1, isLang()). "/page/");
			$count = $this->Forums_Model->count();
		}

		$limit = $start .", ". MAX_LIMIT;

		$this->helper("pagination");
		$this->pagination = ($count > MAX_LIMIT) ? paginate($count, MAX_LIMIT, $start, $URL) : null;
		
		return $limit;
	}

	public function publish()
	{
		if (POST("title") and POST("content") and POST("fname")) {
			$data = $this->Forums_Model->savePost();

			echo ($data) ? $data : path();
		}
	}

	public function updatePost()
	{
		if (POST("title") and POST("content")) {
			$data = $this->Forums_Model->updatePost();

			echo ($data) ? $data : path();
		}
	}

	public function cancelEdit()
	{
		echo path("forums/". POST("fname"));		
	}

	public function cancelComment()
	{
		$UrlCancel = path("forums/". POST("fname") ."/". POST("fid"));
		echo $UrlCancel;
	}

	public function updateComment()
	{
		if (POST("content")) {
			$data = $this->Forums_Model->updateComment();

			echo ($data) ? $data : path();			
		}
	}

	public function deletePost($postID, $forum)
	{
		$this->Forums_Model->deletePost($postID);
		$this->getForum($forum);
	}

	public function getForums()
	{
		$data = $this->Forums_Model->getForums($this->language);

		if ($data) {
			$vars["forums"] = $data;
			$vars["view"] = $this->view("forums", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function getForum($forum)
	{
		$this->CSS("pagination");
		
		$limit = $this->limit();
		$data = $this->Forums_Model->getByForum($forum, $this->language, $limit);

		if ($data) { 
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");

			if(!SESSION("ZanUser") and !isset($data[0]["Forum_Name"])) {
				redirect("forums");
			}

			$vars["ckeditor"] = $this->js("ckeditor", "basic", true);
			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] = isset($data[0]["Forum_Name"]) ? $data[0]["Forum_Name"] : $data[0]["Title"];
			$vars["posts"] = isset($data[0]["Forum_Name"]) ? $data : false;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("forum", true);

			$this->render("content", $vars);
		}
	}

	public function getPost($postID)
	{
		$data = $this->Forums_Model->getPost($postID);

		if ($data) {
			$this->helper("time");
			$this->css("posts", "blog");
			$this->js("forums", "forums");

			$vars["ckeditor"] = $this->js("ckeditor", "basic", true);
			$vars["forum"] = segment(1, isLang());
			$vars["posts"] = $data;
			$vars["view"] = $this->view("posts", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function getEditPost($postID, $forum)
	{
		$data = $this->Forums_Model->getPostToEdit($postID);
		
		if ($data) {
			$this->helper("time");
			$this->css("posts", "blog");
			$this->js("forums", "forums");

			$vars["ckeditor"] = $this->js("ckeditor", "basic", true);
			$vars["forum"] = $forum;
			$vars["data"] = $data; 
			$vars["view"] = $this->view("edit", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function getEditComment($postID, $forum)
	{

		$data = $this->Forums_Model->getCommentToEdit($postID);

		if ($data) {
			$this->helper("time");
			$this->css("posts", "blog");
			$this->js("forums", "forums");
			
			$vars["forum"] = $forum;
			$vars["data"] = $data;
			$vars["view"] = $this->view("editComment", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function publishComment()
	{
		$this->Forums_Model->saveComment(POST("fid"), POST("content"), POST("fname"));
	}
}