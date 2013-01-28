<?php
	echo p(__("Hi! There is a new proposal."));

	echo p("<strong>" . __("Title") . "</strong>:<br />" . $data[0]["Title"]);
	echo p("<strong>" . __("Description") . "</strong>:<br />" . $data[0]["Description"]);
	echo p("<strong>" . __("Temas") . "</strong>:<br />" . $data[0]["Topics"]);
	echo p("<strong>" . __("Slides") . "</strong>:<br />" . a(__("Click here to download the slides"), path($data[0]["File"], TRUE), TRUE));
	echo p("<strong>" . __("Email") . "</strong>:<br />" . $data[0]["Email"]);
	echo p("<strong>" . __("Day") . "</strong>:<br />" . $data[0]["Proposal_Day"]);
	echo p("<strong>" . __("Time") . "</strong>:<br />" . $data[0]["Proposal_Time"]);
	
	if($data[0]["Skype"] !== "") {
		echo p("<strong>" . __("Skype") . "</strong>:<br />" . $data[0]["Skype"]);
	}
	
	if($data[0]["Gtalk"] !== "") {
		echo p("<strong>" . __("Gtalk") . "</strong>:<br />" . $data[0]["Gtalk"]);
	}

	if($data[0]["Twitter"] !== "") {
		echo p("<strong>" . __("Twitter") . "</strong>:<br />" . $data[0]["Twitter"]);
	}

	if($data[0]["Facebook"] !== "") {
		echo p("<strong>" . __("Facebook") . "</strong>:<br />" . $data[0]["Facebook"]);
	}

	echo p("<strong>" . __("Date") . "</strong>:<br />" . howLong($data[0]["Start_Date"]));
?>