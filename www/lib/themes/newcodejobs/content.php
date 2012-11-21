	<?php 
		if(segment(0, isLang()) === "forums") {
			$style = ' style="width: 1000px;"';
		} elseif((segment(0, isLang()) === "codes" or segment(0, isLang()) === "blog") and segment(1, isLang()) === "add") {
			$style = ' style="width: 1000px;"';
		} else {
			$style = NULL;
		}
	?>

	<div id="content"<?php echo $style; ?>>
		<?php
			if(segment(0, isLang()) === "live") {
				echo display('<div style="width: 728px; margin-left: 120px;">
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
							</div>', 4);
			} else {
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

		$this->load(isset($view) ? $view : NULL, TRUE); ?>
	</div>