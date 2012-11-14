<?php
	echo __("If you are sure to deactivate your account, please choose an option below and click the confirm button to continue.");
?>
	<form method="post" class="deleteForm">
		<fieldset>
			<label class="radio">
				<input type="radio" name="option" value="deactivate" checked>
				<dl>
				  <dt><?php echo __("Deactivate my account"); ?></dt>
				  <dd><?php echo __("It will no delete your account, but your profile will not be accessible. Your publications will be still available."); ?></dd>
				</dl>
			</label>
			<label class="radio">
				<input type="radio" name="option" value="delete">
				<dl>
				  <dt><?php echo __("Delete my account"); ?></dt>
				  <dd><?php echo __("It will permanently delete your account. No turning back!"); ?></dd>
				</dl>
			</label>
			<input type="submit" value="<?php echo __("Confirm"); ?>" name="confirm" class="btn btn-danger" />
		</fieldset>
	</form>