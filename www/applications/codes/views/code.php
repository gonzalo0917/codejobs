<?php
    if(!defined("_access")) {
        die("Error: You don't have permission to access here...");
    }
    
    $URL = path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);
?>
<div class="codes">
	<h2>
		<?php echo getLanguage($code["Language"], TRUE); ?> <a href="<?php echo $URL; ?>" title="<?php echo quotes($code["Title"]); ?>"><?php echo quotes($code["Title"]); ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __("Published") ." ". howLong($code["Start_Date"]) ." ". __("by") .' <a title="'. $code["Author"] .'" href="'. path("codes/author/". $code["Author"]) .'">'. $code["Author"] .'</a> '; 
			 
			if($code["Languages"] !== "") {
				echo __("in") ." ". exploding(implode(", ", array_map("strtolower", explode(", ", $code["Languages"]))), "codes/language/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __("Likes") .":</span> ". (int) $code["Likes"]; 
			echo ' <span class="bold">'. __("Dislikes") .":</span> ". (int) $code["Dislikes"];
			echo ' <span class="bold">'. __("Views") .":</span> ". (int) $Views;
		?>
	</span>

    <?php 
        echo display(social($URL, $code["Title"], FALSE), 4); 

        if($code["Description"] !== "") {
            echo str_replace("\\", "", htmlTag("p", showLinks($code["Description"])));
        }

        foreach ($code["Files"] as $file) {
        ?>
            <p>
                <div class="title-file">
                    <?php
                        echo htmlTag("div", array("class" => "filename"), $file["Name"]);
                        
                        echo htmlTag("a", array(
                            "name"  => slug($file["Name"]),
                            "class" => "permalink",
                            "title" => __("Permalink to this file"),
                            "href"  => "#" . slug($file["Name"])
                        ), "&para;&nbsp;");
                    ?>
                </div>

                <textarea name="code" data-syntax="<?php echo $file["ID_Syntax"];?>"><?php echo stripslashes($file["Code"]); ?></textarea>
            </p>
        <?php
        }
		
        if(SESSION("ZanUser")) {
	    ?>
			<p class="small italic">
				<?php  echo like($code["ID_Code"], "codes", $code["Likes"]) ." ". dislike($code["ID_Code"], "codes", $code["Dislikes"]) ." ". report($code["ID_Code"], "codes"); ?>
			</p>

            <p>
                <a href="<?php echo path("codes/download/". $code['ID_Code'] ."/". $code['Slug']); ?>" class="btn download"><?php echo __("Download code"); ?></a>
            </p>
	    <?php
		}
        ?>
    
        <br />
    
        <?php
            echo display('<p>
                        <script type="text/javascript">
                            google_ad_client = "ca-pub-4006994369722584";
                            /* CodeJobs.biz */
                            google_ad_slot = "1672839256";
                            google_ad_width = 728;
                            google_ad_height = 90;
                            </script>
                            <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                        </script>
                    </p>', 4);
        ?>   

    <p>
        <a name="comments">
            <?php echo fbComments($URL); ?>   
        </a>
    </p>
	
	<p>
		<a href="<?php echo path("codes"); ?>">&lt;&lt; <?php echo __("Go back"); ?></a>
	</p>
</div>

<script type="text/javascript">
    var syntax = [];
    <?php
        $data = getSyntax();
        
        foreach($data as $language) {
        ?>syntax[<?php echo $language["ID_Syntax"]; ?>] = <?php echo json($language); ?>;<?php
        }
    ?>
</script>