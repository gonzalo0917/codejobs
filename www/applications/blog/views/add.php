<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) 			 : 0;
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])   		 : recoverPOST("title");		
	$tags      = isset($data) ? recoverPOST("tags", $data[0]["Tags"])   		 : recoverPOST("tags");
	$content   = isset($data) ? recoverPOST("content", $data[0]["Content"])		 : recoverPOST("content");	
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$author    = isset($data) ? recoverPOST("author", $data[0]["Author"])        : SESSION("ZanUser");
	$userID    = isset($data) ? recoverPOST("ID_User", $data[0]["ID_User"])      : SESSION("ZanUserID");
	$buffer    = isset($data) ? (int)recoverPOST("buffer", $data[0]["Buffer"])	 : 1;
	$code      = isset($data) ? recoverPOST("code", $data[0]["Code"])		 	 : recoverPOST("code");
	$mural     = isset($data) ? $data[0]["Image_Mural"]                          : NULL;
	$image 	   = isset($data) ? $data[0]["Image_Medium"]						 : NULL;
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
	$enable_comments = isset($data) ? (int)recoverPOST("enable_comments", $data[0]["Enable_Comments"]) : 1;

	$editor    = _get("defaultEditor") === "Redactor" ? 1 : 2;
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add", NULL, "post", "multipart/form-data");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"id"    => "title",
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => stripslashes($title)
			));

			echo formInput(array(	
				"id"    => "tags",
				"name" 	=> "tags", 
				"class" => "span10 required", 
				"field" => __("Tags"), 
				"p" 	=> TRUE, 
				"value" => $tags
			));

			echo formInput(array(	
				"name" 	=> "mural", 
				"type"  => "file",
				"class" => "add-img", 
				"field" => __("Mural"), 	
				"p" 	=> TRUE
			));

			if($action === "edit" and $mural != "") { 
				echo p(img(path($mural, TRUE), array("style" => "max-width:700px;", "class" => "mural")));
				echo formInput(array(	
					"name" 	=> "delete_mural", 
					"type"  => "checkbox",
					"p" 	=> FALSE
				)) . " " . __("Delete Mural")  . "<br /><br />";
			} 

			$options = array(
				array("value" => 1, "option" => "Redactor", "selected" => ($editor === 1 ? TRUE : FALSE)),
				array("value" => 2, "option" => "markItUp!", "selected" => ($editor === 2 ? TRUE : FALSE))
			);

			echo formSelect(array(
				"id"		=> "editor",
				"name" 		=> "editor", 
				"p" 		=> TRUE, 
				"field" 	=> __("Editor"), 
				"onchange" 	=> 'switchEditor($(this).val())'),
				$options
			);

			echo formTextarea(array(	 
				"id"     => "redactor",
				"name" 	 => "content", 
				"class"  => "markItUp", 
				"style"  => "height: 240px;", 
				"field"  => __("Content"), 
				"p" 	 => TRUE, 
				"value"  => stripslashes($content)
			));

			echo '<p><span id="show-multimedia" class="field pointer">&raquo; Multimedia</span></p>';

			echo getFilesFromMultimedia($multimedia);

			echo formInput(array(	
				"name" 	=> "image", 
				"type"  => "file",
				"class" => "add-img", 
				"field" => __("Post Image"), 	
				"p" 	=> TRUE
			));

			if($action === "edit" and $image != "") { 
				echo p(img(path($image, TRUE)));
				echo formInput(array(	
					"name" 	=> "delete_image", 
					"type"  => "checkbox",
					"p" 	=> FALSE
				)) . " " . __("Delete Image")  . "<br /><br />";
			}

			echo formInput(array(	
				"id"    => "author",
				"name" 	=> "author", 
				"class" => "span2 required", 
				"field" => __("Author"), 
				"p" 	=> TRUE, 
				"value" => stripslashes($author)
			));

			echo formField(NULL, __("Language of the post") ."<br />". getLanguagesInput($language, "language", "select"));

			$options = array(
				0 => array("value" => 1, "option" => __("Yes"), "selected" => ($enable_comments === 1) ? TRUE : FALSE),
				1 => array("value" => 0, "option" => __("No"),  "selected" => ($enable_comments === 0) ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "enable_comments", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Enable Comments")), 
				$options
			);		

			$options = array(
				0 => array("value" => 1, "option" => __("Active"), 	  "selected" => ($buffer === 1) ? TRUE : FALSE),
				1 => array("value" => 0, "option" => __("Inactive"),  "selected" => ($buffer === 0) ? TRUE : FALSE)
			);

			echo formSelect(array(
				"id"    => "buffer",
				"name" 	=> "buffer", 
				"p" 	=> TRUE, 
				"class" => "required", 
				"field" => __("Buffer")), 
				$options
			);
			
			$options = array(
				0 => array("value" => "Draft",   "option" => __("Draft"),     "selected" => ($situation === "Draft")    ? TRUE : FALSE),
				1 => array("value" => "Active",   "option" => __("Active"),   "selected" => ($situation === "Active")   ? TRUE : FALSE),
				2 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"id"    => "situation",
				"name" 	=> "situation", 
				"p" 	=> TRUE, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);			

			if(isset($medium)) {
				echo img(path($medium, TRUE));
			}
			
			echo formSave($action, TRUE, $ID);
			
			echo formInput(array("id" => "ID_Post", 	 "name" => "ID", 			"type" => "hidden", "value" => $ID));
			echo formInput(array("id" => "ID_User", 	 "name" => "ID_User",		"type" => "hidden", "value" => $userID));
			echo formInput(array("id" => "code", 		 "name" => "code", 			"type" => "hidden", "value" => code(10)));
			echo formInput(array("id" => "temp_title", 	 "name" => "temp_title", 	"type" => "hidden", "value" => addslashes($title)));
			echo formInput(array("id" => "temp_tags", 	 "name" => "temp_tags", 	"type" => "hidden", "value" => $tags));
			echo formInput(array("id" => "temp_content", "name" => "temp_content",  "type" => "hidden", "value" => $content));

		echo formClose();
	echo div(FALSE);
?>