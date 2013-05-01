<?php
	if (is_array($ads)) {
		$path  = path("www/applications/pages/views/", true);
		$count = count($ads);

		foreach ($ads as $n => $ad) {
			echo '<a rel="nofollow" target="_blank" href="'. $ad["URL"] .'"><img src="'. path($ad["Banner"] .'_small.png', true) .'" alt="'. $ad["Title"] .'" title="'. $ad["Title"] .'" /></a>';
			if (($n + 1) % 10 === 0) {
				echo '<br />';
			}
		}

		if ($count < 40) {
			for ($i = $n + 1; $i < 40; $i++) {
				echo '<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="' . $path .'/images/buy15.png" width="100" height="31" /></a>';

				if (($i + 1) % 10 === 0) {
					echo '<br />';
				}
			}
		}
	}