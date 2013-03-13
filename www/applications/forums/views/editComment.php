<?php 
if (!defined("ACCESS")) { 
	die("Error: You don't have permission to access here..."); 
}

$fid 	 = isset($data) ? recoverPOST("fid", $data[0]["ID_Parent"]) : recoverPOST("fid");
$pid 	 = isset($data) ? recoverPOST("pid", $data[0]["ID_Post"]) : recoverPOST("pid");
$content = isset($data) ? recoverPOST("content", $data[0]["Content"]) : recoverPOST("content", "clean");
$content = str_replace("%u200B", "", $content);
?>

<p id="fmessage"></p>
<div class="post-title">
	<span class="forums-create"><?php echo __("Edit Comment"); ?></span>
	<br />
	<form action="#" method="post">
		<textarea id="editor" placeholder="Write the content here..." class="ckeditor"><?php echo $content ?></textarea> <br />
		<input id="cedit" class="btn btn-success" name="publish" type="button" value="<?php echo __("Edit"); ?>" />
		<input id="ccancel" class="btn btn-danger" name="cancel" type="button" value="<?php echo __("Cancel"); ?>" />
		<input id="pid" name="pid" type="hidden" value="<?php echo $pid; ?>" />
		<input id="fid" name="fid" type="hidden" value="<?php echo $fid; ?>" />
		<input id="fname" type="hidden" value="<?php echo $forum ?>" />
		<input id="needcontent" type="hidden" value="<?php echo __("Comment can't be blank..."); ?>" />
	</form>
</div>
<?php echo $ckeditor; ?>