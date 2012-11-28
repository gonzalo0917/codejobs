<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class="bookmarks">
	<?php 
		$i = 1;
		$rand1 = rand(1, 10);
		$rand2 = rand(11, 20);
		
		foreach($bookmarks as $bookmark) { 
			$URL = path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], FALSE, $bookmark["Language"]);
	?>
			<h2>
				<?php echo getLanguage($bookmark["Language"], TRUE); ?> <a href="<?php echo $URL; ?>" title="<?php echo quotes($bookmark["Title"]); ?>"><?php echo quotes($bookmark["Title"]); ?></a>
			</h2>

			<span class="small italic grey">
				<?php 
					echo __("Published") ." ". howLong($bookmark["Start_Date"]) ." ". __("by") .' <a title="'. $bookmark["Author"] .'" href="'. path("bookmarks/author/". $bookmark["Author"]) .'">'. $bookmark["Author"] .'</a> '; 
					 
					if($bookmark["Tags"] !== "") {
						echo __("in") ." ". exploding($bookmark["Tags"], "bookmarks/tag/");
					}
				?>			
				<br />

				<?php 
					echo '<span class="bold">'. __("Likes") .":</span> ". (int) $bookmark["Likes"]; 
					echo ' <span class="bold">'. __("Dislikes") .":</span> ". (int) $bookmark["Dislikes"];
					echo ' <span class="bold">'. __("Views") .":</span> ". (int) $bookmark["Views"];
				?>
			</span>

			<div class="social" style="position: relative; z-index:100;">
				<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style" addthis:url="<?php echo $URL; ?>" addthis:title="<?php echo stripslashes($bookmark["Title"]); ?>">							
						<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo stripslashes($bookmark["Title"]); ?>" tw:url="<?php echo $URL; ?>"></a>
						<a class="addthis_button_pinterest_pinit"></a>
						<a class="addthis_counter addthis_pill_style" addthis:url="<?php echo $URL; ?>" addthis:title="<?php echo stripslashes($bookmark["Title"]); ?>"></a>
					</div>
					<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b64f6b39227d84"></script>
				<!-- AddThis Button END -->
			</div>		

			<p class="justify">				
				<?php echo stripslashes($bookmark["Description"]); ?>
			</p>

			<?php 
				if(SESSION("ZanUser")) { 
			?>
					<p class="small italic">
						<?php echo like($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Likes"]) ." ". dislike($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Dislikes"]) ." ". report($bookmark["ID_Bookmark"], "bookmarks"); ?>
					</p>
			<?php 
				} 
			?>
			
			<?php					
				if($i === $rand2) {
					echo display('<p>
                        <script type="text/javascript"><!--
                            google_ad_client = "ca-pub-4006994369722584";
                            /* CodeJobs.biz */
                            google_ad_slot = "1672839256";
                            google_ad_width = 728;
                            google_ad_height = 90;
                            //-->
                            </script>
                            <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                        </script>
                    </p>', 4);
				}

				$i++;
			?>			
			<br />
	<?php 
		} 
	?>

	<?php echo $pagination; ?>
</div>
