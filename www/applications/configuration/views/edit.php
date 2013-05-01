<?php 
	if (!defined("ACCESS")) {
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
	$editor    	  = recoverPOST("editor", $data[0]["Editor"]);	
	$situation    = recoverPOST("situation", $data[0]["Situation"]);	
	$action	      = "edit";
	$href		  = path(whichApplication() ."/cpanel/edit");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name" 	=> "name", 
				"class" => "required span10", 
				"field" => __("Name of the Website"), 
				"p" 	=> true, 
				"value" => $name)
			);

			echo formInput(array(
				"name" 	=> "URL", 
				"class" => "required span10", 
				"field" => __("URL of the Website"), 
				"p" 	=> true, 
				"value" => $URL)
			);

			echo formInput(array(
				"name" 	=> "slogan_spanish", 
				"class" => "required span10", 
				"field" => getLanguage("Spanish", true) ." ". __("Slogan of the Website"), 
				"p" 	=> true, 
				"value" => $sloganEs)
			);
			
			echo formInput(array(
				"name" 	=> "slogan_english", 
				"class" => "required span10", 
				"field" => getLanguage("English", true) ." ". __("Slogan of the Website"), 
				"p" 	=> true, 
				"value" => $sloganEn)
			);			
		
			echo formInput(array(
				"name" 	=> "slogan_french", 
				"class" => "required span10", 
				"field" => getLanguage("French", true) ." ". __("Slogan of the Website"), 
				"p" 	=> true, 
				"value" => $sloganFr)
			);	
	
			echo formInput(array(
				"name" 	=> "slogan_portuguese", 
				"class" => "required span10", 
				"field" => getLanguage("Portuguese", true) ." ". __("Slogan of the Website"), 
				"p" 	=> true, 
				"value" => $sloganPt)
			);
			
			echo formInput(array(
				"name" 	=> "email_recieve", 
				"class" => "required span10", 
				"field" => __("Email for recieve notifications"), 
				"p" 	=> true, 
				"value" => $emailRecieve)
			);

			echo formInput(array(
				"name" 	=> "email_send", 
				"class" => "required span10", 
				"field" => __("Email for send notifications"), 
				"p" 	=> true, 
				"value" => $emailSend)
			);

			echo formSelect(array(
				"name" 	=> "theme", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Default theme")), $themes
			);
	
			echo formSelect(array(
				"name" 	=> "application", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Default application")), $defaultApplications
			);	

			$options = array(
				0 => array(
					"value"    => "Active",
					"option"   => __("Active"),
					"selected" => ($validation === "Active") ? true : false
				),
				
				1 => array(
					"value"    => "Inactive",
					"option"   => __("Inactive"),
					"selected" => ($validation === "Inactive") ? true : false
				)
			);

			echo formSelect(array(
				"name" 	=> "validation", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Comments validations")), $options
			);
			
			$options = array(
				0 => array(
					"value"    => "User",
					"option"   => __("User"),
					"selected" => ($activation === "User") ? true : false
				),
				
				1 => array(
					"value"    => "Admin",
					"option"   => __("Administrator"),
					"selected" => ($activation === "Admin") ? true : false
				)
			);

			echo formSelect(array(
				"name" 	=> "activation", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Accounts activation")), $options
			);
			
			$options = array(
				0 => array(
					"value"    => "Active",
					"option"   => __("Active"),
					"selected" => ($situation === "Active") ? true : false
				),
				
				1 => array(
					"value"    => "Inactive",
					"option"   => __("Inactive"),
					"selected" => ($situation === "Inactive") ? true : false
				)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Situation")), $options
			);
			
			$options = array(
				0 => array(
					"value"    => "Redactor",
					"option"   => "Redactor",
					"selected" => ($editor === "Redactor") ? true : false
				),
				
				1 => array(
					"value"    => "MarkItUp",
					"option"   => "MarkItUp",
					"selected" => ($editor === "MarkItUp") ? true : false
				)
			);

			echo formSelect(array(
				"name" 	=> "editor", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Default editor")), $options
			);			

			echo formField(null, __("Update minified files") ."<br />" . 
								 formInput(array("type" => "submit", "value" => "CSS", "name" => "minify_css", "class" => "btn btn-primary", "onclick" => "return confirm('". __("This may take several minutes. Are you sure you want to do this?") ."')")) .
								 formInput(array("type" => "submit", "value" => "JS", "name" => "minify_js", "class" => "btn btn-primary", "onclick" => "return confirm('". __("This may take several minutes. Are you sure you want to do this?") ."')")) .
								 formInput(array("type" => "submit", "value" => __("All files"), "name" => "minify", "class" => "btn btn-danger", "onclick" => "return confirm('". __("This may take several minutes. Are you sure you want to do this?") ."')"))
						  );
			
			echo formField(null, __("Cache") . "<br />" . formSelect(array(
				"name" 	=> "cache", 
				"class" => "required", 
				"p" 	=> false
			), array(
				array(
					"value"  => "blog",
					"option" => __("Blog"),
					"selected" => true
				),
				array(
					"value"  => "bookmarks",
					"option" => __("Bookmarks")
				),
				array(
					"value"  => "codes",
					"option" => __("Codes")
				),
				array(
					"value"  => "pages",
					"option" => __("Pages")
				),
				array(
					"value"  => "world",
					"option" => __("World")
				),
				array(
					"value"  => "ads",
					"option" => __("Ads")
				)
			)) . formInput(array("type" => "submit", "value" => __("Delete"), "name" => "delete_cache", "class" => "btn btn-danger", "style" => "margin-bottom: 9px")));

			echo formTextarea(array(
				"id" 	=> "editor", 
				"name" 	=> "message", 
				"class" => "required", 
				"field" => __("Message when the Website is inactive"), 
				"p" 	=> true, 
				"value" => $message)
			);
			
			echo formField(null, __("Languages") ."<br />". getLanguagesInput($language));
			
			echo formAction("edit");

		echo formClose();
	echo div(false);