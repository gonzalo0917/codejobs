<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_User"]) 			 	: 0;
	$username  = isset($data) ? recoverPOST("username", $data[0]["Username"]) 	 	: recoverPOST("username");
	$privilege = isset($data) ? recoverPOST("privilege", $data[0]["ID_Privilege"]) 	: recoverPOST("privilege"); 
	$email     = isset($data) ? recoverPOST("email", $data[0]["Email"]) 		 	: recoverPOST("email");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  	: recoverPOST("situation");				
	$pwd   	   = isset($data) ? null				 								: recoverPOST("pwd");
	$edit      = isset($data) ? true											 	: false;
	$action	   = isset($data) ? "edit"											 	: "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") 	: path(whichApplication() ."/cpanel/add");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name" 	=> "username", 
				"class" => "required", 
				"field" => __("Username"), 
				"p" 	=> true, 
				"value" => $username
			));
			
			echo formInput(array(
				"name" 	=> "pwd", 
				"type" 	=> "password", 
				"class" => "required", 
				"field" => __("Password"),
				"autocomplete" => "off", 
				"p" 	=> true, 
				"value" => null
			));
	
			echo formInput(array(
				"name" 	=> "email", 
				"class" => "required", 
				"field" => __("Email"), 
				"p" 	=> true, 
				"value" => $email
			));
			
			$i = 0;
			
			foreach ($privileges as $value) { 
				$options[$i]["value"]    = $value["ID_Privilege"];
				$options[$i]["option"]   = $value["Privilege"];
				$options[$i]["selected"] = ($value["ID_Privilege"] === $privilege) ? true : false;

				$i++;
			} 
			
			echo formSelect(array(
				"name" 	=> "privilege", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Privilege")), 
				$options
			);	
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? true : false),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? true : false)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Situation")), 
				$options
			);	
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);