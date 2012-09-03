<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$name         = recoverPOST("name", $data[0]["Name"]);
	$sloganEn     = recoverPOST("slogan_en", $data[0]["Slogan_English"]);
	$sloganEs     = recoverPOST("slogan_es", $data[0]["Slogan_Spanish"]);
	$sloganFr     = recoverPOST("slogan_fr", $data[0]["Slogan_French"]);
	$sloganPt     = recoverPOST("slogan_pt", $data[0]["Slogan_Portuguese"]);
	$URL	 	  = recoverPOST("URL", $data[0]["URL"]);
	$language     = recoverPOST("language", $data[0]["Language"]);
	$theme	      = recoverPOST("theme", $data[0]["Theme"]);
	$validation   = recoverPOST("validation", $data[0]["Validation"]);
	$application  = recoverPOST("application", $data[0]["Application"]);
	$message	  = recoverPOST("message", $data[0]["Message"]);
	$activation   = recoverPOST("activation", $data[0]["Activation"]);
	$emailRecieve = recoverPOST("email1", $data[0]["Email_Recieve"]);
	$emailSend    = recoverPOST("email2", $data[0]["Email_Send"]);
	$situation    = recoverPOST("situation", $data[0]["Situation"]);	
	$action	      = "edit";
	$href		  = path($this->application ."/cpanel/edit");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name" 	=> "name", 
				"class" => "required span10", 
				"field" => __("Name of the Website"), 
				"p" 	=> TRUE, 
				"value" => $name)
			);

			echo formInput(array(
				"name" 	=> "URL", 
				"class" => "required span10", 
				"field" => __("URL of the Website"), 
				"p" 	=> TRUE, 
				"value" => $URL)
			);

			echo formInput(array(
				"name" 	=> "slogan_spanish", 
				"class" => "required span10", 
				"field" => getLanguage("Spanish", TRUE) ." ". __("Slogan of the Website"), 
				"p" 	=> TRUE, 
				"value" => $sloganEs)
			);
			
			echo formInput(array(
				"name" 	=> "slogan_english", 
				"class" => "required span10", 
				"field" => getLanguage("English", TRUE) ." ". __("Slogan of the Website"), 
				"p" 	=> TRUE, 
				"value" => $sloganEn)
			);			
		
			echo formInput(array(
				"name" 	=> "slogan_french", 
				"class" => "required span10", 
				"field" => getLanguage("French", TRUE) ." ". __("Slogan of the Website"), 
				"p" 	=> TRUE, 
				"value" => $sloganFr)
			);	
	
			echo formInput(array(
				"name" 	=> "slogan_portuguese", 
				"class" => "required span10", 
				"field" => getLanguage("Portuguese", TRUE) ." ". __("Slogan of the Website"), 
				"p" 	=> TRUE, 
				"value" => $sloganPt)
			);
			
			echo formInput(array(
				"name" 	=> "email_recieve", 
				"class" => "required span10", 
				"field" => __("Email for recieve notifications"), 
				"p" 	=> TRUE, 
				"value" => $emailRecieve)
			);

			echo formInput(array(
				"name" 	=> "email_send", 
				"class" => "required span10", 
				"field" => __("Email for send notifications"), 
				"p" 	=> TRUE, 
				"value" => $emailSend)
			);

			echo formSelect(array(
				"name" 	=> "theme", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Default theme")), $themes
			);
	
			echo formSelect(array(
				"name" 	=> "application", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Default application")), $defaultApplications
			);	

			$options = array(
				0 => array(
					"value"    => "Active",
					"option"   => __("Active"),
					"selected" => ($validation === "Active") ? TRUE : FALSE
				),
				
				1 => array(
					"value"    => "Inactive",
					"option"   => __("Inactive"),
					"selected" => ($validation === "Inactive") ? TRUE : FALSE
				)
			);

			echo formSelect(array(
				"name" 	=> "validation", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Comments validations")), $options
			);
			
			$options = array(
				0 => array(
					"value"    => "User",
					"option"   => __("User"),
					"selected" => ($activation === "User") ? TRUE : FALSE
				),
				
				1 => array(
					"value"    => "Admin",
					"option"   => __("Administrator"),
					"selected" => ($activation === "Admin") ? TRUE : FALSE
				)
			);

			echo formSelect(array(
				"name" 	=> "activation", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Accounts activation")), $options
			);
			
			$options = array(
				0 => array(
					"value"    => "Active",
					"option"   => __("Active"),
					"selected" => ($situation === "Active") ? TRUE : FALSE
				),
				
				1 => array(
					"value"    => "Inactive",
					"option"   => __("Inactive"),
					"selected" => ($situation === "Inactive") ? TRUE : FALSE
				)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Situation")), $options
			);			
			
			echo formTextarea(array(
				"id" 	=> "editor", 
				"name" 	=> "message", 
				"class" => "required", 
				"field" => __("Message when the Website is inactive"), 
				"p" 	=> TRUE, 
				"value" => $message)
			);
			
			echo formField(NULL, __("Languages") ."<br />". getLanguagesInput($language));
			
			echo formSave("edit");

		echo formClose();
	echo div(FALSE);