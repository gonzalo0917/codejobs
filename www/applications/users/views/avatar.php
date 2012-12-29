<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$avatar = recoverPOST("avatar", encode($data[0]["Avatar"]));

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;
			
			echo p(TRUE, "");

				echo span("field", "&raquo; " . __("Choose an image"));

				echo formInput(array(
					"id" => "choose-avatar",
					"name" => "avatar",
					"type" => "file"
				));

				echo formInput(array(
					"name" => "delete",
					"type" => "button",
					"value" => "Delete image",
					"onclick" => "document.querySelector('#choose-avatar').click()"
				));

				echo p(TRUE, "avatar-container");

					echo image(path("www/lib/files/images/users/$avatar", TRUE), "avatar");

				echo p(FALSE);

			echo p(FALSE);

		echo formClose();
	echo div(FALSE);