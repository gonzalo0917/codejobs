<?php 
if (!defined("ACCESS")) { 
	die("Error: You don't have permission to access here..."); 
} 

$i = 1;
$rand2 = rand(6, 10);
?>
<div id="fposts">

<?php
if ($noTopics) {
	$return = "?return_to=". encode(path("forums/". segment(1, isLang())), true);
	redirect("users/login/". $return);
} else {
	if ($posts) {
		$i = 0;
		foreach ($posts as $post) {		
			$forum 	   = $post["Forum_Name"];
			$slug      = isset($post["Post_Slug"]) ? $post["Post_Slug"] : $post["Slug"];
			$URL       = path("forums/". $forum ."/". $post["ID_Post"] ."/". $slug);	
			$URLEdit   = path("forums/". $forum ."/edit/". $post["ID_Post"]);
			$URLDelete = path("forums/". $forum ."/delete/". $post["ID_Post"]);
			$in        = ($forum !== "") ? __("in") : null;				
			

			if ($i == 0) {
			?>
				<ul class="breadcrumb">
					<li><a href="<?php echo path("forums"); ?>"><?php echo __("Forums"); ?></a> <span class="divider">></span></li>
					<li class="active"><?php echo $post["Forum_Name"]; ?></li>
				</ul>
			<?php
				$i++;
			}
			?>			


			<div class="post">
				<div class="post-title">
					<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
						<?php echo stripslashes($post["Title"]); ?>
					</a>
				</div>

				<div class="post-left">
					<?php 
						echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/". $forum ."/tag/") ." ". __("by") .' ';
						echo '<a href="'. path("forums/". $forum ."/author/". $post["Author"]) .'">'. $post["Author"] .'</a>';

						if (SESSION("ZanUserPrivilegeID")) {
							$confirm = " return confirm('Do you want to delete this post?') ";

							if (SESSION("ZanUserPrivilegeID") <= 3 or SESSION("ZanUserID") == $post["ID_User"]) {
								echo '| <a href="'. $URLEdit .'">'. __("Edit") .'</a> | <a href="'. $URLDelete .'" onclick="'. $confirm .'">'. __("Delete") .'</a>';
							}
						}
					?>
				</div>

				<div class="post-right">
					<?php echo __("Comments") .': '. $post["Total_Comments"] .' | '. __("Last author") .': <a href="'. path("forums/". $forum ."/author/". $post["Last_Author"]) .'">'. $post["Last_Author"] .'</a>'; ?>
				</div>

				<div class="clear"><?php echo showContent(cut($post["Content"], 20)); ?></div>
			</div>
			<?php
			$i++;
		}
	}
	?>
	</div>

	<?php
	echo isset($pagination) ? $pagination : null;


	if (SESSION("ZanUser")) {
	?>
		<p id="fmessage"></p>
		<div class="forums-options">
			<span class="forums-create"><?php echo __("Create new topic"); ?></span>
			<br />
			<form action="#" method="post">
				<input id="ftitle" placeholder="<?php echo __("Write the title of the new topic..."); ?>" class="span8 forums-title" name="title" type="text" value="" /> <br />
				<input id="ftags" placeholder="<?php echo __("Write the tags separated by commas..."); ?>" class="span8 forums-title" name="tags" type="text" value="" /> <br />
				<textarea id="editor" placeholder="Write the content here..." class="ckeditor"></textarea> <br />
				<input id="fpublish" class="btn btn-success" name="publish" type="button" value="<?php echo __("Publish"); ?>" />
				<input id="fcancel" class="btn btn-danger" name="cancel" type="button" value="<?php echo __("Cancel"); ?>" />
				<input id="fid" type="hidden" value="<?php echo $forumID; ?>" />
				<input id="fname" type="hidden" value="<?php echo $forum; ?>" />
				<input id="needtitle" type="hidden" value="<?php echo __("You need to write the title..."); ?>" />
				<input id="needcontent" type="hidden" value="<?php echo __("Content must have at least 30 characters..."); ?>" />
				<input id="needtags" type="hidden" value="<?php echo __("You need to write at least one tag..."); ?>" />
			</form>
		</div>
	<?php 
	}
	echo $ckeditor;
}
	?>