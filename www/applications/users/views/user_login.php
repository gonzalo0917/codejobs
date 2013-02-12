<?php
/**
 * Access from index.php:
 */
if(!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$name  = isset($name)  ? recoverPOST("name", $name)    : recoverPOST("name");	
$email = isset($email) ? recoverPOST("email", $email)  : recoverPOST("email");				


echo div("login-form", "class");
	echo a(img(path("$this->themeRoute/images/logo.png", TRUE), array(
		"id"    => "logo",
		"align" => "center",
		"alt"   => "CodeJobs",
		"class" => "noborder"
	)), path());

	if(isset($alert)) {
		echo $alert;
	}

	echo formOpen(getURL(), "form", "form");
		
		if(!isset($inserted) or !$inserted) {
			if(!SESSION("UserRegistered")) {
				echo formInput(array(
					"id"	   => "username",
					"name" 	   => "username",
					"maxlength" => "30", 
					"field"    => __("Username"), 
					"p" 	   => TRUE, 
					"value"    => recoverPOST("username")
				));
				
				echo formInput(array(
					"id" 	   => "password",
					"name" 	   => "password",
					"maxlength" => "30",
					"type"     => "password",
					"field"    => __("Password"), 
					"p" 	   => TRUE
				));

				echo a(
					__("Forgot your password?"),
					path("users/recover"),
					FALSE,
					array("class" => "forgot")
				);

				echo formInput(array(	
					"name" 	=> "login",
					"type"  => "submit",
					"class" => "btn btn-success",
					"value" => __("Log in")
				));

				echo a(
					__("Sign up"),
					path("users/register"),
					FALSE,
					array("class" => "btn")
				);
			}
		}

	echo formClose();
echo div(FALSE);