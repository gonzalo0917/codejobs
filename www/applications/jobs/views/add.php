<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Job"]) 			 : 0;
	$ID_URL    = isset($data) ? recoverPOST("ID_URL", $data[0]["ID_URL"]) 		 : recoverPOST("ID_URL");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])   		 : recoverPOST("title");		
	$email     = isset($data) ? recoverPOST("email", $data[0]["Email"])   		 : recoverPOST("email");	
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(_(ucfirst(whichApplication()))), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			

			$options = array(
				0 => array("value" => 0, "option" => __(_("select"))),
				1 => array("value" => 1, "option" => __(_("company1"))),
				2 => array("value" => 2, "option" => __(_("company2")))
			);

			echo formSelect(array(
				"name" 	=> "company", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __(_("Company"))), 
				$options
			);	

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __(_("Title")), 
				"p" 	=> TRUE, 
				"value" => $title 
			));

			echo formInput(array(	
				"name" 	=> "email", 
				"class" => "span10 required", 
				"field" => __(_("Email")), 
				"p" 	=> TRUE, 
				"value" => $email
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "company_information", 
				"class"  => "span9", 
				"field"  => __(_("Company information")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			echo formInput(array(	
				"name" 	=> "location", 
				"class" => "span10 required", 
				"field" => __(_("Location")), 
				"p" 	=> TRUE, 
				"value" => ""
			));

			echo formInput(array(	
				"name" 	=> "salary", 
				"class" => "span10 required", 
				"field" => __(_("salary")), 
				"p" 	=> TRUE, 
				"value" => ""
			));

			echo formInput(array(	
				"name" 	=> "allocation_time", 
				"class" => "span10 required", 
				"field" => __(_("Allocation time")), 
				"p" 	=> TRUE, 
				"value" => ""
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "requirements", 
				"class"  => "span9",
				"field"  => __(_("Requirements")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "experience", 
				"class"  => "span9", 
				"field"  => __(_("Experience")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "activities", 
				"class"  => "span9",
				"field"  => __(_("Activities")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "profile", 
				"class"  => "span9",
				"field"  => __(_("Profile")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			echo formInput(array(	
				"name" 	=> "technologies", 
				"class" => "span10 required", 
				"field" => __(_("Technologies")), 
				"p" 	=> TRUE, 
				"value" => ""
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "additional_information", 
				"class"  => "span9",
				"field"  => __(_("Additional Information")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "company_contact", 
				"class"  => "span9", 
				"field"  => __(_("Company contact")), 
				"p" 	 => TRUE, 
				"value"  => ""
			));

			#echo formField(NULL, __(_("Language of the post")) ."<br />". getLanguagesInput($language, "language", "select"));
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array("name" => "situation", "p" => TRUE, "field" => __(_("Situation"))), $options);

			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		echo formClose();
	echo div(FALSE);