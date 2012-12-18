<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"type"  => "hidden",
				"name" 	=> "username",
				"p" 	=> FALSE,
				"value" => SESSION("ZanUser")
			));

			echo formInput(array(
				"type"  => "password",
				"name" 	=> "password", 
				"class" => "field-title span4",
				"field" => __("Password"), 
				"p" 	=> TRUE,
				"maxlength" => "50"
			));

			echo formInput(array(
				"type"  => "password",
				"name" 	=> "new_password", 
				"class" => "field-title span4",
				"field" => __("New password"), 
				"p" 	=> TRUE,
				"maxlength" => "50"
			));

			echo formInput(array(
				"type"  => "password",
				"name" 	=> "re_new_password", 
				"class" => "field-title span4",
				"field" => __("Confirm new password"), 
				"p" 	=> TRUE,
				"maxlength" => "50"
			));

			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

		echo formClose();
	echo div(FALSE);
