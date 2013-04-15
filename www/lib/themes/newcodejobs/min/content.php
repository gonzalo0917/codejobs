	<?php 
		$app = segment(0, isLang());

		if ($app === "forums") {
			$style = ' style="width: 1000px;"';
		} elseif (($app === "codes" or $app === "blog") and segment(1, isLang()) === "add") {
			$style = ' style="width: 1000px;"';
		} else {
			$style = null;
		}


		if ($app === "users") { ?>
			<div id="contentUsers">
		<?php } else { ?>
			<div id="content"<?php echo $style; ?>>
		<?php }
			if (segment(0, isLang()) === "live" or segment(0, isLang()) === "forums") {
				echo display('<div style="width: 728px; margin-left: 115px;">'. getAd("728px") .'</div>', 4);
			} else {
				echo display('<p>'. getAd("728px") .'</p>', 4);
			}
		
		$this->load(isset($view) ? $view : null, true); ?>
	</div>