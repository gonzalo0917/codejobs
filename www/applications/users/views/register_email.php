<p>
	<?php echo __("Your account has been created"); ?>
</p>

<p>
	<?php echo __("You need access to this link to activate your account:"); ?><br /> 
	<a href="<?php echo path("users/activate/$user/$code"); ?>"><?php echo __("Activate account"); ?></a>
</p>