<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}
	
	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Ad"]) : 0;
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$banner    = isset($data) ? recoverPOST("banner", $data[0]["Banner"]) : null;
	$URL       = isset($data) ? recoverPOST("URL", $data[0]["URL"]) : "http://";
	$time 	   = isset($data) ? recoverPOST("time", $data[0]["Time"]) : recoverPOST("time");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
	$date      = isset($data) ? ($data[0]["End_Date"] ? "date" : "never") : recoverPOST("date", "date");
	$end_date  = isset($data) ? recoverPOST("end_date", ($data[0]["End_Date"] ? date("d/m/Y", $data[0]["End_Date"]) : now(true))) : recoverPOST("end_date", now(true));
	$principal = isset($data) ? recoverPOST("principal", $data[0]["Principal"]) : recoverPOST("principal");
	$edit      = isset($data) ? true : false;	
	$action	   = isset($data) ? "edit" : "save";
	$href	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add/");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add", null, "post", "multipart/form-data");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> true, 
				"value" => $title
			));

			echo formInput(array(
				"type" 	=> "url",
				"name" 	=> "URL", 
				"class" => "span10 required", 
				"field" => __("URL"), 
				"p" 	=> true, 
				"value" => $URL
			));

			$options = array(
				0 => array(
					"value"    => 1,
					"option"   => __("Yes"),
					"selected" => ((int) $principal === 1) ? true : false
				),		
				1 => array(
					"value"    => 0,
					"option"   => __("No"),
					"selected" => ((int) $principal === 0) ? true : false
				)
			);

			echo formSelect(array(
				"name" 	=> "principal", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Principal")), 
				$options
			);
			
			if (isset($banner)) {
				$image = img(path($banner, true), array("alt" => "Banner", "class" => "no-border", "style" => "max-width: 780px;"));
			
				echo __("If you change the banner image, this image will be deleted") . "<br />";
				echo $image;
				echo formInput(array("name" => "banner", "type" => "hidden", "value" => $banner));
			}

			echo p(true, "");
				echo span("field", "&raquo; ". __("Image"));
			echo p(false);

			echo p(true, "preview");

				echo formInput(array(
					"type" 	=> "file", 
					"name" 	=> "image", 
					"class" => "required", 
					"p" 	=> false
				));

				echo span("field", "&raquo; ". __("Large") ." (250x100)");

				echo br();

				echo htmlTag("canvas", array(
					"id" 	 => "preview",
					"class"  => "transparent",
					"width"  => "250",
					"height" => "100"
				));

			echo p(false);

			echo p(true, "preview");

				echo span("field", "&raquo; ". __("Miniature") ." (100x40)");

				echo br();

				echo htmlTag("canvas", array(
					"id" 	 => "miniature",
					"class"  => "transparent",
					"width"  => "100",
					"height" => "40"
				));

			echo p(false);

			echo htmlTag("button", array(
				"id" 	  => "transparent",
				"type" 	  => "button",
				"data-on" => "0",
				"data-set" => __("Set transparent color"), 
				"data-select" => __("Select a color") ."..." 
			), __("Set transparent color"));
			
			$options = array(
				0 => array(
					"value"    => "Active",
					"option"   => __("Active"),
					"selected" => ($situation === "Active") ? true : false
				),				
				1 => array(
					"value"    => "Inactive",
					"option"   => __("Inactive"),
					"selected" => ($situation === "Inactive") ? true : false
				)
			);

			$months = array(__("January"), __("February"), __("March"), __("April"), __("May"), __("June"), __("July"), __("August"), __("September"), __("October"), __("November"), __("December"));

			echo p(true, "");

				echo span("field", "&raquo; ". __("End date"));

				echo br();

				echo '<label class="date_option">';

					echo formInput(array(
						"id"      => "date",
						"checked" => ($date === "date"),
						"type"    => "radio",
						"name"    => "date",
						"value"   => "date",
						"p"       => false
					));

				echo '</label>';

					echo formInput(array(
						"type"  => "text",
						"name" 	=> "end_date", 
						"class" => "span3 required jdpicker",
						"p" 	=> false, 
						"value" => $end_date,
						"data-options" => '{"placeholder": "'. date("d/m/Y") .'", "date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
					));

				echo '<label class="date_option">';

					echo formInput(array(
						"id"   => "never",
						"checked" => ($date === "never"),
						"type" => "radio",
						"name" => "date",
						"value" => "never",
						"p"    => false
					));

					echo __("Never");

				echo '</label>';

			echo p(false);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Situation")), 
				$options
			);			
			
			echo formAction($action);

			echo formInput(array(
				"name"  => "MAX_FILE_SIZE",
				"type"  => "hidden",
				"value" => "1048576"
			));

			echo formInput(array(
				"id"    => "small-error",
				"type"  => "hidden",
				"value" => __("The file size must be greater than or equal to") ." 1KB"
			));

			echo formInput(array(
				"id"    => "big-error",
				"type"  => "hidden",
				"value" => __("The file size must be less than or equal to") ." 2MB"
			));

			echo formInput(array(
				"id"    => "type-error",
				"type"  => "hidden",
				"value" => __("Image type not supported")
			));

			echo formInput(array(
				"id"    => "orientation-error",
				"type"  => "hidden",
				"value" => __("Image orientation must be horizontal")
			));
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);