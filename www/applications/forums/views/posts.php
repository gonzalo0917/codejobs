<?php 		
	if(is_array($posts)) {
		$count = count($posts) - 1;

		foreach($posts as $post) {
			if($post["ID_Parent"] === 0) {
				$URL = path("forums/". segment(1, isLang()) ."/". $post["ID_Post"] ."/". $post["Slug"]);		
				$in  = ($post["Tags"] !== "") ? __("in") : NULL;

				?>
				<div class="post">
					<div class="post-title">
						<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
							<?php echo stripslashes($post["Title"]); ?>
						</a>
					</div>
						
					<div class="post-left">
						<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/tag/") ." " . __("by") . ' <a href="'. path("forums/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
					</div>
					
					<div class="clear"></div>
						
					<div class="post-content">
						<div class="social">
							<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo stripslashes($post["Title"]); ?>" tw:url="<?php echo $URL; ?>"></a>
							</div>

							<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
							<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-5026e83358e73317"></script>
						</div>
						<?php echo showContent($post["Content"], $URL); ?>
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

				<?php				
					if($count > 0) {
					?>
						<h3><?php echo __("Replies") . ": $count"; ?></h3>
					<?php
					}				
			} else {
				?>
				<div class="comments">
					<div class="comments-author">
						<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash4/372155_100002559760317_1123013291_q.jpg" /> <?php echo $post["Author"]; ?>
						<?php echo __("Published") ." ". howLong($post["Start_Date"]); ?>
					</div>

					<div class="comments-content">
						<?php echo $post["Content"]; ?>
					</div>
				</div>
				<?php
			}		
		}

			if(SESSION("ZanUser")) {
			?>				
				<div class="comments-editor">
					<form action="">
						<textarea name="comment"></textarea> <br />
						<input name="save" type="submit" value="<?php echo __("_Comment"); ?>" />
					</form>
				</div>		
			<?php
			} else {
			?>
				<div class="no-connected"><?php echo __("You need to login or create an account to comment this topic"); ?></div>
			<?php
			}
					
		?>
		<br /> 
		<h3><?php echo __("Comments") . ": "; ?><div class="fb-comments-count" data-href="<?php echo $URL; ?>"></div></h3>
		<div class="fb-comments" data-href="<?php echo $URL; ?>" data-num-posts="50" data-width="750"></div><?php
	}	
