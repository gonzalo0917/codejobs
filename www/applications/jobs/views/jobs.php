<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}
?>
<div class="page-title">
	<h1>
		<?php echo __("Codejobs Vacancies");?>
	</h1>
</div>
<div class="searcher">
	<form action="<?php echo path("jobs/search/"); ?>" method="post" enctype="multipart/form-data">
	<?php
			echo formInput(array(
				"name" => "find",
				"class" => "span5 required", 
				"field" => __("Search"),  
				"placeholder" => __("Type your search"),
			));

			$options = array(
				0 => array("value" => "Tag", "option" => __("Tag")),
				1 => array("value" => "Author", "option" => __("Author")),
				2 => array("value" => "Company", "option" => __("Company")),
				3 => array("value" => "City", "option" => __("City"))
			);

			echo formSelect(array(
				"id" => "type",
				"name" => "type", 
				"class" => "span2 required", 
				"field" => __("Type")), 
				$options
			);

			echo formInput(array(
				"type" => "submit", 
				"id" => "search",
				"name" => "search",
				"value" => __("Search Job")
			));
	?>
	</form>
</div>
<div class="cities">
		<ul>
			<?php
				foreach ($cities as $city) {
					echo '<li><a href="'. path("jobs/city/". $city["City_Slug"]) .'">'. $city["City"] .", ". $city["Country"] ." (". $city["Total"] .") </li>".'</a>';
				}
		?>
		</ul>
	</div>

<div class="jobs">
	<?php 
		$i = 1;
		$rand1 = rand(1, 5);
		$rand2 = rand(6, 10);	
		foreach ($jobs as $job) {
			$in  = ($job["Tags"] !== "") ? __("in") : null;
			$URL = path("jobs/". $job["ID_Job"] ."/". $job["Slug"], false, $job["Language"]);
	?>		
			<div class="jobs-title">
				<h2>
				<?php echo getLanguage($job["Language"], true); ?>
				</h2>
				<a href="<?php echo $URL; ?>" title="<?php echo quotes($job["Title"]); ?>">
				<?php echo quotes($job["Title"]); ?></a>
			</div>
			<div class="jobs-company">
				<?php echo '<a href="'. path("jobs/company/". $job["Company"]) .'">'. $job["Company"] .'</a>'; ?>
			</div>

			<div class="jobs-location">
				<?php echo $job['City'].', '.$job['Country']; ?>
			</div>

			<div class="jobs-dateAdded">
					<?php echo __("Published") ." ". howLong($job["Start_Date"]) ." $in ". exploding($job["Tags"], "jobs/tag/") ." ". __("by") .' ';
					echo '<a href="'. path("jobs/author/". $job["Author"]) .'">'. $job["Author"] .'</a>'; ?>
			</div>

			<?php echo display(social($URL, $job["Title"], false), 4); ?>

			<?php
				if ($i === $rand2) { 
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
