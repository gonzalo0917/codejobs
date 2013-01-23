<?php 
	if(!defined("_access")) die("Error: You don't have permission to access here..."); 

	$count = count($records);
?>
<p class="resalt">
	<?php echo $caption; ?>
</p>

<?php
	if($count > 0) {
?>
<form>
	<div class="container full-container">
		<div class="pull-left">
			<a id="new" class="btn no-decoration black-a" href="<?php echo path("blog/add"); ?>"><?php echo __("New"); ?></a>
			<a id="delete" class="btn btn-danger no-decoration white-a" href="#"><?php echo __("Delete"); ?></a>
		</div>
		<div class="pull-right">
			<form class="form-search">
			    <input type="text" class="input-medium search-query" />
			    <button type="submit" class="btn"><?php echo __("Search"); ?></button>
			</form>
		</div>
	</div>
	<?php
		}
	?>

	<table class="results table table-bordered table-striped">
		<thead>
			<tr>
				<th style="width: 20px;"><input id="records" type="checkbox" title="<?php echo __("Select all"); ?>" /></th>
				<th ><a href="#"><?php echo __("Title"); ?></a></th>
				<th style="width: 70px;"><a href="#"><?php echo __("Views"); ?></a></th>
				<th style="width: 70px;"><?php echo __("Language"); ?></th>
				<th style="width: 70px;"><a href="#"><?php echo __("Situation"); ?></a></th>
				<th data-order="DESC" style="width: 120px;"><a href="#"><?php echo __("Published"); ?></a></th>
				<th style="width: 70px;"><?php echo __("Action"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($count > 0) {
					foreach($records as $column) {
						$URL  	   = path("blog/". $column["Year"] ."/". $column["Month"] ."/". $column["Day"] ."/". $column["Slug"]);
						$text_date = ucfirst(howLong($column["Start_Date"]));
			?>
			<tr>
				<td data-center><input name="records[]" value="<?php echo $column["ID_Post"]; ?>" type="checkbox" /></td>
				<td><a href="<?php echo $URL; ?>" target="_blank"><?php echo $column["Title"]; ?></a></td>
				<td data-center><?php echo $column["Views"]; ?></td>
				<td data-center><?php echo getLanguage($column["Language"], TRUE); ?></td>
				<td data-center><?php echo __($column["Situation"]); ?></td>
				<td data-center title="<?php echo $text_date; ?>"><?php echo $text_date; ?></td>
				<td data-center>
					<a href="#" title="<?php echo __("Edit"); ?>" class="tiny-image tiny-edit no-decoration" onclick="return confirm('¿Deseas editar el registro?')">&nbsp;&nbsp;&nbsp;</a>
					<a href="#" title="<?php echo __("Delete"); ?>" class="tiny-image tiny-delete no-decoration" onclick="return confirm('¿Deseas enviar el registro a la papelera?')">&nbsp;&nbsp;&nbsp;</a>
				</td>
			</tr>
			<?php
					}
				} else {

				}
			?>
		</tbody>
	</table>

	<p style="text-align: center">
		<a id="more" disabled class="btn no-decoration">Cargando...</a>
	</p>

	<input type="hidden" id="order-desc" value="<?php echo __("Sort descending"); ?>">
	<input type="hidden" id="order-asc" value="<?php echo __("Sort ascending"); ?>">
	<input type="hidden" id="delete-question" value="<?php echo __("Do you want to delete the records"); ?>">
	<input type="hidden" id="count" value="<?php echo $count; ?>">
	<input type="hidden" id="total" value="<?php echo $total; ?>">
	<input type="hidden" id="main-url" value="<?php echo path("blog/users/"); ?>">

</form>