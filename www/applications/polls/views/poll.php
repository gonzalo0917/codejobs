<?php
	if(isset($special)) {
		$width = "500px;";
	?>
		<div class="polls" style="width: 225px; margin-top: -50px; border:1px solod #000;">
	<?php
	} else {
		$width = "250px;";
	?>
		<div class="polls" style="width: 225px; margin: 0 auto; border:1px solod #000;">
	<?php
	}	

	if(isset($poll["answers"])) {
		if(!COOKIE("ZanPoll") and !$results) {
			$URL = path("polls/". $poll["question"]["ID_Poll"] ."/". slug($poll["question"]["Title"]));
			?>
				<form id="polls" method="post" action="<?php echo path("polls/vote"); ?>">			
					<p style="text-align: center; width: <?php echo $width; ?>">
						<h3 style="width: <?php echo $width; ?>"><a href="<?php echo $URL; ?>"><?php echo $poll["question"]["Title"]; ?></a></h3>
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
					<input name="URL" type="hidden" value="<?php echo $URL; ?>" />			
				  
					<label for="send-vote">
						<input id="send-vote" name="send" type="submit" value="<?php echo __("Vote");?>" class="poll-submit" />
						<input id="results" name="results" type="submit" value="<?php echo __("Results");?>" class="poll-submit" />
					</label>
				</form>
			<?php
		} else {
			if(isset($poll)) {
				$total = 0;
				$URL = path("polls/". $poll["question"]["ID_Poll"] ."/". slug($poll["question"]["Title"]));

				foreach($poll["answers"] as $answers) {
					$total = (int) ($total + $answers["Votes"]);
				}
				
				?>
					<p class="section">					
						<p style="text-align: center; width: <?php echo $width; ?>">
							<h3 style="width: <?php echo $width; ?>"><a href="<?php echo $URL; ?>"><?php echo $poll["question"]["Title"]; ?></a></h3>
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
							
							$show = ($total === 1) ? '1 ' . __("_vote") : $total .' '. __("votes");
						?>
						
						<br />
						<span style="font-size: 12px;"><strong><?php echo __("Total");?>:</strong> <?php echo $show; ?></span>
					</p>
					<?php
			}
		}
	}
?>
</div>
<br />

<?php 
	if(_get("domain")) {
	?>
		<p>
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-4006994369722584";
				/* CodeJobs.biz */
				google_ad_slot = "1672839256";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</p>
	<?php
	}
					
	if(isset($special)) {
	?>
		<div class="fb-comments" data-href="<?php echo $URL; ?>" data-num-posts="2" data-width="750"></div>
	<?php
	}