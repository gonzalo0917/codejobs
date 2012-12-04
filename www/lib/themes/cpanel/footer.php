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
			$this->js("jquery", NULL, FALSE, TRUE); 

			if(defined("_angularjs")) {
	            $this->js("angular", NULL, FALSE, TRUE); 
	        }
	        
	        if(defined("_codemirror")) {
	            $this->js("codemirror", NULL, FALSE, TRUE); 
	        }
	        
			$this->js("www/lib/scripts/js/main.js", NULL, FALSE, TRUE); 

			if(segment(0, isLang()) !== "codes" and segment(0, isLang()) !== "blog") {
				$this->js(_corePath ."/vendors/js/editors/markitup/jquery.markitup.js", NULL, FALSE, TRUE); 
				$this->js(_corePath ."/vendors/js/editors/markitup/sets/html/set.js", NULL, FALSE, TRUE); 
			}

			echo $this->getJs();

			if(segment(0, isLang()) !== "codes" and segment(0, isLang()) !== "blog" and segment(2, isLang()) !== "minifier" and segment(2, isLang()) !== "tv") {
		?>
		<script type="text/javascript">
			$(window).on("load", function() {
	      		$("textarea").markItUp(mySettings);
	   		});
	   	</script>
		<?php
			}
		?>
    </body>
</html>
