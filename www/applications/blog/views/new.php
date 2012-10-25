<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	     = isset($data) ? recoverPOST("ID", 0) 								: 0;
	$title       = isset($data) ? recoverPOST("title", $data["Title"]) 				: recoverPOST("title");
	$content 	 = isset($data) ? recoverPOST("content", $data["Content"])		 	: stripslashes(recoverPOST("content"));
	$tags    	 = isset($data) ? recoverPOST("tags", $data["Tags"]) 				: recoverPOST("tags");
	$language  	 = isset($data) ? recoverPOST("language", $data["Language"])  	 	: recoverPOST("language");
	$edit        = isset($data) ? TRUE 												: FALSE;
	$action	     = isset($data) ? "edit"											: "save";
	$href	     = path("blog/add/");
	$editor 	 = _get("defaultEditor") === "Redactor" ? 1 : 2;
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Add new post"), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 		=> "title", 
				"style" 	=> "width: 100%;", 
				"field" 	=> __("Title"), 
				"p" 		=> TRUE, 
				"autofocus" => "autofocus", 
				"value" 	=> stripslashes($title)
			));

			$options = array(
				array("value" => 1, "option" => "Redactor", "selected" => ($editor === 1 ? TRUE : FALSE)),
				array("value" => 2, "option" => "markItUp!", "selected" => ($editor === 2 ? TRUE : FALSE))
			);

			echo formSelect(array(
				"name" 		=> "editor", 
				"p" 		=> TRUE, 
				"field" 	=> __("Editor"), 
				"onchange" 	=> 'switchEditor($(this).val())'),
				$options
			);
			
			echo formTextarea(array(
				"name" 	 => "content", 
				"style"  => "height: 240px;", 
				"field"  => __("Content"), 
				"p" 	 => TRUE, 
				"value"  => stripslashes($content)
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"style" => "width: 300px;", 
				"field" => __("Tags"), 
				"p" 	=> TRUE, 
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
	echo div(FALSE);