<?php
	if (!defined("ACCESS")) die("Error: You don't have permission to access here...");

	$avatar     = encode($data[0]["Avatar"]);
	$coordinate = recoverPOST("coordinate", encode($data[0]["Avatar_Coordinate"]));

	if ($avatar !== "default.png") {
		$info = pathinfo($avatar);
		$avatar = sha1(SESSION("ZanUser") ."_O") .".". $info["extension"];
	}

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add", null, "post", "multipart/form-data");
			echo isset($alert) ? $alert : null;

			echo p(span("field", "&raquo; " . __("Select a image or use drag & drop")), "");

			echo div("filedrag", true, null, __("Drop image here"));

			echo div("avatar", "class");
				echo span(
					"btn",
					__("Browse") ."...". formInput(array("class" => "avatar-file", "name" => "avatar", "id" => "avatar", "type" => "file")),
					"filebrowser"
				);

				echo formInput(array(
					"name"  => "resume",
					"type"  => "button",
					"class" => "btn",
					"value" => __("Restore image")
				));
			echo div(false);

			echo div("avatar", "class");
				echo div("avatar-container", "id/class", "avatar-image well");

					echo image(path("www/lib/files/images/users/$avatar?". time(), true), "avatar", "avatar-image");

				echo div(false);
			echo div(false);

			echo formInput(array(
				"id"    => "coordinate",
				"name"  => "coordinate",
				"type"  => "hidden",
				"value" => $coordinate
			));

			echo formInput(array(
				"id"    => "file",
				"name"  => "file",
				"type"  => "hidden",
				"value" => ""
			));

			echo formInput(array(
				"id"    => "resized",
				"name"  => "resized",
				"type"  => "hidden",
				"value" => ""
			));

			echo formInput(array(
				"id"    => "name",
				"name"  => "name",
				"type"  => "hidden",
				"value" => ""
			));

			echo formInput(array(
				"id"    => "type",
				"name"  => "type",
				"type"  => "hidden",
				"value" => ""
			));

			echo formInput(array(
				"id"    => "size",
				"name"  => "size",
				"type"  => "hidden",
				"value" => ""
			));

			echo formInput(array(
				"name"  => "MAX_FILE_SIZE",
				"type"  => "hidden",
				"value" => "1048576"
			));

			echo formInput(array(
				"id"    => "small-error",
				"type"  => "hidden",
				"value" => __("The file size must be greater than or equal to 1KB")
			));

			echo formInput(array(
				"id"    => "big-error",
				"type"  => "hidden",
				"value" => __("The file size must be less than or equal to 5MB")
			));

			echo formInput(array(
				"id"    => "type-error",
				"type"  => "hidden",
				"value" => __("Image type not supported")
			));

			echo formInput(array(
				"id"    => "delete-message",
				"type"  => "hidden",
				"value" => __("Are you sure you want to delete the current avatar image?")
			));

			echo div("avatar", "class");
				echo formInput(array(
					"name"  => "save", 
					"class" => "btn btn-success", 
					"value" => __("Save"), 
					"type"  => "submit"
				));

				echo formInput(array(
					"name"  => "delete",
					"type"  => "submit",
					"class" => "btn btn-danger",
					"value" => __("Delete")
				));
			echo div(false);
		echo formClose();
	echo div(false);