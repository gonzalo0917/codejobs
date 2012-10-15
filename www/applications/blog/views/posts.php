<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {
	$i = 1;
	$rand1 = rand(1, 5);
	$rand2 = rand(6, 10);
	
	foreach($posts as $post) {			
		if(isset($post["post"])) {
			$post = array_shift($post);
		}
			
		$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);	

		$in = ($post["Tags"] !== "") ? __("in") : NULL;	

		$lock = (strlen($post["Pwd"]) === 40) ? img(_get("webURL") . _sh . _lock, array("alt" => __("Private"), "class" => "no-border")) : NULL;
?>		
			
		<div class="post">
			<div class="post-title">
				<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
					<?php echo $lock . stripslashes($post["Title"]); ?>
				</a>
			</div>
			
			<div class="post-left">
				<?php 
					echo __("Published") ." ". 
						 howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." ". 
					 	 __("by") .' 
						 <a href="'. path("users/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
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
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo stripslashes($post["Title"]); ?>" tw:url="<?php echo $URL; ?>"></a>
					</div>

					<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-5026e83358e73317"></script>
				</div>
					
				<?php echo showContent(pagebreak($post["Content"], $URL), TRUE); ?>	
				<br />
				<?php					
					if(_get("production") and ($i === $rand1 or $i === $rand2)) {
						?>
							<p>
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
							</p>
						<?php
					}
				?>		
			</div>
			
			<div class="clear"></div>
		</div>
				
		<div class="clear"></div>
		<?php
		$i++;
	}
}
	
echo isset($pagination) ? $pagination : NULL;
