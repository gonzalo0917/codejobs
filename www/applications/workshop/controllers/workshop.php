<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Workshop_Controller extends ZP_Load
{
	
	public function __construct()
	{
		$this->application = $this->app("workshop");
		$this->config($this->application);
		$this->Templates = $this->core("Templates");
		$this->Cache = $this->core("Cache");		
		$this->Workshop_Model = $this->model("Workshop_Model");
		$this->Templates->theme();
		$this->config("workshop");
		$this->language = whichLanguage();
		$this->helper(array("forms", "html", "time"));

		setURL();
	}

	public function index()
	{
		$this->meta("language", whichLanguage(false));

		$this->newProposal();
	}

	public function newProposal()
	{
		$this->title(__("Workshop"));
		$this->CSS(CORE_PATH ."/vendors/css/frameworks/bootstrap/bootstrap-codejobs.css", null, false, true);
		$this->CSS("new", $this->application);


		$vars["view"] = $this->view("new", true);

		if (POST("send") and SESSION("ZanUser")) {
			$vars["alert"] = $this->Workshop_Model->newProposal();
		}
		
		$this->render("content", $vars); 
	}
}
