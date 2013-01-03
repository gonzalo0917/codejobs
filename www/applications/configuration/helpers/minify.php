<?php
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}

	function minify($ext = NULL) {
		$css = FALSE; 
		$js  = FALSE;

		if(is_null($ext)) {
			$css = TRUE; 
			$js  = TRUE;
		} else {
			$$ext = TRUE;
		}

		if($js) {
			$path = _cacheDir .'/js';

			if($handle = opendir($path)) {
			    while(FALSE !== ($entry = readdir($handle))) {
			    	if(preg_match('/.+\.js$/', $entry)) {
			    		unlink("$path/$entry");
			    	}
			    }

			    closedir($handle);
			}
		}

		if($css) {
			$path = _cacheDir .'/css';

			if($handle = opendir($path)) {
			    while(FALSE !== ($entry = readdir($handle))) {
			    	if(preg_match('/.+\.css$/', $entry)) {
			    		unlink("$path/$entry");
			    	}
			    }

			    closedir($handle);
			}
		}
	}