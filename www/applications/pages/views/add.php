<?php 
	if(!defined("_access")) { 
		die("Error: You don't have permission to access here..."); 
	} 
	
	
	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Page"]) 			: 0;
	$title     = isset($data) ? recoverPOST("title",     $data[0]["Title"]) 	: recoverPOST("title"); 
	$content   = isset($data) ? recoverPOST("content",   $data[0]["Content"]) 	: recoverPOST("content");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
	$principal = isset($data) ? recoverPOST("principal", $data[0]["Principal"]) : recoverPOST("principal");
	$language  = isset($data) ? recoverPOST("language",  $data[0]["Language"])  : recoverPOST("language");
	$edit      = isset($data) ? TRUE 											: FALSE;
	$action    = isset($data) ? "edit" 											: "save";
	$href	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID") : path(whichApplication() ."/cpanel/add");
	

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"type" 	=> "text", 
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => stripslashes($title)
			));

			echo formTextarea(array(
				"id" 	=> "editor", 
				"name" 	=> "content", 
				"style" => "height: 400px;", 
				"field" => __("Content"), 
				"p" 	=> TRUE, 
				"value" => $content)
			);

			echo formField(NULL, __("Languages") ."<br />". getLanguagesInput($language));
			
			$options = array(
				0 => array(
						"value"    => 1,
						"option"   => __("Yes"),
						"selected" => ((int) $principal === 1) ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => 0,
						"option"   => __("No"),
						"selected" => ((int) $principal === 0) ? TRUE : FALSE
					)
			);

			echo formSelect(array(
				"name" 	=> "principal", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Principal")), 
				$options
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
				"field" => __("Situation")), 
				$options
			);

			echo formSave($action);

			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);