<?php
	if(!defined("_access")) die("Error: You don't have permission to access here...");

	$avatar = recoverPOST("avatar", encode($data[0]["Avatar"]));

	echo div("edit-profile", "class");
		echo formOpen($href, "form-add", "form-add");
			echo isset($alert) ? $alert : NULL;
			
			echo '<img src="'. path("www/lib/files/images/users/$avatar", TRUE) .'" />';

		echo formClose();
	echo div(FALSE);