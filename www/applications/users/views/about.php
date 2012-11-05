<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name" 	=> "name", 
				"class" => "field-title field-full-size",
				"field" => __("Full name") ."*", 
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
				"field" 	=> __("Gender") ."*"),
				$options
			);

			$months = array(__("January"), __("February"), __("March"), __("April"), __("May"), __("June"), __("July"), __("August"), __("September"), __("October"), __("November"), __("December"));

			echo formInput(array(
				"name" 	=> "birthday", 
				"class" => "field-title span3 jdpicker",
				"field" => __("Date of birth") ."*", 
				"p" 	=> TRUE,
				"value" => "01/01/1980",
				"type"  => "hidden",
				"maxlength" => "10",
				"data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
			));

			echo formSelect(array(
				"name" 		=> "country", 
				"p" 		=> TRUE, 
				"field" 	=> __("Country") ."*"),
				$countries
			);

			echo formInput(array(
				"name" 	=> "city", 
				"class" => "field-title span3",
				"field" => __("City") ."*", 
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
