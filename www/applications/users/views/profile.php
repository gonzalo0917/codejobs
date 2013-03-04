<?php
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}
?>
<div class="editProfile">
	<aside class="left">
		<?php
			if (substr(SESSION("ZanUserAvatar"), 0, 4) === "http") {
				$avatar = SESSION("ZanUserAvatar");
			} else {
				$avatar = path("www/lib/files/images/users/". SESSION("ZanUserAvatar"), true);
			}
		?>
		<div class="center">
			<div>
				<a href="#"><?php echo $user["Username"]; ?></a>
			</div>
			<img src="<?php echo $avatar ?>" alt="<?php echo SESSION("ZanUser"); ?>" class="avatar" />
		</div>

	</aside>
	<div id="posts">
		<strong><?php echo __("Recent posts");?></strong>
	</div>
</div>
