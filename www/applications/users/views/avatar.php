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


			echo p(TRUE, "avatar-container");
				echo formInput(array(
					"name" => "browse",
					"type" => "button",
					"value" => __("Browse") ."..."
				));

				echo formInput(array(
					"name" => "delete",
					"type" => "button",
					"value" => __("Remove image")
				));

				echo image(path("www/lib/files/images/users/$avatar", TRUE), "avatar", FALSE, array("p" => TRUE));

			echo p(FALSE);

		echo formClose();
	echo div(FALSE);