<?php 
	echo p(__("Hi! There is a new proposal."), "left");

	echo p("<strong>" . __("Title") . "</strong>:<br />" . $Title, "left");
	echo p("<strong>" . __("Description") . "</strong>:<br />" . $Description, "left");
	echo p("<strong>" . __("Temas") . "</strong>:<br />" . $Topics, "left");
	echo p("<strong>" . __("Slides") . "</strong>:<br />" . a(__("Click here to download the slides"), path($File, true), true), "left");
	echo p("<strong>" . __("Email") . "</strong>:<br />" . $Email, "left");
	echo p("<strong>" . __("Day") . "</strong>:<br />" . $Proposal_Day, "left");
	echo p("<strong>" . __("Time") . "</strong>:<br />" . $Proposal_Time, "left");
	
	if (!is_null($Skype)) {
		echo p("<strong>" . __("Skype") . "</strong>:<br />" . $Skype, "left");
	}
	
	if (!is_null($Gtalk)) {
		echo p("<strong>" . __("Gtalk") . "</strong>:<br />" . $Gtalk, "left");
	}

	if (!is_null($Twitter)) {
		echo p("<strong>" . __("Twitter") . "</strong>:<br />" . $Twitter, "left");
	}

	if (!is_null($Facebook)) {
		echo p("<strong>" . __("Facebook") . "</strong>:<br />" . $Facebook, "left");
	}
?>
