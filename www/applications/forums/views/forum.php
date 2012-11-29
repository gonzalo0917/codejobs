<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {
	$i = 1;
	$rand2 = rand(6, 10);

	?>
		<h1><?php echo $forum; ?></h1>
		<div class="forums-options">
			<span class="forums-create"><?php echo __("Create new topic"); ?></span>

			<br />
			<form action="#" method="post">
				<input id="ftitle" class="span8 forums-title" name="title" type="text" value="<?php echo __("Write the title of the new topic..."); ?>" /> <br />
				<input id="ftags" class="span8 forums-title no-display" name="tags" type="text" value="<?php echo __("Write the tags separated by commas..."); ?>" /> <br />
				<textarea id="fcontent" class="span8 forums-textarea no-display"><?php echo __("Write the content here..."); ?></textarea> <br />
				<input id="fpublish" class="btn-success no-display" name="publish" type="button" value="<?php echo __("Publish"); ?>" />
				<input id="fcancel" class="btn-danger no-display" name="cancel" type="button" value="<?php echo __("Cancel"); ?>" />

				<input id="fid" type="hidden" value="<?php echo $forumID; ?>" />
				<input id="ftitle-temp" type="hidden" value="<?php echo __("Write the title of the new topic..."); ?>" />
				<input id="ftags-temp" type="hidden" value="<?php echo __("Write the tags separated by commas..."); ?>" />
				<input id="fcontent-temp" type="hidden" value="<?php echo __("Write the content here..."); ?>" />
			</form>
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
