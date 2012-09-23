<?php
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}

	$ID  	     = isset($data) ? recoverPOST("ID", $data[0]["ID_Forum"]) 			  : 0;
	$title       = isset($data) ? recoverPOST("title", $data[0]["Title"]) 			  : recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) : recoverPOST("description");
	$language    = isset($data) ? recoverPOST("language", $data[0]["Language"]) 	  : recoverPOST("language");
	$situation 	 = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 	  : recoverPOST("situation");
	$edit        = isset($data) ? TRUE 												  : FALSE;
	$action	     = isset($data) ? "edit" 											  : "save";
	$href        = isset($data) ? path(whichApplication() ."/cpanel/edit/$ID") 		  : path(whichApplication() ."/cpanel/add/");		

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name"  => "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => $title
			));
	
			echo formTextarea(array(
				"name"  => "description", 
				"class" => "required", 
				"style" => "height: 150px;", 
				"field" => __("Description"), 
				"p" 	=> TRUE, 
				"value" => $description
			));

			echo formField(NULL, __("Languages") ."<br />". getLanguagesInput($language)); 	
			
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

			echo formSelect(array("name" => "situation", "class" => "required", "p" => TRUE, "field" => __("Situation")), $options);
						
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);