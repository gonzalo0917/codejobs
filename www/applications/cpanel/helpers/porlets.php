<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

if(!function_exists("porlet")) {
	function porlet($porlet, $content)
	{
		$skin = path("www/lib/themes/cpanel", true);
		
		$HTML  = '<div class="box">&nbsp; <span class="bold grey">'. $porlet .'</span> <span class="float-right bold small grey">X</span>';

		if (is_array($content)) {
			$HTML .= openUl(); 

			foreach ($content as $list) {
				$HTML .= $list;
			}
			$HTML .= closeUl();
		} else { 
			$HTML .= $content;
		}

		$HTML .= '</div><br />';

		return $HTML;
	}
}