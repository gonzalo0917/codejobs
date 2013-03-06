<?php
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}
?>
<div class="editProfile">
	<section class="about">
		<?php $avatar = path("www/lib/files/images/users/". $user["Avatar"], true); ?>
		<div>
			<div>
				<a class="username" href="#"><?php echo $user["Username"]; ?></a>
			</div>
			<?php if ($user["Name"]) { ?>
			<div class="fullname">
				<?php echo $user["Name"]; ?>
			</div>
			<?php } ?>
			<img src="<?php echo $avatar ?>" alt="<?php echo SESSION("ZanUser"); ?>" class="avatar" />
		</div>

	</section>
	<div id="posts">
		<strong><?php echo __("Recent posts");?></strong>
	</div>
</div>
