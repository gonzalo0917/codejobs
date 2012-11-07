<?php
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	header("Content-type: application/json");

	foreach ($data as $district) {
		$cities[$district['District']] = $district['District'];
	}

	echo json($cities);