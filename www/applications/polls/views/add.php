<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID = isset($data) ? recoverPOST("ID", $data["question"]["ID_Poll"]) : recoverPOST("ID");
	$title = isset($data) ? recoverPOST("title", $data["question"]["Title"]) : recoverPOST("title");
	$answers = isset($data) ? recoverPOST("answers", $data["answers"]) : recoverPOST("answers");
	$situation = isset($data) ? recoverPOST("situation", $data["question"]["Situation"]) : recoverPOST("situation");
	$language = isset($data) ? recoverPOST("language", $data["question"]["Language"]) : recoverPOST("language");
	$action = isset($data) ? "edit" : "save";
	$href = isset($data) ? path("polls/cpanel/$action/$ID/") : path("polls/cpanel/add/");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name"  => "title", 
				"class" => "span10 required", 
				"field" => __("Question"), 
				"p"     => true, 
				"value" => $title
			));


			echo formField(null, __("Answers") ." (". __("Empty answers not be added") . ")");
			
			if (is_array($answers)) { 
				$count = 1;

				foreach ($answers as $answer) { 
					echo p(true, "field panswer");
						echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answer["Answer"]));
					echo p(false);

					$count++;
				}

				for ($i = $count; $i <= 6; $i++) {
					echo p(true, "field panswer");
						echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => ""));
					echo p(false);
				}
			} else { 
				echo p(true, "field panswer");
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
					echo formInput(array("name" => "answers[]", "class" => "span10 required", "value" => $answers));
				echo p(false);
			}

			echo formField(null, __("Language") ."<br />". getLanguagesInput($language, "language", "select"));

			$options = array(
				0 => array("value" => "Active", "option"   => __("Active"), "selected"   => ($situation === "Active")   ? true : false),
				1 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? true : false)
			);

			echo formSelect(array(
				"name"  => "situation", 
				"p"     => true, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);

			echo formSave($action);

			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);