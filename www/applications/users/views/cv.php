<div class="personal-information">
	<input id="name" name="name" type="text" value="Carlos" /> <br />
	<input id="birthday" name="birthday" ... /> <br />
	<input id="update-personal-information" type="button" value="<?php echo __("Update"); ?>" />
</div>

<div class="school-information">
	<input id="name2" name="name" type="text" value="<?php echo $user["Name"]; ?>" /> <br />
	<input id="birthday" name="birthday" ... /> <br />
	<input id="update-school-information" type="button" value="<?php echo __("Update"); ?>" />
</div>

<div class="work-information">
	<input id="name3" name="name" type="text" value="<?php echo $user["Name"]; ?>" /> <br />
	<input id="birthday" name="birthday" ... /> <br />
	<input id="update-work-information" type="button" value="<?php echo __("Update"); ?>" />
</div>

<input id="userid" name="userid" value="1" type="hidden" />