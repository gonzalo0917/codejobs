<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class="jobs">
	<?php 
		$i = 1;
		$rand1 = rand(1, 5);
		$rand2 = rand(6, 10);
		
		foreach($jobs as $job) { 
			$URL = path("jobs/". $job["ID_Job"] ."/". $job["Slug"], FALSE, $job["Language"]);
	?>
			<h2>
				<?php echo getLanguage($job["Language"], TRUE); ?> <a href="<?php echo $URL; ?>" title="<?php echo quotes($job["Title"]); ?>"><?php echo quotes($job["Title"]); ?></a>
			</h2>

			<span class="small italic grey">
				<?php 
				    echo $job["Company"] .' - '.$job['Country'].', '.$job['City'].'<br/>';
					echo __("Published") ." ". howLong($job["Start_Date"]) ." ". __("by") .' <a title="'. $job["Author"] .'" href="'. path("jobs/author/". $job["Author"]) .'">'. $job["Author"] .'</a> '; 
					 
					if($job["Technologies"] !== "") {
						//validacion antes si esta autor, agregar autor a la url
						echo __("in") ." ". exploding($job["Technologies"], "jobs/tag/");
					}
				?>			
				<br />
			</span>

			<?php echo display(social($URL, $job["Title"], FALSE), 4); ?>	

			<p class="justify">				
				<?php 
					echo showContent(pagebreak($job["Requirements"], $URL), TRUE); 
				?>
			</p>

			<br />

			<?php					
				if($i === $rand2) { 
					echo display('<p>
									<script type="text/javascript">
										google_ad_client = "ca-pub-4006994369722584";
										/* CodeJobs.biz */
										google_ad_slot = "1672839256";
										google_ad_width = 728;
										google_ad_height = 90;
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
