<?php
if(!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}
?>
<div class="post">
	<div class="post-title">
		<?php echo a($hello, _get("webBase")); ?>
	</div>
	
	<div class="post-left">
		<?php echo $date; ?>
	</div>
	
	<div class="post-right">
		<?php echo $comments; ?>
	</div>
	
	<div class="clear"></div>
	
	<div class="post-content">
		<?php echo $post; ?>
	</div>
</div>