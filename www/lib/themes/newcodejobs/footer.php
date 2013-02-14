        <div class="clear"></div>

        <?php
            if (segment(0, isLang()) !== "live") {
            ?>
                <footer>
                    <p>
                        <?php 
                            echo display('<a href="'. path(slug(__("Advertising")), false, false) .'">'. __("Advertising") .'</a> &nbsp;&nbsp;
                                <!--<a href="'. path(slug(__("Legal notice")), false, false) .'">'. __("Legal notice") .'</a>  &nbsp;&nbsp;-->
                                <!--<a href="'. path(slug(__("Terms of Use")), false, false) .'">'. __("Terms of Use") .'</a>  &nbsp;&nbsp;-->
                                <!--<a href="'. path(slug(__("About CodeJobs")), false, false) .'">'. __("About CodeJobs") .'</a> &nbsp;&nbsp;-->
                                <a href="'. path("links", true) .'">'. __("Links") .'</a> &nbsp;&nbsp;
                                <a href="'. path("feedback") .'">'. __("Contact us") .'</a><br />', true, "Spanish");
                            
                            echo __("This site is licensed under a"); 
                        ?> 
                        
                        <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank">Creative Commons Attribution 3.0 License</a>. 
                        <?php echo __("Powered by"); ?> <a href="http://www.milkzoft.com" target="_blank">MilkZoft</a>
                    </p>
                </footer>

                <script type="text/javascript">
                    var PATH = "<?php echo path(); ?>",
                        URL = "<?php echo _get('webURL'); ?>",
                        ZAN = "<?php echo path("", "zan");?>",
                        APP = "<?php echo whichApplication(); ?>";
                        THEME = "<?php echo _get("webTheme"); ?>";
                </script>
        
                <?php 
                }   
                
                $this->js("jquery", null, false, true);
                $this->js("$this->themeRoute/js/porlets.js", null, false, true);
                $this->js("$this->themeRoute/js/search.js", null, false, true);

                if (_get("environment") > 3) {
                    $this->js("$this->themeRoute/js/social.js", null, false, true);
                }

                if (segment(0, isLang()) === "live") {
                    $this->js("www/lib/scripts/js/tweetscroller/js/handlebars.js", null, false, true);
                    $this->js("www/lib/scripts/js/tweetscroller/js/moment.js", null, false, true);
                    $this->js("www/lib/scripts/js/tweetscroller/js/jquery.masonry.js", null, false, true);
                    $this->js("www/lib/scripts/js/tweetscroller/js/jquery.hoverIntent.js", null, false, true);
                    $this->js("www/lib/scripts/js/tweetscroller/js/jquery.tweetscroller.js", null, false, true);
                }
                
                echo $this->getJs();

                if (segment(0, isLang()) === "live") {
                ?>
                    <script>
                        !function($){
                            $('#tweets').tweetscroller({
                                autoplay: true,
                                speed: 65,
                                username: 'codejobs'
                            });
                        }(jQuery);
                    </script>
                <?php
                }

                echo display('<script type="text/javascript">var _gaq = _gaq || [];_gaq.push([\'_setAccount\', \'UA-38459206-1\']);_gaq.push([\'_trackPageview\']);(function() {var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);})();</script>', 4);
                echo display('<script type="text/javascript">var sc_project = 7655788;var sc_invisible = 1;var sc_security = "f167f55b";</script><script type="text/javascript" src="http://www.statcounter.com/counter/counter.js"></script>', 4);
                echo display('<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if (!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>', 4);
                echo display('<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>', 4);
                echo display('
                    <script type="text/javascript">
                        window.___gcfg = {lang: "es-419"};

                        (function() {
                            var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
                            po.src = "https://apis.google.com/js/plusone.js";
                            var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>
                ', 4);
            ?>
        </body>
    </html>