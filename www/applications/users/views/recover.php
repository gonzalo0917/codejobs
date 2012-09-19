<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

echo div("new-user", "class");
	echo formOpen(path("users/recover"), "form", "form");
		echo p(__("Recover your password"), "resalt left");
		
		echo isset($alert) ? $alert : NULL;

		if(isset($tokenID)) {
			echo p(__("Enter your new password twice to change"));
				
			echo formInput(array(	
				"name" 	   => "password1",
				"pattern"  => "^.*(?=.{6,})(?=.*[a-zA-Z])[a-zA-Z0-9]+$", 
				"type"     => "password",
				"field"    => __("Password"), 
				"p" 	   => TRUE, 
				"required" => TRUE
			));

			echo formInput(array(	
				"name" 	   => "password2",
				"pattern"  => "^.*(?=.{6,})(?=.*[a-zA-Z])[a-zA-Z0-9]+$", 
				"type"     => "password",
				"field"    => __("Confirm your Password"), 
				"p" 	   => TRUE, 
				"required" => TRUE
			));

			echo formInput(array(	
				"name" 	=> "change",
				"type"  => "submit",
				"class" => "submit",
				"value" => __("Change my password")
			));

			echo formInput(array(	
				"name"  => "tokenID",
				"type"  => "hidden",
				"value"	=> $tokenID
			));
		} else {
			if(!isset($inserted)) {
				echo p(__("To recover your password, please enter your username or your e-mail"));
				
				echo formInput(array(
					"id"	   => "username",
					"name" 	   => "username",
					"pattern"  => "^[a-z0-9_-]{3,15}$", 
					"field"    => __("Username"), 
					"p" 	   => TRUE, 
					"value"    => recoverPOST("username")
				));			
		
				echo formInput(array(	
					"name" 	   => "email",
					"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
					"type"     => "email",
					"field"    => "E-mail", 
					"p" 	   => TRUE, 
					"value"    => recoverPOST("email")
				));

				echo formInput(array(	
					"name" 	=> "recover",
					"type"  => "submit",
					"class" => "submit",
					"value" => __("Recover my password")
				));
			}
		}

	echo formClose();
echo div(FALSE);