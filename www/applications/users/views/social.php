<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$twitter  = recoverPOST("twitter", encode($data[0]["Twitter"]));
	$facebook = recoverPOST("facebook", encode($data[0]["Facebook"]));
	$linkedin = recoverPOST("linkedin", encode($data[0]["Linkedin"]));
	$google   = recoverPOST("google", encode($data[0]["Google"]));
	$viadeo   = recoverPOST("viadeo", encode($data[0]["Viadeo"]));


	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(
				"name" 	=> "twitter", 
				"class" => "field-title field-full-size",
				"field" => __("Twitter"), 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"value" => $twitter
			));

			echo formInput(array(
				"name" 	=> "facebook", 
				"class" => "field-title field-full-size",
				"field" => __("Facebook"), 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"value" => $facebook
			));

			echo formInput(array(
				"name" 	=> "linkedin", 
				"class" => "field-title field-full-size",
				"field" => __("Linkedin"), 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"value" => $linkedin
			));

			echo formInput(array(
				"name" 	=> "google", 
				"class" => "field-title field-full-size",
				"field" => __("Google"), 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"value" => $google
			));

			echo formInput(array(
				"name" 	=> "viadeo", 
				"class" => "field-title field-full-size",
				"field" => __("Viadeo"), 
				"p" 	=> TRUE,
				"maxlength" => "150",
				"value" => $viadeo
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