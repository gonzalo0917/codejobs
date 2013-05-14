<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

if ($author["Twitter"]) {
	$social[] = a("Twitter", "https://twitter.com/". $author["Twitter"], true, array("rel" => "nofollow"));
}

if ($author["Facebook"]) {
	$social[] = a("Facebook", "http://facebook.com/". $author["Facebook"], true, array("rel" => "nofollow"));
}

if ($author["Linkedin"]) {
	$social[] = a("LinkedIn", "http://linkedin.com/in/". $author["Linkedin"], true, array("rel" => "nofollow"));
}

if ($author["Google"]) {
	$social[] = a("Google+", "https://profiles.google.com/". $author["Google"], true, array("rel" => "nofollow"));
}

if ($author["Viadeo"]) {
	$social[] = a("Viadeo", "http://viadeo.com/en/profile/". $author["Viadeo"], true, array("rel" => "nofollow"));
}

$in = ($post["Tags"] !== "") ? __("in") : null;
$social[] = a(__("View more publications by this author"), path("user/". $author["Username"] . "/"));
?>
<div class="post">
	<div class="post-title">
		<a href="#" title="<?php echo stripslashes($post["Title"]); ?>">
			<?php echo stripslashes($post["Title"]); ?>
		</a>
	</div>
	

	<div class="post-left">
		<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." " . __("by") . ' <a href="'. path("user/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
	</div>
	
	<div class="post-right">
		<?php
			if ($post["Enable_Comments"]) {
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

	<br />

	<div class="bio">
		<table class="bio">
			<tr>
				<td>
					<?php echo getAvatar($author["Avatar"], $author["Username"]); ?>
				</td>
				<td>
					<p class="author-details">
						<span class="author-name"><?php echo $author["Name"]; ?></span>
						<span class="author-username"><?php echo $author["Username"]; ?></span>
					</p>

					<?php if ($author["Country"] or ($author["Website"] and $author["Website"] !== "http://")) { ?>
					<p class="author-location">
						<?php if ($author["Country"]) {
							echo getFlag($author["Country"]); ?>&nbsp;<?php echo __($author["Country"]); ?>
						<?php } ?>

						<?php if ($author["Website"] and $author["Website"] !== "http://") {
							echo "&#xb7; ". a($author["Website"], $author["Website"], true, array("rel" => "nofollow"));
						} ?>
					</p>
					<?php } ?>

					<p class="author-social">
						<?php echo implode(" | ", $social); ?> 
					</p>
				</td>
			</tr>
		</table>
	</div>

	<br /><br />

	<form action="<?php echo path("blog/add/". ((int) $post["ID"] !== 0 ? $post["ID"] : "")); ?>" method="post" style="display: inline">
		<fieldset style="display:inline">
			<input type="hidden" name="title" value="<?php echo htmlentities($post["Title"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="content" value="<?php echo htmlentities($post["Content"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="tags" value="<?php echo htmlentities($post["Tags"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="language" value="<?php echo htmlentities($post["Language"], ENT_QUOTES, "UTF-8"); ?>" />
			<input type="hidden" name="ID" value="<?php echo $post["ID"]; ?>" />
			<input type="submit" name="save" onclick="needToConfirm = false" class="btn btn-success" value="<?php echo __("Save"); ?>" />
			<input type="submit" onclick="needToConfirm = false" class="btn" value="<?php echo __("Go back"); ?>" />
	</fieldset>
	</form>
</div>

<div class="preview"><?php echo __("Preview"); ?></div>