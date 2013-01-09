<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$email 		= recoverPOST("email", encode($data[0]["Email"]));
	$subscribed = (boolean) recoverPOST("subscribed", encode($data[0]["Subscribed"]));

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"type"  => "hidden",
				"name" 	=> "username",
				"p" 	=> FALSE,
				"value" => SESSION("ZanUser")
			));

			echo formInput(array(
				"name" 	=> "email", 
				"class" => "field-title span4",
				"field" => __("E-mail"), 
				"p" 	=> TRUE,
				"maxlength" => "45",
				"pattern"   => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"value" => $email
			));

			echo formCheckbox(array(
				"name" 	   => "subscribed",
				"position" => "right",
				"text"     => __("Subscribe to our free email newsletters"),
				"checked"  => $subscribed === TRUE
			));

			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

		echo formClose();
	echo div(FALSE);
?>
<script>
	var acceptLabel = "<?php echo __("Accept"); ?>",
		cancelLabel = "<?php echo __("Cancel"); ?>",
		inputLabel  = "<?php echo __("Input your password"); ?>",
		btnSelector = 'input[type="submit"]:first';
</script>