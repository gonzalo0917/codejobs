<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("About me"), "resalt");

			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name" 	=> "name", 
				"class" => "field-title field-full-size",
				"field" => __("Full name"), 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"autofocus" => "autofocus"
			));

			$options = array(
				array("value" => 'M', "option" => __("Male"), "selected" => TRUE),
				array("value" => 'F', "option" => __("Female"))
			);

			echo formSelect(array(
				"name" 		=> "gender", 
				"p" 		=> TRUE, 
				"field" 	=> __("Gender")),
				$options
			);

			echo formInput(array(
				"name" 	=> "birthday", 
				"class" => "field-title span3",
				"field" => __("Birthday"), 
				"p" 	=> TRUE, 
				"maxlength" => "10"
			));

			echo formInput(array(
				"name" 	=> "country", 
				"class" => "field-title span3",
				"field" => __("Country"), 
				"p" 	=> TRUE, 
				"maxlength" => "10"
			));

		echo formClose();
	echo div(FALSE);