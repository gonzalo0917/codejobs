<?php
	function minify($path = '.') {
		if($handle = opendir($path)) {
			$files = 0;

		    while(FALSE !== ($entry = readdir($handle))) {
		    	if(preg_match('/^\./', $entry)) {
		    		continue;
		    	}

		        if(is_dir("$path/$entry")) {
		        	$files += minify("$path/$entry");
		        } elseif(preg_match('/(.+)\.(js|css)$/', $entry, $name) and !preg_match('/\.min\.(js|css)$/', $entry)) {
					unset($name[0]);
		        	$filename = current($name) .'.min.'. next($name);
		        	$contents = compress(file_get_contents("$path/$entry"), current($name));
		        	file_put_contents("$path/$filename", $contents, LOCK_EX);
		        	$files++;
		        }
		    }
		    closedir($handle);

		    return $files;
		}

		return 0;
	}