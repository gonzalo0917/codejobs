        <div class="clear"></div>

        <footer>
            <p>
                <?php 
                    if(whichLanguage() === "Spanish") {
                    ?>
                        <a href="<?php echo path(slug(__("Advertising")), FALSE, FALSE); ?>"><?php echo __("Advertising"); ?></a> &nbsp;&nbsp;
                        <!--<a href="<?php echo path(slug(__("Legal notice")), FALSE, FALSE); ?>"><?php echo __("Legal notice"); ?></a>  &nbsp;&nbsp;-->
                        <!--<a href="<?php echo path(slug(__("Terms of Use")), FALSE, FALSE); ?>"><?php echo __("Terms of Use"); ?></a>  &nbsp;&nbsp;-->
                        <!--<a href="<?php echo path(slug(__("About CodeJobs")), FALSE, FALSE); ?>"><?php echo __("About CodeJobs"); ?></a> &nbsp;&nbsp;-->
                        <a href="<?php echo path("links", TRUE); ?>"><?php echo __("Links"); ?></a> &nbsp;&nbsp;
                		<a href="<?php echo path("feedback"); ?>"><?php echo __("Contact us"); ?></a><br />
                    <?php
                    }
                    
                    echo __("This site is licensed under a"); ?> 
                    <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank">Creative Commons Attribution 3.0 License</a>. 
                    <?php echo __("Powered by"); ?> <a href="http://www.milkzoft.com" target="_blank">MilkZoft</a>
            </p>
        </footer>

        <?php echo $this->getJs(); ?>


        <script type="text/javascript">
            var sc_project = 7655788; 
            var sc_invisible = 1; 
            var sc_security = "f167f55b"; 
        </script>

        <script type="text/javascript" src="http://www.statcounter.com/counter/counter.js"></script>
    </body>
</html>