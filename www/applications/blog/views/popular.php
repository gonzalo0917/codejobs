<?php
	if(is_array($posts)) {
	?>
		<ul>
	<?php
		foreach($posts as $post) {
			$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);

			$views = ceil($post["Views"] / 2);
		?>
			<li><a href="<?php echo $URL; ?>" title="<?php echo __("Readings") .": ". $views; ?>"><?php echo $post["Title"]; ?></a></li></li>
		<?php
		}
	?>
		</ul>
	<?php
	}
?>