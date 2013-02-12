<?php
	if(!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	header("Content-type: application/json");

	if ($data) {
		foreach ($data as $district) {
			$cities[$district['District']] = $district['District'];
		}
	} else {
		$cities = array();
	}

	echo json($cities);