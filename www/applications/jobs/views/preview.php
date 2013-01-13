<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class="jobs">
	<h2>
		<?php echo getLanguage($job["Language"], TRUE); ?> <a href="<?php echo $job["URL"]; ?>" target="_blank" title="<?php echo htmlentities($job["Title"], ENT_QUOTES, "UTF-8"); ?>"><?php echo $job["Title"]; ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo $job["Company"] .' - '.$job['Country'].', '.$job['City'].'<br/>';
			echo __("Published") ." ". howLong($job["Start_Date"]) ." ". __("by") .' <a title="'. $job["Author"] .'" href="'. path("users/". $job["Author"]) .'">'. $job["Author"] .'</a> '; 
			 
			if($job["Technologies"] !== "") {
				echo __("in") ." ". exploding($job["Technologies"], "jobs/tag/");
			}
		?>			
		<br />

	</span>
	
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

	<h3>
		<a href="<?php echo $job["URL"]; ?>" target="_blank" title="<?php echo htmlentities($job["Title"], ENT_QUOTES, "UTF-8"); ?>"><?php echo __("Visit Job"); ?></a>
	</h3>

	<br />
	
	<form action="<?php echo path("jobs/add/"); ?>" method="post" style="display: inline">
		<fieldset style="display:inline">
			<input type="hidden" name="title" value="<?php echo htmlentities($job["Title"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="email" value="<?php echo htmlentities($job["Email"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="address1" value="<?php echo htmlentities($job["Address1"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="address2" value="<?php echo htmlentities($job["Address2"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="phone" value="<?php echo htmlentities($job["Phone"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="author" value="<?php echo htmlentities($job["Author"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="company" value="<?php echo htmlentities($job["Company"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="cinformation" value="<?php echo htmlentities($job["Company_Information"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="country" value="<?php echo htmlentities($job["Country"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="city" value="<?php echo htmlentities($job["City"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="salary" value="<?php echo htmlentities($job["Salary"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="allocation_time" value="<?php echo htmlentities($job["Allocation_Time"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="salary_currency" value="<?php echo htmlentities($job["Salary_Currency"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="requirements" value="<?php echo htmlentities($job["Requirements"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="technologies" value="<?php echo htmlentities($job["Technologies"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="language" value="<?php echo htmlentities($job["Language"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="ID" value="" />
			<input type="submit" name="save" onclick="needToConfirm = false" class="btn btn-success" value="<?php echo __("Save"); ?>" />
			<input type="submit" onclick="needToConfirm = false" class="btn" value="<?php echo __("Go back"); ?>" />
	</fieldset>
	</form>

</div>

<div class="preview"><?php echo __("Preview"); ?></div>