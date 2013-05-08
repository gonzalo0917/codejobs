<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Blog_Controller extends ZP_Load 
{
	
	public function __construct() 
	{		
		$this->application = $this->app("blog");
		$this->config($this->application);
		$this->Templates = $this->core("Templates");
		$this->Cache = $this->core("Cache");
		$this->Blog_Model = $this->model("Blog_Model");
		$this->Templates->theme();
		$this->language = whichLanguage();		

		setURL();
	}
	
	public function index($year = null, $month = null, $day = null, $slug = null) 
	{ 
		$this->meta("language", whichLanguage(false));               

		if (isYear($year) and isMonth($month) and isDay($day) and $slug and $slug !== "page") {
			$this->slug($year, $month, $day, $slug);
		} elseif (isYear($year) and isMonth($month) and isDay($day)) { 
			$this->getPosts($year, $month, $day);
		} elseif (isYear($year) and isMonth($month)) {
			$this->getPosts($year, $month);
		} elseif (isYear($year)) {
			$this->getPosts($year);
		} else { 
			$this->last();
		}
	}

	public function rss() 
	{
		$this->helper("time");

		$data = $this->Cache->data("rss-$this->language", "blog", $this->Blog_Model, "getRSS", array(), 86400);
		
		if ($data) {
			$vars["posts"]= $data;

			$this->view("rss", $vars, $this->application);
		} else {
			redirect();
		}

	}

	public function add($ID = 0) 
	{
		isConnected();

		if (POST("save")) {
			$action = ((int) POST("ID") !== 0) ? "edit" : "save";

			$vars["alert"] = $this->Blog_Model->add($action);
		} 
		
		if (POST("preview")) {
			$this->helper(array("forms","html"));
			$this->title(htmlentities(encode(POST("title", "decode", null)), ENT_QUOTES, "UTF-8"));

			$data = $this->Blog_Model->preview();

			if ($data) {
				$this->CSS("posts", $this->application);
				$this->CSS("forms");
				$this->js("preview", $this->application);
				$this->config("user", $this->application);

				$vars["post"] = $data;
				$vars["URL"] = path("blog/". $data["Year"] ."/". $data["Month"] ."/". $data["Day"] ."/". $data["Slug"]);					
				$vars["view"] = $this->view("preview", true);
			} else {
				redirect();
			}
		} else {
			if ((int) $ID !== 0) {
				$data = $this->Blog_Model->getPostByID($ID);

				if (!$data) {
					redirect();
				}

				$vars["data"] = $data[0];
			}

			$this->CSS("forms", "cpanel");
			
			$this->helper(array("html", "forms"));
			$this->config("user", "blog");

			$vars["ckeditor"] = $this->js("ckeditor", "full", true);
			$vars["view"] = $this->view("new", true);
		}
		
		$this->render("content", $vars);
	}

	public function author($user = null, $tagLabel = null, $tag = null) 
	{
		if ($user === null) {
			redirect($this->application);
		} elseif ($tagLabel === null or $tagLabel === "page") {
			$this->getPostsByAuthor($user);
		} elseif ($tagLabel === "tag" and $tag !== null) {
			$this->getPostsByTag($user, $tag);
		} else {
			redirect("$this->application/author/$user");
		}
	}

	public function archive() 
	{		
		$this->CSS("archive", true);
		$date = $this->Blog_Model->getArchive();		
		
		if ($date) {
			$vars["date"] = $date;

			$this->view("archive", $vars, $this->application);
		}				
		
		return false;
	}
	
	public function mural($limit = 10) 
	{
		$this->CSS("mural", $this->application, true);
		$this->CSS("slides", null, true);
		$data = $this->Cache->data("mural-$limit-". $this->language, "blog", $this->Blog_Model, "getMural", array($limit));

		if ($data) {
			$vars["mural"] = $data;
			$this->view("mural", $vars, $this->application);
		} else {
			return false;
		}
	}

	public function relevant() 
	{
		$data = $this->Cache->data("relevant-". $this->language, "blog", $this->Blog_Model, "getMostRelevantPosts");

		if ($data) {
			$vars["posts"] = $data;
			
			$this->view("relevant", $vars, $this->application);			
		}
	}
	
	private function getPosts($year = null, $month = null, $day = null) 
	{
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		$this->helper("time");
		
		if ($day) {
			$limit = $this->limit("day");		
		} elseif ($month) {
			$limit = $this->limit("month");
		} else {
			$limit = $this->limit("year");
		}

		$data = $this->Cache->data("$limit-$year-$month-$day-". $this->language, "blog", $this->Blog_Model, "getByDate", array($limit, $year, $month, $day));
	
		if ($data) {
			$this->title("Blog - ". $year ."/". $month ."/". $day);
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Content"]);
                        
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("posts", true);
			
			$this->render("content", $vars);			
		} else {
			redirect();
		}
	}
	
	private function getPostsByAuthor($author) 
	{
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		$this->helper("time");
		
		$limit = $this->limit("author");
		$data = $this->Cache->data("$limit-author-$author-". $this->language, "blog", $this->Blog_Model, "getAllByAuthor", array($author, $limit));
	
		if ($data) {
			$this->title(__("Posts of") ." ". $author);
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Content"]);
                        
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("posts", true);
			
			$this->render("content", $vars);			
		} else {
			redirect();
		}
	}
	
	private function getPostsByTag($author, $tag) 
	{
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		$this->helper("time");
		
		$limit = $this->limit("author-tag");

		$data = $this->Cache->data("$limit-author-$author-tag-$tag-". $this->language, "blog", $this->Blog_Model, "getAllByTag", array($author, $tag, $limit));
	
		if ($data) {
			$this->title(__("Posts of") ." ". $author);
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Content"]);
                        
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("posts", true);
			
			$this->render("content", $vars);			
		} else {
			redirect();
		}
	}
	
	public function tag($tag) 
	{
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");

		$limit = $this->limit("tag");
		$data = $this->Cache->data("tag-$tag-$limit-". $this->language, "blog", $this->Blog_Model, "getByTag", array($tag, $limit));
		
		if ($data) {
			$this->title("Blog - ". $tag);
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Content"]);
                        
			$this->helper("time");
			
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("posts", true);
			
			$this->render("content", $vars);		
		} else {
			redirect();
		}
	}
	
	private function slug($year = null, $month = null, $day = null, $slug = null) 
	{			
		$this->CSS("posts", $this->application);
		$this->CSS("comments", $this->application);
		$this->CSS("forms");

		$this->helper(array("forms","html"));
		
		$data = $this->Cache->data("$slug-$year-$month-$day-". $this->language, "blog", $this->Blog_Model, "getPost", array($year, $month, $day, $slug));

		$this->Users_Model = $this->model("Users_Model");

		$user = $this->Users_Model->getByUsername($data[0]["post"][0]["Author"]);

		$URL = path("blog/$year/$month/$day/". segment(4, isLang()));
		
		$vars["ID_Post"] = $data[0]["post"][0]["ID_Post"];
		$vars["post"] = $data[0]["post"][0];
		$vars["author"] = $user[0];
		$vars["URL"] = $URL;					
		
		if ($data) {	
			$this->title(decode($data[0]["post"][0]["Title"]));
            $this->meta("description", $data[0]["post"][0]["Content"]);
            $this->meta("keywords", $data[0]["post"][0]["Tags"]);
			
			if ($data[0]["post"][0]["Pwd"] === "") {	 
				$vars["view"][0] = $this->view("post", true);		
			} elseif (POST("access")) {
				if (POST("password", "encrypt") === POST("pwd")) {
					if (!SESSION("access-id")) {
						SESSION("access-id", $data[0]["post"][0]["ID_Post"]);					
					} else {
						SESSION("access-id", $data[0]["post"][0]["ID_Post"]);
					}
					
					redirect($URL);
				} else {
					showAlert(__("Incorrect password"), "blog");
				}				
			} elseif (!SESSION("access-id") and strlen($data[0]["post"][0]["Pwd"]) === 40 and !POST("access")) {
				$vars["password"] = $data[0]["post"][0]["Pwd"];
				$vars["view"] = $this->view("access", true);
			} elseif (SESSION("access-id") === $data[0]["post"][0]["ID_Post"]) {
				$vars["view"][0] = $this->view("post", true);
			} elseif (SESSION("access-id") and SESSION("access-id") !== $data[0]["post"][0]["ID_Post"]) {
				$vars["password"] = $data[0]["post"][0]["Pwd"];
				$vars["view"] = $this->view("access", true);						
			}
			
			$this->helper("time");
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	private function last() 
	{
		$this->title("Blog");
		$this->CSS("posts", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		$data = $this->Cache->data("last-". $this->language ."-$limit", "blog", $this->Blog_Model, "getPosts", array($limit));

		$this->helper(array("html","time"));
		
		if ($data) {			
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Content"]);
                        
			$vars["posts"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("posts", true);
			
			$this->render("content", $vars);
		} else {
			$post = __("Welcome to") ." ";
			$post .= a(_get("webName"), _get("webBase")) ." ";
			$post .= __("this is your first post, going to your") ." ";
			$post .= a(__("Control Panel"), path("cpanel")) ." ";
			$post .= __("and when you add a new post this post will be disappear automatically, enjoy it!");				
				
			$vars["hello"] =  __("Hello World");
			$vars["date"] = now(1);
			$vars["post"] = $post;
			$vars["comments"] = __("No Comments");				
			$vars["view"] = $this->view("zero", true);
			
			$this->render("content", $vars);		
		} 
	}
	
	private function limit($type = "posts") 
	{ 
		$start = 0;
		$count = $this->Blog_Model->count("posts");

		if ($type === "posts") {
			if (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) { 
				$start = (segment(2, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			} 
							
			$URL = path("blog/page/");		
		} elseif ($type === "categories") {
			if (segment(1, isLang()) === "category" and segment(2, isLang()) !== "page" and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4) * MAX_LIMIT) - MAX_LIMIT;
			}
			
			$URL = path("blog/category/". segment(3, isLang()) ."/page");					
			$count = $this->Blog_Model->count("categories");			
		} elseif ($type === "day") {
			if (isYear(segment(1, isLang())) and isMonth(segment(2, isLang())) and isDay(segment(3, isLang())) and segment(4, isLang()) === "page" and segment(5, isLang()) > 0) {
				$start = (segment(5) * MAX_LIMIT) - MAX_LIMIT;
			}
				
			$URL = path("blog/". segment(1, isLang()) ."/". segment(2, isLang()) ."/". segment(3, isLang()) ."/page/");			
		} elseif ($type === "month") {
			if (isYear(segment(1, isLang())) and isMonth(segment(2, isLang())) and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4) * MAX_LIMIT) - MAX_LIMIT;
			}
			
			$URL = path("blog/". segment(1, isLang()) ."/". segment(2, isLang()) ."/page/");		
		} elseif ($type === "year") {
			if (isYear(segment(1, isLang())) and segment(2, isLang()) === "page" and segment(3, isLang()) > 0) {
				$start = (segment(3, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}
			
			$URL = path("blog/". segment(1, isLang()) ."/page/");			
		} elseif ($type === "tag") {	
			if (segment(1, isLang()) === "tag" and segment(2, isLang()) and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}
			
			$count = $this->Blog_Model->count("tag");
			$URL   = path("blog/tag/". segment(2, isLang()) ."/page/");
		} elseif ($type === "author") {	
			if (segment(1, isLang()) === "author" and segment(2, isLang()) and segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
				$start = (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}
			
			$count = $this->Blog_Model->count("author");
			$URL   = path("blog/author/". segment(2, isLang()) ."/page/");
		} elseif ($type === "author-tag") {	
			if (segment(1, isLang()) === "author" and segment(2, isLang()) and segment(3, isLang()) === "tag" and segment(4, isLang()) and segment(5, isLang()) === "page" and segment(6, isLang()) > 0) {
				$start = (segment(6, isLang()) * MAX_LIMIT) - MAX_LIMIT;
			}
			
			$count = $this->Blog_Model->count("author-tag");
			$URL   = path("blog/author/". segment(2, isLang()) ."/tag/". segment(4, isLang()) ."/page/");
		}

		$limit = $start .", ". MAX_LIMIT;
		$this->helper("pagination");
		$this->pagination = ($count > MAX_LIMIT) ? paginate($count, MAX_LIMIT, $start, $URL) : null;
		
		return $limit;
	}
}