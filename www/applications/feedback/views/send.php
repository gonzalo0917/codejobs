<?php 
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here..."); 
}

$name  	 = recoverPOST("name");	
$email 	 = recoverPOST("email");
$message = recoverPOST("message");

echo div("new-user", "class");
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
				"required" => true
			));
			
			echo formTextarea(array(
				"id"	   => "editor",
				"name" 	   => "message",								
				"field"    => __("Message"), 
				"p" 	   => true, 
				"value"    => $message,
				"required" => true
			));

			echo formCaptcha(array(
				"name" 	   => "captcha",
				"p"		   => true,
				"field"    => __("Verification") .' ('. __("answer must be a number") .')'
			));
			
			echo formInput(array(	
				"name" 	=> "send",
				"type"  => "submit",
				"class" => "submit",
				"value" => __("Send my message")
			));
		}

	echo formClose();
echo div(false);