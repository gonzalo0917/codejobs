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
				<a class="username" href="<?php echo getURL(); ?>"><?php echo $user["Username"]; ?></a>
			</div>
			<?php if ($user["Name"]) { ?>
			<div class="fullname header">
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
			<div class="gender-country">
				<div class="gender">
					<?php if ($user["Gender"] === 'F') { ?>
					<span class="gender-icon female-icon"></span> <?php echo __("Woman"); } else { ?>
					<span class="gender-icon"></span> <?php echo __("Man"); } ?>
				</div>
				<div class="country">
					<?php echo getFlag($user["Country"]); ?> &nbsp;<?php echo __($user["Country"]); ?>
				</div>
			</div>
			<?php if (!empty($user["Twitter"]) or !empty($user["Facebook"]) or !empty($user["Linkedin"]) or !empty($user["Google"]) or !empty($user["Viadeo"])) { ?>
			<div class="social">
				<?php if (!empty($user["Twitter"])) { ?>
				<a href="http://twitter.com/<?php echo $user["Twitter"]; ?>" target="_blank">
					<div class="social-btn twitter-social-btn"></div>
				</a>
				<?php } ?>
				<?php if (!empty($user["Facebook"])) { ?>
				<a href="http://facebook.com/<?php echo $user["Facebook"]; ?>" target="_blank">
					<div class="social-btn facebook-social-btn"></div>
				</a>
				<?php } ?>
				<?php if (!empty($user["Linkedin"])) { ?>
				<a href="http://linkedin.com/in/<?php echo $user["Linkedin"]; ?>" target="_blank">
					<div class="social-btn linkedin-social-btn"></div>
				</a>
				<?php } ?>
				<?php if (!empty($user["Google"])) { ?>
				<a href="https://profiles.google.com/<?php echo $user["Google"]; ?>" target="_blank">
					<div class="social-btn google-social-btn"></div>
				</a>
				<?php } ?>
				<?php if (!empty($user["Viadeo"])) { ?>
				<a href="http://viadeo.com/en/profile/<?php echo $user["Viadeo"]; ?>" target="_blank">
					<div class="social-btn viadeo-social-btn"></div>
				</a>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
		<div class="information">
			<div class="date">
				<?php echo __("Member since") ." ". howLong($user["Start_Date"]); ?>
			</div>
			<div class="counter">
				<div>
					<?php if ($user["Posts"] > 0) { ?>
					<a href="<?php echo path("blog/author/". $user["Username"]); ?>"><?php echo "<strong>". $user["Posts"] ."</strong>". __(" posts"); ?></a>
					<?php } else {
						echo "<strong>0</strong>". __(" posts");
					} ?>
				</div>
				<div>
					<?php if ($user["Codes"] > 0) { ?>
					<a href="<?php echo path("codes/author/". $user["Username"]); ?>"><?php echo "<strong>". $user["Codes"] ."</strong>". __(" codes"); ?></a>
					<?php } else {
						echo "<strong>0</strong>". __(" codes");
					} ?>
				</div>
				<div>
					<?php if ($user["Bookmarks"] > 0) { ?>
					<a href="<?php echo path("bookmarks/author/". $user["Username"]); ?>"><?php echo "<strong>". $user["Bookmarks"] ."</strong>". __(" bookmarks"); ?></a>
					<?php } else {
						echo "<strong>0</strong>". __(" bookmarks");
					} ?>
				</div>
			</div>
			<div class="credits">
				<div>
					<strong><?php echo $user["Credits"]; ?></strong> <?php echo __("credit points"); ?>
				</div>
				<div>
					<strong><?php echo $user["Recommendation"]; ?></strong> <?php echo __("recommendation points"); ?>
				</div>
			</div>
		</div>
	</section>
	<div id="posts">
		<div class="header subtitle"><?php echo __("Recent posts");?></div>
		<?php
			if (empty($posts)) {
		?>
		<div>
			<?php echo __("No posts"); ?>
		</div>
		<?php
			} else {
				foreach ($posts as $post) {
		?>
		<div class="post">
			<strong><?php echo $post["Title"]; ?></strong>
			<div><?php echo __("Published") ." ". howLong($post["Start_Date"]); ?></div>
			<div><?php echo $post["Content"]; ?></div>
		</div>
		<?php
				}
			}
		?>
		<div class="header subtitle"><?php echo __("Recent codes"); ?></div>
	</div>
</div>
