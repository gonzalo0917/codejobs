<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here..."));
}

$username = (!$inserted) ? recoverPOST("username")) : NULL;
$password = (!$inserted) ? recoverPOST("password")) : NULL;
$email    = (!$inserted) ? recoverPOST("email"))    : NULL;
?>

<form class="register" action="<?php echo $href;?>" method="post">
	<fieldset>
		<legend><?php echo __("Register"); ?></legend>
		
		<?php
			if(isset($alert)) {
				echo $alert;
			}
		?>
		
		<p class="center">
			<?php echo __("Register"); ?>
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
			<strong><?php echo __("E-Mail"); ?>:</strong><br />
			<input id="email" class="email" name="email" type="text" value="<?php echo $email; ?>" tabindex="3" />
		</p>
		
		<p>
			<input class="submit" name="register" type="submit" value="<?php echo __("Register"); ?>" tabindex="4" />
		</p>
	</fieldset>
</form>