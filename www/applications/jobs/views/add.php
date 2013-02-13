<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID = isset($data) ? recoverPOST("ID", $data[0]["ID_Job"]) : 0;
	$title = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$email = isset($data) ? recoverPOST("email", $data[0]["Email"]) : recoverPOST("email");
	$address1 = isset($data) ? recoverPOST("address1", $data[0]["Address1"]) : recoverPOST("address1");
	$address2 = isset($data) ? recoverPOST("address2", $data[0]["Address2"]) : recoverPOST("address2");
	$logo = isset($data) ? recoverPOST("logo", $data[0]["Logo"]) : recoverPOST("logo");
	$phone = isset($data) ? recoverPOST("phone", $data[0]["Phone"]) : recoverPOST("phone");
	$company = isset($data) ? recoverPOST("company", $data[0]["Company"]) : recoverPOST("company");
	$cinformation = isset($data) ? recoverPOST("cinformation", $data[0]["Company_Information"]) : recoverPOST("cinformation");
	$country = isset($data) ? recoverPOST("country", $data[0]["Country"]) : recoverPOST("country");
	$city = isset($data) ? recoverPOST("city", $data[0]["City"]) : recoverPOST("city");
	$salary = isset($data) ? recoverPOST("salary", $data[0]["Salary"]) : recoverPOST("salary");
	$currency = isset($data) ? recoverPOST("salary_currency", $data[0]["Salary_Currency"]) : recoverPOST("salary_currency");	
	$allocation = isset($data) ? recoverPOST("allocation_time", $data[0]["Allocation_Time"]) : recoverPOST("allocation_time");
	$requirements = isset($data) ? recoverPOST("requirements", $data[0]["Requirements"]) : recoverPOST("requirements");
	$technologies = isset($data) ? recoverPOST("technologies", $data[0]["Technologies"]) : recoverPOST("technologies");
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

			echo formInput(array( 
				"name" => "address1",
				"class" => "span5 required",
				"field" => __("Company Address"), 
				"p" => true, 
				"placeholder" => __("Company Address"),
				"value" => $address1,
			));

			echo formInput(array( 
				"name" => "address2",
				"class" => "span5",
				"placeholder" => __("Company Address (Optional)"),
				"value" => $address2,
			));

			if (isset($logo)) {
				$image = img(path($logo, true), array("alt" => "Logo", "class" => "no-border", "style" => "max-width: 200px;"));
				echo __("If you change the logo image, this image will be deleted") . "<br />";
				echo $image;
				echo formInput(array("name" => "logo", "type" => "hidden", "value" => $logo));
			} 

			echo formInput(array(
				"type" => "file", 
				"name" => "image", 
				"class" => "required", 
				"field" => __("Image"),
				"p" => true
			));

			echo formInput(array( 
				"name" => "phone",
				"class" => "span5 required",
				"field" => __("Company Phone"), 
				"p" => true,
				"placeholder" => __("Enter your company phone"), 
				"value" => $phone,
			));

			echo formInput(array(
				"name" => "company",
				"class" => "span5 required", 
				"field" => __("Company"), 
				"p" => true, 
				"placeholder" => __("Enter your company name"),
				"value" => $company
			));

			echo formTextarea(array(
				"id" => "redactor",
				"name" => "cinformation", 
				"class" => "markItUp", 
				"style" => "height: 240px;", 
				"field" => __("Company Information"), 
				"p" => true, 
				"placeholder" => __("Enter the details of your company"),
				"value" => stripslashes($cinformation)
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
				1 => array("value" => "Half Time", "option" => __("Half Time"), "selected" => ($allocation === "Half Time") ? true : false)
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
				"name" => "requirements", 
				"class" => "markItUp",
				"style" => "height: 240px;",
				"field" => __("Requirements"), 
				"p" => true, 
				"placeholder" => __("Enter the necessary requirements to apply for the job"),
				"value" => $requirements
			));

			echo formInput(array(
				"name" => "technologies", 
				"class" => "span5 required", 
				"field" => __("Technologies"), 
				"p" => true, 
				"placeholder" => __("Enter the technologies separated by commas"),
				"value" => $technologies
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

			echo formSave($action);

			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Job"));
		echo formClose();
	echo div(false);