<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_User"]) 			 	: 0;
	$username  = isset($data) ? recoverPOST("username", $data[0]["Username"]) 	 	: recoverPOST("username");
	$privilege = isset($data) ? recoverPOST("privilege", $data[0]["ID_Privilege"]) 	: recoverPOST("privilege"); 
	$email     = isset($data) ? recoverPOST("email", $data[0]["Email"]) 		 	: recoverPOST("email");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  	: recoverPOST("situation");				
	$pwd   	   = isset($data) ? NULL				 								: recoverPOST("pwd");
	$edit      = isset($data) ? TRUE											 	: FALSE;
	$action	   = isset($data) ? "edit"											 	: "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") 	: path(whichApplication() ."/cpanel/add");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name" 	=> "username", 
				"class" => "required", 
				"field" => __("Username"), 
				"p" 	=> TRUE, 
				"value" => $username
			));
			
			echo formInput(array(
				"name" 	=> "pwd", 
				"type" 	=> "password", 
				"class" => "required", 
				"field" => __("Password"),
				"autocomplete" => "off", 
				"p" 	=> TRUE, 
				"value" => NULL
			));
	
			echo formInput(array(
				"name" 	=> "email", 
				"class" => "required", 
				"field" => __("Email"), 
				"p" 	=> TRUE, 
				"value" => $email
			));
			
			$i = 0;
			
			foreach($privileges as $value) { 
				$options[$i]["value"]    = $value["ID_Privilege"];
				$options[$i]["option"]   = $value["Privilege"];
				$options[$i]["selected"] = ($value["ID_Privilege"] === $privilege) ? TRUE : FALSE;

				$i++;
			} 
			
			echo formSelect(array(
				"name" 	=> "privilege", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Privilege")), 
				$options
			);	
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Situation")), 
				$options
			);	
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);