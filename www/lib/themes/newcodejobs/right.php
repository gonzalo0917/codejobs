<?php
    if ((segment(0, isLang()) !== "live" and segment(0, isLang()) !== "forums" and segment(1, isLang()) !== "add") and !defined("HIDE_RIGHT")) { 
?>
        <aside>

            <?php 
                if (segment(0, isLang()) !== "users" ) {
                    echo display('<section class="ads">'. getAd() .'</section>', 4);  
                } 
            ?>
            <div class="line"></div>

            <section class="facebook-like">
                <div class="fb-like-box" data-href="http://www.facebook.com/codejobs" data-width="292" data-show-faces="true" data-stream="false" data-header="false"></div>
            </section>

            <section class="transmission">
                <header>
                    <h3><?php echo __("Live broadcast"); ?></h3>
                </header>

                <p class="text"><?php echo __("Every Saturday in"); ?> <a href="<?php echo path("tv"); ?>">CodeJobs TV!</a></p> 

                <ul>
                    <li>
                        <span class="flag mexico-flag" title="México"></span>
                        11:00 am
                    </li>

                    <li>
                        <span class="flag peru-flag" title="Perú"></span>
                        <span class="flag colombia-flag" title="Colombia"></span>
                        <span class="flag ecuador-flag" title="Ecuador"></span>
                        <span class="flag panama-flag" title="Panamá"></span>
                        12:00 pm
                    </li>

                    <li>
                        <span class="flag venezuela-flag" title="Venezuela"></span>
                        12:30 pm
                    </li>

                    <li>
                        <span class="flag chile-flag" title="Chile"></span>
                        <span class="flag argentina-flag" title="Argentina"></span>
                        <span class="flag paraguay-flag" title="Paraguay"></span>
                        02:00 pm
                    </li>

                    <li>
                        <span class="flag uruguay-flag" title="Uruguay"></span>
                        03:00 pm
                    </li>

                    <li>
                        <span class="flag spain-flag" title="España"></span>
                        06:00 pm
                    </li>
                </ul>
            </section>

            <section class="popular">
                <header>
                    <h3><?php echo __("Relevant posts"); ?></h3>
                </header>

                <?php $this->execute("Blog_Controller", "relevant"); ?>
            </section>

            <?php if (segment(0, isLang()) !== "polls") { ?>
            <section class="polls">
                <?php $this->execute("Polls_Controller", "last"); ?>
            </section>
            <?php } ?>

            <section class="sponsors">
                <header>
                    <h3><?php echo __("Sponsors"); ?></h3>
                </header>

                <ul>
                    <?php $this->execute("Ads_Controller", "principal"); ?>
                    <li><a rel="nofollow" href="http://www.codejobs.biz/publicidad"><img src="<?php echo path("www/applications/pages/views/images/patrocinadores/space.png", TRUE); ?>" /></a></li>
                </ul>
            </section>
        </aside>
    <?php
    }