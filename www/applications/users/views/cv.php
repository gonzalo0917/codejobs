<?php 
    if (!defined("ACCESS")) {
    	die("Error: You don't have permission to access here..."); 
    }
    
    echo div("float-msg","class");
    echo htmlTag("div",false);
    
    echo p(__("My profile"), "resalt");
    
    echo "<a href='#' id='expand' class='btn btn-primary'>".__("Expand All")."<i class='icon-plus icon-white'></i></a>";
    echo "<a href='#' id='collapse' class='btn btn-primary'>".__("Collapse All")."<i class='icon-minus icon-white'></i></a>";

    echo div("show-section","class");
        echo "<h3 class='inactive-section'><i class='icon-chevron-right'></i>".__("Avatar")."</h3>";
        echo div("avatar-section");
            include 'avatar.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    echo div("show-section","class");
        echo "<h3 class='inactive-section'><i class='icon-chevron-right'></i>".__("About me")."</h3>";
        echo div("about-section");
            include 'about.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

     echo div("show-section","class");
        echo "<h3 class='inactive-section'><i class='icon-chevron-right'></i>".__("Social Networks")."</h3>";
        echo div("social-section");
            include 'social.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    echo div("show-section","class");
        echo "<h3 class='inactive-section'><i class='icon-chevron-right'></i>".__("Curriculum Vitae")."</h3>";
        echo div("cv-section");
            include 'formcv.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    echo div("show-section","class");
        echo "<h3 class='inactive-section'><i class='icon-chevron-right'></i>".__("Password")."</h3>";
        echo div("password-section");
            include 'password.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

?>