<?php 
	if(!defined("_access")) die("Error: You don't have permission to access here..."); 

	if(is_array($records)) {
		$count = count($records);
	} else {
		$count = 0;
	}
?>
<p class="resalt">
	<?php echo $caption; ?>
</p>

<p id="subtitle" style="display: none">
	<?php echo __("Results for"); ?> <span id="query"></span> <a href="#" id="clear" title="<?php echo __("Clear results"); ?>" class="tiny-image tiny-back no-decoration">&nbsp;</a>
</p>

<form>
	<div class="container full-container" <?php echo $count > 0 ? "" : 'style="margin-bottom:20px"'; ?>>
		<div class="pull-left">
			<a id="new" class="btn no-decoration black-a" href="<?php echo $path ."add"; ?>"><?php echo __("New"); ?></a>
			<?php
				if($count > 0) {
			?>
			<a id="delete" class="btn btn-danger no-decoration white-a" href="#"><?php echo __("Delete"); ?></a>
			<?php
				}
			?>
		</div>
		<?php
			if($count > 0) {
		?>
		<div class="pull-right">
			<form class="form-search">
			    <input id="search-input" type="text" class="input-medium search-query" placeholder="<?php echo __("Search"); ?>..." />
			</form>
		</div>
		<?php
			}
		?>
	</div>

	<table class="results table table-bordered table-striped">
		<thead>
			<tr>
				<th style="width: 20px;"><input id="records" type="checkbox" title="<?php echo __("Select all"); ?>" /></th>
				<th data-field="Title"><a href="#"><?php echo __("Title"); ?></a></th>
				<th style="width: 70px;" data-field="Views"><a href="#"><?php echo __("Views"); ?></a></th>
				<th style="width: 100px;"><?php echo __("Language"); ?></th>
				<th style="width: 70px;"><?php echo __("Situation"); ?></th>
				<th data-order="DESC" style="width: 120px;" data-field="<?php echo $ID_Column; ?>"><a href="#"><?php echo __("Published"); ?></a></th>
				<th style="width: 70px;"><?php echo __("Action"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($count > 0) {
					foreach($records as $column) {
						$URL  	   = $path . $column[$ID_Column] ."/". $column["Slug"];
						$text_date = ucfirst(howLong($column["Start_Date"]));
			?>
			<tr>
				<td data-center><input name="records[]" value="<?php echo $column[$ID_Column]; ?>" type="checkbox" /></td>
				<td><a title="<?php echo $column["Title"]; ?>" href="<?php echo $URL; ?>" target="_blank"><?php echo $column["Title"]; ?></a></td>
				<td data-center><?php echo $column["Views"]; ?></td>
				<td data-center><?php echo getLanguage($column["Language"], TRUE); ?></td>
				<td data-center><?php echo __($column["Situation"]); ?></td>
				<td data-center title="<?php echo $text_date; ?>"><?php echo $text_date; ?></td>
				<td data-center>
					<a href="<?php echo $path ."add/". $column[$ID_Column]; ?>" title="<?php echo __("Edit"); ?>" class="tiny-image tiny-edit no-decoration">&nbsp;&nbsp;&nbsp;</a>
					<a href="#" title="<?php echo __("Delete"); ?>" class="tiny-image tiny-delete no-decoration">&nbsp;&nbsp;&nbsp;</a>
				</td>
			</tr>
			<?php
					}
				} else {
			?>
			<tr>
				<td data-center class="no-data" colspan="7"><?php echo __("You still have not published a code"); ?></td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>

	<p style="text-align: center">
		<a id="more" disabled class="btn no-decoration" <?php echo (($count < $total and $count > 0) ? '' : 'style="display:none"'); ?>>Cargando...</a>
	</p>

	<input type="hidden" id="order-desc" value="<?php echo __("Sort descending"); ?>">
	<input type="hidden" id="order-asc" value="<?php echo __("Sort ascending"); ?>">
	<input type="hidden" id="delete-question" value="<?php echo __("Do you want to delete the records"); ?>">
	<input type="hidden" id="delete-empty-question" value="<?php echo __("You must select at least one record"); ?>">
	<input type="hidden" id="deleting-question" value="<?php echo __("Do you want to delete the record?"); ?>">
	<input type="hidden" id="count" value="<?php echo $count; ?>">
	<input type="hidden" id="total" value="<?php echo $total; ?>">
	<input type="hidden" id="edit-label" value="<?php echo __("Edit"); ?>">
	<input type="hidden" id="delete-label" value="<?php echo __("Delete"); ?>">
	<input type="hidden" id="no-results" value="<?php echo __("No records were found"); ?>">
	<input type="hidden" id="ajax-error" value="<?php echo __("An error has occurred"); ?>">

</form>

<div id="table-shadow"></div>