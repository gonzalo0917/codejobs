<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$href = path(whichApplication() ."/cpanel/minifier");
	$type = isset($type) ? $type : recoverPOST("type");
	$code = isset($code) ? $code : recoverPOST("code");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Minifier"), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formSelect(array(
				"name" 	=> "type", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Filetype")), array(
					array(
						"value"    => "css",
						"option"   => __("Stylesheet"),
						"selected" => $type === "css" ? TRUE : FALSE
					),
					array(
						"value"    => "js",
						"option"   => "Javascript",
						"selected" => $type === "js" ? TRUE : FALSE
					),
					array(
						"value"    => "php",
						"option"   => "PHP",
						"selected" => $type === "php" ? TRUE : FALSE
					)
				)
			);
	
			echo formTextarea(array(
				"name" 	=> "code", 
				"class" => "required span10", 
				"field" => __("Code"), 
				"p" 	=> TRUE,
				"rows"  => 15,
				"value" => stripslashes($code),
				"onfocus"   => "this.select()"
			));
			
			echo formInput(array(
				"name" 	=> "minify", 
				"class" => "btn",
				"p" 	=> FALSE, 
				"value" => __("Minify"),
				"type"  => "submit")
			);

		echo formClose();
	echo div(FALSE);