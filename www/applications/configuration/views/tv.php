<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$href = path(whichApplication() ."/cpanel/tv");
	$tv   = recoverPOST("tv", 	$data[0]["TV"]);
	$chat = recoverPOST("chat", $data[0]["Enable_Chat"]);

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p("Codejobs TV", "resalt");
			
			echo isset($alert) ? $alert : null;
	
			echo formTextarea(array(
				"name" 	=> "tv", 
				"class" => "required span9", 
				"field" => __("Embed code"), 
				"p" 	=> true,
				"rows"  => 4,
				"value" => $tv
			));

			echo p(true);

			$opt = array(
				"id" 	=> "enable_chat",
				"name"  => "chat",
				"p" 	=> false,
				"type"  => "checkbox"
			);

			if ($chat) $opt["checked"] = "checked";

			echo formInput($opt);

			echo htmlTag("label", array("for" => "enable_chat", "style" => "display:inline"), htmlTag("span", array("class" => "field", "style" => "font-size:1em"), __("Enable chat")));

			echo p(false);
			
			echo formInput(array(
				"name" 	=> "save", 
				"class" => "btn",
				"p" 	=> false, 
				"value" => __("Save"),
				"type"  => "submit")
			);

		echo formClose();
	echo div(false);