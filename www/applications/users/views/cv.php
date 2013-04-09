<?php 
    if (!defined("ACCESS")) {
    	die("Error: You don't have permission to access here..."); 
    }
    
    echo "<a href='#' id='expand-collapse' class='btn btn-primary'>".__("Expand All")."</a>";
    echo div("show-section","class");
        echo "<h3 class='span10 inactive-section'><i class='icon-chevron-right'></i>".__("Avatar")."</h3>";
        echo div("avatar-section");
            include 'avatar.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    echo div("show-section","class");
        echo "<h3 class='span10 inactive-section'><i class='icon-chevron-right'></i>".__("About me")."</h3>";
        echo div("about-section");
            include 'about.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

     echo div("show-section","class");
        echo "<h3 class='span10 inactive-section'><i class='icon-chevron-right'></i>".__("Social Networks")."</h3>";
        echo div("social-section");
            include 'social.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    echo div("show-section","class");
        echo "<h3 class='span10 inactive-section'><i class='icon-chevron-right'></i>".__("Curriculum Vitae")."</h3>";
        echo div("cv-section");
            include 'formcv.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

?>
<script type="text/javascript">
function CvExperience($scope) {
    $scope.experiences = [
        <?php
        for ($experience = 0; $experience < count($experiences); $experience++) {
        ?>
            {
                idexperience: "<?php print recoverPOST("idexperience$experience", $experiences[$experience]["ID_Experience"]); ?>",
                company: "<?php print recoverPOST("company$experience", $experiences[$experience]["Company"]); ?>",
                title: "<?php print recoverPOST("title$experience", $experiences[$experience]["Job_Title"]); ?>",
                location: "<?php print recoverPOST("location$experience", $experiences[$experience]["Location"]); ?>",
                periodfrom: "<?php print recoverPOST("periodfrom$experience", $experiences[$experience]["Period_From"]); ?>",
                periodto: "<?php print recoverPOST("periodto$experience", $experiences[$experience]["Period_To"]); ?>",
                description: "<?php print recoverPOST("description$experience", $experiences[$experience]["Description"]); ?>"
            } <?php print $experience < (count($experiences) - 1) ? ',' : '';
        }
        ?>
    ];

    $scope.addExperience = function () {
        var index = $scope.experiences.length;

        $scope.experiences.push({
            idexperience: "", company: "", title: "", location: "", periodfrom: "", periodto: "", description: ""
        });

        window.setTimeout(function () {
            $('html, body').animate({
                scrollTop: $("#company" + ($scope.experiences.length - 1)).parent().parent().offset().top - 10
            }, 1000, function () {
                $("#company" + ($scope.experiences.length - 1)).focus();
            });
        }, 0);
    };

    $scope.removeExperience = function (index) {
        if (index > 0) {
            if (confirm("<?php print __("Do you want to remove this experience?"); ?>")) {
                this.experiences.splice(index, 1);
            }
        }
    };
}

function CvEducation($scope) {
     $scope.education = [
        <?php

        for ($school = 0; $school < count($education); $school++) {
        ?>
            {
                idschool: "<?php print recoverPOST("idschool$school", $education[$school]["ID_School"]); ?>",
                nameschool: "<?php print recoverPOST("nameschool$school", $education[$school]["School"]); ?>",
                degree: "<?php print recoverPOST("degree$school", $education[$school]["Degree"]); ?>",
                periodfrom: "<?php print recoverPOST("school_periodfrom$school", $education[$school]["Period_From"]); ?>",
                periodto: "<?php print recoverPOST("school_periodto$school", $education[$school]["Period_To"]); ?>",
                description: "<?php print recoverPOST("description$school", $education[$school]["Description"]); ?>"
            } <?php print $school < (count($education) - 1) ? ',' : '';
        }
        ?>
    ];

    $scope.addSchool = function () {
        var index = $scope.education.length;
        
        $scope.education.push({
            idschool: "", nameschool: "", degree: "", periodfrom: "", periodto: "", description: ""
        });

        window.setTimeout(function () {
            $('html, body').animate({
                scrollTop: $("#nameschool" + ($scope.education.length - 1)).parent().parent().offset().top - 10
            }, 1000, function () {
                $("#nameschool" + ($scope.education.length - 1)).focus();
            });
        }, 0);
    };

    $scope.removeSchool = function (index) {
        if (index > 0) {
            if (confirm("<?php print __("Do you want to remove this institute?"); ?>")) {
                this.education.splice(index, 1);
            }
        }
    };
    //Configurar addschool y removeschool para que se utilicen para en school y experience

}
</script>