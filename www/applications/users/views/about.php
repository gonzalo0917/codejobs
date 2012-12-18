<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$name        = recoverPOST("name", encode($data[0]["Name"]));
	$gender      = recoverPOST("gender", $data[0]["Gender"]);
	$birthday    = recoverPOST("birthday", $data[0]["Birthday"] !== "" ? $data[0]["Birthday"] : "01/01/1980");
	$country     = recoverPOST("country", encode($data[0]["Country"]));
	$city        = recoverPOST("city", encode($data[0]["City"]));
	$district    = recoverPOST("district", encode($data[0]["District"]));
	$phone       = recoverPOST("phone", $data[0]["Phone"]);
	$mobile      = recoverPOST("mobile", $data[0]["Mobile"]);
	$website     = recoverPOST("website", $data[0]["Website"] !== "" ? $data[0]["Website"] : "http://");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name" 	=> "name", 
				"class" => "field-title field-full-size",
				"field" => __("Full name") ."*", 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"value" => $name
			));

			$options = array(
				array("value" => 'M', "option" => __("Male"), "selected" => $gender === 'M' ? TRUE : FALSE),
				array("value" => 'F', "option" => __("Female"), "selected" => $gender === 'F' ? TRUE : FALSE)
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
				"value" => $birthday,
				"type"  => "hidden",
				"maxlength" => "10",
				"data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
			));

			array_unshift($countries, array("option" => "[". __("Select one") ."...]", "value" => ""));

			$country_selected = array_search(array("option" => $country, "value" => $country), $countries);

			if ($country_selected !== FALSE) {
				$countries[$country_selected]["selected"] = TRUE;
			}

			echo formSelect(array(
				"name" 		=> "country", 
				"p" 		=> TRUE, 
				"field" 	=> __("Country") ."*"),
				$countries
			);

			if(isset($cities)) {
				$city_index = array_search(array("option" => $city, "value" => $city), $cities);

				if($city_index !== FALSE) {
					$cities[$city_index]["selected"] = TRUE;
				}
			}

			echo formSelect(array(
				"name" 		=> "city", 
				"p" 		=> TRUE, 
				"field" 	=> __("City") ."*",
				"disabled"  => !isset($cities)
				), isset($cities) ? $cities : array()
			);

			echo formInput(array(
				"name" 	=> "district", 
				"class" => "field-title span3",
				"field" => __("District"), 
				"p" 	=> TRUE, 
				"maxlength" => "100",
				"value" => $district
			));

			echo formInput(array(
				"name" 	=> "phone", 
				"class" => "field-title span3",
				"field" => __("Phone"), 
				"p" 	=> TRUE, 
				"maxlength" => "15",
				"value" => $phone
			));

			echo formInput(array(
				"name" 	=> "mobile", 
				"class" => "field-title span3",
				"field" => __("Mobile phone"), 
				"p" 	=> TRUE, 
				"maxlength" => "15",
				"value" => $mobile
			));

			echo formInput(array(
				"name" 	=> "website", 
				"class" => "field-title field-full-size",
				"field" => __("Website"),
				"value" => $website, 
				"p" 	=> TRUE,
				"maxlength" => "100"
			));

			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

		echo formClose();
	echo div(FALSE);
