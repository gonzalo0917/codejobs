<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) 			 : 0;
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])   		 : recoverPOST("title");		
	$tags      = isset($data) ? recoverPOST("tags", $data[0]["Tags"])   		 : recoverPOST("tags");
	$content   = isset($data) ? $data[0]["Content"] 	 						 : recoverPOST("content");	
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$pwd   	   = isset($data) ? recoverPOST("pwd", $data[0]["Pwd"])				 : recoverPOST("pwd");
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
	$editor    = _get("defaultEditor") === "Redactor" ? 1 : 2;
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => stripslashes($title)
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"class" => "span10 required", 
				"field" => __("Tags"), 
				"p" 	=> TRUE, 
				"value" => $tags
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
				"class"  => "markItUp", 
				"style"  => "height: 240px;", 
				"field"  => __("Content"), 
				"p" 	 => TRUE, 
				"value"  => $content
			));

			echo formField(NULL, __("Language of the post") ."<br />". getLanguagesInput($language, "language", "select"));

			$options = array(
				0 => array("value" => 1, "option" => __("Yes"), "selected" => TRUE),
				1 => array("value" => 0, "option" => __("No"))
			);

			echo formSelect(array(
				"name" 	=> "enable_comments", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Enable Comments")), 
				$options
			);				
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"), 	  "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"),  "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"p" 	=> TRUE, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);
						
			if(!isset($pwd)) { 
				echo formInput(array(
					"name" 	=> "pwd", 
					"class" => "span10", 
					"field" => __("Password"), 
					"p" 	=> TRUE, 
					"value" => $pwd)
				);	
			} else { 
				echo formField(NULL, __("Password") ."<br />");
				
				echo formInput(array(
					"id" 	=> "lock", 
					"class" => "lock", 
					"type" 	=> "button")
				);

							
				echo formInput(array(
					"id" 	=> "password", 
					"type" 	=> "hidden", 
					"value" => $pwd
				));
			}

			if(isset($medium)) {
				echo img(path($medium, TRUE));
			}
			
			echo formSave($action, TRUE, $ID);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		echo formClose();
	echo div(FALSE);
?>