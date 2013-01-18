<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

$username  = recoverPOST("username", $username);
$email     = recoverPOST("email", $email);
$name      = recoverPOST("name", $name);
$avatar    = recoverPOST("avatar", $avatar);
$birthday  = recoverPOST("birthday", $birthday);
$serviceID = recoverPOST("serviceID", $serviceID);

echo div("new-user", "class");
	echo formOpen(path("users/register/facebook"), "form", "form");
		echo p(__("Join today to") ." ". _get("webName"), "resalt");
		
		if(!isset($alert) and SESSION("UserRegistered") and !POST("register")) {
			redirect();
		} else {
			if(POST("register") and SESSION("UserRegistered")) {
				echo getAlert(__("You can't register many times a day"));
			} else { 
				echo isset($alert) ? $alert : NULL;
			}
		}

		if(!isset($inserted) or !$inserted) {
			if(!SESSION("UserRegistered")) {
				?>
				<p><?php echo img($avatar, array("class" => "dotted")); ?> <strong><?php echo __("Hi"); ?></strong>, <?php echo $name; ?>!</p>
				<?php
				echo formInput(array(
					"id"	   => "username",
					"name" 	   => "username",
					"pattern"  => "^[A-Za-z0-9_-]{3,15}$", 
					"class"    => "required", 
					"field"    => __("Username"), 
					"p" 	   => TRUE, 
					"value"    => $username,
					"required" => TRUE
				));

				echo formInput(array(	
					"name" 	   => "email",
					"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
					"type"     => "email",
					"field"    => __("Email"), 
					"p" 	   => TRUE, 
					"value"    => $email,
					"required" => TRUE
				));

				echo formInput(array(					
					"name" 	=> "name", 										
					"value" => $name,
					"type"  => "hidden"
				));

				echo formInput(array(					
					"name" 	=> "avatar", 										
					"value" => $avatar,
					"type"  => "hidden"
				));

				echo formInput(array(					
					"name" 	=> "birthday",
					"value" => $birthday,
					"type"  => "hidden"
				));

				echo formInput(array(					
					"name" 	=> "serviceID", 										
					"value" => $serviceID,
					"type"  => "hidden"
				));
				
				echo formInput(array(	
					"name" 	=> "register",
					"type"  => "submit",
					"class" => "submit",
					"value" => __("Create my account")
				));
			}
		}

	echo formClose();
echo div(FALSE);