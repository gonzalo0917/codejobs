<?php
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}

	if(is_array($forums)) {
		?><h2><?php echo __("Welcome to the CodeJobs's forums"); ?></h2><?php
		foreach($forums as $forum) {
		?>
			<h3><a href="<?php echo path("forums/". $forum["Slug"]); ?>"><?php echo $forum["Title"]; ?></a></h3>
			<small><?php echo $forum["Description"]; ?></small>
		<?php
		}
	}