<?php
	header("Content-type: application/json");

	foreach ($data as $district) {
		$cities[$district['District']] = $district['District'];
	}

	echo json($cities);