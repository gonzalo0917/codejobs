<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class="bookmarks">
	<h2>
		<?php echo getLanguage($bookmark["Language"], TRUE); ?> <a href="<?php echo $bookmark["URL"]; ?>" target="_blank" title="<?php echo htmlentities($bookmark["Title"], ENT_QUOTES, "UTF-8"); ?>"><?php echo $bookmark["Title"]; ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __("Published") ." ". howLong($bookmark["Start_Date"]) ." ". __("by") .' <a title="'. $bookmark["Author"] .'" href="'. path("users/". $bookmark["Author"]) .'">'. $bookmark["Author"] .'</a> '; 
			 
			if($bookmark["Tags"] !== "") {
				echo __("in") ." ". exploding($bookmark["Tags"], "bookmarks/tag/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __("Likes") .":</span> 0"; 
			echo ' <span class="bold">'. __("Dislikes") .":</span> 0";
			echo ' <span class="bold">'. __("Views") .":</span> 0";
		?>
	</span>
	
	<p class="justify">				
		<?php echo $bookmark["Description"]; ?> 
	</p>

	<h3>
		<a href="<?php echo $bookmark["URL"]; ?>" target="_blank" title="<?php echo htmlentities($bookmark["Title"], ENT_QUOTES, "UTF-8"); ?>"><?php echo __("Visit Bookmark"); ?></a>
	</h3>

	<br />
	
	<form action="<?php echo path("bookmarks/add/"); ?>" method="post" style="display: inline">
		<fieldset style="display:inline">
			<input type="hidden" name="title" value="<?php echo htmlentities($bookmark["Title"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="URL" value="<?php echo htmlentities($bookmark["URL"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="description" value="<?php echo htmlentities($bookmark["Description"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="tags" value="<?php echo htmlentities($bookmark["Tags"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="language" value="<?php echo htmlentities($bookmark["Language"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="ID" value="" />
			<input type="submit" name="save" onclick="needToConfirm = false" class="btn btn-success" value="<?php echo __("Save"); ?>" />
			<input type="submit" onclick="needToConfirm = false" class="btn" value="<?php echo __("Go back"); ?>" />
	</fieldset>
	</form>

</div>

<div class="preview"><?php echo __("Preview"); ?></div>