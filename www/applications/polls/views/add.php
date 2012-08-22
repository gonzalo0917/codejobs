<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Poll"])			 : recoverPOST("ID");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])			 : recoverPOST("title");
	$answers   = isset($data) ? recoverPOST("answers", $data[1])				 : recoverPOST("answers");
	$type 	   = isset($data) ? recoverPOST("type", $data[0]["Type"])			 : recoverPOST("type");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])	 : recoverPOST("situation");
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$action	   = isset($data) ? "edit"											 : "save";
	$href	   = isset($data) ? path($this->application ."/cpanel/$action/$ID/") : path($this->application ."/cpanel/add/");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(_(ucfirst(whichApplication()))), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __(_("Question")), 
				"p" 	=> TRUE, 
				"value" => $title
			));
						
			
			echo formField(NULL, __(_("Answers")) ." (". __(_("Empty answers not be added")) . ")");
			
			if(is_array($answers)) { 
				foreach($answers as $key => $answer) { 
					echo p(TRUE, "field panswer");	
						echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answer));	
					echo p(FALSE);
				}
			} else { 
				echo p(TRUE, "field panswer");	
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));	
				echo p(FALSE);
			} 	

			echo formField(NULL, __(_("Language")) ."<br />". getLanguagesInput($language, "language", "select"));		
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"p" 	=> TRUE, 
				"class" => "required", 
				"field" => __(_("Situation"))), 
				$options
			);
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);