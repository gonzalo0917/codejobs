<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$name = isset($name) ? recoverPOST("name", $name) : recoverPOST("name");
$email = isset($email) ? recoverPOST("email", $email) : recoverPOST("email");


echo div("login-form", "class");
	echo a(img(path("$this->themeRoute/images/logo.png", true), array(
		"id" => "logo",
		"align" => "center",
		"alt" => "CodeJobs",
		"class" => "noborder"
	)), path());

	if (isset($alert)) {
		echo $alert;
	}

	echo formOpen(getURL(), "form", "form");
		
		if (!isset($inserted) or !$inserted) {
			if (!SESSION("UserRegistered")) {
				echo formInput(array(
					"id" => "username",
					"name" => "username",
					"maxlength" => "30", 
					"field" => __("Username"), 
					"p" => true, 
					"value" => recoverPOST("username")
				));

				echo formInput(array(
					"id" => "password",
					"name" => "password",
					"maxlength" => "30",
					"type" => "password",
					"field" => __("Password"), 
					"p" => true
				));

				echo a(
					__("Forgot your password?"),
					path("users/recover"),
					false,
					array("class" => "forgot")
				);

				echo formInput(array(
					"name" => "login",
					"type" => "submit",
					"class" => "btn btn-success",
					"value" => __("Log in")
				));

				echo a(
					__("Sign up"),
					path("users/register"),
					false,
					array("class" => "btn")
				);
			}
		}

	echo formClose();
echo div(false);