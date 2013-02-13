<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	     = isset($data) ? recoverPOST("ID", $data["ID_Bookmark"]) 			: 0;
	$title       = isset($data) ? recoverPOST("title", $data["Title"]) 				: recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data["Description"]) 	: recoverPOST("description");
	$URL         = isset($data) ? recoverPOST("URL", $data["URL"]) 					: recoverPOST("URL", "http://");
	$tags    	 = isset($data) ? recoverPOST("tags", $data["Tags"]) 				: recoverPOST("tags");
	$language  	 = isset($data) ? recoverPOST("language", $data["Language"])  	 	: recoverPOST("language");
	$edit        = isset($data) ? true 												: false;
	$action	     = isset($data) ? "edit"											: "save";
	$resalt      = isset($data) ? __("Edit bookmark") 								: __("Add new bookmark");
	$href	     = path("bookmarks/add/");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p($resalt, "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(	
				"name" 	=> "URL", 
				"class" => "required",
				"style" => "width: 100%;", 
				"field" => __("URL"), 
				"p" 	=> true, 
				"value" => $URL,
				"type"  => "url"
			));

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "required",
				"style" => "width: 100%;", 
				"field" => __("Title"), 
				"p" 	=> true, 
				"value" => stripslashes($title)
			));
			
			echo formTextarea(array(	
				"id" 	 => "editor", 
				"name" 	 => "description", 
				"class"  => "required",
				"style"  => "width: 100%; height: 140px;", 
				"field"  => __("Description"), 
				"p" 	 => true, 
				"value"  => stripslashes($description)
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"class" => "required",
				"style" => "width: 300px;", 
				"field" => __("Tags"), 
				"p" 	=> true, 
				"value" => $tags
			));

			echo htmlTag("p", span("field", "&raquo; " . __("Language of the post")) . "<br />" . getLanguagesInput($language, "language", "select"));

			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

			echo formInput(array(	
				"name" 	=> "preview", 
				"class" => "btn", 
				"value" => __("Preview"), 
				"type"  => "submit"
			));
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);