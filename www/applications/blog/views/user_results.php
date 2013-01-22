<?php 
	if(!defined("_access")) die("Error: You don't have permission to access here..."); 

	$total = count($records);
?>
<p class="resalt">
	<?php echo $caption; ?>
</p>

<?php
	if($total > 0) {
?>

<input class="btn" name="add" onclick="javascript:location.href='../../add/'; return false;" value="Agregar registro" type="submit" />
<input class="btn btn-danger" onclick="javascript:return confirm(\'¿Deseas eliminar los registros seleccionados?\')" name="delete" value="Eliminar" type="submit" />

Buscar: <input type="span1" name="search"> <input type="submit" class="btn btn-info" value="<?php echo __("Search"); ?>">

<?php
	}
?>

<br /><br />

<table class="results table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width: 20px;"><input id="records" name="records[]" value="3" type="checkbox"></th>
			<th><?php echo __("Title"); ?></th>
			<th style="width: 100px;"><?php echo __("Views"); ?></th>
			<th style="width: 100px;"><?php echo __("Language"); ?></th>
			<th style="width: 100px;"><?php echo __("Situation"); ?></th>
			<th style="width: 70px;"><?php echo __("Action"); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($total > 0) {
				foreach($records as $column) {
		?>
		<tr>
			<td data-center><input id="records" name="records[]" value="3" type="checkbox"></td>
			<td><?php echo $column["Title"]; ?></td>
			<td data-center><?php echo $column["Views"]; ?></td>
			<td data-center><?php echo getLanguage($column["Language"], TRUE); ?></td>
			<td data-center><?php echo __($column["Situation"]); ?></td>
			<td data-center>
				<a href="#" title="<?php echo __("Edit"); ?>" onclick="return confirm('¿Deseas editar el registro?')"><span class="tiny-image tiny-edit">&nbsp;&nbsp;&nbsp;</span></a>
				<a href="#" title="<?php echo __("Delete"); ?>" onclick="return confirm('¿Deseas enviar el registro a la papelera?')"><span class="tiny-image tiny-delete">&nbsp;&nbsp;&nbsp;</span></a>
			</td>
		</tr>
		<?php
				}
			} else {

			}
		?>
	</tbody>
</table>