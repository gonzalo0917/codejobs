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
					$(window).on("ready", function() {
			      		$("textarea").markItUp(mySettings);
			   		});
			   	</script>
				<?php
			} else {
				?>
				<script type="text/javascript">
					function add(type, filename, url) {
						if(type == "audio") {
							var name = "Audio",
								code = '<p><audio controls><source src="' + url + '" type="audio/mpeg"></audio></p>';							
						}

						if(type == "codes" || type == "documents" || type == "programs" || type == "unknown") {
							var name = "All",
								code = '<p><a href="' + url + '" target="_blank">' + filename + '</a></p>';							
						}

						if(type == "images") {
							var name = "Images",
								code = '<p><img alt="' + filename + '" src="' + url +'" class="no-border" /></p>';
			        	}

			        	if(type == "videos") {
			        		var name = "Videos",
								code = '<p><video width="640" height="360" controls><source src="' + url + '" type="video/mp4"></video></p>';
			        	}

			        	$.markItUp({ 
			        		name: name, 
			        		replaceWith: code + '\n' 
			        	});

	        			return false;
					}
				</script>
				<?php
			}
		?>

    </body>
</html>
