<?php
	if(is_array($posts)) {
	?>
		<ul>
	<?php
		foreach($posts as $post) {
			$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);

			$views = ceil($post["Views"] / 2);
		?>
			<li><img src="<?php echo path("www/lib/themes/newcodejobs/images/arrow.png", TRUE); ?>" /> <a href="<?php echo $URL; ?>" title="<?php echo __("Readings") .": ". $views; ?>"><?php echo stripslashes($post["Title"]); ?></a></li></li>
		<?php
		}
	?>
		</ul>
	<?php
	}
?>