<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="editProfile">
	<form id="editUserProfile" action="<?php echo $href; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<p class="center2"><?php echo __("Edit Profile"); ?></p>
		
			<?php echo isset($alert) ? $alert : NULL; ?>
			
			<div id="box" class="set2 important">
				<p class="title main"><?php echo __("Profile"); ?></p>
				
				<div class="avatar">
					<div id="avatar">
						<img src="<?php echo $avatar;?>" title="<?php echo $user["Username"];?>" alt="<?php echo $user["Username"];?>" />
					</div> <br />
					
					<div class="buttons">
					<?php 
						if(SESSION("ZanUserMethod") !== "twitter") { 
					?>
							<input class="upAvatar" value="<?php echo __("Upload"); ?>" type="button" />
					<?php 
						} 
					?>
						<input class="editData" name="<?php echo _get("webLang");?>" value="<?php echo __("Edit Profile"); ?>" type="button" />
					</div>
				</div>

				<?php 
					if(SESSION("ZanUserMethod") !== "twitter") { 
				?>
						<input id="file" name="file" type="file" onchange="doUpload();" />
				<?php 
					} else { 
				?>
						<input id="userTwitter" name="userTwitter" value="Yes" type="hidden" />
				<?php 
					} 
				?>
				
				<div class="social">
				<?php 
					if($twitter) { 
				?>
						<a class="sn" id="twitter" target="_blank" href="http://twitter.com/<?php echo $user["Twitter"];?>" 
						title="<?php echo $user["Twitter"];?>"><img src="<?php print $twitter;?>" alt="twitter.com"/></a>
				<?php 
					} 
 					
 					if($facebook) { 
	 			?>
						<a class="sn" id="facebook" target="_blank" href="http://facebook.com/<?php echo $user["Facebook"];?>" 
						title="<?php echo $user["Facebook"];?>"><img src="<?php print $facebook;?>" alt="twitter.com"/></a>
				<?php 
					} 
					
					if($linkedin) { 
				?>
						<a class="sn" id="linkedin" target="_blank" href="http://linkedin.com/<?php echo $user["Linkedin"];?>" 
						title="<?php echo $user["Linkedin"];?>"><img src="<?php print $linkedin;?>" alt="twitter.com"/></a>
				<?php 
					} 
					
					if($google) { 
				?>
						<a class="sn" id="google" href="http://plus.google.com/<?php echo $user["Google"];?>/about" target="_blank" 
						title="<?php echo $user["Google"];?>"><img src="<?php print $google;?>" alt="twitter.com"/></a>
				<?php 
					} 
				?>
				</div>
				
				<div class="clear"></div>
				
				<div class="wrapper">
					<div class="blocktitle maintop"><?php echo __("Main Information"); ?></div>

					<div class="information principal">
						<div id="mainhide">
							<p>
								<strong><?php echo __("User"); ?>:</strong> <?php echo $user["Username"];?>
							</p>
							
							<p>
								<strong <?php echo ((!$user["Email"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Email"); ?>:
								</strong> 
								<?php echo $user["Email"];?>
							</p>
							
							<p>
								<strong><?php echo __("Join Date"); ?>:</strong> <?php echo $joinDate;?>
							</p>
							
							<p class="website">
								<strong <?php echo ((!$user["Website"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Website"); ?>:
								</strong> 

								<a <?php echo ((!$user["Website"]) ? 'style="display:none;" class="remove"' : null);?> 
								href="<?php echo $user["Website"];?>" id="website">
									<?php echo __("Go"); ?>
								</a>
							</p>
						</div>
					</div>
					
					<div class="blocktitle private"><?php echo __("Personal Information"); ?></div>
					
					<div class="information personal">
						<div id="personalhide">
							<p class="name">
								<strong <?php echo ((!$user["Name"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Name"); ?>:
								</strong> 

								<span id="name"><?php echo $user["Name"];?></span>
							</p>
							
							<p class="gender">
								<strong <?php echo ((!$user["Gender"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Gender"); ?>:
								</strong> 

								<span id="gender"><?php echo __($user["Gender"]);?></span>
							</p>
							
							<p class="birthday">
								<strong <?php echo ((!$user["Birthday"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Birthday"); ?>:
								</strong> 

								<span id="birthday"><?php echo $user["Birthday"];?></span>
							</p>
															
							<p class="telephone">
								<strong <?php echo ((!$user["Phone"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Telephone"); ?>:
								</strong> 
								
								<span id="telephone"><?php echo $user["Phone"];?></span>
							</p>
						</div>
					</div>
					
					<div class="blocktitle stats"><?php echo __("User Statistics"); ?></div>
					
					<div class="information statistics">
						<div id="statshide">
							<p><strong><?php echo __("Messages"); ?>:</strong> <?php echo $user["Messages"];?></p>
							<p><strong><?php echo __("Receive Messages"); ?>:</strong> <?php echo __($user["Recieve_Messages"]);?></p>
							<p><strong><?php echo __("Comments"); ?>:</strong> <?php echo $user["Comments"];?></p>
							<p><strong><?php echo __("Subscribed"); ?>:</strong> <?php echo $user["Subscribed"];?></p>
						</div>
					</div>
					
					<?php 
						if($user["Country"] === "" and $user["District"] === "") {
							$showLocation = FALSE;
						} else {
							$showLocation = TRUE;
						}
					?>
					
					<div id="location" <?php echo ((!$showLocation) ? 'style="display:none;"' : null);?> class="blocktitle location">
						<?php echo __("User Location"); ?>
					</div>
					
					<div class="information ubication">
						<div id="ubihide">
							<p class="country">
								<strong <?php echo ((!$user["Country"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Country"); ?>:
								</strong> 

								<span id="country"><?php echo $user["Country"];?></span></p>
								
							<p class="district">
								<strong <?php echo ((!$user["District"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("District"); ?>:
								</strong> 

								<span id="district"><?php echo $user["District"];?></span>
							</p>
						</div>					
					</div>
					
					<?php 
						if($user["Sign"] === "") {
							$showOther = FALSE;
						} else {
							$showOther = TRUE;
						}
					?>

					<div id="other" <?php echo ((!$showOther) ? 'style="display:none;"' : null);?> 
					class="blocktitle other"><?php echo __("Social Information"); ?></div>
					
					<div class="information socialmedia">
						<div id="socialhide">
							<p class="sign">
								<strong <?php echo ((!$user["Sign"]) ? 'style="display:none;" class="remove"' : null);?>>
									<?php echo __("Sign"); ?>:
								</strong>
							</p>
							
							<div id="sign"><?php echo $user["Sign"];?></div>
							
							<div id="sclntw">
								<p class="twitter"><strong>Twitter:</strong></p>
								<p class="facebook"><strong>Facebook:</strong></p>
								<p class="linkedin"><strong>LinkedIn:</strong></p>
								<p class="google"><strong>Google:</strong></p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
						
			<input class="removable" name="website" type="hidden" value="<?php echo $user["Website"];?>" />
			<input class="removable" name="twitter" type="hidden" value="<?php echo $user["Twitter"];?>" />
			<input class="removable" name="facebook" type="hidden" value="<?php echo $user["Facebook"];?>" />
			<input class="removable" name="linkedin" type="hidden" value="<?php echo $user["Linkedin"];?>" />
			<input class="removable" name="google" type="hidden" value="<?php echo $user["Google"];?>" />
			<input class="removable" name="name" type="hidden" value="<?php echo $user["Name"];?>" />
			<input class="removable" name="gender" type="hidden" value="<?php echo $user["Gender"];?>" />
			<input class="removable" name="birthday" type="hidden" value="<?php echo $user["Birthday"];?>" />
			<input class="removable" name="company" type="hidden" value="<?php echo $user["Company"];?>" />
			<input class="removable" name="country" type="hidden" value="<?php echo $user["Country"];?>" />
			<input class="removable" name="district" type="hidden" value="<?php echo $user["District"];?>" />
			<input class="removable" name="town" type="hidden" value="<?php echo $user["Town"];?>" />
			<input class="removable" name="telephone" type="hidden" value="<?php echo $user["Phone"];?>" />
			<input class="removable" name="sign" type="hidden" value="<?php echo $user["Sign"];?>" />
			<input name="ID_User" type="hidden" value="<?php echo $ID;?>" />
		</fieldset>
	</form>
</div>