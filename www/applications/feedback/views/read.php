<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
		
<?php
	if($data) {
		$ID      = $data[0]["ID_Feedback"];
		$name    = $data[0]["Name"];
		$email   = $data[0]["Email"];
		$company = $data[0]["Company"];
		$phone   = $data[0]["Phone"];
		$subject = $data[0]["Subject"];
		$message = $data[0]["Message"];
		$date    = $data[0]["Text_Date"];
		$state   = $data[0]["Situation"];
		$back    = path(whichApplication() . _sh . "cpanel" . _sh . "results");
	} else {
		redirect(path(whichApplication() . _sh . "cpanel" . _sh . "results"));
	}
?>

<div class="add-form">
	<p class="field">
		<strong><?php echo __("Name"); ?></strong><br />
		<?php echo $name;?>
	</p>
	
	<p class="field">
		<strong><?php echo __("Email"); ?></strong><br />
		<?php echo $email;?>
	</p>
	
	<p class="field">
		<strong><?php echo __("Date"); ?></strong><br />
		<?php echo $date;?>
	</p>
	
	<p class="field">
		<strong><?php echo __("Subject"); ?></strong><br />
		<?php echo $subject;?>
	</p>
	
	<p class="field">
		<strong><?php echo __("Phone"); ?></strong><br />
		<?php echo $phone;?>
	</p>
	
	<p class="field">
		<strong><?php echo __("Company"); ?></strong><br />
		<?php echo $company;?>
	</p>
	
	<p class="field">
		<strong><?php echo __("Message"); ?></strong><br />
		<?php echo $message;?>
	</p>
	
	<p>
		<a href="<?php echo $back;?>" title="<?php echo __("Back"); ?>"><?php echo __("Back");?></a>
	</p>
</div>
<?php
	echo div("add-form", "class");
		echo formOpen(path("feedback/cpanel/read/$ID"), "form-add", "form-add");
			echo p(__("Respond"), "resalt");			

			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"id"    => "email",
				"name" 	=> "to", 
				"class" => "required", 
				"field" => __("To"), 
				"p" 	=> TRUE, 
				"value" => $email
			));

			echo formInput(array(	
				"id"    => "email",
				"name" 	=> "from", 
				"class" => "required", 
				"field" => __("From"), 
				"p" 	=> TRUE, 
				"value" => _get("webEmailSend")
			));

			echo formInput(array(					
				"name" 	=> "subject", 
				"class" => "required", 
				"field" => __("Subject"), 
				"p" 	=> TRUE, 
				"value" => __("Respons about your CodeJobs's message")
			));

			echo formTextarea(array(	 
				"id"     => "redactor",
				"name" 	 => "message", 
				"class"  => "markItUp", 
				"style"  => "height: 240px;", 
				"field"  => __("Content"), 
				"p" 	 => TRUE				
			));

			echo formInput(array(					
				"name" 	=> "send", 
				"class" => "btn btn-success", 								
				"value" => __("Send"),
				"type"  => "submit"
			));

		echo formClose();
	echo div(FALSE);