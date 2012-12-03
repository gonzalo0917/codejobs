<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$href = path(whichApplication() ."/cpanel/minifier");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Minifier"), "resalt");
			
			echo isset($alert) ? $alert : NULL;
	
			echo formTextarea(array(
				"class" => "required span10", 
				"field" => __("Result"), 
				"p" 	=> TRUE,
				"rows"  => 15,
				"value" => $result
			));
			
			echo a(__("Go back"), $href, FALSE, array("class" => "btn"));

		echo formClose();
	echo div(FALSE);