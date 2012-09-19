<?php
	if(is_array($posts)) {
	?>
		<ul>
	<?php
		foreach($posts as $post) {
			$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);
		?>
			<li><a href="<?php echo $URL; ?>" title="<?php echo __("Readings") .": ". $post["Views"]; ?>"><?php echo $post["Title"]; ?></a></li></li>
		<?php
		}
	?>
		</ul>
	<?php
	}
?>