<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}

	$ID  	     = isset($data) ? recoverPOST("ID", $data[0]["ID_Image"]) 				: 0;
	$title       = isset($data) ? recoverPOST("title", $data[0]["Title"]) 				: recoverPOST("title");
	$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) 	: recoverPOST("description");
	$category 	 = isset($data) ? recoverPOST("category", $data[0]["Album"]) 			: recoverPOST("category");
	$ID_Category = isset($data) ? recoverPOST("ID_Category", $data[0]["ID_Category"]) 	: recoverPOST("ID_Category");
	$medium      = isset($data) ? recoverPOST("medium", $data[0]["Medium"]) 			: recoverPOST("medium");
	$situation 	 = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 		: recoverPOST("situation");
	$edit        = isset($data) ? TRUE 													: FALSE;
	$action	     = isset($data) ? "edit" 												: "save";
	$href	     = isset($data) ? path($this->application ."/cpanel/edit/$ID") 			: path($this->application ."/cpanel/add");


	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;
			
			echo formInput(array(	
								"name" 	=> "title", 
								"class" => "span10 required", 
								"field" => __("Title"), 
								"p" 	=> TRUE, 
								"value" => $title
			));
		
			echo formTextarea(array(
								"name"  => "description", 
								"class" => "span10 required", 
								"style" => "height: 150px;", 
								"field" => __("Description"), 
								"p" 	=> TRUE, 
								"value" => $description));
			
			if($medium) { 
				echo p(img(_webURL . _sh . $medium), "field");
			} 
			
			if($action === "save") {
				echo formInput(array(	
									"name" 	=> "files[]", 
									"type"  => "file",
									"class" => "add-img required", 
									"field" => __("Image"), 
									"p" 	=> TRUE
				));

				echo span(FALSE, "&nbsp;&nbsp;&nbsp;&nbsp;", "add-img");
			} else { 
				echo formInput(array(	
									"name" 	=> "file",
									"type"	=> "file", 
									"class" => "required", 
									"field" => __("Image"), 
									"p" 	=> TRUE
				));
			} 

			echo formInput(array(	
								"name" 	=> "category", 
								"class" => "span10 required", 
								"field" => __("Album") ." (". __("Write a album or select") .")", 
								"p" 	=> TRUE
			));
			
			/*
			<p class="field">
				<select id="ID_Category" name="ID_Category" size="1" tabindex="5" class="select">
					<option value="0"><?php echo __("Select Album"); ?></option>
					<?php if(is_array($categories)) { ?>
						<?php foreach($categories as $cat) { ?>
							<?php if($ID_Category === $cat["ID_Category"]) { ?>
								<option value="<?php echo $cat["ID_Category"]?>" selected="selected"><?php echo $cat["Title"]; ?></option>
							<?php } else { ?>
								<option value="<?php echo $cat["ID_Category"]?>"><?php echo $cat["Title"]; ?></option>
							<?php } ?>
						<?php } ?>
					<? } ?>
				</select>
			</p>
			*/

			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __("Active"),
						"selected" => ($situation === "Active") ? TRUE : FALSE
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __("Inactive"),
						"selected" => ($situation === "Inactive") ? TRUE : FALSE
					)
			);

			echo formSelect(array("name" => "situation", "class" => "required", "p" => TRUE, "field" => __("Situation")), $options);
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);