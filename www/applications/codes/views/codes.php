<?php
    if(!defined("_access")) {
        die("Error: You don't have permission to access here...");
    }
    
    $this->CSS("codes_", "codes", TRUE);
?>
<div class="codes">
	<?php 
		$i = 1;
		$rand1 = rand(1, 5);
		$rand2 = rand(6, 10);

		foreach($codes as $code) { 
			if($code["Situation"] === "Active") {
				$URL = path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);				
			} else {
				$URL = path("codes/author/". $code["Author"] ."/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);				
			}
	?>
			<h2>
				<?php echo getLanguage($code["Language"], TRUE); ?> <a href="<?php echo $URL; ?>" title="<?php echo $code["Title"]; ?>"><?php echo $code["Title"]; ?></a>
			</h2>

			<span class="small italic grey">
				<?php 
					echo __("Published") ." ". howLong($code["Start_Date"]) ." ". __("by") .' <a title="'. $code["Author"] .'" href="'. path("users/". $code["Author"]) .'">'. $code["Author"] .'</a> '; 
					 
					if($code["Languages"] !== "") {
						echo __("in") ." ". exploding(implode(", ", array_map("strtolower", explode(", ", $code["Languages"]))), "codes/language/");
					}
				?>			
				<br />

				<?php 
					echo '<span class="bold">'. __("Likes") .":</span> ". (int) $code["Likes"]; 
					echo ' <span class="bold">'. __("Dislikes") .":</span> ". (int) $code["Dislikes"];
					echo ' <span class="bold">'. __("Views") .":</span> ". (int) $code["Views"];
				?>
			</span>

			<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_tweet" tw:via="codejobs" addthis:title="#Code <?php echo $code["Title"]; ?>" tw:url="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]); ?>"></a>
			</div>

			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-5026e83358e73317"></script>					                     

			<?php
				if($code["Description"] !== "") {
					echo str_replace("\\", "", htmlTag("p", showLinks($code["Description"])));
				}

			?>

            <p>
            	<textarea name="code" data-syntax="<?php echo $code["File"]["ID_Syntax"];?>"><?php echo stripslashes(linesWrap($code["File"]["Code"])); ?></textarea>
            </p>

			<?php 
				if(SESSION("ZanUser")) { 
			?>
					<p class="small italic">
						<?php
                            echo like($code["ID_Code"], "codes", $code["Likes"]) . " " . dislike($code["ID_Code"], "codes", $code["Dislikes"]) . " " . report($code["ID_Code"], "codes");
                        ?>
					</p>
			<?php 
				} 
							
				if(_get("production") and ($i === $rand1 or $i === $rand2)) {
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

				$i++;
			?>			
			<br />
	<?php 
		} 
	?>

	<?php echo $pagination; ?>
</div>

<script type="text/javascript">
    var syntax = [];
    <?php
        $data = getSyntax();

        foreach ($data as $language) {
    	?>
    		syntax[<?php echo $language["ID_Syntax"]; ?>] = <?php echo json($language); ?>;
    <?php
        }
    ?>
</script>

<?php
    echo $this->js("codes.js", "codes", TRUE);
?>