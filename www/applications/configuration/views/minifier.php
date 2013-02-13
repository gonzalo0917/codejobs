<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$href = path(whichApplication() ."/cpanel/minifier");
	$type = isset($type) ? $type : recoverPOST("type");
	$code = isset($code) ? $code : recoverPOST("code");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Minifier"), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formSelect(array(
				"name" 	=> "type", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Filetype")), array(
					array(
						"value"    => "css",
						"option"   => __("Stylesheet"),
						"selected" => $type === "css" ? true : false
					),
					array(
						"value"    => "js",
						"option"   => "Javascript",
						"selected" => $type === "js" ? true : false
					),
					array(
						"value"    => "php",
						"option"   => "PHP",
						"selected" => $type === "php" ? true : false
					)
				)
			);
	
			echo formTextarea(array(
				"name" 	=> "code", 
				"class" => "required span10", 
				"field" => __("Code"), 
				"p" 	=> true,
				"rows"  => 15,
				"value" => stripslashes($code),
				"onfocus"   => "this.select()"
			));
			
			echo formInput(array(
				"name" 	=> "minify", 
				"class" => "btn",
				"p" 	=> false, 
				"value" => __("Minify"),
				"type"  => "submit")
			);

		echo formClose();
	echo div(false);