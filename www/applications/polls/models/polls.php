<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Polls_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->table  = "polls";
		$this->fields = "ID_Poll, Title, Text_Date, Language, Situation";
		
		$this->Data = $this->core("Data");

		$this->helper("alerts");
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Poll DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit) {
		if(!$trash) { 			
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") === 1) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);
		}	
	}
	
	private function editOrSave() {		
		$j = 0;
		$k = 0;
		
		foreach(POST("answers") as $key => $answer) {
			if($answer === "") {
				$j += 1; 
			} else {
				$k += 1;
			}
		}
		
		if(count(POST("answers")) === $j) {
			return getAlert(__("You need to write a answers"));
		} elseif($k < 2) {
			return getAlert(__("You need to write more than one answer"));
		} else {
			$this->answers = POST("answers");
		}

		$validations = array(
			"title" => "required"
		);

		$this->helper("time");

		$data = array(
			"ID_User" 	 => SESSION("ZanUserID"),
			"Start_Date" => now(4),
			"Text_Date"  => decode(now(2)),
		);

		$this->Data->ignore("answers");
		
		$this->data = $this->Data->proccess($data, $validations);
	}
	
	private function save() {
		$lastID = $this->Db->insert($this->table, $this->data);
		
		if($lastID) {
			for($i = 0; $i <= count($this->answers) - 1; $i++) {
				if($this->answers[$i] !== "") {
					$answers[$i]["ID_Poll"] = $lastID;
					$answers[$i]["Answer"]  = decode($this->answers[$i]);
				}
			}
			
			$this->Db->insertBatch("polls_answers", $answers);
			
			return getAlert(__("The poll has been saved correctly"), "success");
		}
		
		return getAlert(__("Insert error"));
	}
	
	private function edit() {
		$this->Db->update($this->table, $this->data, POST("ID"));
		
		$this->Db->deleteBySQL("ID_Poll = '". POST("ID") ."'", "polls_answers");
		
		foreach($this->answers as $key => $answer) {
			if($answer !== "") {
				$this->Db->insert("polls_answers", array("ID_Poll" => POST("ID"), "Answer" => decode($answer)));
			}
		}
		
		return getAlert(__("The poll has been edit correctly"), "success");
	}
	
	public function getByID($ID) {
		$data1 = $this->Db->find($ID, $this->table, "ID_Poll, Title, Language, Situation");		
		
		if($data1) {
			$data2 = $this->Db->findBy("ID_Poll", $data1[0]["ID_Poll"], "polls_answers", "ID_Answer, Answer, Votes");
			
			$data["question"] = $data1[0];
			$data["answers"]  = $data2;
			
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function getLastPoll() {		
		$language = whichLanguage();

		$data1 = $this->Db->findBySQL("Language = '$language'", $this->table, $this->fields, NULL, "ID_Poll DESC", 1);
		
		if($data1) {
			$data2 = $this->Db->findBy("ID_Poll", $data1[0]["ID_Poll"], "polls_answers", "ID_Answer, Answer, Votes");
			
			$data["question"] = $data1[0];
			$data["answers"]  = $data2;
			
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function vote() {
		$this->helper("time");

		$ID_Poll   = GET("ID_Poll");
		$ID_Answer = GET("answer");
		$IP		   = getIP();
		$date	   = now(4);
		$end	   = $date + 3600;

		$data = $this->Db->findBySQL("ID_Poll = '$ID_Poll' AND IP = '$IP' AND End_Date > $date", "polls_ips", "ID_Poll, IP, Start_Date, End_Date");
		
		if($data) {
			COOKIE("ZanPoll", $ID_Poll, 3600);
			
			return FALSE;
		} else {								
			$this->Db->updateBySQL("polls_answers", "Votes = (Votes) + 1 WHERE ID_Answer = '$ID_Answer'");								
			
			$data = array(
				"ID_Poll" 	 => $ID_Poll,
				"IP"	  	 => $IP,
				"Start_Date" => $date,
				"End_Date"	 => $end
			);

			$this->Db->insert("polls_ips", $data);
			
			COOKIE("ZanPoll", $ID_Poll, 3600);
		}
		
		return TRUE;
	}
}