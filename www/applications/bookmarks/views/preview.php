<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class="bookmarks">
	<h2>
		<?php echo getLanguage($bookmark["Language"], TRUE); ?> <a href="<?php echo $bookmark["URL"]; ?>" target="_blank" title="<?php echo $bookmark["Title"]; ?>"><?php echo $bookmark["Title"]; ?></a>
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
		<?php echo stripslashes($bookmark["Description"]); ?> 
	</p>

	<h3>
		<a href="<?php echo $bookmark["URL"]; ?>" target="_blank" title="<?php echo $bookmark["Title"]; ?>"><?php echo __("Visit Bookmark"); ?></a>
	</h3>

	<br />
	
		<form action="<?php echo path("bookmarks/add/"); ?>" method="post">
			<fieldset>
				<input type="hidden" name="title" value="<?php echo $bookmark["Title"]; ?>" />
				<input type="hidden" name="URL" value="<?php echo $bookmark["URL"]; ?>" />
				<input type="hidden" name="description" value="<?php echo $bookmark["Description"]; ?>" />
				<input type="hidden" name="tags" value="<?php echo $bookmark["Tags"]; ?>" />
				<input type="hidden" name="language" value="<?php echo $bookmark["Language"]; ?>" />
				<input type="hidden" name="ID" value="" />
				<input type="submit" name="save" class="btn btn-success" value="<?php echo __("Save"); ?>" />
				<input type="submit" name="back" class="btn" value="<?php echo __("Edit"); ?>" />
			</fieldset>
		</form>
	</p>
</div>
