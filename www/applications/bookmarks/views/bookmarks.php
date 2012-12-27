<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class="bookmarks">
	<?php 
		$i = 1;
		
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
			</span>

			<?php echo display(social($URL, $bookmark["Title"], FALSE), 4); ?>	

			<p class="justify">				
				<?php echo stripslashes(compress($bookmark["Description"])); ?>
			</p>

			<br />
					
			<p>
				<script type="text/javascript">
					google_ad_client = "ca-pub-4006994369722584";
					/* CodeJobs.biz */
					google_ad_slot = "1672839256";
					google_ad_width = 728;
					google_ad_height = 90;
				</script>

				<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
			</p>
							
			<br />
	<?php 
		} 
	?>

	<?php echo $pagination; ?>
</div>
