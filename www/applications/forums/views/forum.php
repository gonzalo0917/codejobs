<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 

if(is_array($posts)) {
	$i = 1;
	$rand2 = rand(6, 10);
	if(SESSION("ZanUser")) {
	?>
		<h1><?php echo $forum; ?></h1>
		<div class="forums-options">
			<span class="forums-create"><?php echo __("Create new topic"); ?></span>
			<span id="fmessage"></span>
			<br />
			<form action="#" method="post">
				<input id="ftitle" placeholder="Write the title of the new topic..." class="span8 forums-title" name="title" type="text" value="" /> <br />
				<input id="ftags" placeholder="Write the tags separated by commas..." class="span8 forums-title" name="tags" type="text" value="" /> <br />
				<textarea id="fcontent" placeholder="Write the content here..." class="span8 forums-textarea"></textarea> <br />
				<input id="fpublish" class="btn btn-success" name="publish" type="button" value="<?php echo __("Publish"); ?>" />
				<input id="fcancel" class="btn btn-danger" name="cancel" type="button" value="<?php echo __("Cancel"); ?>" />

				<input id="fid" type="hidden" value="<?php echo $forumID; ?>" />
				<input id="fname" type="hidden" value="<?php echo $forum ?>" />
				<input id="needtitle" type="hidden" value="<?php echo __("You need to write the title..."); ?>" />
				<input id="needcontent" type="hidden" value="<?php echo __("You need to write the content..."); ?>" />
				<input id="needtags" type="hidden" value="<?php echo __("You need to write at least one tag..."); ?>" />				
			</form>
		</div>	
	<?php 
	}
	?>
	<div id="fposts">
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
					<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/tag/") ." ". __("by") .' <a href="'. path("forums/author/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
				</div>
				
				<div class="clear"><?php echo cut($post["Content"], 20); ?></div>
			</div>
								
			<?php
			$i++;
		}
	?>
	</div>
	<?php		
		echo isset($pagination) ? $pagination : NULL;
}