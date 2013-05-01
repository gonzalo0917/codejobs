<?php
	if (is_array($ads)) {
		foreach ($ads as $ad) {
			echo '	<li>
						<a rel="nofollow" target="_blank" href="'. $ad["URL"] .'">
							<img src="'. path($ad["Banner"] .".png", true) .'" alt="'. $ad["Title"] .'" title="'. $ad["Title"] .'" />
						</a>
					</li>';
		}
	}