<?php 			
	$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);		
	$in  = ($post["Tags"] !== "") ? __("in") : NULL;
?>
		<div class="post">
			<div class="post-title">
				<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
					<?php echo stripslashes($post["Title"]); ?>
				</a>
			</div>
			
		
			<div class="post-left">
				<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." " . __("by") . ' <a href="'. path("blog/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
			</div>
			
			<div class="post-right">
				<?php
					if($post["Enable_Comments"]) {
                    ?>
                   		<div class="fb-comments-count" data-href="<?php echo $URL; ?>"></div> <span data-singular="<?php echo __("comment"); ?>"><?php echo __("comments"); ?></span>
                    <?php
					}
				?>
			</div>
			
			<div class="clear"></div>
				
			<div class="post-content">
				<div class="social">
					<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count" addthis:url="<?php echo $URL; ?>" addthis:title="<?php echo stripslashes($post["Title"]); ?>"></a>
							<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo stripslashes($post["Title"]); ?>" tw:url="<?php echo $URL; ?>"></a>
							<a class="addthis_button_pinterest_pinit"></a>
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
						<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b64f6b39227d84"></script>
					<!-- AddThis Button END -->
				</div>

				<?php echo showContent($post["Content"], $URL); ?>

				<br />

				<a href="https://twitter.com/codejobs" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size="large"><?php echo __("Follow"); ?> @codejobs</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<br />

				<?php 
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
				?>
			</div>
		</div>
		<br /></br />
		<?php
			if($post["Enable_Comments"]) {
				?><div class="fb-comments" data-href="<?php echo $URL; ?>" data-num-posts="50" data-width="750"></div><?php
			}
		?>
