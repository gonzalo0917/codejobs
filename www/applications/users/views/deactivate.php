<?php
	echo __("If you are sure to deactivate your account, please choose an option below and click the confirm button to continue.");
?>
	<form method="post" class="deleteForm">
		<fieldset>
			<input type="hidden" name="username" value="<?php echo $username; ?>" />
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
			<input type="submit" value="<?php echo __("Confirm"); ?>" name="confirm" class="btn btn-danger" data-toggle="modal" data-target="#getPassword" />
		</fieldset>
	</form>

	<div id="getPassword" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"><?php echo __("Input your password"); ?></h3>
		</div>
		<div class="modal-body">
			<p><input type="password" /></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __("Cancel"); ?></button>
			<button class="btn btn-primary" onclick="acceptedPass()"><?php echo __("Accept"); ?></button>
		</div>
	</div>