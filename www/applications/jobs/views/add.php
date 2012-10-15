<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID          = isset($data) ? recoverPOST("ID", $data[0]["ID_Job"]) 			   : 0;
	$id_company  = isset($data) ? recoverPOST("id_company", $data[0]["ID_Company"])    : recoverPOST("id_company");
	$title       = isset($data) ? recoverPOST("title", $data[0]["Title"])   		   : recoverPOST("title");		
	$email       = isset($data) ? recoverPOST("email", $data[0]["Email"])   		   : recoverPOST("email");
	$company_i   = isset($data) ? recoverPOST("Company_Information", $data[0]["Company_Information"]): recoverPOST("Company_Information");
	$location    = isset($data) ? recoverPOST("location", $data[0]["Location"])        : recoverPOST("location");	
	$salary      = isset($data) ? recoverPOST("salary", $data[0]["Salary"])            : recoverPOST("salary");	
	$allocation  = isset($data) ? recoverPOST("allocation_time", $data[0]["Allocation_Time"]) : recoverPOST("allocation_time");
	$requirements= isset($data) ? recoverPOST("requirements", $data[0]["Requirements"]): recoverPOST("requirements");
	$experience  = isset($data) ? recoverPOST("experience", $data[0]["Experience"])    : recoverPOST("experience");
	$activities  = isset($data) ? recoverPOST("activities", $data[0]["Activities"])    : recoverPOST("activities");
	$profile     = isset($data) ? recoverPOST("profile", $data[0]["Profile"])          : recoverPOST("profile");
	$technologies= isset($data) ? recoverPOST("technologies", $data[0]["Technologies"]): recoverPOST("technologies");
	$additional_i= isset($data) ? recoverPOST("additional_information", $data[0]["Additional_Information"]): recoverPOST("additional_information");
	$company_contact= isset($data) ? recoverPOST("company_contact", $data[0]["Company_Contact"]): recoverPOST("company_contact");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	//$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			$options = array(
				0 => array("value" => 0, "option" => __("select")),
				1 => array("value" => 1, "option" => __("company1"), "selected" => ($id_company === "1")   ? TRUE : FALSE),
				2 => array("value" => 2, "option" => __("company2"), "selected" => ($id_company === "2")   ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "id_company", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Company")), 
				$options
			);	

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => $title 
			));

			echo formInput(array(	
				"name" 	=> "email", 
				"class" => "span10 required", 
				"field" => __("Email"), 
				"p" 	=> TRUE, 
				"value" => $email
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "Company_Information", 
				"class"  => "span9", 
				"field"  => __("Company Information"), 
				"p" 	 => TRUE, 
				"value"  => $company_i
			));

			echo formInput(array(	
				"name" 	=> "location", 
				"class" => "span10 required", 
				"field" => __("Location"), 
				"p" 	=> TRUE, 
				"value" => $location
			));

			echo formInput(array(	
				"name" 	=> "salary", 
				"class" => "span10 required", 
				"field" => __("salary"), 
				"p" 	=> TRUE, 
				"value" => $salary
			));

			echo formInput(array(	
				"name" 	=> "allocation_time", 
				"class" => "span10 required", 
				"field" => __("Allocation time"), 
				"p" 	=> TRUE, 
				"value" => $allocation
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "requirements", 
				"class"  => "span9",
				"field"  => __("Requirements"), 
				"p" 	 => TRUE, 
				"value"  => $requirements
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "experience", 
				"class"  => "span9", 
				"field"  => __("Experience"), 
				"p" 	 => TRUE, 
				"value"  => $experience
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "activities", 
				"class"  => "span9",
				"field"  => __("Activities"), 
				"p" 	 => TRUE, 
				"value"  => $activities
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "profile", 
				"class"  => "span9",
				"field"  => __("Profile"), 
				"p" 	 => TRUE, 
				"value"  => $profile
			));

			echo formInput(array(	
				"name" 	=> "technologies", 
				"class" => "span10 required", 
				"field" => __("Technologies"), 
				"p" 	=> TRUE, 
				"value" => $technologies
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "additional_information", 
				"class"  => "span9",
				"field"  => __("Additional Information"), 
				"p" 	 => TRUE, 
				"value"  => $additional_i
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "company_contact", 
				"class"  => "span9", 
				"field"  => __("Company contact"), 
				"p" 	 => TRUE, 
				"value"  => $company_contact
			));

			#echo formField(NULL, __("Language of the post") ."<br />". getLanguagesInput($language, "language", "select"));
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array("name" => "situation", "p" => TRUE, "field" => __("Situation")), $options);

			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		echo formClose();
	echo div(FALSE);