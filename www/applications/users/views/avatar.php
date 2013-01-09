<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$avatar = recoverPOST("avatar", encode($data[0]["Avatar"]));

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
					"name" => "delete",
					"type" => "button",
					"class" => "btn btn-danger",
					"value" => __("Remove image")
				));
			echo div(FALSE);

			echo div("avatar", "class");
				echo div("avatar-container", "id/class", "avatar-image well");

					echo image(path("www/lib/files/images/users/$avatar", TRUE), "avatar", "avatar-image");

				echo div(FALSE);
			echo div(FALSE);

			echo div("avatar", "class");
				echo formInput(array(	
					"name" 	=> "save", 
					"class" => "btn btn-success", 
					"value" => __("Save"), 
					"type"  => "submit"
				));
			echo div(FALSE);
		echo formClose();
	echo div(FALSE);