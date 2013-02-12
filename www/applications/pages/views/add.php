<?php 
	if (!defined("ACCESS")) { 
		die("Error: You don't have permission to access here..."); 
	} 
	
	
	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Page"]) 			: 0;
	$title     = isset($data) ? recoverPOST("title",     $data[0]["Title"]) 	: recoverPOST("title"); 
	$content   = isset($data) ? recoverPOST("content",   $data[0]["Content"]) 	: recoverPOST("content");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
	$principal = isset($data) ? recoverPOST("principal", $data[0]["Principal"]) : recoverPOST("principal");
	$language  = isset($data) ? recoverPOST("language",  $data[0]["Language"])  : recoverPOST("language");
	$edit      = isset($data) ? true 											: false;
	$action    = isset($data) ? "edit" 											: "save";
	$href	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID") : path(whichApplication() ."/cpanel/add");
	

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"type" 	=> "text", 
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> true, 
				"value" => stripslashes($title)
			));

			echo formTextarea(array(
				"id" 	=> "editor", 
				"name" 	=> "content", 
				"style" => "height: 400px;", 
				"field" => __("Content"), 
				"p" 	=> true, 
				"value" => $content)
			);

			echo formField(null, __("Languages") ."<br />". getLanguagesInput($language));
			
			$options = array(
				0 => array(
						"value"    => 1,
						"option"   => __("Yes"),
						"selected" => ((int) $principal === 1) ? true : false
					),
				
				1 => array(
						"value"    => 0,
						"option"   => __("No"),
						"selected" => ((int) $principal === 0) ? true : false
					)
			);

			echo formSelect(array(
				"name" 	=> "principal", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Principal")), 
				$options
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
				"field" => __("Situation")), 
				$options
			);

			echo formSave($action);

			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);