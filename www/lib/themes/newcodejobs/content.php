	<?php 
		if(segment(0, isLang()) === "forums") {
			$style = ' style="width: 1000px;"';
		} elseif((segment(0, isLang()) === "codes" or segment(0, isLang()) === "blog") and segment(1, isLang()) === "add") {
			$style = ' style="width: 1000px;"';
		} else {
			$style = NULL;
		}
	?>

	<div id="content"<?php echo $style; ?>>
		<?php $this->load(isset($view) ? $view : NULL, TRUE); ?>
	</div>