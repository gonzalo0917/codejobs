<?php
	if (defined("SHOW_LEFT")) {
		if (SESSION("ZanUser")) {
			switch (segment(1, isLang())) {
				case "password": case "options": case "cv":
					$active = segment(1, isLang());
					break;
				default:
					$active = "cv";
			}
			?>
			<aside class="left">
				<div class="well" style="padding: 8px 0px">
				    <ul class="nav nav-list">
					    <!-- <li<?php echo $active === "about" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/about/"); ?>"><?php echo __("About me"); ?></a>
					    </li> -->
					    <li<?php echo $active === "password" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/password/"); ?>"><?php echo __("Password");?></a>
					    </li>
					   <!--  <li<?php echo $active === "email" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/email/"); ?>"><?php echo __("E-mail");?></a>
					    </li> -->
					    <li<?php echo $active === "cv" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/cv/"); ?>"><?php echo __("Update Resume");?></a>
					    </li>
					    <!-- <li<?php echo $active === "avatar" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/avatar/"); ?>"><?php echo __("Avatar");?></a>
					    </li> -->
					    <li<?php echo $active === "options" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/options/"); ?>"><?php echo __("Options");?></a>
					    </li>
					    <!-- <li<?php echo $active === "social" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/social/"); ?>"><?php echo __("Social networks");?></a>
					    </li> -->
				    </ul>
				</div>
			</aside>
			<?php
		}
	}