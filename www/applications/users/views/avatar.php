<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$avatar 	= recoverPOST("avatar", encode($data[0]["Avatar"]));
	$coordinate = recoverPOST("coordinate", encode($data[0]["Avatar_Coordinate"]));

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;
			
			echo p(span("field", "&raquo; " . __("Choose an image")), "");

			echo formInput(array(
				"class" => "avatar-file",
				"name"  => "avatar",
				"type"  => "file"
			));


			echo div("avatar", "class");
				echo formInput(array(
					"name" => "browse",
					"type" => "button",
					"class" => "btn",
					"value" => __("Browse") ."..."
				));

				echo formInput(array(
					"name" => "resume",
					"type" => "button",
					"class" => "btn",
					"value" => __("Restore image")
				));
			echo div(FALSE);

			echo div("avatar", "class");
				echo div("avatar-container", "id/class", "avatar-image well");

					echo image(path("www/lib/files/images/users/$avatar", TRUE), "avatar", "avatar-image");

				echo div(FALSE);
			echo div(FALSE);

			echo formInput(array(
				"id"	=> "coordinate",
				"name"  => "coordinate",
				"type"  => "hidden",
				"value" => $coordinate
			));

			echo formInput(array(
				"id" 	=> "small-error",
				"type" 	=> "hidden",
				"value" => __("The file size must be greater than or equal to 1KB")
			));

			echo formInput(array(
				"id" 	=> "big-error",
				"type" 	=> "hidden",
				"value" => __("The file size must be less than or equal to 5MB")
			));

			echo formInput(array(
				"id" 	=> "type-error",
				"type" 	=> "hidden",
				"value" => __("Image type not supported")
			));

			echo formInput(array(
				"id" 	=> "delete-message",
				"type" 	=> "hidden",
				"value" => __("Are you sure you want to delete the current avatar image?")
			));

			echo div("avatar", "class");
				echo formInput(array(	
					"name" 	=> "save", 
					"class" => "btn btn-success", 
					"value" => __("Save"), 
					"type"  => "submit"
				));

				echo formInput(array(
					"name" => "delete",
					"type" => "submit",
					"class" => "btn btn-danger",
					"value" => __("Delete")
				));
			echo div(FALSE);
		echo formClose();
	echo div(FALSE);