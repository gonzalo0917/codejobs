<?php 
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here..."); 
}

$name = recoverPOST("name");
$email = recoverPOST("email");
$message = recoverPOST("message");
echo div("new-user", "class");
<<<<<<< HEAD
echo formOpen(path("feedback"), "form", "form");
echo p(__("Contact us today"), "resalt");
echo isset($alert) ? $alert : null;

		if (!is($inserted, true)) {
			echo formInput(array(
				"id" => "name",
				"name" => "name",
				"field" => __("Name"), 
				"p" => true, 
				"value" => $name,
				"required" => true
			));

			echo formInput(array(
				"name" => "email",
				"pattern" => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"type" => "email",
				"field" => __("Email"), 
				"p" => true, 
				"value" => $email,
=======
	echo formOpen(path("feedback"), "form", "form");
		echo p(__("Contact us today"), "resalt");
		
		echo isset($alert) ? $alert : null;
		
		if (!is($inserted, true)) {
			echo formInput(array(
				"id"	   => "name",
				"name" 	   => "name",				
				"field"    => __("Name"), 
				"p" 	   => true, 
				"value"    => $name,
				"required" => true
			));
			
			echo formInput(array(	
				"name" 	   => "email",
				"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"type"     => "email",
				"field"    => __("Email"), 
				"p" 	   => true, 
				"value"    => $email,
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				"required" => true
			));

			echo formTextarea(array(
<<<<<<< HEAD
				"id" => "editor",
				"name" => "message",
				"field" => __("Message"), 
				"p" => true, 
				"value" => $message,
=======
				"id"	   => "editor",
				"name" 	   => "message",								
				"field"    => __("Message"), 
				"p" 	   => true, 
				"value"    => $message,
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				"required" => true
			));

			echo formCaptcha(array(
<<<<<<< HEAD
				"name" => "captcha",
				"p" => true,
				"field" => __("Verification") .' ('. __("answer must be a number") .')'
=======
				"name" 	   => "captcha",
				"p"		   => true,
				"field"    => __("Verification") .' ('. __("answer must be a number") .')'
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			));

			echo formInput(array(
				"name" => "send",
				"type" => "submit",
				"class" => "submit",
				"value" => __("Send my message")
			));
		}

<<<<<<< HEAD
echo formClose();
=======
	echo formClose();
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
echo div(false);