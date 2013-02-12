<?php
$HTML = null;
$flag = false;

if (is_array($data)) { 
	foreach ($data as $ad) {
		if ((int) count($data) === 1) { 
			$HTML = a(img(path($ad["Banner"], true)), $ad["URL"], true, array("title" => $ad["Title"]));
		} else {
			if ((int) $ad["Principal"] === 1) {
				if (!$flag) {
					$flag = true;
					
					$HTML .= a(img(path($ad["Banner"], true)), $ad["URL"], true, array(
						"title" => $ad["Title"], 
						"class" => "ads principal", 
						"style" => "text-align: center;")
					);
				} else {
					$HTML .= a(img(path($ad["Banner"], true)), $ad["URL"], true, array("title" => $ad["Title"], "class" => "ads"));
				}
			} else {
				$HTML .= a(img(path($ad["Banner"], true)), $ad["URL"], true, array("title" => $ad["Title"], "class" => "ads"));
			}
		}

		$position = strtolower($ad["Position"]);
	}
	
	echo '	<div id="'. $position .'-ads" class="div-ads">
				'. $HTML . '
			</div>';
}
