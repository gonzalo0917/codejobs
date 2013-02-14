<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$name  = isset($name) ? recoverPOST("name", $name) : recoverPOST("name");
$email = isset($email) ? recoverPOST("email", $email) : recoverPOST("email");
$pwd   = isset($pwd) ? recoverPOST("password", $pwd) : recoverPOST("password");

echo div("new-user", "class");
	echo formOpen(path("users/register"), "form", "form");
		echo p(__("Join today to") ." ". _get("webName"), "resalt");

		if (!isset($alert) and SESSION("UserRegistered") and !POST("register")) {
			redirect();
		} else {
			if (POST("register") and SESSION("UserRegistered")) {
				echo getAlert(__("You can't register many times a day"));
			} else { 
				echo isset($alert) ? $alert : null;
			}
		}

		if (!isset($inserted) or !$inserted) {
			if (!SESSION("UserRegistered")) {
				echo formInput(array(
					"id"       => "username",
					"name"     => "username",
					"pattern"  => "^[A-Za-z0-9_-]{3,15}$", 
					"class"    => "required", 
					"field"    => __("Username"), 
					"p"        => true, 
					"value"    => recoverPOST("username"),
					"required" => true
				));

				echo formInput(array(
					"name"     => "name", 
					"field"    => __("Name"), 
					"p"        => true, 
					"value"    => $name,
					"required" => true
				));

				echo formInput(array(
					"name"     => "password",
					"type"     => "password",
					"field"    => __("Password"), 
					"p"        => true, 
					"value"    => $pwd,
					"required" => true
				));

				echo formInput(array(
					"name"     => "email",
					"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
					"type"     => "email",
					"field"    => __("Email"), 
					"p"        => true, 
					"value"    => $email,
					"required" => true
				));
				
				echo formInput(array(
					"name"  => "register",
					"type"  => "submit",
					"class" => "submit",
					"value" => __("Create my account")
				));
			}
		}

	echo formClose();
echo div(false);