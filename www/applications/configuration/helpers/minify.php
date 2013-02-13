<?php
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}

	function minify($ext = null) 
	{
		$css = false; 
		$js = false;

		if (is_null($ext)) {
			$css = true; 
			$js = true;
		} else {
			$$ext = true;
		}

		if ($js) {
			$path = CACHE_DIR .'/js';

			if ($handle = opendir($path)) {
			    while (false !== ($entry = readdir($handle))) {
			    	if (preg_match('/.+\.js$/', $entry)) {
			    		unlink("$path/$entry");
			    	}
			    }
			    closedir($handle);
			}
		}

		if ($css) {
			$path = CACHE_DIR .'/css';

			if ($handle = opendir($path)) {
			    while (false !== ($entry = readdir($handle))) {
			    	if (preg_match('/.+\.css$/', $entry)) {
			    		unlink("$path/$entry");
			    	}
			    }
			    closedir($handle);
			}
		}
	}