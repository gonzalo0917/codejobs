<?php
	if(!defined("_access")) {
		die("Error: You don't have permission to access here...");
	}
 
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
			<?php echo __("Welcome to the forums of"); ?> <?php echo get("webName"); ?>, 
			<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser"); ?>"><?php echo SESSION("ZanUser"); ?></a>!
		</p>
<?php 
	} else { 
?>
		<p class="welcome">
			<?php echo __("Welcome to the forums of"); ?> <?php echo get("webName"); ?>, 
			<?php echo __("please login to enjoy the forums or register if you don't have an account"); ?>.
		</p>
<?php 
	} 
?>


</div>

<div id="forums">
	<table id="forumsInfo">
		<caption>
			<span><?php echo __("Forums"); ?></span>
		</caption>
		
		<thead>
			<tr>
				<th class="first"><?php echo __("Forum"); ?></th>
				<th class="second"><?php echo __("Last Message"); ?></th>
				<th class="third"><?php echo __("Topics"); ?></th>
				<th class="fourth"><?php echo __("Messages"); ?></th>
				<?php 
					if(SESSION("ZanUserPrivilegeID") === 1) { 
				?>
						<th class="fifth"><?php echo __("Actions"); ?></th>
				<?php 
					} 
				?>
			</tr>
		</thead>

		<tbody>
		<?php 
			$j = 0; 

			foreach($forums as $forum) { 
		?>
				<tr class="rows <?php echo ($j % 2 === 0) ? "odd" : "even"; ?>">
					<td class="first">
						<span class="forumTitle2">
							<a title="<?php echo $forum["Title"]; ?>" href="<?php echo path("forums/". $forum["Slug"]); ?>"><?php echo $forum["Title"]; ?></a>
						</span>
						<br />
						<div class="forumDesc"><?php echo $forum["Description"]; ?></div>
					</td>

					<td class="second">
					<?php 
						if(is_null($forum["Last_Date"])) { 
					?>
							<span class="postDate"><?php echo $forum["Last_Reply"]; ?></span>
					<?php 
						} else { 
					?>
							<span class="forumTitle">
								<a title="<?php echo $forum["Last_Reply_Title"]; ?>" href="<?php echo $forum["Last_URL"]; ?>">
									<?php echo $forum["Last_Reply_Title"]; ?>
								</a>
							</span>

							<span class="postAuthor"> 
								<?php echo __("written by"); ?> 
								
								<a title="<?php echo $forum["Last_Reply_Author"]?>" href="<?php echo path("users/profile/". $forum["Last_Reply_Author_ID"]); ?>">
									<?php echo $forum["Last_Reply_Author"]?>
								</a>.
							</span>
							
							<br />
							
							<span class="postDate"><?php echo howLong($forum["Last_Date2"]); ?></span>
					<?php 
						}
					?>
					</td>
					
					<td class="third"><span class="forumNumbers"><?php echo $forum["Topics"]; ?></span></td>
					<td class="fourth"><span class="forumNumbers"><?php echo $forum["Replies"]; ?></span></td>
					<?php 
						if(SESSION("ZanUserPrivilegeID") === 1) { 
					?>
							<td class="fifth">
								<div class="actionbutton">
									<a title="<?php echo __("Edit"); ?>" onclick="return confirm('<?php echo __("Do you want to edit the forum?"); ?>');" 
									href="<?php echo $forum["editURL"]; ?>" class="ui-icon ui-icon-pencil">
										<span class="hide">Edit</span>
									</a>
								</div>
								
								<div class="actionbutton">
									<a title="<?php echo __("Delete"); ?>" onclick="return confirm('<?php echo __("Do you want to delete the forum?"); ?>');" 
									href="<?php echo $forum["deleteURL"]; ?>" class="ui-icon ui-icon-trash"></a>
									<span class="hide">Delete</span>
								</div>
							</td>
					<?php 
						} 
					?>
				</tr>
		<?php 
				$j++; 
			} 
		?>
		</tbody>		
	</table>
</div>	

	<div class="clear"></div>
</div>