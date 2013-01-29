<?php 
	if(!defined("_access")) {
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
		echo formOpen(path("workshop"), "form", "form", NULL, "post", "multipart/form-data");
			echo div("row", "class");
				echo  h2(__("Send us your proposal"));
				echo isset($alert) ? $alert : NULL;
			echo div(FALSE);

			echo div("row", "class");
				echo div("span5", "class");
					echo formInput(array(
						"id" 	   => "title",
						"name" 	   => "title",
						"field"    => __("Title"),
						"p" 	   => TRUE,
						"value"    => $title,
						"required" => TRUE
					));
				echo div(FALSE);

				echo div("span4 offset1", "class");
					$options = getAllDays("Saturday", "+3 months");

					echo formSelect(array(
						"id"		=> "day",
						"name" 		=> "day", 
						"p" 		=> TRUE, 
						"field" 	=> __("Day")),
						$options
					);
				echo div(FALSE);
			echo div(FALSE);

			echo div("row", "class");
				echo div("span5", "class");
					echo formTextarea(array(
						"id" 	   => "description",
						"name" 	   => "description",
						"field"    => __("Description"),
						"p" 	   => TRUE,
						"value"    => $description,
						"required" => TRUE
					));
				echo div(FALSE);

				echo div("span4 offset1", "class");
					$options = array(
						array("value" => "11 am", "option" => "11 am", "selected" => TRUE),
						array("value" => "4 pm", "option" => "4 pm", "selected" => FALSE)
					);

					echo formSelect(array(
						"id"		=> "time",
						"name" 		=> "time", 
						"p" 		=> TRUE, 
						"field" 	=> __("Time")),
						$options
					);

					echo formInput(array(
						"id" 	      => "email",
						"name" 	      => "email",
						"type"		  => "email",
						"field"       => __("Email"),
						"p" 	      => TRUE,
						"value"       => $email,
						"placeholder" => "me@example.com",
						"required" 	  => TRUE
					));

					echo formInput(array(
						"id" 	   => "skype",
						"name" 	   => "skype",
						"field"    => __("Skype"),
						"p" 	   => TRUE,
						"value"    => $skype
					));
				echo div(FALSE);
			echo div(FALSE);

			echo div("row", "class");
				echo div("span5", "class");
					echo formTextarea(array(
						"id" 	   => "topics",
						"name" 	   => "topics",
						"field"    => __("Topics"),
						"p" 	   => TRUE,
						"value"    => $topics,
						"required" => TRUE
					));
				echo div(FALSE);

				echo div("span4 offset1", "class");
					echo formInput(array(
						"id" 	   => "gtalk",
						"name" 	   => "gtalk",
						"field"    => __("GTalk"),
						"p" 	   => TRUE,
						"value"    => $gtalk
					));

					echo formInput(array(
						"id" 	   => "twitter",
						"name" 	   => "twitter",
						"field"    => __("Twitter"),
						"p" 	   => TRUE,
						"value"    => $twitter
					));

					echo formInput(array(
						"id" 	   => "facebook",
						"name" 	   => "facebook",
						"field"    => __("Facebook"),
						"p" 	   => TRUE,
						"value"    => $facebook
					));
				echo div(FALSE);
			echo div(FALSE);

			echo div("row", "class");
				echo div("span5", "class");
					echo formInput(array(	
						"name" 	=> "file", 
						"type"  => "file",
						"field" => __("Slides"),
						"p" 	  => TRUE
					));
				echo div(FALSE);

				echo div("span4 offset1", "class");
					echo p(formInput(array(	
						"name" 	=> "send",
						"type"  => "submit",
						"class" => "btn btn-success",
						"value" => __("Submit my proposal")
					), (!SESSION("ZanUser")) ? TRUE : FALSE), "submit");
				echo div(FALSE);
			echo div(FALSE);		

			echo br(2);

			if(!(SESSION("ZanUser"))) {
				setURL();
				
				echo a(__("You need to login to send your proposal"), path("users/login"), FALSE);
			}

		echo formClose();
	echo div(FALSE);

?>
