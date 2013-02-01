
<?php 

die(var_dump(345));
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
}

	$fid     = isset($data) ? recoverPOST("fid", $data[0]["ID_Post"]);
	$title   = isset($data) ? recoverPOST("title", $data[0]["Title"]);
	$tags    = isset($data) ? recoverPOST("tags", $data[0]["Tags"]);
	$content = isset($data) ? recoverPOST("content", $data[0]["Content"]);
?>
	<div class="forums-options">
		<span class="forums-create"><?php echo __("Create new topic"); ?></span>
		<span id="fmessage"></span>
		<br />
		<form action="#" method="post">
			<input id="ftitle" placeholder="Write the title of the new topic..." class="span8 forums-title" name="title" type="text" value="<?php echo $title; ?>" /> <br />
			<input id="ftags" placeholder="Write the tags separated by commas..." class="span8 forums-title" name="tags" type="text" value="<?php echo $tags; ?>" /> <br />
			<textarea id="fcontent" name="content" placeholder="Write the content here..." class="span8 forums-textarea" value="<?php echo $content; ?>"></textarea> <br />
			<input id="fpublish" class="btn btn-success" name="publish" type="button" value="<?php echo __("Publish"); ?>" />
			<input id="fcancel" class="btn btn-danger" name="cancel" type="button" value="<?php echo __("Cancel"); ?>" />

			<input id="fid" name="fid" type="hidden" value="<?php echo $fid; ?>" />
			<input id="fname" type="hidden" value="<?php echo $forum ?>" />
			<input id="needtitle" type="hidden" value="<?php echo __("You need to write the title..."); ?>" />
			<input id="needcontent" type="hidden" value="<?php echo __("You need to write the content..."); ?>" />
			<input id="needtags" type="hidden" value="<?php echo __("You need to write at least one tag..."); ?>" />				
		</form>
	</div>