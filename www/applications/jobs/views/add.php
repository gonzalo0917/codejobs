<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID         	= isset($data) ? recoverPOST("ID", $data[0]["ID_Job"]) 			   					 : 0;
	$title      	= isset($data) ? recoverPOST("title", $data[0]["Title"])   		   					 : recoverPOST("title");		
	$email       	= isset($data) ? recoverPOST("email", $data[0]["Email"])   		   					 : recoverPOST("email");
	$company       	= isset($data) ? recoverPOST("company", $data[0]["Company"])   		   				 : recoverPOST("company");
	$cinformation	= isset($data) ? recoverPOST("cinformation", $data[0]["Company_Information"]) 		 : recoverPOST("cinformation");
	$location   	= isset($data) ? recoverPOST("location", $data[0]["Location"])        				 : recoverPOST("location");	
	$salary    	  	= isset($data) ? recoverPOST("salary", $data[0]["Salary"])            				 : recoverPOST("salary");	
	$allocation  	= isset($data) ? recoverPOST("allocation_time", $data[0]["Allocation_Time"]) 		 : recoverPOST("allocation_time");
	$requirements	= isset($data) ? recoverPOST("requirements", $data[0]["Requirements"])				 : recoverPOST("requirements");
	$experience  	= isset($data) ? recoverPOST("experience", $data[0]["Experience"])    				 : recoverPOST("experience");
	$activities  	= isset($data) ? recoverPOST("activities", $data[0]["Activities"])    				 : recoverPOST("activities");
	$profile     	= isset($data) ? recoverPOST("profile", $data[0]["Profile"])          				 : recoverPOST("profile");
	$technologies	= isset($data) ? recoverPOST("technologies", $data[0]["Technologies"])				 : recoverPOST("technologies");
	$additional		= isset($data) ? recoverPOST("additional", $data[0]["Additional_Information"]) 		 : recoverPOST("additional");
	$ccontact		= isset($data) ? recoverPOST("company_contact", $data[0]["Company_Contact"])		 : recoverPOST("ccontact");
	$language  		= isset($data) ? recoverPOST("language", $data[0]["Language"])  	 				 : recoverPOST("language");
	$duration 		= isset($data) ? recoverPOST("duration", $data[0]["Duration"])  					 : recoverPOST("duration");
	$situation 		= isset($data) ? recoverPOST("situation", $data[0]["Situation"])  					 : recoverPOST("situation");				
	$edit      		= isset($data) ? TRUE											 					 : FALSE;
	$action	   		= isset($data) ? "edit"											 					 : "save";
	$href 	   		= isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") 					 : path(whichApplication() ."/cpanel/add");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;
			
			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => $title 
			));
			
			echo formInput(array( 
				"name"     => "email",
				"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"type"     => "email",
				"class"    => "span10 required",
				"field"    => __("Email"), 
				"p"    	   => TRUE, 
				"value"    => $email,
				"required" => TRUE
			));

			echo formInput(array(
				"name"	 => "company",
				"class"  => "span10 required", 
				"field"  => __("Company"), 
				"p" 	 => TRUE, 
				"value"  => $company
			));
			
			echo formTextarea(array(  
				"id"     => "redactor",
				"name"   => "cinformation", 
				"class"  => "markItUp", 
				"style"  => "height: 240px;", 
				"field"  => __("Company Information"), 
				"p"   	 => TRUE, 
				"value"  => stripslashes($cinformation)
			));
			
			echo formInput(array(
				"name"	 => "location",
				"class"  => "span10 required", 
				"field"  => __("Location"), 
				"p" 	 => TRUE, 
				"value"  => $location
			));
			
			echo formInput(array(	
				"name" 	=> "salary", 
				"class" => "span10 required", 
				"field" => __("Salary"), 
				"p" 	=> TRUE, 
				"value" => $salary
			));
			
			$options = array(
				0 => array("value" => "Full Time",   "option" => __("Full Time"),   "selected" => ($allocation === "Full Time")   ? TRUE : FALSE),
				1 => array("value" => "Half Time",   "option" => __("Half Time"),   "selected" => ($allocation === "Half Time")   ? TRUE : FALSE)
			);

			echo formSelect(array(
				"id"    => "allocation",
				"name"  => "allocation", 
				"p"  	=> TRUE, 
				"class" => "required", 
				"field" => __("Allocation Time")), 
				$options
			);

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "requirements", 
				"class"  => "markItUp",
				"style"  => "height: 240px;",
				"field"  => __("Requirements"), 
				"p" 	 => TRUE, 
				"value"  => $requirements
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "experience", 
				"class"  => "markItUp", 
				"style"  => "height: 240px;",
				"field"  => __("Experience"), 
				"p" 	 => TRUE, 
				"value"  => $experience
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "activities", 
				"class"  => "markItUp",
				"style"  => "height: 240px;",
				"field"  => __("Activities"), 
				"p" 	 => TRUE, 
				"value"  => $activities
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "profile", 
				"class"  => "markItUp",
				"style"  => "height: 240px;",
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
				"class"  => "markItUp",
				"style"  => "height: 240px;",
				"field"  => __("Additional Information"), 
				"p" 	 => TRUE, 
				"value"  => $additional
			));

			echo formTextarea(array(	
				"id" 	 => "", 
				"name" 	 => "ccontact", 
				"class"  => "markItUp", 
				"style"  => "height: 240px;",
				"field"  => __("Company contact"), 
				"p" 	 => TRUE, 
				"value"  => $ccontact
			));
			
			echo formField(NULL, __("Language") ."<br />". getLanguagesInput($language, "language", "select"));
			
			$options = array(
				0 => array("value" => "86400",   "option" => "1 ". __("Day"),     "selected" => ($duration === "86400")    ? TRUE : FALSE),
				1 => array("value" => "604800",   "option" => "7 ". __("Days"),   "selected" => ($duration === "604800")   ? TRUE : FALSE),
				2 => array("value" => "1296000", "option" => "15 ". __("Days"),   "selected" => ($duration === "1296000") ? TRUE : FALSE),
				3 => array("value" => "2592000", "option" => "30 ". __("Days"),   "selected" => ($duration === "2592000") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"id"    => "duration",
				"name"  => "duration", 
				"p"  	=> TRUE, 
				"class" => "required", 
				"field" => __("Duration")), 
				$options
			);

			$options = array(
				0 => array("value" => "Draft",   "option" => __("Draft"),     "selected" => ($situation === "Draft")    ? TRUE : FALSE),
				1 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				2 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"id"    => "situation",
				"name"  => "situation", 
				"p"  	=> TRUE, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);
			
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Job"));
		echo formClose();
	echo div(FALSE);
			