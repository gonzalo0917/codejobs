<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Workshop_Model extends ZP_Load
{

	public function __construct()
	{
		$this->Db = $this->db();
		
		$this->table = "workshop";
		$this->fields  = "ID_Workshop, Title, Slug, Topics, Description, File, Email, Skype, Gtalk, Facebook, Twitter, Proposal_Day,";
		$this->fields .= "Proposal_Time, Start_Date, Situation";

		$this->Data = $this->core("Data");
		$this->Data->table($this->table);

		$this->Email = $this->core("Email");
		$this->Email->setLibrary("PHPMailer");
		$this->Email->fromName = _get("webName");
		$this->Email->fromEmail = _get("webEmailSend");
	}
	
	public function cpanel($action, $limit = null, $order = "Language DESC", $search = null, $field = null, $trash = false)
	{
		$this->helper("time");
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if ($validation) {
				return $validation;
			}
		}
		
		if ($action === "all") {
			return $this->all($trash, "ID_Workshop DESC", $limit);
		} elseif ($action === "edit") {
			return $this->edit();
		} elseif ($action === "save") {
			return $this->save();
		} elseif ($action === "search") {
			return $this->search($search, $field);
		}
	}

	private function all($trash, $order, $limit, $own = false) 
	{	
		$fields = "ID_Workshop, Title, File, Email, Start_Date, Situation";
		$userID = SESSION("ZanUserID");

		if (!$trash) {
			if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
				return $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			} else { 
				return $this->Db->findBySQL("ID_User = '". $userID ."' AND Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		} else {
			if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
				return $this->Db->findBy("Situation", "Deleted", $this->table, $fields, null, $order, $limit);
			} else {
			 	return $this->Db->findBySQL("ID_User = '". $userID ."' AND Situation = 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		}
	}

  	public function getByID($ID)
  	{
  		return $this->Db->findBySQL("ID_Workshop = $ID", $this->table, "*");
  	}

  	public function newProposal()
  	{
  		$validations = array(
			"title" => "required",
			"email" => "email?",
			"description" => "required",
			"topics" => "required",
			"day" => "required",
			"time" => "required"
		);

		$this->helper(array("alerts", "time", "files"));

		$data = $this->Data->process(null, $validations);

		if (isset($data["error"])) {
			return $data["error"];
		}
		
		$slides = $this->uploadSlides();

		if (!$slides) {
			return getAlert($this->uploadStatus["message"]);
		}

		$values = array(
			"Title" => POST("title"),
			"Slug" => slug(POST("title", "clean")),
			"Description" => nl2br(cleanHTML(decode(POST("description", "clean")))),
			"Topics" => nl2br(cleanHTML(decode(POST("topics", "clean")))),
			"File" => $slides,
			"Email" => POST("email"),
			"Skype" => POST("skype"),
			"Gtalk" => POST("gtalk"),
			"Twitter" => POST("twitter"),
			"Facebook" => POST("facebook"),
			"Proposal_Day" => POST("day"),
			"Proposal_Time" => POST("time"),
			"Start_Date" => now(4),
			"Situation" => "Active"
		);

		if ($this->Db->findBySQL("Proposal_Day = '" . POST("day") . "' and Proposal_Time = '" . POST("time") . "'", $this->table, "ID_Workshop")) {
			return getAlert(__("There is other proposal with the same day and time"));
		} elseif (!$this->Db->insert($this->table, $values)) {
			return getAlert(__("An error has happened."));
		} else {
			$this->sendMail($values);
			return getAlert(__("Your proposal has been sent"), "success");
		}
  	}

  	private function sendMail($values = null)
  	{
  		$this->Email->email = _get("webEmailRecieve");
  		$this->Email->subject = __("New Proposal") . " - " . _get("webName");
  		$this->Email->message = $this->view("mail", $values, "workshop", true);

		$this->Email->send();
  	}

  	private function uploadSlides()
  	{
  		$dir = "www/lib/files/workshops/";

		if (!is_dir($dir)) {
			@mkdir($dir, 0777);
		}

		$this->Files = $this->core("Files");

		$this->Files->filename = FILES("file", "name");
		$this->Files->fileType = FILES("file", "type");
		$this->Files->fileSize = FILES("file", "size");
		$this->Files->fileError = FILES("file", "error");
		$this->Files->fileTmp = FILES("file", "tmp_name");

		$this->uploadStatus = $this->Files->upload($dir, "document");
		
		if (is_array($this->uploadStatus) and $this->uploadStatus["upload"]) {
			return $dir . $this->uploadStatus["filename"];
		} else {
			return false;
		}
  	}
}
