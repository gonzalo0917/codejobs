<?php
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}

	$ID = isset($data) ? recoverPOST("ID", $data[0]["ID_Forum"]) : 0;
	$title = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) : recoverPOST("description");
<<<<<<< HEAD
	$language    = isset($data) ? recoverPOST("language", $data[0]["Language"]) : recoverPOST("language");
	$situation 	 = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
	$edit        = isset($data) ? true : false;
	$action	     = isset($data) ? "edit" : "save";
	$href        = isset($data) ? path(whichApplication() ."/cpanel/edit/$ID") : path(whichApplication() ."/cpanel/add/");
=======
	$language    = isset($data) ? recoverPOST("language", $data[0]["Language"]) 	  : recoverPOST("language");
	$situation 	 = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 	  : recoverPOST("situation");
	$edit        = isset($data) ? true 												  : false;
	$action	     = isset($data) ? "edit" 											  : "save";
	$href        = isset($data) ? path(whichApplication() ."/cpanel/edit/$ID") 		  : path(whichApplication() ."/cpanel/add/");		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
<<<<<<< HEAD
=======
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name" => "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
<<<<<<< HEAD
				"p" => true, 
=======
				"p" 	=> true, 
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				"value" => $title
			));

			echo formTextarea(array(
				"name" => "description", 
				"class" => "required", 
				"style" => "height: 150px;", 
				"field" => __("Description"), 
<<<<<<< HEAD
				"p" => true, 
				"value" => $description
			));

			echo formField(null, __("Languages") ."<br />". getLanguagesInput($language));

			$options = array(
				0 => array(
						"value" => "Active",
						"option" => __("Active"),
=======
				"p" 	=> true, 
				"value" => $description
			));

			echo formField(null, __("Languages") ."<br />". getLanguagesInput($language)); 	
			
			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __("Active"),
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
						"selected" => ($situation === "Active") ? true : false
					),

				1 => array(
<<<<<<< HEAD
						"value" => "Inactive",
						"option" => __("Inactive"),
=======
						"value"    => "Inactive",
						"option"   => __("Inactive"),
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
						"selected" => ($situation === "Inactive") ? true : false
					)
			);

			echo formSelect(array("name" => "situation", "class" => "required", "p" => true, "field" => __("Situation")), $options);
<<<<<<< HEAD
=======
						
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			echo formSave($action);
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);