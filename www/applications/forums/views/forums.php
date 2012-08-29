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
			<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser"); ?>"><?php echo SESSION("ZanUser"); ?></a>!</p>
			
			<div class="options">
				<ul>
					<li class="main"><?php echo __("Options"); ?> <span class="little">&rsaquo;&rsaquo;</span></li>
					<li>
						<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo __("Edit Profile"); ?>">
							<?php echo __("Edit Profile"); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo path("users/logout/forums"); ?>" title="<?php echo __("Logout"); ?>"><?php echo __("Logout"); ?></a>
					</li>
				</ul>
			</div>
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
					if(SESSION("ZanUserID") and SESSION("ZanUserPrivilege") === "Super Admin") { 
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
						if(SESSION("ZanUserID") and SESSION("ZanUserPrivilege") === "Super Admin") { 
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

<div class="forumsFooter">
	<div class="privileges">
		<p class="footerTitle"><?php echo __("Extra information"); ?>.</p>
		
		<img src="<?php echo $avatar; ?>" title="<?php echo ((SESSION("ZanUser")) ? SESSION("ZanUser") : __("Sign up, please") . " :)"); ?>" 
			alt="<?php echo __("A user avatar"); ?>" />
		
		<?php 
			if(SESSION("ZanUserID")) { 
				if(SESSION("ZanUserPrivilegeID") === 1) { 
		?>
					<p class="<?php echo (SESSION("ZanUserMethod")) ? "onlineUserInfo2" : "onlineUserInfo"; ?>">
						<?php echo __("Hi there!, "); ?> <a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser"); ?>">
						<?php echo SESSION("ZanUser"); ?></a>. 
						<br /> 
						<?php echo __("Here are your statistics"); ?>: <br />
						
						<ul class="userStatistics">
							<li><strong><?php echo __("Topics"); ?>:</strong>  <?php echo $stats[0]["Topics"];  ?></li>
							<li><strong><?php echo __("Replies"); ?>:</strong> <?php echo $stats[0]["Replies"]; ?></li>
							<li><strong><?php echo __("Visits"); ?>:</strong>  <?php echo $stats[0]["Visits"];  ?></li>
						</ul>
					</p>
				
					<ul class="lsprivileges2">
						<li>
							<?php echo __("You can"); ?> 
							<a href="<?php echo path("forums/cpanel/add"); ?>" title="<?php echo __("Create Forums"); ?>">
								<?php echo __("create"); ?>
							</a> 
							<?php echo __("new forums"); ?>.
						</li>
						<li><?php echo __("You can create new topics"); ?>.</li>
						<li><?php echo __("You can reply to topics"); ?>.</li>
						<li><?php echo __("You can send private messages"); ?>.</li>
					</ul>
		<?php 
				} elseif(SESSION("ZanUserPrivilege") === "Member") { 
		?>
					<p class="<?php echo (SESSION("ZanUserMethod")) ? "onlineUserInfo2" : "onlineUserInfo"; ?>">
						<?php echo __("Hi there!, "); ?> 
						<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser"); ?>">
							<?php echo SESSION("ZanUser"); ?>
						</a>. 
						<br /> 

						<?php echo __("Here are your statistics"); ?>: <br />
						
						<ul class="userStatistics">
							<li><strong><?php echo __("Topics"); ?>:</strong> <?php echo $stats[0]["Topics"]; ?></li>
							<li><strong><?php echo __("Replies"); ?>:</strong> <?php echo $stats[0]["Replies"]; ?></li>
							<li><strong><?php echo __("Visits"); ?>:</strong> <?php echo $stats[0]["Visits"]; ?></li>
						</ul>
					</p>
					
					<ul class="lsprivileges2">
						<li class="noprivilege"><?php echo __("You can <strong>NOT</strong> create new forums"); ?>.</li>
						<li><?php echo __("You can create new topics"); ?>.</li>
						<li><?php echo __("You can reply to topics"); ?>.</li>
						<li><?php echo __("You can send private messages"); ?>.</li>
					</ul>
		<?php 
				} 
		 	} else { 
		?> 
				<p class="noUserInfo">
					<?php echo __("Hi there!, you should"); ?> 
					<a class="signIn" href="<?php echo path("users/login/forums"); ?>" title="<?php echo __("Login"); ?>">
						<?php echo __("login"); ?>
					</a> 

					<?php echo __("to enjoy full access to the forums"); ?>.
					<br />
					<?php echo __("If you don't have an account, you can create it"); ?> 
					<a class="signUp" href="<?php echo path("users/register/forums"); ?>" title="<?php echo __("Sign up"); ?>"><?php echo __("here"); ?></a>.
				</p>
				
				<ul class="lsprivileges">
					<li class="noprivilege"><?php echo __("You can <strong>NOT</strong> create new forums"); ?>.</li>
					<li class="noprivilege"><?php echo __("You can <strong>NOT</strong> create new topics"); ?>.</li>
					<li class="noprivilege"><?php echo __("You can <strong>NOT</strong> reply to topics"); ?>.</li>
					<li class="noprivilege"><?php echo __("You can <strong>NOT</strong> send private messages"); ?>.</li>
				</ul>
		<?php 
			} 
		?>
	</div>
	
	<div class="lastUsers">
		<p class="footerTitle"><?php echo __("Last registered users"); ?>.</p>

		<ol>
		<?php 
			foreach($users as $user) { 
		?>
				<li>
					<a href="<?php echo path("users/profile/". $user["ID_User"]); ?>" title="<?php echo $user["Username"]; ?>">
						<?php echo $user["Username"]; ?>
					</a>
				</li>
		<?php 
			} 
		?>
		</ol>
	</div>
	
	<div class="clear"></div>
</div>