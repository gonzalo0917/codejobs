<?php 
if(!defined("_access")) { 
	die("Error: You don't have permission to access here..."); 
} 
	$i = 1;
	$rand2 = rand(6, 10);
	if(SESSION("ZanUser")) {
		$forum = str_replace("-", " ", $forum);
	?>
		<h1><?php echo strtoupper($forum); ?></h1>
		<p id="fmessage"></p>
		<div class="forums-options">
			<span class="forums-create"><?php echo __("Create new topic"); ?></span>
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
				<input id="needcontent" type="hidden" value="<?php echo __("Content must have at least 30 characters..."); ?>" />
				<input id="needtags" type="hidden" value="<?php echo __("You need to write at least one tag..."); ?>" />				
				<input id="id_user" type="hidden" value="<?php echo $id_user; ?>" />
			</form>
		</div>	
	<?php 
	}
	?>
	<div id="fposts">
	<?php
		foreach($posts as $post) {		
			$slug      = isset($post["Post_Slug"]) ? $post["Post_Slug"] : $post["Slug"];
			$URL       = path("forums/". $forum ."/". $post["ID_Post"] ."/". $slug);	
			$URLEdit   = path("forums/". $forum ."/edit/". $post["ID_Post"]);
			$URLDelete = path("forums/". $forum ."/delete/". $post["ID_Post"]);
			$in        = ($forum !== "") ? __("in") : NULL;	
			?>		
			
			<div class="post">
				<div class="post-title">
					<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
						<?php echo stripslashes($post["Title"]); ?>
					</a>
				</div>
				
				<div class="post-left">
					<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/". $forum ."/tag/") ." ". __("by") .' <a href="'. path("forums/". $forum ."/author/". $post["Author"]) .'">'. $post["Author"] .'</a>';?>					
					
					<?php
					if(SESSION("ZanUserPrivilegeID") !== FALSE){
						$confirm = " return confirm('Do you want to delete this post?') ";
						if(SESSION("ZanUserPrivilegeID") <= 3) {
							echo '| <a href="'. $URLEdit .'"> Edit </a> | <a href="'. $URLDelete .'" onclick="'. $confirm .'"> Delete </a>';
						}elseif(SESSION("ZanUserID") == $id_user){
									echo '| <a href=""> Edit </a> | <a href=""> Delete </a>';
					}
				}
					?>
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