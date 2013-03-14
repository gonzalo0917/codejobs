<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Jobs_Controller extends ZP_Load
{
	public function __construct()
	{
		$this->Templates = $this->core("Templates");
		$this->Cache = $this->core("Cache");
		$this->application = $this->app("jobs");
		$this->Templates->theme();
		$this->config("jobs");
		$this->Jobs_Model = $this->model("Jobs_Model");
		$this->helper(array("pagination", "debugging"));
		setURL();
	}

	public function index($jobID = 0)
	{
		$this->meta("language", whichLanguage(false));

		if ($jobID !== "add") {
			if ($jobID > 0) {
				$this->go($jobID);
			} else {
				$this->getJobs();
			}
		}
	}

	public function rss()
	{
		$this->helper("time");
		$data = $this->Cache->data("rss", "jobs", $this->Jobs_Model, "getRSS", array(), 86400);
		
		if ($data) {
			$vars["jobs"]= $data;
			$this->view("rss", $vars, $this->application);
		} else {
			redirect();
		}
	}

	public function add()
	{
		isConnected();

		if (POST("save")) {
			$vars["alert"] = $this->Jobs_Model->save();
		} 

		$vars["countries"] = $this->Jobs_Model->getCountries();

		if (POST("preview")) {
			$this->helper("time");
			$this->title(__("Jobs") ." - ". htmlentities(encode(POST("title", "decode", null)), ENT_QUOTES, "UTF-8"));
			$data = $this->Jobs_Model->preview();

			if ($data) {
				$this->CSS("jobs", $this->application);
				$this->js("preview", $this->application);
				$this->config("user", "jobs");
				$vars["job"] = $data;
				$vars["view"] = $this->view("preview", true);
				$this->render("content", $vars);
			} else {
				redirect();
			}
		} else {
			$this->CSS("forms", "cpanel");
			$this->helper(array("html", "forms"));
			$this->config("user", "jobs");
			$vars["view"] = $this->view("new", true);
			$this->render("content", $vars);
		}
	}

	public function admin()
	{
		isConnected();
		$this->config("user", "jobs");
		$data = $this->Jobs_Model->getAllByUser();
		$this->CSS("results", "cpanel");
		$this->CSS("admin", "jobs");

		if ($data) {
			$vars["tFoot"] = $data;
			$total = count($data);
		} else {
			$vars["tFoot"] = array();
			$total = 0;
		}

		$label = ($total === 1 ? __("record") : __("records"));
		$vars["total"] = (int)$total . " $label";
		$vars["view"] = $this->view("admin", true);
		$this->render("content", $vars);
	}

	public function author($user = null, $tagLabel = null, $tag = null)
	{
		if ($user === null) {
			redirect($this->application);
		} elseif ($tagLabel === null or $tagLabel === "page") {
			$this->getJobsByAuthor($user);
		} elseif ($tagLabel === "tag" and $tag !== null) {
			$this->getJobsByTag($user, $tag);
		} else {
			redirect("$this->application/author/$user");
		}
	}

	public function tag($tag)
	{
		$this->title(__("Jobs"));
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$limit = $this->limit("tag");
		$data = $this->Cache->data("tag-$tag-$limit", "jobs", $this->Jobs_Model, "getByTag", array($tag, $limit));

		if ($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$this->helper("time");
			$vars["cities"] = $this->Jobs_Model->getCities();
			$vars["jobs"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("jobs", true);
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function apply()
	{
		$this->Jobs_Model->saveVacant(POST("jid"), POST("message", "clean"));
	}

	public function go($jobID = 0)
	{
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$this->js("jobs", "jobs");
		$data = $this->Cache->data("job-$jobID", "jobs", $this->Jobs_Model, "getByID", array($jobID));

		if ($data) {
			$this->helper(array("time", "forms", "alerts"));
			$this->title(__("Jobs") ." - ". decode($data[0]["Title"]), false);
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$vars["vacancy"] = $this->Jobs_Model->getVacancy();
			$vars["views"] = $this->Jobs_Model->updateViews($jobID);
			$vars["job"] = $data[0];
			$vars["view"] = $this->view("job", true);
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	public function visit($jobID = 0)
	{
		$data = $this->Cache->data("job-$jobID", "jobs", $this->Jobs_Model, "getByID", array($jobID));

		if ($data) {
			$this->Jobs_Model->updateViews($jobID);
			redirect($data[0]["URL"]);
		} else {
			redirect();
		}
	}

	private function getJobs()
	{
		$this->title(__("Jobs"));
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$limit = $this->limit();
		$data = $this->Cache->data("jobs-$limit", "jobs", $this->Jobs_Model, "getAll", array($limit));
		$this->helper("time");

		if ($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$vars["jobs"] = $data;
			$vars["cities"] = $this->Jobs_Model->getCities();
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("jobs", true);
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	private function getJobsByAuthor($author)
	{
		$this->title(__("Jobs of") ." ". $author);
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$limit = $this->limit("author");
		$data = $this->Cache->data("author-$author-$limit", "jobs", $this->Jobs_Model, "getAllByAuthor", array($author, $limit));
		$this->helper("time");

		if ($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$vars["jobs"] = $data;
			$vars["cities"] = $this->Jobs_Model->getCities();
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("jobs", true);
			$this->render("content", $vars);
		} else {
			redirect($this->application);
		} 
	}

	public function city($city)
	{
		$this->title(__("Jobs of") ." ". $city);
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$limit = $this->limit("city");
		$data = $this->Cache->data("city-$city-$limit", "jobs", $this->Jobs_Model, "getAllByCity", array($city, $limit));
		$this->helper("time");

		if ($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$vars["jobs"] = $data;
			$vars["cities"] = $this->Jobs_Model->getCities();
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("jobs", true);
			$this->render("content", $vars);
		} else {
			redirect($this->application);
		} 
	}

	public function company($company)
	{
		$this->title(__("Jobs of") ." ". $company);
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$limit = $this->limit("company");
		$data = $this->Cache->data("company-$company-$limit", "jobs", $this->Jobs_Model, "getAllByCompany", array($company, $limit));
		$this->helper("time");

		if ($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$vars["jobs"] = $data;
			$vars["cities"] = $this->Jobs_Model->getCities();
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("jobs", true);
			$this->render("content", $vars);
		} else {
			redirect($this->application);
		} 
	}

	private function getJobsByTag($author, $tag)
	{
		$this->CSS("jobs", $this->application);
		$this->CSS("pagination");
		$limit = $this->limit("author-tag");
		$data = $this->Cache->data("author-$author-tag-$tag-$limit", "jobs", $this->Jobs_Model, "getAllByTag", array($author, $tag, $limit));
		$this->helper("time");
		
		if ($data) {
			$this->meta("keywords", $data[0]["Tags"]);
			$this->meta("description", $data[0]["Description"]);
			$vars["jobs"] = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"] = $this->view("jobs", true);
			$this->render("content", $vars);
		} else {
			redirect();
		} 
	}

	private function limit($type = null)
	{
		$count = $this->Jobs_Model->count($type);

		if (is_null($type)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("jobs/page/");
		} elseif ($type === "tag") {
			$tag = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("jobs/tag/$tag/page/");
		} elseif ($type === "author") {
			$user = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("jobs/author/$user/page/");
		} elseif ($type === "city") {
			$city = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("jobs/city/$city/page/");
		} elseif ($type === "company") {
			$company = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("jobs/company/$company/page/"); } elseif ($type === "author-tag") {
			$user = segment(2, isLang());
			$tag = segment(4, isLang());
			$start = (segment(5, isLang()) === "page" and segment(6, isLang()) > 0) ? (segment(6, isLang()) * MAX_LIMIT) - MAX_LIMIT : 0;
			$URL = path("jobs/author/$user/tag/$tag/page/");
		}

		$limit = $start .", ". MAX_LIMIT;
		$this->pagination = ($count > MAX_LIMIT) ? paginate($count, MAX_LIMIT, $start, $URL) : null;
		return $limit;
	}
} 