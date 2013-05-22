<?php 
	if (is_array($posts)) {
		$count = count($posts) - 1;
		?>
		<div id="forum-content">
			<?php
			foreach ($posts as $post) {
				$forum = $post["Forum_Name"];

				if ($post["ID_Parent"] === 0) {
					$URL = path("forums/". segment(1, isLang()) ."/". $post["ID_Post"] ."/". $post["Slug"]);		
					$URLEdit   = path("forums/". slug($forum) ."/edit/". $post["ID_Post"]);
					$URLDelete = path("forums/". slug($forum) ."/delete/". $post["ID_Post"]);
					$in  = ($post["Tags"] !== "") ? __("in") : null;
					?>
					
					<div class="post">
						<ul class="breadcrumb">
							<li><a href="<?php echo path("forums"); ?>"><?php echo __("Forums"); ?></a> <span class="divider">></span></li>
  							<li><a href="<?php echo path("forums/". segment(1, isLang())); ?>"><?php echo $post["Forum_Name"]; ?></a> <span class="divider">></span></li>
  							<li class="active"><?php echo stripslashes($post["Title"]); ?></li>
						</ul>
						<div class="post-title">
							<a href="<?php echo $URL; ?>" title="<?php echo stripslashes($post["Title"]); ?>">
								<?php echo stripslashes($post["Title"]); ?>
							</a>
						</div>

						<div class="post-left">
							<?php echo __("Published") ." ". howLong($post["Start_Date"]) ." $in ". exploding($post["Tags"], "forums/". segment(1, islang()) ."/tag/") ." " . __("by") . ' <a href="'. path("user/". $post["Author"]) .'">'. $post["Author"] .'</a> ';
								
								if (SESSION("ZanUserPrivilegeID")) {
									$confirm = " return confirm('Do you want to delete this post?') ";

									if (SESSION("ZanUserPrivilegeID") <= 3 or SESSION("ZanUserID") == $post["ID_User"]) {
										echo '| <a href="'. $URLEdit .'">'. __("Edit") .'</a> | <a href="'. $URLDelete .'" onclick="'. $confirm .'">'. __("Delete") .'</a>';
									}
								} ?>
						</div>

						<div class="clear"></div>

						<div class="post-content">
							<div class="social">
								<div class="addthis_toolbox addthis_default_style ">
									<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo stripslashes($post["Title"]); ?>" tw:url="<?php echo $URL; ?>"></a>
								</div>

								<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
								<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-5026e83358e73317"></script>
							</div>
							<?php echo showContent($post["Content"], $URL); ?>
							<br />
						</div>
					</div>
					<?php
				} else {
					?>
					<a name="<?php echo 'id'. $post["ID_Post"]; ?>"></a>

					<div class="comments">
						<div class="comments-author">
							<img src="<?php echo $post["Avatar"] ?>" style="max-width: 70px;" class="dotted"/>
						</div>

						<div class="comments-content">
						<?php
							$authorUrl = path("forums/". slug($forum) ."/author/". $post["Author"]);
						?>
							<p class="comment-data"><?php echo "<a href='". $authorUrl ."'>". $post["Author"] ." </a> ". __("Published") ." ". howLong($post["Start_Date"]); ?>
						
						<?php
							if (SESSION("ZanUserPrivilegeID")) {
								$URLEditComment   = path("forums/". slug($forum) ."/editComment/". $post["ID_Post"]);
								$URLDeleteComment = path("forums/". slug($forum) ."/delete/". $post["ID_Post"] ."/". segment(2, islang()));
								$confirm   = " return confirm('". __("Do you want to delete this post?") ."') ";

								if (SESSION("ZanUserPrivilegeID") <= 3 or SESSION("ZanUserPrivilegeID") == $post["ID_User"]) {
									echo '| <a href="'. $URLEditComment .'">'. __("Edit") .'</a> | <a href="'. $URLDeleteComment .'" onclick="'. $confirm .'">'. __("Delete") .'</a>';
								}
							}
							?>
							</p>
							<p class="comment-post"><?php echo showContent($post["Content"]); ?></p>
						</div>
					</div>
				<?php
				}
			}
			?>
		</div>

		<div id="comment-alert"></div>
		
		<?php
			echo isset($pagination) ? $pagination : null;
			if (SESSION("ZanUser")) {			
		?>
				<div class="comments-editor">	
					<input id="needcontent" type="hidden" value="<?php echo __("You need to write the content..."); ?>" />
					<textarea id="editor" class="ckeditor" name="comment" style="height:200px"></textarea> <br />
					<input id="fid" type="hidden" value="<?php echo segment(2, isLang()); ?>" />
					<input id="fname" type="hidden" value="<?php echo $post["Forum_Name"]; ?>" />
					<input id="avatar" type="hidden" value="<?php echo $post["Avatar"]; ?>" />
					<input id="cpublish" class="btn btn-success" name="save" type="submit" value="<?php echo __("_Comment"); ?>" />
				</div>
		<?php
			} else {				
		?>
				<div class="no-connected"><?php echo __('You need to'). ' <a href="'. path("users/login/". returnTo(getURL())) .'">'. __('login'). '</a> '. __('or'). '<a href="'. path("users/register") .'"> '. __('create'). '</a> '. __('an account to comment this topic'); ?></div>
		<?php
			}
		}

		echo $ckeditor;