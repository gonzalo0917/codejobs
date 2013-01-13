<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Jobs_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("jobs");

		$this->Templates->theme();

		$this->config("bookmarks");
		
		$this->Jobs_Model = $this->model("Jobs_Model");

		$this->helper("pagination");
	}

	public function index($jobID = 0) {
		$this->meta("language", whichLanguage(FALSE));
                
		if($jobID !== "add") {
			if($jobID > 0) {
				$this->go($jobID);
			} else {
				$this->getJobs();
			}
		}
	}

	public function rss() {
		$this->helper("time");

		$data = $this->Cache->data("rss", "jobs", $this->Jobs_Model, "getRSS", array(), 86400);
		
		if($data) {
			$vars["jobs"]= $data;	

			$this->view("rss", $vars, $this->application);
		} else {
			redirect();
		}

	}

	public function add() {
		isConnected();
		
		if(POST("save")) {
			$vars["alert"] = $this->Jobs_Model->save();
		} 

		$vars["countries"]   = $this->Jobs_Model->getCountries();

		if(POST("preview")) {
			$this->helper("time");

			$this->title(__("Jobs") ." - ". htmlentities(encode(POST("title", "decode", NULL)), ENT_QUOTES, "UTF-8"));

			$data = $this->Jobs_Model->preview();

			if($data) {
				$this->CSS("jobs", $this->application);
				$this->js("preview", $this->application);
				
				$this->config("user", "jobs");

				$vars["job"] = $data;
				$vars["view"] = $this->view("preview", TRUE);
				
				$this->render("content", $vars);
			} else {
				redirect();
			}
		} else {
			$this->CSS("forms", "cpanel");

			$this->helper(array("html", "forms"));

			$this->config("user", "jobs");

			$vars["view"] = $this->view("new", TRUE);

			$this->render("content", $vars);
		}
	}

	public function admin() {
		isConnected();

		$this->config("user", "jobs");

		$data = $this->Jobs_Model->getAllByUser();

		$this->CSS("results", "cpanel");
		$this->CSS("admin", "jobs");

		if($data) {
			$vars["tFoot"] = $data;
			$total = count($data);
		} else {
			$vars["tFoot"] = array();
			$total = 0;
		}

		$label = ($total === 1 ? __("record") : __("records"));

		$vars["total"] = (int)$total . " $label";
		
		$vars["view"] = $this->view("admin", TRUE);
		$this->render("content", $vars);
	}

	public function author($user = NULL, $tagLabel = NULL, $tag = NULL) {
		if($user === NULL) {
			redirect($this->application);
		} elseif($tagLabel === NULL or $tagLabel === "page") {
			$this->getJobsByAuthor($user);
		} elseif($tagLabel === "tag" and $tag !== NULL) {
			$this->getJobsByTag($user, $tag);
		} else {
			redirect("$this->application/author/$user");
		}
	}


	public function tag($tag) {
		$this->title(__("Jobs"));
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("tag");

		$data = $this->Cache->data("tag-$tag-$limit", "jobs", $this->Jobs_Model, "getByTag", array($tag, $limit));

		if($data) {
			$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
			$this->helper("time");

			$vars["jobs"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("jobs", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function go($jobID = 0) {
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");

		$data = $this->Cache->data("job-$jobID", "jobs", $this->Jobs_Model, "getByID", array($jobID));

		if($data) {
			$this->helper("time");

			$this->title(__("Jobs") ." - ". decode($data[0]["Title"]), FALSE);
			$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
                        
			$vars["views"]    = $this->Jobs_Model->updateViews($jobID);
			$vars["job"] = $data[0];
			$vars["view"]     = $this->view("job", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	public function visit($jobID = 0) {
		$data = $this->Cache->data("job-$jobID", "jobs", $this->Jobs_Model, "getByID", array($jobID));

		if($data) {
			$this->Jobs_Model->updateViews($jobID);

			redirect($data[0]["URL"]);
		} else {
			redirect();
		}
	}

	private function getJobs() { 
		$this->title(__("Jobs"));
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		
		$data = $this->Cache->data("jobs-$limit", "jobs", $this->Jobs_Model, "getAll", array($limit));
	
		$this->helper("time");
		
		if($data) {	
			$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
                        
			$vars["jobs"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("jobs", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}

	private function getJobsByAuthor($author) {
		$this->title(__("Jobs of") ." ". $author);
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("author");
		
		$data = $this->Cache->data("author-$author-$limit", "jobs", $this->Jobs_Model, "getAllByAuthor", array($author, $limit));
	
		$this->helper("time");
		
		if($data) {	
			$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
                        
			$vars["jobs"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("jobs", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect($this->application);	
		} 
	}

	private function getJobsByTag($author, $tag) {
		$this->title(__("Jobs of") ." ". $author);
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("author-tag");
		
		$data = $this->Cache->data("author-$author-tag-$tag-$limit", "jobs", $this->Jobs_Model, "getAllByTag", array($author, $tag, $limit));
	
		$this->helper("time");
		
		if($data) {	
			$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
                        
			$vars["jobs"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("jobs", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}

	private function limit($type = NULL) {
		$count = $this->Jobs_Model->count($type);	
		
		if(is_null($type)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("jobs/page/");
		} elseif($type === "tag") {
			$tag   = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("jobs/tag/$tag/page/");
		} elseif($type === "author") {
			$user  = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("jobs/author/$user/page/");
		} elseif($type === "author-tag") {
			$user  = segment(2, isLang());
			$tag   = segment(4, isLang());
			$start = (segment(5, isLang()) === "page" and segment(6, isLang()) > 0) ? (segment(6, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("jobs/author/$user/tag/$tag/page/");
		}

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}

}