<?php
	if (!defined("ACCESS")) die("Error: You don't have permission to access here...");

	$sign  = isset($data) ? recoverPOST("sign", encode($data[0]["Sign"])) : "";

	echo div("container", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : null;

			echo formTextarea(array(
				"id" 		=> "editor",
				"name"      => "sign", 
				"class" 	=> "ckeditor", 
				"field"     => __("Sign for forum"), 
				"p"         => true,
				"value"     => $sign
			));

			echo formInput(array(
				"name"  => "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

			echo formInput(array(
				"name"  => "delete", 
				"class" => "btn btn-danger", 
				"value" => __("Remove"), 
				"type"  => "submit"
			));

			echo a(__("Restore sign"), path("users/options"), false, array(
				"class" => "btn",
				"style" => "text-decoration:none"
			));

		echo formClose();
	echo div(false);

	echo $ckeditor;