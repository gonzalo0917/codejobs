<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
}
	$fid     = isset($data) ? recoverPOST("fid", $data[0]["ID_Forum"]) : recoverPOST("fid");
	$pid     = isset($data) ? recoverPOST("pid", $data[0]["ID_Post"]) : recoverPOST("pid");
	$title   = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$tags    = isset($data) ? recoverPOST("tags", $data[0]["Tags"])   : recoverPOST("tags");
	$content = isset($data) ? recoverPOST("content", $data[0]["Content"]) : recoverPOST("content");
?>
	<p id="fmessage"></p>
	<div class="forums-options">
		<span class="forums-create"><?php echo __("Edit topic"); ?></span>	
		<br />
		<form action="#" method="post">
			<input id="ftitle" placeholder="Write the title of the new topic..." class="span8 forums-title" name="title" type="text" value="<?php echo $title; ?>" /> <br />
			<input id="ftags" placeholder="Write the tags separated by commas..." class="span8 forums-title" name="tags" type="text" value="<?php echo $tags; ?>" /> <br />
			<textarea id="fcontent" name="content" placeholder="Write the content here..." class="span8 forums-textarea"><?php echo $content ?></textarea> <br />
			<input id="ppublish" class="btn btn-success" name="publish" type="button" value="<?php echo __("Publish"); ?>" />
			<input id="pcancel" class="btn btn-danger" name="cancel" type="button" value="<?php echo __("Cancel"); ?>" />

			<input id="pid" name="pid" type="hidden" value="<?php echo $pid; ?>" />
			<input id="fid" name="fid" type="hidden" value="<?php echo $fid; ?>" />
			<input id="edit" name="edit" type="hidden" value="edit" />
			<input id="fname" type="hidden" value="<?php echo $forum ?>" />
			<input id="needtitle" type="hidden" value="<?php echo __("You need to write the title..."); ?>" />
			<input id="needcontent" type="hidden" value="<?php echo __("Content must have at least 90 characters..."); ?>" />
			<input id="needtags" type="hidden" value="<?php echo __("You need to write at least one tag..."); ?>" />				
		</form>
	</div>