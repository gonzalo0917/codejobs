<?php
if (is_array($ads)) {
	echo "<ul>";

	foreach ($ads as $ad) {
		echo '	<li>
					<a rel="nofollow" target="_blank" href="'. $ad["URL"] .'">
						<img src="'. path($ad["Banner"], true) .'" alt="'. $ad["Title"] .'" />
					</a>
				</li>';
	}

	echo "</ul>";
}