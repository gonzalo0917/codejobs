<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}

	$ID = isset($data) ? recoverPOST("ID", $data[0]["ID_Work"]) : 0;
	$title = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) : recoverPOST("description");
	$URL = isset($data) ? recoverPOST("URL", $data[0]["URL"]) : recoverPOST("URL");
	$image = isset($data) ? recoverPOST("image", $data[0]["Image"]) : recoverPOST("image");
	$preview1 = isset($data) ? recoverPOST("preview1", $data[0]["Preview1"]) : recoverPOST("preview1");
	$preview2 = isset($data) ? recoverPOST("preview2", $data[0]["Preview2"]) : recoverPOST("preview2");
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
				"placeholder" => __("Type the title of the work"),
				"value" => $title 
			));

			echo formInput(array(
				"name" => "URL", 
				"class" => "span5 required", 
				"field" => __("URL"), 
				"p" => true, 
				"placeholder" => __("Type the URL of the website"),
				"value" => $title 
			));

			echo formTextarea(array(
				"id" => "redactor",
				"name" => "description", 
				"class" => "markItUp", 
				"style" => "height: 240px;", 
				"field" => __("Description"), 
				"p" => true, 
				"placeholder" => __("Enter the details of the work"),
				"value" => stripslashes($description)
			));

			if (isset($image)) {
				$imageLast = $image;
				$image = img(path($image, true), array("alt" => "Image", "class" => "no-border", "style" => "max-width: 200px;"));

				echo __("If you change the image, this image will be deleted") . "<br />";
				echo $image;
				echo formInput(array("name" => "image_last", "type" => "hidden", "value" => $imageLast));
			}

			echo formInput(array(
				"type" => "file",
				"name" => "image",
				"field" => __("Image"),
				"p" => true
			));

			if (isset($preview1)) {
				$preview1Last = $preview1;
				$preview1 = img(path($preview1, true), array("alt" => "Preview1", "class" => "no-border", "style" => "max-width: 200px;"));

				echo __("If you change the image, this image will be deleted") . "<br />";
				echo $preview1;
				echo formInput(array("name" => "preview1_last", "type" => "hidden", "value" => $preview1Last));
			}

			echo formInput(array(
				"type" => "file", 
				"name" => "preview1",
				"field" => __("Preview1"),
				"p" => true
			));

			if (isset($preview2)) {
				$preview2Last = $preview2;
				$preview2 = img(path($preview2, true), array("alt" => "Preview2", "class" => "no-border", "style" => "max-width: 200px;"));

				echo __("If you change the image, this image will be deleted") . "<br />";
				echo $preview2;
				echo formInput(array("name" => "preview2_last", "type" => "hidden", "value" => $preview2Last));
			}

			echo formInput(array(
				"type" => "file", 
				"name" => "preview2", 
				"field" => __("Preview2"),
				"p" => true
			));

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