<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$URL = path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], FALSE, $bookmark["Language"]);
?>

<div class="bookmarks">
	<h2>
		<?php echo getLanguage($bookmark["Language"], TRUE); ?> <a href="<?php echo path("bookmarks/visit/". $bookmark["ID_Bookmark"], FALSE, $bookmark["Language"]); ?>" target="_blank" title="<?php echo quotes($bookmark["Title"]); ?>"><?php echo quotes($bookmark["Title"]); ?></a>
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
			<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:url="<?php echo $URL; ?>" fb:like:title="<?php echo stripslashes($bookmark["Title"]); ?>"></a>
				<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo stripslashes($bookmark["Title"]); ?>" tw:url="<?php echo $URL; ?>"></a>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
			</div>
			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b64f6b39227d84"></script>
		<!-- AddThis Button END -->
	</div>


	<p class="justify">				
		<?php echo stripslashes($bookmark["Description"]); ?> 
	</p>

	<h3>
		<a href="<?php echo path("bookmarks/visit/". $bookmark["ID_Bookmark"]); ?>" target="_blank" title="<?php echo $bookmark["Title"]; ?>"><?php echo __("Visit Bookmark"); ?></a>
	</h3>

	<?php
		if(SESSION("ZanUser")) {
	?>
			<p class="small italic">
				<?php  echo like($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Likes"]) ." ". dislike($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Dislikes"]) ." ". report($bookmark["ID_Bookmark"], "bookmarks"); ?>
			</p>
	<?php
		}
	?>

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
	<p><div class="fb-comments" data-href="<?php echo path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], FALSE, $bookmark["Language"]); ?>" data-num-posts="2" data-width="750"></div></p>
	
	<p>
		<a href="<?php echo path("bookmarks"); ?>">&lt;&lt; <?php echo __("Go back"); ?></a>
	</p>
</div>
