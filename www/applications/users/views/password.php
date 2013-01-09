<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

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
				"type"  => "password",
				"name" 	=> "new_password", 
				"class" => "field-title span4",
				"field" => __("Password"), 
				"p" 	=> TRUE,
				"maxlength" => "40"
			));

			echo formInput(array(
				"type"  => "password",
				"name" 	=> "re_new_password", 
				"class" => "field-title span4",
				"field" => __("Confirm password"), 
				"p" 	=> TRUE,
				"maxlength" => "40"
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