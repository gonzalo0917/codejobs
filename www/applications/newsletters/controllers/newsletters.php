<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Newsletters_Controller extends ZP_Load 
{
	
	public function __construct() 
	{		
		$this->Ads_Model = $this->model("Ads_Model");
		$this->application = $this->app("ads");
		$this->Cache = $this->core("Cache");
	}
	
	public function index($action = null, $position = "Top") 
	{
		redirect();	
	}
	
	public function principal() 
	{
		$data = $this->Cache->data("principal", "ads", $this->Ads_Model, "getAds", array(1));
	
		if ($data) {
			$vars["ads"] = $data;
			
			$this->view("principal", $vars, $this->application);				
		} 

		return false;
	}

	public function tv() 
	{
		$this->helper("time");
		
		$data = $this->Cache->data("tv", "ads", $this->Ads_Model, "getAds", array(0));
	
		if ($data) {
			$vars["ads"] = $data;
			
			$this->view("tv", $vars, $this->application);				
		} 

		return false;
	}

}
