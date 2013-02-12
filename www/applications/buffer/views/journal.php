<?php 
	if(!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	echo '<div id="news">';
	
		if(is_array($posts)) {
			$i = 0; $j = 0;
			$total = count($posts) - 1;

			foreach($posts as $post) {
				if(isset($post["categories"][0]["Title"]) and $post["categories"][0]["Title"] === "La Grilla") {
					$total -= 1;

					continue;
				} else {
					if($i === 0) {
						echo '<div class="news-wrapper">';	
					}
					
					$URL = WEB_BASE . SH . WEB_LANG . SH . BLOG . SH;

					if(isset($post["categories"][0]["Title"])) {
						$category = '<span class="new-category">'. a($post["categories"][0]["Title"], $URL . CATEGORY . SH . $post["categories"][0]["Slug"]) . '</span> ';
					} else {
						$category = NULL;
					}

					$URL = WEB_BASE . SH . WEB_LANG . SH . BLOG . SH . $post["post"]["Year"] . SH . $post["post"]["Month"] . SH . $post["post"]["Day"] . SH;

					echo '<div class="new">';
						echo $category;
						
						if($post["post"]["Image_Medium"] !== "") {
							echo a(img(WEB_URL . SH . $post["post"]["Image_Medium"], $post["categories"][0]["Title"], "new-image"), $URL . $post["post"]["Slug"]) ."<br />";
						} else {
							echo '<br />';
						}

						echo '<span class="new-title">'. a(cut($post["post"]["Title"], 10), $URL . $post["post"]["Slug"]) .'</span><br />';
						echo cut(cleanHTML($post["post"]["Content"]), 16) ." <br /> ". a(__("Read more"), $URL . $post["post"]["Slug"]);
					echo '</div>';

					if($i === 2 or $j === $total) {
						echo '<div class="clear"></div>';
						echo '</div>';

						$i = 0;
					} else {
						$i++;
					}

					$j++;
				}
			}
		}
		
	echo '</div>';