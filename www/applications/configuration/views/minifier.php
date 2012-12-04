<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$href = path(whichApplication() ."/cpanel/minifier");

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
						"selected" => TRUE
					),
					array(
						"value"    => "js",
						"option"   => "Javascript"
					)
				)
			);
	
			echo formTextarea(array(
				"name" 	=> "code", 
				"class" => "required span10", 
				"field" => __("Code"), 
				"p" 	=> TRUE,
				"rows"  => 15
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