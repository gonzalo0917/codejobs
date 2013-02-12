<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here..."));
}

$username = (!$inserted) ? recoverPOST("username")) : null;
$password = (!$inserted) ? recoverPOST("password")) : null;
?>
<
<form class="login" action="<?php echo $href;?>" method="post">
	<fieldset>
		<legend><?php echo __("Login"); ?></legend>
		
		<?php
			if (isset($alert)) {
				echo $alert;
			}
		?>
		
		<p class="center">
			<?php echo __("Login"); ?>
		</p>
		
		<p>
			<strong><?php echo __("Username"); ?>:</strong><br />
			<input id="username" class="username" name="username" type="text" value="<?php echo $username; ?>" tabindex="1" />
		</p>	
		
		<p>
			<strong><?php echo __("Password"); ?>:</strong><br />
			<input id="password" class="password" name="password" type="password" value="<?php echo $password; ?>" tabindex="2" />
		</p>
		
		<p>
			<input class="submit" name="login" type="submit" value="<?php echo __("Login"); ?>" tabindex="4" />
		</p>
	</fieldset>
</form>