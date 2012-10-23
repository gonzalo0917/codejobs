<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="editProfile">
	<?php if(_get("webLang") === "en") { ?>
		<p class="center"><?php echo $user["Username"] . "'s Profile";?></p>
	<?php } elseif(_get("webLang") === "es") { ?>
		<p class="center"><?php echo "Perfil de " . $user["Username"];?></p>
	<?php } ?>
	
	<?php echo isset($alert) ? $alert : NULL; ?>
	
	<div id="box" class="set important">
		<p class="title main"><?php echo __("Profile");?></p>
		
		<div class="avatar">
			<div id="avatar"><img src="<?php echo $avatar;?>" title="<?php echo $user["Username"];?>" alt="<?php echo $user["Username"];?>" /></div><br />
		</div>
		
		<div class="social">
			<?php if($user["Twitter"]) { ?>
				<a class="sn" id="twitter" rel="external" href="http://twitter.com/<?php echo $user["Twitter"];?>" title="<?php echo $user["Twitter"];?>">
					Twitter
				</a>
			<?php } ?>
			<?php if($user["Facebook"]) { ?>
				<a class="sn" id="facebook" rel="external" href="http://facebook.com/<?php echo $user["Facebook"];?>" title="<?php echo $user["Facebook"];?>">
					Facebook
				</a>
			<?php } ?>
			<?php if($user["Linkedin"]) { ?>
				<a class="sn" id="linkedin" rel="external" href="http://linkedin.com/<?php echo $user["Linkedin"];?>" title="<?php echo $user["Linkedin"];?>">
					Linkedin
				</a>
			<?php } ?>
			<?php if($user["Google"]) { ?>
				<a class="sn" id="google" href="http://plus.google.com/<?php echo $user["Google"];?>/about" rel="external" title="<?php echo $user["Google"];?>">
					Google+
				</a>
			<?php } ?>
		</div>
		
		<div class="clear"></div>
		
		<div class="wrapper">
		</div>
	</div>
</div>
