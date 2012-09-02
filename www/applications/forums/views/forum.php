<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<?php 
	if(!SESSION("ZanUserID")) { 
?>
		<div class="twitterButton">
			<?php $this->view("twitter", "twitter", array("action" => $URL, "redirect" => $URL)); ?>
		</div>
	
		<div class="clear"></div>
<?php 
	} 
?>

<div class="actions">
	<?php 
		if(SESSION("ZanUserID") > 0) { 
	?>
			<p class="welcome">
				<?php echo __("Welcome to the forum, ") . $forum["Forum_Title"]; ?>, 
				<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser"); ?>"><?php echo SESSION("ZanUser"); ?></a>. 
				<?php echo __("Feel free of generate new topics"); ?>.
			</p>
	<?php 
		} else { 
	?>
			<p class="welcome">
				<?php echo __("Welcome to the forums of"); ?> 
				<?php echo get("webName"); ?>, <?php echo __("please login to enjoy the forums or register if you don't have an account"); ?>.
			</p>
	<?php 
		} 
	?>
</div>

<div id="forums">
	<table id="forumsInfo">
		<caption>
			<span><?php echo $forum["Forum_Title"]; ?></span>
		</caption>
		
		<thead>
			<tr>
				<th class="first"><?php echo __("Topic") ."/". __("Author"); ?></th>
				<th class="second"><?php echo __("Last Message"); ?></th>
				<th class="third"><?php echo __("Replies"); ?></th>
				<th class="fourth"><?php echo __("Visits"); ?></th>
				<?php 
					if(SESSION("ZanUserID")) { 
				?>
						<th class="fifth"><?php echo __("Actions"); ?></th>
				<?php 
					} 
				?>
			</tr>
		</thead>

		<tbody>
		<?php 
			if($topics) {
				$j = 0; 
				
				foreach($topics as $topic) { 
		?>
					<tr class="rows <?php echo ($j % 2 === 0) ? "odd" : "even"; ?>">
						<td class="first">
							<span class="forumTitle">
								<a title="<?php echo $topic["Title"]; ?>" href="<?php echo path("forums/". segment(2) ."/". $topic["ID"]); ?>">
									<?php echo $topic["Title"]; ?>
								</a>
							</span>
							
							<br />

							<div class="forumDesc">
								<a title="<?php echo $topic["Author"]?>" href="<?php echo path("users/profile/". $topic["Author_ID"]); ?>">
									<?php echo $topic["Author"]?>
								</a>
							</div>
						</td>

						<td class="second">
						<?php 
							if($topic["Count"] === 0) { 
						?>
								<span class="postDate"><?php echo $topic["Last_Reply"]; ?></span>
						<?php 
							} else { 
						?>
								<span class="forumTitle">
									<a title="<?php echo $topic["Last_Title"]; ?>" href="<?php echo $topic["Last_URL"]; ?>">
										<?php echo $topic["Last_Title"]; ?>
									</a>
								</span>
								
								<span class="postAuthor"> 
									<?php echo __("written by"); ?> 
									
									<a title="<?php echo $topic["Last_Author"]?>" href="<?php echo path("users/profile/". $topic["Last_Author_ID"]); ?>">
										<?php echo $topic["Last_Author"]?>
									</a>.
								</span>
								
								<br />
								
								<span class="postDate"><?php echo howLong($topic["Last_Start"]); ?></span>
						<?php 
							} 
						?>
						</td>
						
						<td class="third"><span class="forumNumbers"><?php echo $topic["Count"]; ?></span></td>
						<td class="fourth"><span class="forumNumbers"><?php echo $topic["Visits"]; ?></span></td>
						
						<?php 
							if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $topic["Author_ID"])) { 
						?>
								<td class="fifth">
									<div class="actionbutton">
										<a title="<?php echo __("Edit"); ?>" onclick="return confirm('<?php echo __("Do you want to edit the topic?"); ?>');" href="<?php echo $topic["editURL"]; ?>" class="ui-icon ui-icon-pencil">
											<span class="hide">Edit</span>
										</a>
									</div>
							
									<div class="actionbutton">
										<a title="<?php echo __("Delete"); ?>" onclick="return confirm('<?php echo __("Do you want to delete the topic?"); ?>');" href="<?php echo $topic["deleteURL"]; ?>" class="ui-icon ui-icon-trash">
											<span class="hide">Delete</span>
										</a>
									</div>
								</td>
						<?php 
							} elseif(SESSION("ZanUserID")) { 
						?>
								<td class="fifth">
									<div class="actionbutton">
										<a href="<?php echo $topic["replyURL"]; ?>" title="<?php echo __("Reply"); ?>" class="ui-icon ui-icon-arrowreturnthick-1-w"></a>
										<span class="hide">Reply</span>
									</div>
									
									<div class="actionbutton">
										<a href="<?php echo $topic["topicURL"]; ?>" title="<?php echo __("New topic"); ?>" class="ui-icon ui-icon-plusthick"></a>
										<span class="hide">Topic</span>
									</div>
								</td>
						<?php 
							}
						?>
					</tr>
					<?php $j++; 
				} 
			} else { ?>
			<?php 
				if(SESSION("ZanUserID")) { 
			?>
					<tr class="rows odd">
						<td class="noTopics" colspan="5">
							<?php echo __("There are no topics, be the first!"); ?> 
							
							<a class="newTopic" href="<?php echo path("forums/". $forum["Forum_Slug"] ."/new"); ?>" title="<?php echo __("Post a topic!"); ?>">
								<?php echo __("Post a topic!"); ?>
							</a>
						</td>
					</tr>
			<?php 
				} else { 
			?>
					<tr class="rows odd">
						<td class="noTopics" colspan="5">
							<?php echo __("There are no topics, be the first! but first"); ?>:  
							
							<a href="<?php echo path("users/login/forums"); ?>" title="<?php echo __("Login"); ?>">
								<?php echo __("Login"); ?>
							</a> 
							
							<a href="<?php echo path("users/register/forums"); ?>" title="<?php echo __("Sign up"); ?>">
								<?php echo __("Sign up"); ?>
							</a>
						</td>
					</tr>
			<?php 
				} 
			?>
		<?php 
			} 
		?>
		</tbody>		
	</table>
</div>