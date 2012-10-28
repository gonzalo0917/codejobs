<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Edit profile"), "resalt");

			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
                "name" 	=> "name", 
                "class" => "field-title field-full-size",
                "field" => __("Full name"), 
                "p" 	=> TRUE, 
                "value" => "",
                "maxlength" => "150",
                "autofocus" => "autofocus"
			));

			echo formInput(array(	
                "name" 	=> "email", 
                "class" => "field-title span4",
                "field" => __("Email"), 
                "p" 	=> TRUE, 
                "value" => "",
                "maxlength" => "45"
			));

			echo formInput(array(	
                "name" 	=> "website", 
                "class" => "field-title field-full-size",
                "field" => __("Website"), 
                "p" 	=> TRUE, 
                "value" => "http://",
                "maxlength" => "100"
			));
		echo formClose();
	echo div(FALSE);
?>