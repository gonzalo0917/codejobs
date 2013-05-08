<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$URL = path("blog/". $post["Year"] ."/". $post["Month"] ."/". $post["Day"] ."/". $post["Slug"]);		
$in  = ($post["Tags"] !== "") ? __("in") : null;
?>
<div class="post">
	<div class="post-title">
		<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
			<?php echo stripslashes($post["Title"]); ?>
		</a>
	</div>
	

	<div class="post-left">
		<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "blog/tag/") ." " . __("by") . ' <a href="'. path("user/". $post["Author"]) .'">'. $post["Author"] .'</a>'; ?>
	</div>
	
	<div class="post-right">
		<?php
			if ($post["Enable_Comments"]) {
            	echo fbComments($URL, true);
			}
		?>
	</div>
	
	<div class="clear"></div>
		
	<div class="post-content">
		<?php
			echo display(social($URL, $post["Title"], false), 4); 
			echo showContent($post["Content"]); 

			if ($post["Display_Bio"]) {
		?>
		
		<br />

		<div class="bio">
			<table class="bio">
				<tr>
					<td>
						<?php echo getAvatar($author["Avatar"], $author["ID_User"]); ?>
					</td>
					<td>
						<p class="author-details">
							<span class="author-name"><?php echo $author["Name"]; ?></span>
							<span class="author-username"><?php echo $author["Username"]; ?></span>
						</p>

						<?php if ($author["Country"] or ($author["Website"] and $author["Website"] !== "http://")) { ?>
						<p class="author-location">
							<?php if ($author["Gender"] === 'F') { ?>
							<span class="gender-icon female-icon"></span> <?php echo __("Woman"); } else { ?>
							<span class="gender-icon"></span> <?php echo __("Man"); } ?>

							<?php if ($author["Country"]) {
								echo "&#xb7; ". getFlag($author["Country"]); ?>&nbsp;<?php echo __($author["Country"]); ?>
							<?php } ?>

							<?php if ($author["Website"] and $author["Website"] !== "http://") {
								echo "&#xb7; ". a($author["Website"], $author["Website"], true);
							} ?>
						</p>
						<?php } ?>

						<?php if ($author["Twitter"] or $author["Facebook"] or $author["Google"] or $author["Linkedin"] or $author["Viadeo"]) { ?>
						<p class="author-social">
							<?php echo __("Follow him on"); ?>
						</p>
						<?php } ?>
					</td>
				</tr>
			</table>
		</div>
		
		<?php
			}
		?>

		<br /><br />

		<?php 
			echo display('<p>'. getAd("728px") .'</p>', 4);
		?>
	</div>

</div>
<br /></br />
<?php
	if ($post["Enable_Comments"]) {
		echo fbComments($URL);
	}
?>
