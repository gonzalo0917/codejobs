<?php 
if(!defined("_access")) die("Error: You don't have permission to access here..."); 

$application = ucfirst(whichApplication());
$caption = __("Manage languages");
$colspan = 6;

//echo $search;
echo formOpen(path("codes/cpanel/languages"), "form-results-search");

$colors[0] = _color1;
$colors[1] = _color2;
$colors[2] = _color3;
$colors[3] = _color4;
$colors[4] = _color5;		

$i = 0;	
?>		
<table id="results" class="results">
	<caption class="caption">
		<span class="bold"><?php echo $caption; ?></span>
	</caption>
					
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>ID</th>
			<th><?php echo __("Name"); ?></th>
			<th><?php echo "MIME"; ?></th>
			<th><?php echo __("Filename"); ?></th>
			<th><?php echo __("Extension"); ?></th>
		</tr>
	</thead>
					
	<tfoot>
		<tr>
			<td class="center" colspan="<?php echo $colspan; ?>">
				<span class="bold"><?php echo __("Total"); ?>:</span> <?php echo $total; ?>
			</td>
		</tr>
	</tfoot>		  
		
	<tbody>		
	<?php
		if($tFoot) {
			foreach($tFoot as $column) {
				$ID = $column["ID_Syntax"];
				$color = $colors[$i];
				
				$i = ($i === 1) ? 0 : 1;
				?>
				<tr style="background-color: <?php echo $color; ?>">		
					<td class="center">
						<?php echo getCheckbox($ID); ?>
					</td>
								
					<td class="center">
						<?php echo $ID; ?>
					</td>
																				
					<td>
	                    <?php echo $column["Name"]; ?>
					</td>
								
					<td>
						<?php echo $column["MIME"]; ?>
					</td>
	
					<td>
						<?php echo $column["Filename"]; ?>
					</td>
					
					<td>
						<?php echo $column["Extension"]; ?>
					</td>
	 			</tr>
	 		<?php
	 		}
	 	}
	 	?>                     
	</tbody>            
</table>
		
<div class="table-options" style="position: relative; z-index: 1; margin-bottom: 25px;">
	<?php echo __("Select"); ?>: <br />
	
	<a onclick="checkAll('records')" class="pointer" title="<?php echo __("All"); ?>"><?php echo __("All"); ?></a> |
	<a onclick="unCheckAll('records')" class="pointer" title="<?php echo __("None"); ?>"><?php echo __("None"); ?></a><br /><br />
	
	<input class="btn" onclick="$('form').attr('action', '<?php echo path("codes/cpanel/language"); ?>');" name="add" value="<?php echo __("Add"); ?>" type="submit" class="small-input" />
	<input class="btn" onclick="$('form').attr('action', '<?php echo path("codes/cpanel/language"); ?>');" name="edit" value="<?php echo __("Edit"); ?>" type="submit" class="small-input" />
	<input class="btn btn-danger" onclick="javascript:return confirm('<?php echo __("Do you want to delete the records?"); ?>')" name="delete" value="<?php echo __("Delete"); ?>" type="submit" class="small-input" />
					
</div>

<?php
	echo formClose();
?>