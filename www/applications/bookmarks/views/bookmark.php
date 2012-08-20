<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="bookmarks">
	<h2>
		<?php echo getLanguage($bookmark["Language"], TRUE); ?> <a href="<?php echo path("bookmarks/visit/". $bookmark["ID_Bookmark"]); ?>" target="_blank" title="<?php echo $bookmark["Title"]; ?>"><?php echo $bookmark["Title"]; ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __(_("Published")) ." ". howLong($bookmark["Start_Date"]) ." ". __(_("by")) .' <a title="'. $bookmark["Author"] .'" href="'. path("users/". $bookmark["Author"]) .'">'. $bookmark["Author"] .'</a> '; 
			 
			if($bookmark["Tags"] !== "") {
				echo __(_("in")) ." ". exploding($bookmark["Tags"], "bookmarks/tag/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __(_("Likes")) .":</span> ". (int) $bookmark["Likes"]; 
			echo ' <span class="bold">'. __(_("Dislikes")) .":</span> ". (int) $bookmark["Dislikes"];
			echo ' <span class="bold">'. __(_("Views")) .":</span> ". (int) $bookmark["Views"];
		?>
	</span>
		
	<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count" addthis:url="<?php echo $URL; ?>"></a>
		<a class="addthis_button_tweet" addthis:title="<?php echo $post["Title"]; ?>"></a>
	</div>

	<p class="justify">				
		<?php echo $bookmark["Description"]; ?> 
	</p>

	<h3>
		<a href="<?php echo path("bookmarks/visit/". $bookmark["ID_Bookmark"]); ?>" target="_blank" title="<?php echo $bookmark["Title"]; ?>"><?php echo __(_("Visit Bookmark")); ?></a>
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
	
	<p><div class="fb-comments" data-href="<?php echo path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"]); ?>" data-num-posts="2" data-width="750"></div></p>
	<p>
		<a href="<?php echo path("bookmarks"); ?>">&lt;&lt; <?php echo __(_("Go back")); ?></a>
	</p>
</div>
