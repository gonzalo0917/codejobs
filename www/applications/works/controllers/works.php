<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Works_Controller extends ZP_Load
{

	private $effect = false;

	public function __construct()
	{
		$this->Templates = $this->core("Templates");

		$this->application = $this->app("works");

		setURL();
	}

	public function index($workID = 0)
	{

		redirect();
	}

	public function works()
	{
		$data = $this->Works_Model->getWorks();

		if ($data) {
			$vars["data"] = $data;

			$this->view("works", $vars, $this->application);
		} 

		return false;
	}
}
