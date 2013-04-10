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
			<header class="top">
				    <ul class="nav nav-pills">
					    <li<?php echo $active === "cv" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/cv/"); ?>"><?php echo __("Update Resume");?></a>
					    </li>
					    <li<?php echo $active === "password" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/password/"); ?>"><?php echo __("Password");?></a>
					    </li>
					    <!-- <li<?php echo $active === "options" ? ' class="active"' : ''; ?>>
					    	<a href="<?php echo path("users/options/"); ?>"><?php echo __("Options");?></a>
					    </li> -->
				    </ul>
				</div>
			</header>
			<?php
		}
	}
?>