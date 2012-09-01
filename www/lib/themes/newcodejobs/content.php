	<?php $style = segment(0, isLang()) === "forums" ? ' style="width: 1000px;"' : NULL; ?>

	<div id="content"<?php echo $style; ?>>
		<?php $this->load(isset($view) ? $view : NULL, TRUE); ?>
	</div>