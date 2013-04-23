<?php
	if (!defined("ACCESS")) die("Error: You don't have permission to access here...");

	$name     	= recoverPOST("name", $data[1]["Name"]);
	$gender   	= recoverPOST("gender", $data[1]["Gender"]);
	$birthday 	= recoverPOST("birthday", $data[1]["Birthday"] !== "" ? $data[1]["Birthday"] : "01/01/1980");
	$country  	= recoverPOST("country", $data[1]["Country"]);
	$state     	= recoverPOST("city", $data[1]["City"]);
	$city 		= recoverPOST("district", $data[1]["District"]);
	$phone    	= recoverPOST("phone", $data[1]["Phone"]);
	$mobile     = recoverPOST("mobile", $data[1]["Mobile"]);
	$email      = recoverPOST("email", encode($data[1]["Email"]));
	$subscribed = (boolean) recoverPOST("subscribed", encode($data[1]["Subscribed"]));
	$website  	= recoverPOST("website", $data[1]["Website"] !== "" ? $data[1]["Website"] : "http://");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");

			echo formInput(array(
				"name"      => "name", 
				"class"     => "field-title field-full-size",
				"field"     => __("Full name") ."*", 
				"p"         => true,
				"maxlength" => "150",
				"value"     => $name
			));

			$options = array(
				array("value" => 'M', "option" => __("Male"), "selected"   => $gender === 'M' ? true : false),
				array("value" => 'F', "option" => __("Female"), "selected" => $gender === 'F' ? true : false)
			);

			echo formSelect(array(
				"name"  => "gender", 
				"class" => "span3 field-title",
				"p"     => true, 
				"field" => __("Gender") ."*"),
				$options
			);

			$months = array(__("January"), __("February"), __("March"), __("April"), __("May"), __("June"), __("July"), __("August"), __("September"), __("October"), __("November"), __("December"));

			echo formInput(array(
				"name"         => "birthday", 
				"class"        => "field-title span3 jdpicker",
				"field"        => __("Date of birth") ."*", 
				"p"            => true,
				"value"        => $birthday,
				"type"         => "hidden",
				"maxlength"    => "10",
				"data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
			));

			array_unshift($countries, array("option" => "[". __("Select one") ."...]", "value" => ""));

			$country_selected = array_search(array("option" => $country, "value" => $country), $countries);

			if ($country_selected !== false) {
				$countries[$country_selected]["selected"] = true;
			}

			echo formSelect(array(
				"name"   => "country", 
				"class" => "field-title span3",
				"p"      => true, 
				"field"  => __("Country") ."*"),
				$countries
			);

			if (isset($states)) {
				$state_index = array_search(array("option" => $state, "value" => $state), $states);

				if ($state_index !== false) {
					$states[$state_index]["selected"] = true;
				}
			}

			echo formSelect(array(
				"name"     => "state", 
				"class"    => "field-title span3",
				"p"        => true, 
				"field"    => __("State") ."*"
				), isset($states) ? $states : array()
			);

			echo formInput(array(
				"name"      => "city", 
				"class"     => "field-title span3",
				"field"     => __("City"), 
				"p"         => true, 
				"maxlength" => "100",
				"value"     => $city
			));

			echo formInput(array(
				"name"      => "phone", 
				"class"     => "field-title span3",
				"field"     => __("Phone"), 
				"p"         => true, 
				"maxlength" => "15",
				"value"     => $phone
			));

			echo formInput(array(
				"name"      => "mobile", 
				"class"     => "field-title span3",
				"field"     => __("Mobile phone"), 
				"p"         => true, 
				"maxlength" => "15",
				"value"     => $mobile
			));

			echo formInput(array(
				"name"      => "email", 
				"class"     => "field-title span3",
				"field"     => __("E-mail"), 
				"p"         => true,
				"maxlength" => "45",
				"pattern"   => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"value"     => $email
			));

			echo '<label>';

			echo formCheckbox(array(
				"name"     => "subscribed",
				"position" => "right",
				"text"     => __("Subscribed to our free email newsletters"),
				"checked"  => $subscribed === true
			));

			echo '</label>';

			echo formInput(array(
				"name"      => "website", 
				"class"     => "field-title field-full-size span3",
				"field"     => __("Website"),
				"value"     => $website, 
				"p"         => true,
				"maxlength" => "100"
			));

			echo formInput(array(
				"name"  => "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

		echo formClose();
	echo div(false);
?>