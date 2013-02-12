<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);		
$in  = ($post["Tags"] !== "") ? __("in") : null;
?>
<div class="post">
	<div class="post-title">
		<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
			<?php echo stripslashes($post["Title"]); ?>
		</a>
	</div>
	

	<div class="post-left">
		<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." " . __("by") . ' <a href="'. path("blog/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
	</div>
	
	<div class="post-right">
		<?php
			if ($post["Enable_Comments"]) {
            	echo fbComments($URL, true);
			}
		?>
	</div>
	
	<div class="clear"></div>
		
	<div class="post-content">
		<?php
			echo display(social($URL, $post["Title"], false), 4); 
			echo showContent($post["Content"]); 
		?>

		<br /><br />

		<?php 
			echo display('<p>'. getAd("728px") .'</p>', 4);
		?>
	</div>
</div>
<br /></br />
<?php
	if ($post["Enable_Comments"]) {
		echo fbComments($URL);
	}
?>
