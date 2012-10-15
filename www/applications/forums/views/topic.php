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
			<?php echo __("Welcome to this topic"); ?>, 
			
			<a href="<?php echo path("users/editprofile"); ?>" title="<?php echo SESSION("ZanUser"); ?>"><?php echo SESSION("ZanUser"); ?></a>. 
			
			<?php echo __("Feel free of reply to the topic"); ?>.

			<span style="float: right; margin-right: 10px;"><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __("_Reply"); ?>">+ <?php echo __("_Reply"); ?></a></span>
		</p>
<?php 
	} else { 
?>
		<p class="welcome">
			<?php echo __("Welcome to the forums of"); ?> <?php echo _get("webName"); ?>, 
			<?php echo __("please login to enjoy the forums or register if you don't have an account"); ?>.
		</p>	
<?php 
	} 
?>
</div>

<div id="wrapper">
	<div class="pagination">
	<?php 
		if(isset($pagination)) {
			echo $pagination;
		} 
	?>
	</div>
	
	<div class="clear"></div>
	
	<table id="topic">
		<tbody>
			<tr>
				<td class="caption">
					<p class="titleTopic"><?php echo $data["topic"][0]["Title"]; ?></p>
				</td>
			</tr>

			<tr>
				<td class="profile">
<?php 
				if($data["topic"][0]["Avatar"] !== "") {  
?>
					<img src="<?php echo path("www/lib/files/images/users/". $data["topic"][0]["Avatar"] ."", TRUE); ?>" title="<?php echo $data["topic"][0]["Username"]; ?>" /><br />
<?php 

				} else { 
?>
					<img src="<?php echo path("www/lib/files/images/users/default.png", TRUE); ?>" title="<?php echo $data["topic"][0]["Username"]; ?>" /><br />
<?php 
				} 
?>				
					<div class="userinfo">
						<p>
							<strong>
								<a href="<?php echo path("users/". $data["topic"][0]["Username"]); ?>" title="<?php echo $data["topic"][0]["Username"]; ?>">
									<?php echo $data["topic"][0]["Username"]; ?>
								</a>
							</strong>
						</p>
						
<?php 
						if($data["topic"][0]["Country"]) { 
?>
							<p><?php echo $data["topic"][0]["Country"]; ?></p>
<? 	
						} 
					
						if($data["topic"][0]["Website"]) { 
?>
							<a rel="nofollow" target="_blank" href="<?php echo $data["topic"][0]["Website"]; ?>" title="<?php echo $data["topic"][0]["Website"]; ?>">
								<?php echo $data["topic"][0]["Website"]; ?>
							</a>
<?php 
						} 
?>
						<p><?php echo __("Published"); ?> <?php echo howLong($data["topic"][0]["Start_Date"]); ?></p>
					</div>
					
					<div class="clear"></div>
				</td>
			</tr>

<?php 
		if(SESSION("ZanUserID")) { 
?>
			<tr class="actionsTopic">
				<td>
					<ul>
<?php 
					if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $data["topic"][0]["ID_User"])) { 
?>
						<li><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __("_Reply"); ?>"><?php echo __("_Reply"); ?></a></li>
						<li>
							<a title="<?php echo __("Edit"); ?>" onclick="return confirm('<?php echo __("Do you want to edit the topic?"); ?>');" 
							href="<?php echo $data["topic"][0]["editURL"]; ?>">
								<?php echo __("Edit"); ?>
							</a>
						</li>
						<li>
							<a title="<?php echo __("Delete"); ?>" onclick="return confirm('<?php echo __("Do you want to delete the topic?"); ?>');" 
							href="<?php echo $data["topic"][0]["deleteURL"]; ?>">
								<?php echo __("Delete"); ?>
							</a>
						</li>
<?php 
					} elseif(SESSION("ZanUserID")) { 
?>
						<li><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __("Reply"); ?>"><?php echo __("Reply"); ?></a></li>
<?php 
					} 
?>
					</ul>
				</td>
			</tr>
<?php 
		} 
