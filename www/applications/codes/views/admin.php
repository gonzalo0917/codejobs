<?php 
if(!defined("_access")) die("Error: You don't have permission to access here..."); 

$application 	= ucfirst(whichApplication());
$caption 		= __("My ". $application);
$colspan		= 5;
$colors[0] 		= _color1;
$colors[1] 		= _color2;
$colors[2] 		= _color3;
$colors[3]		= _color4;
$colors[4] 		= _color5;	
$i 				= 0;
$j 				= 2;

?>
<table id="results" class="results">
	<caption class="caption">
		<span class="bold"><?php echo $caption; ?></span>
	</caption>
					
	<thead>
		<tr>
			<th>No.</th>
			<th><?php echo __("Title"); ?></th>
			<th><?php echo __("Views"); ?></th>
			<th><?php echo __("Language"); ?></th>
			<th><?php echo __("Situation"); ?></th>
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
		if(count($tFoot) > 0) {
			$nro = 0;
			foreach($tFoot as $column) {
				$nro++;
				$color = $colors[$i];
				
				$i = ($i === 1) ? 0 : 1;
				$j = ($j === 3) ? 2 : 3;
				?>
				<tr style="background-color: <?php echo $color; ?>">
					<td class="center">
						<?php echo $nro; ?>
					</td>
																				
					<td class="anchor_title">
                        <a href="<?php echo path("codes/{$column["ID_Code"]}/{$column["Slug"]}"); ?>" target="_blank">
                            <?php			
                                echo cut($column["Title"], 4, "text");
                            ?>
                        </a>
					</td>
	
					<td class="center">
						<?php echo $column["Views"]; ?>
					</td>
					
					<td class="center">
						<?php echo getLanguage($column["Language"], TRUE); ?>
					</td>

					<td class="center">
						<?php echo __($column["Situation"]); ?>
					</td>

	 			</tr>
	 		<?php
	 		}
	 	} else {
	 		?>
	 		<tr style="background-color: <?php echo $colors[$i]; ?>">
				<td colspan="<?php echo $colspan; ?>">
					<?php echo __("You still have not published a code"); ?>. <a href="<?php echo path("codes/add"); ?>"><?php echo __("Publish a code"); ?></a>
				</td>
			</tr>
			<?php
	 	}
	 	?>                     
	</tbody> 
</table>