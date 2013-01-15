<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

$name  = isset($name)  ? recoverPOST("name", $name)    : recoverPOST("name");	
$email = isset($email) ? recoverPOST("email", $email)  : recoverPOST("email");				

echo div("new-user", "class");
	echo formOpen(path("users/login"), "form", "form");
		echo p(__("Do you Have an account?, Login!"), "resalt");
		
		if(!isset($inserted) or !$inserted) {
			if(!SESSION("UserRegistered")) {
				echo formInput(array(
					"id"	   => "username",
					"name" 	   => "username",
					"pattern"  => "^[A-Za-z0-9_-]{3,15}$", 
					"class"    => "required", 
					"field"    => __("Username"), 
					"p" 	   => TRUE, 
					"value"    => recoverPOST("username"),
					"required" => TRUE
				));

				echo formInput(array(	
					"name" 	   => "password",
					"type"     => "password",
					"field"    => __("Password"), 
					"p" 	   => TRUE, 
					"value"    => $pwd,
					"required" => TRUE
				));

				echo formInput(array(	
					"name" 	=> "login",
					"type"  => "submit",
					"class" => "submit",
					"value" => __("Login")
				));
			}
		}

	echo formClose();
echo div(FALSE);