<div id="tagcloud">
<?php 
	$i = 0;
	$maximum = $tags["maximum"];

	foreach ($tags["tags"] as $tag) {
		$percent = floor(($tag["counter"] / $maximum) * 100);

		if ($percent < 20) { 
			$class = 'smallest'; 
		} elseif ($percent >= 20 and $percent < 40) {
			$class = 'small'; 
		} elseif ($percent >= 40 and $percent < 60) {
			$class = 'medium';
		} elseif ($percent >= 60 and $percent < 80) {
			$class = 'large';
		} else {
			$class = 'largest';
		}
		?>
		<span class="<?php echo $class; ?>">
	  		<a href="<?php echo path("search/". encode($tag["tag"], true)); ?>"><?php echo $tag["tag"]; ?></a>
		</span>
<?php  	
	} 
?>
</div>