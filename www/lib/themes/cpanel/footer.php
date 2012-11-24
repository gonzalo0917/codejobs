			<div class="clear"></div>
			
			<br />
			
            <div id="footer">
            	<p>&copy; <?php print __("All rights reserved"); ?> - MuuCMS v.1.0 - 2012 - <?php print __("Powered by"); ?> <a href="http://www.milkzoft.com" title="MilkZoft">MilkZoft</a></p>
            </div>
        </div>
		<script type="text/javascript">
			var PATH = "<?php echo path(); ?>";
			var URL  = "<?php echo _get('webURL'); ?>";
		</script>

		<?php
			echo $this->js("jquery", NULL, TRUE); 

			if(defined("_angularjs")) {
	            echo $this->js("angular", NULL, TRUE);
	        }
	        
	        if(defined("_codemirror")) {
	            echo $this->js("codemirror", NULL, TRUE);
	        }

			echo $this->js("upload", NULL, TRUE);
			echo $this->js("www/lib/scripts/js/main.js", NULL, TRUE);

			if(segment(0, isLang()) !== "codes" and segment(0, isLang()) !== "blog") {
				echo $this->js(_corePath ."/vendors/js/editors/markitup/jquery.markitup.js", NULL, TRUE);
				echo $this->js(_corePath ."/vendors/js/editors/markitup/sets/html/set.js", NULL, TRUE);
		?>
		<script type="textjavascript">
			$(document).on("ready", function() {
	      		$("textarea").markItUp(mySettings);
	   		});
		</script>
		<?php
			}

			print $this->getJs();
		?>
    </body>
</html>
