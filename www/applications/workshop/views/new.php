<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$title  	 = recoverPOST("title");
	$description = recoverPOST("description");
	$topics      = recoverPOST("topics");
	$email 		 = recoverPOST("email");
	$skype 		 = recoverPOST("skype");
	$gtalk 		 = recoverPOST("gtalk");
	$twitter   	 = recoverPOST("twitter");
	$facebook    = recoverPOST("facebook");

	echo div("new-proposal", "class");
		echo formOpen(path("workshop"), "form", "form", null, "post", "multipart/form-data");
			echo div("row", "class");
				echo  h2(__("Send us your proposal"));
				echo isset($alert) ? $alert : null;
			echo div(false);

			echo div("row", "class");
				echo div("span5", "class");
					echo formInput(array(
						"id" 	   => "title",
						"name" 	   => "title",
						"field"    => __("Title"),
						"p" 	   => true,
						"value"    => $title,
						"required" => true
					));
				echo div(false);

				echo div("span4 offset1", "class");
					$options = getAllDays("Saturday", "+3 months");

					echo formSelect(array(
						"id"		=> "day",
						"name" 		=> "day", 
						"p" 		=> true, 
						"field" 	=> __("Day")),
						$options
					);
				echo div(false);
			echo div(false);

			echo div("row", "class");
				echo div("span5", "class");
					echo formTextarea(array(
						"id" 	   => "description",
						"name" 	   => "description",
						"field"    => __("Description"),
						"p" 	   => true,
						"value"    => $description,
						"required" => true
					));
				echo div(false);

				echo div("span4 offset1", "class");
					$options = array(
						array("value" => "11 am", "option" => "11 am", "selected" => true),
						array("value" => "4 pm", "option" => "4 pm", "selected" => false)
					);

					echo formSelect(array(
						"id"		=> "time",
						"name" 		=> "time", 
						"p" 		=> true, 
						"field" 	=> __("Time")),
						$options
					);

					echo formInput(array(
						"id" 	      => "email",
						"name" 	      => "email",
						"type"		  => "email",
						"field"       => __("Email"),
						"p" 	      => true,
						"value"       => $email,
						"placeholder" => "me@example.com",
						"required" 	  => true
					));

					echo formInput(array(
						"id" 	   => "skype",
						"name" 	   => "skype",
						"field"    => __("Skype"),
						"p" 	   => true,
						"value"    => $skype
					));
				echo div(false);
			echo div(false);

			echo div("row", "class");
				echo div("span5", "class");
					echo formTextarea(array(
						"id" 	   => "topics",
						"name" 	   => "topics",
						"field"    => __("Topics"),
						"p" 	   => true,
						"value"    => $topics,
						"required" => true
					));
				echo div(false);

				echo div("span4 offset1", "class");
					echo formInput(array(
						"id" 	   => "gtalk",
						"name" 	   => "gtalk",
						"field"    => __("GTalk"),
						"p" 	   => true,
						"value"    => $gtalk
					));

					echo formInput(array(
						"id" 	   => "twitter",
						"name" 	   => "twitter",
						"field"    => __("Twitter"),
						"p" 	   => true,
						"value"    => $twitter
					));

					echo formInput(array(
						"id" 	   => "facebook",
						"name" 	   => "facebook",
						"field"    => __("Facebook"),
						"p" 	   => true,
						"value"    => $facebook
					));
				echo div(false);
			echo div(false);

			echo div("row", "class");
				echo div("span5", "class");
					echo formInput(array(	
						"name" 	=> "file", 
						"type"  => "file",
						"field" => __("Slides"),
						"p" 	  => true
					));
				echo div(false);

				echo div("span4 offset1", "class");
					echo p(formInput(array(	
						"name" 	=> "send",
						"type"  => "submit",
						"class" => "btn btn-success",
						"value" => __("Submit my proposal")
					), (!SESSION("ZanUser")) ? true : false), "submit");
				echo div(false);
			echo div(false);		

			echo br(2);

			if (!(SESSION("ZanUser"))) {
				setURL();
				
				echo a(__("You need to login to send your proposal"), path("users/login"), false);
			}

		echo formClose();
	echo div(false);

?>
