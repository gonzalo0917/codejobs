<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {
	$i = 1;
	$rand2 = rand(6, 10);
	
	foreach($posts as $post) {			
		$URL = path("forums/". $post["Forum_Slug"] ."/". $post["ID_Post"] ."/". $post["Post_Slug"]);	
		
		$in = ($post["Forum_Slug"] !== "") ? __("in") : NULL;	
?>		
			
		<div class="post">
			<div class="post-title">
				<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
					<?php echo stripslashes($post["Title"]); ?>
				</a>
			</div>
			
			<div class="post-left">
				<?php 
					echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/tag/") ." ". __("by") .' <a href="'. path("forums/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
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
