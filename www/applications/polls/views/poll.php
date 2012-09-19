<div style="width: 225px; margin: 0 auto; border:1px solod #000;">
<?php	
	if(isset($poll["answers"])) {
		if(!COOKIE("ZanPoll")) {
			?>
				<form id="polls" method="post" action="<?php echo path("polls/vote"); ?>">			
					<p style="text-align: center; width: 250px;">
						<h3><?php echo $poll["question"]["Title"]; ?></h3>
					</p>
							
					<?php 
						$i = 1; 
						
						foreach($poll["answers"] as $answer) {
							echo '	<label for="answer_'. $i .'" style="font-size: 12px;">
										<input id="answer_'. $i .'" name="answer" type="radio" value="'. $answer["ID_Answer"] .'"/> '. $answer["Answer"] .'<br />
									</label>';
							$i++;
						}
					?>
					
					<input name="ID_Poll" type="hidden" value="<?php echo $poll["question"]["ID_Poll"]; ?>" /><br />
				  
					<label for="send-vote">
						<input id="send-vote" name="send" type="submit" value="<?php echo __("Vote");?>" class="poll-submit" />
					</label>
				</form>
			<?php
		} else {
			if(isset($poll)) {
				$total = 0;
		
				foreach($poll["answers"] as $answers) {
					$total = (int) ($total + $answers["Votes"]);
				}
				
				?>
					<p class="section">					
						<p style="text-align: center; width: 250px;">
							<h3><?php echo $poll["question"]["Title"]; ?></h3>
						</p>
					
						<?php 
							$i = 0;
							$percentage = 0;
							
							foreach($poll["answers"] as $answers) {
								if((int) $answers["Votes"] > 0) {								
									$percentage = ($answers["Votes"] * 100) / $total;
									
									if($percentage >= 10) {
										$percentage = substr($percentage, 0, 5);
									} else {
										$percentage = substr($percentage, 0, 4);
									}
								}			

								if($percentage == 0) {
									$color = "transparent";
								} else {
									$color = "#3478E3";
								}

								$style = "width: ". intval($percentage) ."%; background-color: ". $color .";";
						?>
								
								<span style="margin-left:5px; font-size: 12px;"><?php echo $answers["Answer"]; ?> (<?php echo $percentage; ?>%)</span> <br />
								
								<div class="poll-graphic" style="background-color: #EEE; width: 250px; border: 1px solid <?php echo $color[$i]; ?>; padding: 2px;">
									<div style="<?php echo $style; ?>">&nbsp;</div>
								</div>
								
						<?php
								$i++;
								
								$percentage = 0;
							}
							
							$show = ($total === 1) ? '1 ' . __("vote") : $total .' '. __("votes");
						?>
						
						<br />
						<strong style="font-size: 12px;"><?php echo __("Total");?>:</strong> <?php echo $show; ?>
					</p>
					<?php
			}
		}
	}
?>
</div>
<br />