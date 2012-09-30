<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$title 	 = isset($title)   ? recoverPOST("title", $title) 		  : NULL;
	$content = isset($content) ? recoverpost("description", $content) : NULL;
 	
	if(!isset($success)) { 
?> 	
		<div class="newTopic" style="margin-left: 15%;">
			<form id="formNewTopic" action="<?php echo $href; ?>" method="post" enctype="multipart/form-data">
			
			<?php 
				if($action === "save") { 
			?>
					<legend><?php echo __("New Topic"); ?>
			<?php 
				} else { 
			?>
					<legend><?php echo __("Edit Topic"); ?>
			<?php 
				} 
			
				echo isset($alert) ? $alert : NULL; ?>
					
				<p class="field">
					&raquo; <?php echo __("Title"); ?><br />
					<input class="input" id="title" name="title" type="text" value="<?php echo $title; ?>" style="width: 700px;" />
				</p>
							
				<p class="field">
					&raquo; <?php echo __("Content"); ?><br />
					<textarea id="editor" name="content" class="textarea" style="width: 640px;"><?php echo $content; ?></textarea>
				</p>
					
			<?php 
				if(SESSION("ZanUserMethod") and SESSION("ZanUserMethod") === "twitter") { 
			?>
					<p class="checkTwitter">
						<input type="checkbox" value="Yes" name="tweet" checked="checked" />  <?php echo __("Post in Twitter") ; ?>
					</p>
			<?php 
				} 
			?>	
				<p class="field">
					<input class="input button" style="width: 700px;" id="<?php echo $action; ?>" name="doAction" value="<?php echo __(ucfirst($action)). " ". __("Topic"); ?>" type="submit" />
					<input class="input button" style="width: 700px;" id="cancel" name="cancel" value="<?php echo __("Cancel") ; ?>" type="submit" />
				</p>
					
				<input name="ID_Forum" type="hidden" value="<?php echo $ID; ?>" />
				<input name="URL" type="hidden" value="<?php echo $hrefURL; ?>" />
					
			<?php 
				if($action === "edit") { 
			?>
					<input name="ID_Post" type="hidden" value="<?php echo $ID_Post; ?>" />
			<?php 
				} 
			?>		
			</form>
		</div>
<?php 
	} else { 
?>
		<div class="newTopic">
			<?php 
				if($action === "save") {
					if($success > 0) { 
						echo showAlert("The new topic has been saved correctly", $href);
					} elseif($success === 0) {
						echo showAlert("You need to wait 25 seconds to create a new topic", $hrefE);
					} else { 
						echo showAlert("Ooops an unexpected problem has ocurred", "reload");
					}
				} else { 
					if($success > 0) { 
						echo showAlert("The topic has been edited correctly", $href);
					} else { 
						echo showAlert("Ooops an unexpected problem has ocurred", "reload");
					}
				}
			?>
		</div>
<?php 
	} 
?>