<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {
	$i = 1;
	$rand2 = rand(6, 10);

	?>
		<h1><?php echo __("Forum") .": ". ucfirst($forum) .""; ?></h1>
		<div class="forums-options">
			<?php echo __("Create new post"); ?>
		</div>
	<?php 
	
	foreach($posts as $post) {			
		$URL = path("forums/". $post["Forum_Slug"] ."/". $post["ID_Post"] ."/". $post["Post_Slug"]);	
		
		$in = ($post["Forum_Slug"] !== "") ? __("in") : NULL;	
?>		
			
		<div class="post">
			<div class="post-title">
				<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
					<?php echo stripslashes($post["Title"]); ?>
				</a>
			</div>
			
			<div class="post-left">
				<?php 
					echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/tag/") ." ". __("by") .' <a href="'. path("forums/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
			</div>
			
			<div class="clear"></div>
		</div>
				
		
		<?php
		$i++;
	}
}
	
echo isset($pagination) ? $pagination : NULL;
