<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Polls_Controller extends ZP_Load
{

	public function __construct()
	{
		$this->Templates = $this->core("Templates");
		$this->Polls_Model = $this->model("Polls_Model");
		
		$this->application = "polls";
		
		$this->Templates->theme();
	}

	public function index($pollID = null, $slug = null, $results = null)
	{
		if (!$pollID) {
			redirect();
		} else {
			$this->get($pollID, $results);
		}
	}

	public function get($pollID, $results = false)
	{
		$this->config("polls");

		setURL();

		$this->Polls_Model = $this->model("Polls_Model");

		$data = $this->Polls_Model->getByID($pollID);

		if ($data) {
			$this->title(decode($data["question"]["Title"]));
			$this->CSS("polls", $this->application);
			$this->js("poll", $this->application);

			$vars["already"] = false;
			$vars["results"] = $results;
			$vars["poll"] = $data;
			$vars["special"] = true;
			$vars["view"] = $this->view("poll", true);

			$this->render("content", $vars);
		} else {
			redirect();
		}
	}
	
	public function last($results = false, $already = false)
	{
		$this->config("polls");

		$this->Polls_Model = $this->model("Polls_Model");

		$data = $this->Polls_Model->getLastPoll();

		if ($data) {
			$this->CSS("polls", $this->application);
			$this->js("poll", $this->application);

			$vars["already"] = $already;
			$vars["results"] = $results;
			$vars["poll"] = $data;

			$this->view("poll", $vars, "polls");
		} else {
			return false;
		}
	}

	public function vote()
	{
		if (GET("answer")) {
			$vote = $this->Polls_Model->vote();

			if ($vote === false) {
				$this->last("results", "already");
			} else {
				$this->last("results");
			}
		}
	}
}