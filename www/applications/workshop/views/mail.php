<?php 
	echo p(__("Hi! There is a new proposal."));

	echo p("<strong>" . __("Title") . "</strong>:<br />" . $Title);
	echo p("<strong>" . __("Description") . "</strong>:<br />" . $Description);
	echo p("<strong>" . __("Temas") . "</strong>:<br />" . $Topics);
	echo p("<strong>" . __("Slides") . "</strong>:<br />" . a(__("Click here to download the slides"), path($File, TRUE), TRUE));
	echo p("<strong>" . __("Email") . "</strong>:<br />" . $Email);
	echo p("<strong>" . __("Day") . "</strong>:<br />" . $Proposal_Day);
	echo p("<strong>" . __("Time") . "</strong>:<br />" . $Proposal_Time);
	
	if(!is_null($Skype)) {
		echo p("<strong>" . __("Skype") . "</strong>:<br />" . $Skype);
	}
	
	if(!is_null($Gtalk)) {
		echo p("<strong>" . __("Gtalk") . "</strong>:<br />" . $Gtalk);
	}

	if(!is_null($Twitter)) {
		echo p("<strong>" . __("Twitter") . "</strong>:<br />" . $Twitter);
	}

	if(!is_null($Facebook)) {
		echo p("<strong>" . __("Facebook") . "</strong>:<br />" . $Facebook);
	}
?>