?>
			<tr>
				<td class="topicContent">
					<div class="topicData">
						<?php echo BBCode($data["topic"][0]["Content"]); ?>
						
<?php 
						if($data["topic"][0]["Sign"] !== "") { 
?>
							<p class="sign"><?php echo $data["topic"][0]["Sign"]; ?></p>
<?php 
						} 
?>
					</div>
				</td>
			</tr>

<?php 	
	$i = 0;
			
	if(is_array($data["replies"])) { 
		foreach($data["replies"] as $reply) {
?>
			<tr class="space">
				<?php $i++; ?>
			</tr>
					
			<tr>
<?php 
				if($i === $count) { 
?>
					<a name="bottom"></a>
<?php 
				} 
?>
				<a name="<?php echo $reply["ID_Post"]; ?>"></a>
								
				<td class="profile">
<?php 
				if($reply["Avatar"] !== "") { 
?>
					<img src="<?php echo path("www/lib/files/images/users/". $reply["Avatar"] ."", TRUE); ?>" title="<?php echo $reply["Username"]; ?>" /><br />
<?php  			
				} else { 
?>
					<img src="<?php echo path("www/lib/files/images/users/default.png", TRUE); ?>" title="<?php echo $reply["Username"]; ?>" /><br />
<?php 
				} 
?>
					<div class="userinfo">
						<p>
							<strong>
								<a href="<?php echo path("users/". $reply["Username"]); ?>" title="<?php echo $reply["Username"]; ?>">
									<?php echo $reply["Username"]; ?>
								</a>
							</strong>
						</p>
						
<?php 
						if($reply["Country"]) { 
?>
							<p><?php echo $reply["Country"]; ?></p>
<?php 
						} 
 						
 						if($reply["Website"]) { 
?>
							<a href="<?php echo $reply["Website"]; ?>" rel="external" title="<?php echo $reply["Website"]; ?>"><?php echo __("Website"); ?></a>
<?php 
						} 
?>
						<p><?php echo __("Published"); ?> <?php echo howLong($data["topic"][0]["Start_Date"]); ?></p>
					</div>
				</td>
			</tr>
<?php 
			if(SESSION("ZanUserID")) { 
?>
				<tr class="actionsTopic">
					<td>
						<ul>
<?php 
							if(SESSION("ZanUserID") and (SESSION("ZanUserPrivilege") === "Super Admin" or SESSION("ZanUserID") === $reply["ID_User"])) { 
?>
								<li>
									<a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __("Reply"); ?>"><?php echo __("Reply"); ?></a>
								</li>
								<li>
									<a title="<?php echo __("Edit"); ?>" onclick="return confirm('<?php echo __("Do you want to edit the reply?"); ?>');" href="<?php echo $reply["editURL"]; ?>"><?php echo __("Edit"); ?></a>
								</li>
								<li>
									<a title="<?php echo __("Delete"); ?>" onclick="return confirm('<?php echo __("Do you want to delete the reply?"); ?>');" href="<?php echo $reply["deleteURL"]; ?>"><?php echo __("Delete"); ?></a>
								</li>
<?php 
							} elseif(SESSION("ZanUserID")) { 
?>
								<li><a href="<?php echo $data["topic"][0]["replyURL"]; ?>" title="<?php echo __("Reply"); ?>"><?php echo __("Reply"); ?></a></li>
<?php 
							} 
?>
						</ul>
					</td>
				</tr>
<?php 
			} 
?>
				<tr>
					<td class="topicContent">
						<div class="topicData">
							<p><?php echo BBCode($reply["Content"]); ?></p>
<?php 						
							if($data["topic"][0]["Sign"] !== "") { 
?>
								<p class="sign"><?php echo $reply["Sign"]; ?></p>
<?php 
							} 
?>										
						</div>
					</td>
				</tr>
<?php
		} 
	} 
?>
		</tbody>
	</table>
</div>

<div class="pagination2">
<?php 
	echo isset($pagination) ? $pagination : NULL;
?>
</div>