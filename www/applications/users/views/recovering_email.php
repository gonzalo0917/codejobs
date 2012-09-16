<p> 
	<?php echo __("To recover your password, you need to access here"); ?>
</p>

<p>
	<?php echo __("You need access to this link:"); ?>

	<a href="<?php echo path("users/recover/$token"); ?>"><?php echo __("Recover Password"); ?></a>
</p>