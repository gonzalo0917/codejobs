<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>


<div class="full-container">
	<div class="h-link">
		<a name="image" href="<?php echo $picture["home"];?>/#top" title="<?php echo __("Gallery"); ?>"><?php echo __("Gallery"); ?></a>
	</div>

	<?php
		if($count > 1) { 
	?>
			<div class="np-links">
				<a id="previous" href="<?php echo $picture["prev"];?>" title="<?echo __("Previous"); ?>"><?php echo __("Previous"); ?></a>
				<a id="next" href="<?php echo $picture["next"];?>" title="<?echo __("Next"); ?>"><?php echo __("Next"); ?></a>
				<br />
			</div>
	<?php 
		} 
	?>
	
	<div class="clear"></div>
	
	<div id="gallery-content">
	<?php 
		if($count > 1) { 
	?>
			<a id="next" href="<?php echo $picture["next"];?>">
				<img class="images-view" src="<?php echo $picture["Original"];?>" alt="<?php echo $picture["Title"];?>" />
			</a>
	<?php 
		} else { 
	?>
			<img class="images-view" src="<?php echo $picture["Original"];?>" alt="<?php echo $picture["Title"];?>" />
	<?php 
		} 
	?>
	</div>
	
	<div class="images-description">
		<span><?php echo $picture["Description"];?></span>
	</div>
	
	<br/>
	
	<div class="info-images">
		<span class="images-title"><?php echo __("Album"); ?>:</span><br />
		
		<div class="general-links">
		<?php 
			if($picture["Album"] !== "None") { 
		?>
				<a href="<?php echo $picture["back"] . "/#top";?>" title="<?php echo $picture["Album"];?>"><?php echo $picture["Album"];?></a>
		<?php 	
			} else {
		?>
			<a href="<?php echo $picture["home"] ."/";?>" title="<?php echo __("None"); ?>"><?php echo __("None"); ?></a>
		<?php 
			} 
		?>	
		</div>
	</div>
</div>

<br/><br/><br/>