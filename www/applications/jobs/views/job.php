<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$URL = path("jobs/". $job["ID_Job"] ."/". $job["Slug"], FALSE, $job["Language"])
;?>

<div class="jobs">
	<h2>
		<?php echo getLanguage($job["Language"], TRUE); ?> <a href="<?php echo path("jobs/visit/". $job["ID_Job"], FALSE, $job["Language"]); ?>" target="_blank" title="<?php echo quotes($job["Title"]); ?>"><?php echo quotes($job["Title"]); ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo $job["Company"] .' - '.$job['Country'].', '.$job['City'].'<br/>';
			echo __("Published") ." ". howLong($job["Start_Date"]) ." ". __("by") .' <a title="'. $job["Author"] .'" href="'. path("jobs/author/". $job["Author"]) .'">'. $job["Author"] .'</a> '; 
			 
			if($job["Technologies"] !== "") {
				
				echo __("in") ." ". exploding($job["Technologies"], "jobs/tag/");
			}
		?>			
		<br />
	</span>

	<?php echo display(social($URL, $job["Title"], FALSE), 4); ?>


	<p class="justify">		
		<h5><?php echo __("Job Description")?></h5>
		<p>
			<?php 
				echo stripslashes($job["Requirements"]); 
			?>
		</p> 

		<h5><?php echo __("Company Information")?></h5>
		<p>
			<?php
				echo stripcslashes($job["Company_Information"]);
			?>
		</p>

		<h5><?php echo __("Additional Information")?></h5>
		<p>
			<ul>
				<li><?php echo __("Salary"). ": ". $job["Salary"] ." ". $job["Salary_Currency"] ?></li>
				<li><?php echo __("Allocation Time"). ": ". __($job["Allocation_Time"]) ?></li>
			</ul>
		</p>
	</p>

	<br />

	<br />

	<?php
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
	?>
	<p>
		<?php echo fbComments($URL); ?>
	</p>
	
	<p>
		<a href="<?php echo path("jobs"); ?>">&lt;&lt; <?php echo __("Go back"); ?></a>
	</p>
</div>
