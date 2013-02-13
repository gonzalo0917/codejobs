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

class Feedback_Model extends ZP_Load
{
	public function __construct()
	{
		$this->Db = $this->db();
		$this->Data = $this->core("Data");
		$this->Email = $this->core("Email");
		$this->Email->setLibrary("PHPMailer");
		$this->Email->fromName = _get("webName");
		$this->Email->fromEmail = _get("webEmailSend");
		$this->table = "feedback";
		$this->fields = "ID_Feedback, Name, Email, Company, Phone, City, Subject, Message, Text_Date, Situation";
		$this->Data->table($this->table);
	}
<<<<<<< HEAD

	public function cpanel($action, $limit = null, $order = "ID_Feedback DESC", $search = null, $field = null, $trash = false)
	{
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();

=======
	
	public function cpanel($action, $limit = null, $order = "ID_Feedback DESC", $search = null, $field = null, $trash = false) {
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($validation) {
				return $validation;
			}
		}
<<<<<<< HEAD

		if ($action === "all") {
			return $this->all($trash, "ID_Feedback DESC", $limit);
		} elseif ($action === "edit") {
			return $this->edit();
=======
		
		if ($action === "all") {
			return $this->all($trash, "ID_Feedback DESC", $limit);
		} elseif ($action === "edit") {
			return $this->edit();															
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		} elseif ($action === "save") {
			return $this->save();
		} elseif ($action === "search") {
			return $this->search($search, $field);
		}
	}
<<<<<<< HEAD

	private function all($trash, $order, $limit)
	{
		if (!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? 
			$this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit) : 
			$this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", 
				$this->table, $this->fields, null, $order, $limit);
		} else { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? 
			$this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, null, $order, $limit) : 
			$this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, null, $order, $limit);
		}
	}

	public function read($ID = false, $situation = "Read")
	{
=======
	
	private function all($trash, $order, $limit) {	
		if (!$trash) { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit);
		} else { 
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, null, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, null, $order, $limit);
		}
	}
	
	public function read($ID = false, $situation = "Read") {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($ID) {
			$this->Db->update($this->table, array("Situation" => $situation), $ID);
		}
	}

	public function getByID($ID)
	{
		$this->Db->select("ID_Feedback, Name, Email, Company, Phone, City, Subject, Message, Situation");
		$data = $this->Db->find($ID, $this->table);
		return $data;
	}

	public function send()
	{
		$validations = array("name" => "required", "email" => "email?", "message" => "required", "captcha" => "captcha?");
		$this->helper(array("alerts", "time"));
		$this->Data->ignore(array("captcha_token"));
<<<<<<< HEAD
=======
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$data = $this->Data->proccess(null, $validations);

		if (isset($data["error"])) {
			return $data["error"];
		}
		
<<<<<<< HEAD
		$values = array("Name" => POST("name"),"Email" => POST("email"), "Company" => "", "Phone" => "", "Subject" => "",
					"Message" => POST("message", "decode", false), "Start_Date" => now(4), "Text_Date" => decode(now(2)));
		$insert = $this->Db->insert($this->table, $values);

=======
		$values = array(
			"Name"   	 => POST("name"),
			"Email"   	 => POST("email"),
			"Company"	 => "",
			"Phone" 	 => "",
			"Subject"  	 => "",
			"Message" 	 => POST("message", "decode", false),
			"Start_Date" => now(4),
			"Text_Date"  => decode(now(2))
		);

		
		$insert = $this->Db->insert($this->table, $values);
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (!$insert) {
			return getAlert(__("Insert error"));
		}

<<<<<<< HEAD
		$vars["name"] = POST("name");
		$vars["email"] = POST("email");
		$vars["message"] = POST("message", "decode", false);
=======
		$vars["name"] 	 = POST("name");
		$vars["email"] 	 = POST("email");
		$vars["message"] = POST("message", "decode", false);

>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$this->sendMail($vars);
		$this->sendResponse($vars);
		return getAlert(__("Your message has been sent successfully, we will contact you as soon as possible, thank you very much!"), "success");
	}

<<<<<<< HEAD
	public function respond() 
	{
=======
	public function respond() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if (!isEmail(POST("to"))) {
			return getAlert(__("Invalid (To) E-Mail"));
		} elseif (!isEmail(POST("from"))) {
			return getAlert(__("Invalid (From) E-Mail"));
		} elseif (!POST("message")) {
			return getAlert(__("You need to write a message"));
		} elseif (!POST("subject")) {
			return getAlert(__("You need to write a subject"));
		}

		$this->helper("alerts");
		$this->Email->email = POST("to");
		$this->Email->subject = POST("subject");
		$this->Email->message = POST("message", "decode", false);
<<<<<<< HEAD
=======
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$this->Email->send();
		return getAlert(__("Your message has been sent"), "success");
	}

	private function sendResponse($vars)
	{
		$this->Email->email = POST("email");
		$this->Email->subject = __("Automatic response") . " - " . _get("webName");
		$this->Email->message = $this->view("response_email", null, "feedback", true);
<<<<<<< HEAD
=======
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$this->Email->send();
	}

	private function sendMail($vars)
	{
		$this->Email->email = _get("webEmailRecieve");
		$this->Email->subject = __("New Message") ." - ". _get("webName");
		$this->Email->message = $this->view("send_email", $vars, "feedback", true);
<<<<<<< HEAD
=======
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$this->Email->send();
	}

	public function getNotifications()
	{
		return $this->Db->countBySQL("Situation = 'Inactive'", $this->table);
	}
}
