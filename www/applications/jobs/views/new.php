<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID = isset($data) ? recoverPOST("ID", $data[0]["ID_Job"]) : 0;
	$title = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$company = isset($data) ? recoverPOST("company", $data[0]["Company"]) : recoverPOST("company");
	$country = isset($data) ? recoverPOST("country", $data[0]["Country"]) : recoverPOST("country");
	$city = isset($data) ? recoverPOST("city", $data[0]["City"]) : recoverPOST("city");
	$salary = isset($data) ? recoverPOST("salary", $data[0]["Salary"]) : recoverPOST("salary");
	$currency = isset($data) ? recoverPOST("salary_currency", $data[0]["Salary_Currency"]) : recoverPOST("salary_currency");	
	$allocation = isset($data) ? recoverPOST("allocation_time", $data[0]["Allocation_Time"]) : recoverPOST("allocation_time");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) : recoverPOST("description");
	$tags = isset($data) ? recoverPOST("tags", $data[0]["Tags"]) : recoverPOST("tags");
	$email = isset($data) ? recoverPOST("email", $data[0]["Email"]) : recoverPOST("email");
	$language = isset($data) ? recoverPOST("language", $data[0]["Language"]) : recoverPOST("language");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
	$edit = isset($data) ? true : false;
	$action = isset($data) ? "edit" : "save";
	$href = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add", null, "post", "multipart/form-data");
			echo p(__(ucfirst(whichApplication())), "resalt");
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name" => "title", 
				"class" => "span5 required", 
				"field" => __("Title"), 
				"p" => true, 
				"placeholder" => __("Type the title of the job offer"),
				"value" => $title 
			));

			echo formInput(array(
				"name" => "company", 
				"class" => "span5 required", 
				"field" => __("Company"), 
				"p" => true, 
				"placeholder" => __("Type the name of the company"),
				"value" => $company
			));

			$options = array();
			$i = 0;

			foreach ($countries as $value) { 
				$options[$i]["value"] = $value["Country"];
				$options[$i]["option"] = __($value["Country"]);
				$options[$i]["selected"] = ($value["Country"] === $country) ? true : false;
				$i++;
			}

			echo formSelect(array(
				"name" => "country",
				"class" => "span5 required",
				"p" => true,
				"field" => __("Country")), 
				$options
			);

			echo formInput(array(
				"name" => "city",
				"class" => "span5 required", 
				"field" => __("City"), 
				"p" => true, 
				"placeholder" => __("Enter the city where your company"),
				"value" => $city
			));

			echo formInput(array(
				"name" => "salary", 
				"class" => "span2 required", 
				"field" => __("Salary"),
				"placeholder" => "0.00", 
				"value" => $salary
			));

			$options = array(
				0 => array("value" => "USD", "option" => __("USD"), "selected" => ($currency === "USD") ? true : false),
				1 => array("value" => "MXN", "option" => __("MXN"), "selected" => ($currency === "MXN") ? true : false),
				2 => array("value" => "EUR", "option" => __("EUR"), "selected" => ($currency === "EUR") ? true : false)
			);

			echo formSelect(array(
				"id" => "salary_currency",
				"name" => "salary_currency", 
				"class" => "span1 required", 
				"field" => __("Currency")), 
				$options
			);

			$options = array(
				0 => array("value" => "Full Time", "option" => __("Full Time"), "selected" => ($allocation === "Full Time") ? true : false),
				1 => array("value" => "Half Time", "option" => __("Half Time"), "selected" => ($allocation === "Half Time") ? true : false),
				2 => array("value" => "Half Time", "option" => __("Contract"), "selected" => ($allocation === "Contract") ? true : false),
				3 => array("value" => "Half Time", "option" => __("Intership"), "selected" => ($allocation === "Intership") ? true : false),
				4 => array("value" => "Half Time", "option" => __("Temporal"), "selected" => ($allocation === "Temporal") ? true : false)
			);

			echo formSelect(array(
				"id" => "allocation",
				"name" => "allocation", 
				"p" => true, 
				"class" => "required", 
				"field" => __("Allocation Time")), 
				$options
			);

			echo formTextarea(array(
				"id" => "description",
				"name" => "description", 
				"class" => "required",
				"field" => __("Description"), 
				"p" => "true",
				"placeholder" => __("Enter the description of the job"),
				"value" => $description
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"class" => "span5 required", 
				"field" => __("Tags"), 
				"p" 	=> true,
				"placeholder" => _("Write the tags separated by commas"),
				"value" => $tags
			));

			echo formInput(array( 
				"name" => "email",
				"pattern" => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"type" => "email",
				"class" => "span5 required",
				"field" => __("Company Email"), 
				"p" => true, 
				"placeholder" => __("Enter your company email"),
				"value" => $email,
				"required" => true
			));

			echo formField(null, __("Language") ."<br />". getLanguagesInput($language, "language", "select"));

			$options = array(
				0 => array("value" => "Draft", "option" => __("Draft"), "selected" => ($situation === "Draft") ? true : false),
				1 => array("value" => "Active", "option" => __("Active"), "selected" => ($situation === "Active") ? true : false),
				2 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? true : false)
			);

			echo formSelect(array(
				"id" => "situation",
				"name" => "situation", 
				"p" => true, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);

			echo formAction($action);
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Job"));
		echo formClose();
	echo div(false);