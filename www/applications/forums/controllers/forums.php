<?php
<<<<<<< HEAD
=======
/**
 * Access from index.php:
 */
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

<<<<<<< HEAD
class Forums_Controller extends ZP_Load 
{
=======
class Forums_Controller extends ZP_Load {
	
	private $pagination = null;
	
	public function __construct() {
		$this->config("forums");
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63

	private $pagination = null;

	public function __construct() {
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

<<<<<<< HEAD
	public function index()
	{ 
		$this->title("Forums");
=======
		if (segment(1, isLang()) and segment(2, isLang()) == "delete" and segment(3, isLang())) {
			$forum  = segment(1, isLang());
			$idPost = segment(3, isLang());
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63

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
<<<<<<< HEAD
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "tag" and segment(3, isLang())) {
			$tag = segment(3, isLang());

			$this->tag($tag);
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and 
			segment(3, isLang()) and segment(4, isLang()) === "tag" and segment(5, isLang())) {
=======
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "tag" and segment(3, isLang())) {	
			$tag = segment(3, isLang());

			$this->tag($tag);
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "tag" and segment(5, isLang())) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$author = segment(3, isLang());
			$tag = segment(5, isLang());

			$this->author($author, $tag);
<<<<<<< HEAD
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and 
			segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
=======
		} elseif (segment(1, isLang()) and segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
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
		$data = $this->Cache->data("tag-$tag-$limit-". $this->language, "forums", 
			$this->Forums_Model, "getByTag", array($tag, $limit));

<<<<<<< HEAD
=======
		$data = $this->Cache->data("tag-$tag-$limit-". $this->language, "forums", $this->Forums_Model, "getByTag", array($tag, $limit));

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($data) {
			$this->helper("time");
			$this->js("forums", "forums");
			$this->css("posts", "blog");
			$this->css("forums", "forums");
			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] = segment(1, isLang());
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
<<<<<<< HEAD
			$vars["view"] = $this->view("forum", true);
=======
			$vars["view"]    = $this->view("forum", true);

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

<<<<<<< HEAD
	public function author($author, $tag = null)
	{
		$this->CSS("pagination");

=======
	public function author($author, $tag = null) {	
		$this->CSS("pagination");
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($tag !== null) {
			$limit = $this->limit("author-tag");
			$data = $this->Cache->data("author-$author-tag-$tag-$limit", "forums", 
				$this->Forums_Model, "getByAuthorTag", array($author, $tag, $limit));

		} else {
			$limit = $this->limit("author");
			$data = $this->Cache->data("author-$author-$limit-". $this->language, "forums", 
				$this->Forums_Model, "getByAuthor", array($author, $limit));
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
<<<<<<< HEAD
			$vars["view"] = $this->view("forum", true);
=======
			$vars["view"]    = $this->view("forum", true);

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function limit($type = "posts")
	{
		$start = 0;

		if ($type === "author") {
<<<<<<< HEAD
			if (segment(2, isLang()) === "author" and segment(3, isLang()) and 
				segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
=======
			if (segment(2, isLang()) === "author" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				$start = (segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}

			$count = $this->Forums_Model->count("author");

<<<<<<< HEAD
			$URL = path("forums/". segment(1, isLang()). "/author/". segment(3, isLang()) ."/page/");
		} elseif ($type === "tag") {
=======
			$URL   = path("forums/". segment(1, isLang()). "/author/". segment(3, isLang()) ."/page/");
		} elseif ($type === "tag") {	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if (segment(2, isLang()) === "tag" and segment(3, isLang()) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}

			$count = $this->Forums_Model->count("tag");
			$URL = path("forums/". segment(1, isLang()). "/tag/". segment(3, isLang()) ."/page/");
		} elseif ($type === "author-tag") { 
<<<<<<< HEAD
			$user = segment(3, isLang());
			$tag = segment(5, isLang());
=======
			$user  = segment(3, isLang());
			$tag   = segment(5, isLang());
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
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
<<<<<<< HEAD
		return $limit;
	}

	public function publish()
	{
		if (POST("title") and POST("content") and POST("fname")) {
			$data = $this->Forums_Model->savePost();

=======

		
		return $limit;
	}

	public function publish() {
		if (POST("title") and POST("content") and POST("fname")) {
			$data = $this->Forums_Model->savePost();
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($data) {
				echo $data;
			} else {
				echo path();
			}
		}
	}

<<<<<<< HEAD
	public function updatePost()
	{
=======
	public function updatePost() {

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (POST("title") and POST("content")) {
			$data = $this->Forums_Model->updatePost();

			if ($data) {
				echo $data;
			} else {
				echo path();
			}
		}
	}

	public function cancelEdit()
	{
		$UrlEdit = path("forums/". POST("fname"));
		echo $UrlEdit;
	}

	public function cancelComment()
	{
		$UrlCancel = path("forums/". POST("fname") ."/". POST("fid"));
		echo $UrlCancel;
	}

<<<<<<< HEAD
	public function updateComment()
	{
=======
	public function updateComment() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (POST("content")) {
			$data = $this->Forums_Model->updateComment();

			if ($data) {
				echo $data;
			} else {
				echo path();
			}
		}
	}

	public function deletePost($postID, $forum)
	{
		$this->Forums_Model->deletePost($postID);
		$this->getForum($forum);
	}

<<<<<<< HEAD
	public function getForums()
	{
		$data = $this->Forums_Model->getForums($this->language);
=======
		if ($data) {			
			$vars["forums"]   = $data;
			$vars["view"]     = $this->view("forums", true);
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63

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
<<<<<<< HEAD
			$vars["ckeditor"] = $this->js("ckeditor", "basic", true);
			$vars["forumID"] = $data[0]["ID_Forum"];
			$vars["forum"] = isset($data[0]["Forum_Name"]) ? $data[0]["Forum_Name"] : $data[0]["Title"];
			$vars["posts"] = isset($data[0]["Forum_Name"]) ? $data : false;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("forum", true);
=======

			$vars["ckeditor"] 	= $this->js("ckeditor", "basic", true);
			$vars["forumID"] 	= $data[0]["ID_Forum"];
			$vars["forum"] 	 	= isset($data[0]["Forum_Name"]) ? $data[0]["Forum_Name"] : $data[0]["Title"];
			$vars["posts"]   	= isset($data[0]["Forum_Name"]) ? $data : false;
			$vars["pagination"] = $this->pagination;
			$vars["view"]    	= $this->view("forum", true);

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
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
<<<<<<< HEAD
			$vars["ckeditor"] = $this->js("ckeditor", "basic", true);
			$vars["forum"] = segment(1, isLang());
			$vars["posts"] = $data;
			$vars["view"] = $this->view("posts", true);
=======

			$vars["ckeditor"] = $this->js("ckeditor", "basic", true);
			$vars["forum"]    = segment(1, isLang());
			$vars["posts"]    = $data;
			$vars["view"]     = $this->view("posts", true);

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
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
			$vars["forum"] = $forum;
<<<<<<< HEAD
			$vars["data"] = $data; 
			$vars["view"] = $this->view("edit", true);
=======
			$vars["data"]  = $data; 
			$vars["view"]  = $this->view("edit", true);
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
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
<<<<<<< HEAD
			$vars["data"] = $data;
			$vars["view"] = $this->view("editComment", true);
=======
			$vars["data"]  = $data; 
			$vars["view"]  = $this->view("editComment", true);
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function publishComment()
	{
		$this->Forums_Model->saveComment(POST("fid"), POST("content", "clean"), POST("fname"));
	}
}