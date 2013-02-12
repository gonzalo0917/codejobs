<?php 
if(!defined("ACCESS")) die("Error: You don't have permission to access here..."); 

$caption = __("Manage Works");
$colspan = 8;

echo $search;

$colors[0] = COLOR1;
$colors[1] = COLOR2;
$colors[2] = COLOR3;
$colors[3] = COLOR4;
$colors[4] = COLOR5;		

$i = 0;
$j = 2;	
?>		
<table id="results" class="results">
	<caption class="caption">
		<span class="bold"><?php echo $caption; ?></span>
	</caption>
					
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>ID</th>
			<th><?php echo __("Title"); ?></th>
			<th><?php echo __("URL"); ?></th>
			<th><?php echo __("Image"); ?></th>
			<th><?php echo __("Preview1"); ?></th>
			<th><?php echo __("Preview2"); ?></th>
			<th><?php echo __("Situation"); ?></th>
			<th><?php echo __("Action"); ?></th>
		</tr>
	</thead>
					
	<tfoot>
		<tr>
			<td colspan="<?php echo $colspan; ?>">
				<span class="bold"><?php echo __("Total"); ?>:</span> <?php echo $total; ?>
			</td>
		</tr>
	</tfoot>		  
		
	<tbody>		
	<?php
		if($tFoot) {
			foreach($tFoot as $column) {     
				$ID    = $column["ID_Work"];
				$color = ($column["Situation"] === "Deleted") ? $colors[$j] : $colors[$i];  

				$i = ($i === 1) ? 0 : 1;
				$j = ($j === 3) ? 2 : 3;
				?>
				<tr style="background-color: <?php echo $color; ?>">		
					<td class="center">
						<?php echo getCheckbox($ID); ?>
					</td>
								
					<td class="center">
						<?php echo $ID; ?>
					</td>

					<td>
					<?php			
						$title = cut($column["Title"], 4, "text"); 

						echo $title; 
					?>
					</td>
								
					<td class="center">
						<?php echo $column["URL"]; ?>
					</td>
					
					<?php
						if($column["Image"] !== "") { 				
						?>
							<td class="center">
								<a href="<?php echo path($column["Image"], TRUE); ?>" title="Image" class="banner-lightbox">
									<?php echo __("Preview"); ?>
								</a>
							</td>
						<?php
						} else {
						?>				
							<td class="center">
								<?php echo __("Preview"); ?>
							</td>
						<?php
						}
					
					?>

					<?php
						if($column["Preview1"] !== "") { 				
						?>
							<td class="center">
								<a href="<?php echo path($column["Preview1"], TRUE); ?>" title="Imagen 1" class="banner-lightbox">
									<?php echo __("Preview"); ?>
								</a>
							</td>
						<?php
						} else {
						?>				
							<td class="center">
								<?php echo __("Imagen 1"); ?>
							</td>
						<?php
						}
					
					?>

					<?php
						if($column["Preview2"] !== "") { 				
						?>
							<td class="center">
								<a href="<?php echo path($column["Preview2"], TRUE); ?>" title="Imagen 2" class="banner-lightbox">
									<?php echo __("Preview"); ?>
								</a>
							</td>
						<?php
						} else {
						?>				
							<td class="center">
								<?php echo __("Imagen 2"); ?>
							</td>
						<?php
						}
					
					?>

					<td class="center">
						<?php echo __($column["Situation"]); ?>
					</td>
												 
					<td class="center">
					<?php 
						if($column["Situation"] === "Deleted") {					
							echo getAction(TRUE, $ID);
						} else {					
							echo getAction(FALSE, $ID);
						}
					?>
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
	
	<a onclick="javascript:checkAll('records')" class="pointer" title="<?php echo __("All"); ?>"><?php echo __("All"); ?></a> |
	<a onclick="javascript:unCheckAll('records')" class="pointer" title="<?php echo __("None"); ?>"><?php echo __("None"); ?></a><br /><br />
	
	<?php				
	if(segment(3, isLang()) === "trash") { 
	?>
		<input class="btn btn-success" onclick="javascript:return confirm(\'<?php echo __("Do you want to restore the records?"); ?>\')" name="restore" value="<?php echo __("Restore"); ?>" type="submit" class="small-input" />
		<input class="btn btn-danger" onclick="javascript:return confirm(\'<?php echo __("Do you want to delete the records?"); ?>\')" name="delete" value="<?php echo __("Delete"); ?>" type="submit" class="small-input" />
	<?php
	} else { 
	?>
		<input class="btn btn-warning" onclick="javascript:return confirm(\'<?php echo __("Do you want to send to trash the records?"); ?>\')" name="trash" value="<?php echo __("Send to trash"); ?>" type="submit" class="small-input" />
	<?php
	}
	?>					
</div>

<?php echo $pagination;?>
