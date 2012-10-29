<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
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
				"field" => __("Date of birth"), 
				"p" 	=> TRUE, 
				"maxlength" => "10"
			));

			echo formInput(array(
				"name" 	=> "country", 
				"class" => "field-title span3",
				"field" => __("Country"), 
				"p" 	=> TRUE, 
				"maxlength" => "100"
			));

			echo formInput(array(
				"name" 	=> "city", 
				"class" => "field-title span3",
				"field" => __("City"), 
				"p" 	=> TRUE, 
				"maxlength" => "100"
			));

			echo formInput(array(
				"name" 	=> "district", 
				"class" => "field-title span3",
				"field" => __("District"), 
				"p" 	=> TRUE, 
				"maxlength" => "100"
			));

			echo formInput(array(
				"name" 	=> "phone", 
				"class" => "field-title span3",
				"field" => __("Phone"), 
				"p" 	=> TRUE, 
				"maxlength" => "15"
			));

			echo formInput(array(
				"name" 	=> "mobile", 
				"class" => "field-title span3",
				"field" => __("Mobile phone"), 
				"p" 	=> TRUE, 
				"maxlength" => "15"
			));

			echo formInput(array(
				"name" 	=> "website", 
				"class" => "field-title field-full-size",
				"field" => __("Website"),
				"value" => "http://", 
				"p" 	=> TRUE,
				"maxlength" => "100"
			));

		echo formClose();
	echo div(FALSE);