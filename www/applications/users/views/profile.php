<?php
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}
?>
<div class="editProfile">
	<section class="about">
		<?php $avatar = path("www/lib/files/images/users/". $user["Avatar"], true); ?>
		<div class="personal">
			<div>
				<a class="username" href="#"><?php echo $user["Username"]; ?></a>
			</div>
			<?php if ($user["Name"]) { ?>
			<div class="fullname">
				<?php echo $user["Name"]; ?>
			</div>
			<?php } ?>
			<?php if ($user["Website"] and $user["Website"] !== "http://") { ?>
			<div class="website">
				<a href="<?php echo $user["Website"]; ?>" target="_blank">
					<?php echo $user["Website"]; ?>
				</a>
			</div>
			<?php } ?>
			<?php if ($user["Avatar"] !== "default.png") { ?>
			<a href="<?php echo path("www/lib/files/images/users/". sha1($user["Username"] ."_O") .".png", true); ?>" target="_blank">
				<img src="<?php echo $avatar ?>" alt="<?php echo SESSION("ZanUser"); ?>" class="avatar" />
			</a>
			<?php } else { ?>
			<img src="<?php echo $avatar ?>" alt="<?php echo SESSION("ZanUser"); ?>" class="avatar" />
			<?php } ?>
		</div>
		<div class="information">
			<div class="date">
				<?php echo __("Member since") ." ". howLong($user["Start_Date"]); ?>
			</div>
		</div>
	</section>
	<div id="posts">
		<strong><?php echo __("Recent posts");?></strong>
	</div>
</div>
