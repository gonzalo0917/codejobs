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

class CPanel_Controller extends ZP_Load
{

	private $vars = array();

	public function __construct()
	{
		$this->app("cpanel");
		$this->application = whichApplication();
<<<<<<< HEAD
		$this->CPanel = $this->classes("cpanel", "CPanel", null, "cpanel");
=======
		
		$this->CPanel = $this->classes("cpanel", "CPanel", null, "cpanel");
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$this->isAdmin = $this->CPanel->load();
		$this->vars = $this->CPanel->notifications();
		$this->CPanel_Model = $this->model("CPanel_Model");
		$this->Templates = $this->core("Templates");
		$this->Templates->theme("cpanel");
	}
<<<<<<< HEAD

	public function index()
	{
=======
	
	public function index() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($this->isAdmin) {
			redirect("cpanel");
		} else {
			$this->login();
		}
	}

<<<<<<< HEAD
	public function check()
	{
=======
	public function check() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (POST("trash") and is_array(POST("records"))) { 
			foreach (POST("records") as $record) {
				$this->trash($record, true); 
			}

			redirect("$this->application/cpanel/results");
		} elseif (POST("restore") and is_array(POST("records"))) {
			foreach (POST("records") as $record) {
				$this->restore($record, true); 
			}

			redirect("$this->application/cpanel/results");
		} elseif (POST("delete") and is_array(POST("records"))) {
			foreach (POST("records") as $record) {
				$this->delete($record, true); 
			}

			redirect("$this->application/cpanel/results");
		}

		return false;
	}

<<<<<<< HEAD
	public function delete($ID = 0, $return = false)
	{
		if (!$this->isAdmin) {
			$this->login();
		}

=======
	public function delete($ID = 0, $return = false) {
		if (!$this->isAdmin) {
			$this->login();
		}
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($this->CPanel_Model->delete($ID)) {
			if ($return) {
				return true;
			}

			redirect("$this->application/cpanel/results/trash");
		} else {
			if ($return) {
				return false;
			}

			redirect("$this->application/cpanel/results");
		}
	}

<<<<<<< HEAD
	public function restore($ID = 0, $return = false)
	{ 
		if (!$this->isAdmin) {
			$this->login();
		}

=======
	public function restore($ID = 0, $return = false) { 
		if (!$this->isAdmin) {
			$this->login();
		}
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($this->CPanel_Model->restore($ID)) {
			if ($return) {
				return true;
			}

			redirect("$this->application/cpanel/results/trash");
		} else {
			if ($return) {
				return false;
			}

			redirect("$this->application/cpanel/results");
		}
	}

<<<<<<< HEAD
	public function trash($ID = 0, $return = false)
	{
		if (!$this->isAdmin) {
			$this->login();
		}

		if ($this->CPanel_Model->trash($ID)) {
			if ($return) {
				return true;
			}
=======
	public function trash($ID = 0, $return = false) {
		if (!$this->isAdmin) {
			$this->login();
		}
		
		if ($this->CPanel_Model->trash($ID)) {		
			if ($return) {
				return true;
			}	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63

			redirect("$this->application/cpanel/results");
		} else {
			if ($return) {
				return false;
			}

			redirect("$this->application/cpanel/add");
		}
	}

	public function login()
	{
		$this->title("Login");
		$this->CSS("login", "users");
<<<<<<< HEAD

		if (POST("connect")) {
=======
		
		if (POST("connect")) {	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$this->Users_Controller = $this->controller("Users_Controller");

			$this->Users_Controller->login("cpanel");
		} else {
<<<<<<< HEAD
			$this->vars["URL"] = getURL();
=======
			$this->vars["URL"]  = getURL();
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$this->vars["view"] = $this->view("login", true, "cpanel");
		}

		$this->render("include", $this->vars);
		$this->rendering("header", "footer");
		exit;
	}
<<<<<<< HEAD

	public function results()
	{
=======
	
	public function results() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (!$this->isAdmin) {
			$this->login();
		}

		$this->check();
		$this->title("Manage ". $this->application);
		$this->CSS("results", "cpanel");
		$this->CSS("pagination");
<<<<<<< HEAD
		$this->js("checkbox");
		$trash = (segment(3, isLang()) === "trash") ? true : false;
		$this->vars["total"] = $this->CPanel_Model->total($trash); 
		$this->vars["tFoot"] = $this->CPanel_Model->records($trash, "ID_Feedback DESC"); 
		$this->vars["message"] = (!$this->vars["tFoot"]) ? "Error" : null;
		$this->vars["pagination"] = $this->CPanel_Model->getPagination($trash);
		$this->vars["trash"] = $trash;
		$this->vars["search"] = getSearch();
		$this->vars["view"] = $this->view("results", true, $this->application);
		$this->render("content", $this->vars);
	}

	public function read($ID = 0)
	{
=======
		
		$this->js("checkbox");		
		
		$trash = (segment(3, isLang()) === "trash") ? true : false;
		
		$this->vars["total"] 	  = $this->CPanel_Model->total($trash); 
		$this->vars["tFoot"] 	  = $this->CPanel_Model->records($trash, "ID_Feedback DESC"); 
		$this->vars["message"]    = (!$this->vars["tFoot"]) ? "Error" : null;
		$this->vars["pagination"] = $this->CPanel_Model->getPagination($trash);
		$this->vars["trash"]  	  = $trash;	
		$this->vars["search"] 	  = getSearch(); 			
		$this->vars["view"]       = $this->view("results", true, $this->application);
		
		$this->render("content", $this->vars);
	}
	
	public function read($ID = 0) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (!$this->isAdmin) {
			$this->login();
		}

		$this->title("Read");
		$this->CSS("forms", "cpanel");
		$Model = ucfirst($this->application) ."_Model";
		$this->$Model = $this->model($Model);

		if (POST("send")) {
			$this->vars["alert"] = $this->Feedback_Model->respond();
		}

		$data = $this->$Model->getByID($ID);
<<<<<<< HEAD

=======
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($data) {
			$this->helper("forms");
			$this->$Model->read($ID);
<<<<<<< HEAD
			$this->vars["ID"] = $ID;
			$this->vars["data"] = $data;
			$this->vars["view"] = $this->view("read", true, $this->application);

=======
			
			$this->vars["ID"]	 = $ID;
			$this->vars["data"]	 = $data;
			$this->vars["view"]  = $this->view("read", true, $this->application);
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			$this->render("content", $this->vars);
		} else {
			redirect($this->application ."/cpanel/results");
		}
	}
}