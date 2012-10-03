<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Poll"])			 : recoverPOST("ID");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])			 : recoverPOST("title");
	$answers   = isset($data) ? recoverPOST("answers", $data[1])				 : recoverPOST("answers");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])	 : recoverPOST("situation");
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$action	   = isset($data) ? "edit"											 : "save";
	$href	   = isset($data) ? path("polls/cpanel/$action/$ID/") : path("polls/cpanel/add/");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Question"), 
				"p" 	=> TRUE, 
				"value" => $title
			));
						
			
			echo formField(NULL, __("Answers") ." (". __("Empty answers not be added") . ")");
			
			if(is_array($answers)) { 
				$count = 1;

				foreach($answers as $key => $answer) { 
					echo p(TRUE, "field panswer");	
						echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answer));	
					echo p(FALSE);

					$count++;
				}

				for($i = $count; $i <= 6; $i++) {
					echo p(TRUE, "field panswer");	
						echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => ""));
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

			echo formField(NULL, __("Language") ."<br />". getLanguagesInput($language, "language", "select"));		
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"p" 	=> TRUE, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);