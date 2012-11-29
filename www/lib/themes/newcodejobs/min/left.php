<?php
	if(defined("_showLeft") and segment(0, isLang()) === "users" and segment(1, isLang()) === "edit") {
		switch(segment(2, isLang())) {
			case "avatar": case "password": case "options": case "privacity": case "social": case "email":
				$active = segment(2, isLang());
			break;

			default:
				$active = "about";
		}
?>
		<aside class="left">
			<div class="well" style="padding: 8px 0px">
			    <ul class="nav nav-list">
				    <li<?php echo $active === "about" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/about/"); ?>"><?php echo __("About me"); ?></a>
				    </li>
				    <li<?php echo $active === "password" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/password/"); ?>"><?php echo __("Password");?></a>
				    </li>
				    <li<?php echo $active === "email" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/email/"); ?>"><?php echo __("E-mail");?></a>
				    </li>
				    <li<?php echo $active === "avatar" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/avatar/"); ?>"><?php echo __("Avatar");?></a>
				    </li>
				    <li<?php echo $active === "options" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/options/"); ?>"><?php echo __("Options");?></a>
				    </li>
				    <li<?php echo $active === "privacity" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/privacity/"); ?>"><?php echo __("Privacity");?></a>
				    </li>
				    <li<?php echo $active === "social" ? ' class="active"' : ''; ?>>
				    	<a href="<?php echo path("users/edit/social/"); ?>"><?php echo __("Social networks");?></a>
				    </li>
			    </ul>
			</div>
		</aside>
<?php
	}