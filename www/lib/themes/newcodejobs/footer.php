        <div class="clear"></div>

        <?php
            if(segment(0, isLang()) !== "live") {
            ?>
                <footer>
                    <p>
                        <?php 
                            echo display('<a href="'. path(slug(__("Advertising")), FALSE, FALSE) .'">'. __("Advertising") .'</a> &nbsp;&nbsp;
                                <!--<a href="'. path(slug(__("Legal notice")), FALSE, FALSE) .'">'. __("Legal notice") .'</a>  &nbsp;&nbsp;-->
                                <!--<a href="'. path(slug(__("Terms of Use")), FALSE, FALSE) .'">'. __("Terms of Use") .'</a>  &nbsp;&nbsp;-->
                                <!--<a href="'. path(slug(__("About CodeJobs")), FALSE, FALSE) .'">'. __("About CodeJobs") .'</a> &nbsp;&nbsp;-->
                                <a href="'. path("links", TRUE) .'">'. __("Links") .'</a> &nbsp;&nbsp;
                                <a href="'. path("feedback") .'">'. __("Contact us") .'</a><br />', TRUE, "Spanish");
                            
                            echo __("This site is licensed under a"); 
                        ?> 
                        
                        <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank">Creative Commons Attribution 3.0 License</a>. 
                        <?php echo __("Powered by"); ?> <a href="http://www.milkzoft.com" target="_blank">MilkZoft</a>
                    </p>
                </footer>

                <script type="text/javascript">
                    var PATH = "<?php echo path(); ?>",
                        URL  = "<?php echo _get('webURL'); ?>",
                        ZAN  = "<?php echo path("", "zan");?>";
                </script>
        
                <?php 
                }   
                
                $this->js("jquery", NULL, FALSE, TRUE);
                $this->js("$this->themeRoute/js/porlets.js", NULL, FALSE, TRUE);

                if(_get("environment") > 3) {
                    $this->js("$this->themeRoute/js/social.js", NULL, FALSE, TRUE);
                }

                if(segment(0, isLang()) !== "forums") {         
                    if(defined("_codemirror")) {
                        $this->js("codemirror", NULL, FALSE, TRUE);
                    }
                    
                    if(defined("_angularjs")) {
                        $this->js("angular", NULL, FALSE, TRUE);
                    }

                    if(segment(0, isLang()) === "forums") {
                        $this->js(_corePath ."/vendors/js/editors/markitup/jquery.markitup.js", NULL, FALSE, TRUE);
                        $this->js(_corePath ."/vendors/js/editors/markitup/sets/bbcode/set.js", NULL, FALSE, TRUE);
                    ?>

                        <script type="text/javascript">
                            $(document).on("ready", function() {
                                $("textarea").markItUp(mySettings);
                            });
                        </script>
                    <?php
                    }
                }

                if(segment(0, isLang()) === "live") {
                    $this->js("www/lib/scripts/js/tweetscroller/js/handlebars.js", NULL, FALSE, TRUE);
                    $this->js("www/lib/scripts/js/tweetscroller/js/moment.js", NULL, FALSE, TRUE);
                    $this->js("www/lib/scripts/js/tweetscroller/js/jquery.masonry.js", NULL, FALSE, TRUE);
                    $this->js("www/lib/scripts/js/tweetscroller/js/jquery.hoverIntent.js", NULL, FALSE, TRUE);
                    $this->js("www/lib/scripts/js/tweetscroller/js/jquery.tweetscroller.js", NULL, FALSE, TRUE);
                }
                
                echo $this->getJs();

                if(segment(0, isLang()) === "live") {
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

                echo display('<script type="text/javascript">var sc_project = 7655788;var sc_invisible = 1;var sc_security = "f167f55b";</script><script type="text/javascript" src="http://www.statcounter.com/counter/counter.js"></script>', 4);
                echo display('<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>', 4);
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