<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	$in  = ($post["Tags"] !== "") ? __("in") : NULL;
?>
<div class="post">
	<div class="post-title">
		<a href="#" title="<?php echo stripslashes($post["Title"]); ?>">
			<?php echo stripslashes($post["Title"]); ?>
		</a>
	</div>
	

	<div class="post-left">
		<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." " . __("by") . ' <a href="'. path("users/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
	</div>
	
	<div class="post-right">
		<?php
			if($post["Enable_Comments"]) {
            ?>
           		<div class="fb-comments-count" data-href="<?php echo $URL; ?>"></div> <span data-singular="<?php echo __("comment"); ?>"><?php echo __("comments"); ?></span>
            <?php
			}
		?>
	</div>
	
	<div class="clear"></div>
		
	<div class="post-content">
		<?php echo showContent($post["Content"], $URL); ?>
	</div>

	<form action="<?php echo path("blog/add/"); ?>" method="post" style="display: inline">
		<fieldset style="display:inline">
			<input type="hidden" name="title" value="<?php echo htmlentities($post["Title"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="content" value="<?php echo htmlentities($post["Content"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="tags" value="<?php echo htmlentities($post["Tags"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="language" value="<?php echo htmlentities($post["Language"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="ID" value="" />
			<input type="submit" name="save" onclick="needToConfirm = false" class="btn btn-success" value="<?php echo __("Save"); ?>" />
			<input type="submit" onclick="needToConfirm = false" class="btn" value="<?php echo __("Go back"); ?>" />
	</fieldset>
	</form>
</div>

<div class="preview"><?php echo __("Preview"); ?></div>