			<div class="clear"></div>
			
			<br />
			
            <div id="footer">
            	<p>&copy; <?php print __("All rights reserved"); ?> - MuuCMS v.1.0 - 2012 - <?php print __("Powered by"); ?> <a href="http://www.milkzoft.com" title="MilkZoft">MilkZoft</a></p>
            </div>
        </div>
		<script type="text/javascript">
			var PATH = "<?php echo path(); ?>",
				URL  = "<?php echo _get('webURL'); ?>",
				ZAN  = "<?php echo path("", "zan");?>";
		</script>

		<?php
			$this->js("jquery", NULL, FALSE, TRUE); 
	        
			$this->js("www/lib/scripts/js/main.js", NULL, FALSE, TRUE); 

			echo $this->getJs();
		?>
    </body>
</html>
