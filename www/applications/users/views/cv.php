<?php 
    if (!defined("ACCESS")) {
    	die("Error: You don't have permission to access here..."); 
    }
    
    echo div("show-section","class");
        echo "<h3 class='span10'>".__("Avatar")."</h3>";
        echo div("avatar-section");
            include 'avatar.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    echo div("show-section","class");
        echo "<h3 class='span10'>".__("About me")."</h3>";
        echo div("about-section");
            include 'about.php';
        echo htmlTag("div", false);
    echo htmlTag("div", false);

    $ID_Summary     = (isset($summary) && $summary != false) ? recoverPOST("summary", $summary[0]["ID_Summary"]) : 0;
    $ID_Skills      = (isset($skills) && $skills != false) ? recoverPOST("skills", $skills[0]["ID_Skills"]) : 0;
    $summary        = (isset($summary) && $summary != false) ? $summary : false;
    $skills         = (isset($skills) && $skills != false) ? recoverPOST("skills", $skills[0]["Skills"]) : recoverPOST("skills");
    $experiences    = isset($experiences) ? $experiences : false;
    $education      = isset($education) ? $education : false;

    if (!$experiences) {
        $experiences = recoverExperiences();
    }

    if (!$education) {
        $education = recoverEducation();
    }

    $exp = "";
    for ($experience = 0; $experience < count($experiences); $experience++) {
        $exp .= recoverPOST("experiences", $experiences[$experience]["ID_Experience"]).",";
    }

    $edu = "";
    for ($school = 0; $school < count($education); $school++) {
        $edu .= recoverPOST("education", $education[$school]["ID_School"]).",";
    }

    $exp = substr($exp, 0, -1)."";
    $edu = substr($edu, 0, -1)."";

    if ($summary[0]["Last_Updated"]) {
        echo "<strong>". __("Last Update On") ."</strong>: ". howLong($summary[0]["Last_Updated"]);
    }

    echo div("edit-profile", "class");
        echo formOpen($href, "form-add", "form-add");
            echo isset($alertSummary) ? $alertSummary : null;

            echo formTextArea(array(
                "name"  => "summary",
                "class" => "span10 required",
                "field" => __("Summary"),
                "p"     => true, 
                "style" => "resize: none; height: 100px;",
                "value" => $summary[0]["Summary"]
            ));

            echo formInput(array("name" => "ID_Summary", "type" => "hidden", "value" => $ID_Summary));

            if ($summary != null) {
                echo formInput(array(
                    "name"  => "actionSummary", 
                    "class" => "btn btn-success", 
                    "value" => __("Update"), 
                    "type"  => "submit"
                ));
            } else {
                echo formInput(array(
                    "name"  => "actionSummary", 
                    "class" => "btn btn-success", 
                    "value" => __("Save"), 
                    "type"  => "submit"
                ));
            }

        echo formClose();
    echo htmlTag("div", false);

    echo htmlTag("div", array(
        "ng-controller" => "CvExperience",
        "class" => "add-form"
    ));

        echo div("edit-profile", "class");
        echo formOpen($href, "form-add", "form-add");
            echo isset($alertExperience) ? $alertExperience : null;

            echo span("field", "&raquo; " . __("Experience") . " ({{experiences.length}})");
            
            echo htmlTag("div", array(
                "class"     => "well span10",
                "ng-repeat" => "experience in experiences"
            ));

                echo htmlTag("span", array(
                    "class" => "field field-right",
                ), "#{{\$index + 1}}");

                echo formInput(array(
                    "name"  => "experience[]",
                    "type"  => "hidden",
                    "value" => "{{experience.idexperience}}"
                ));

                echo formInput(array(
                    "name"     => "company[]", 
                    "id"       => "company{{\$index}}", 
                    "class"    => "required", 
                    "field"    => __("Company"), 
                    "p"        => true,
                    "ng-model" => "experience.company"
                ));

                echo formInput(array(
                    "name"     => "title[]", 
                    "id"       => "title{{\$index}}", 
                    "class"    => "required", 
                    "field"    => __("Job Title"), 
                    "p"        => true,
                    "ng-model" => "experience.title"
                ));

                echo formInput(array(
                    "name"     => "location[]", 
                    "id"       => "location{{\$index}}", 
                    "class"    => "required", 
                    "field"    => __("Location"), 
                    "p"        => true,
                    "ng-model" => "experience.location"
                ));

                $months = array(__("January"), __("February"), __("March"), __("April"), __("May"), __("June"), __("July"), __("August"), __("September"), __("October"), __("November"), __("December"));

                echo formInput(array(
                    "name"     => "periodfrom[]", 
                    "id"       => "periodfrom{{\$index}}", 
                    "class"    => "required jdpicker", 
                    "field"    => __("Time Period"), 
                    "ng-model" => "experience.periodfrom",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo " -- ";

                echo formInput(array(
                    "name"     => "periodto[]", 
                    "id"       => "periodto{{\$index}}", 
                    "class"    => "required jdpicker", 
                    "ng-model" => "experience.periodto",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo formTextArea(array(
                    "id"    => "description{{\$index}}", 
                    "name"  => "description[]",
                    "class" => "required noresize",
                    "style" => "height: 200px;width:100%",
                    "ng-model" => "experience.description",
                    "field" => __("Description"), 
                    "p"     => true
                ));
                    
                    echo htmlTag("div", array(
                        "class" => "remove remove-{{\$index > 0}}"
                    ));

                    echo htmlTag("a", array(
                        "class"    => "btn btn-danger",
                        "ng-click" => "removeExperience(\$index)"
                    ), __("Remove experience"));
                    
                    echo htmlTag("div", false);

            echo htmlTag("div", false);

            echo htmlTag("div", array(
                "id"       => "add",
                "class"    => "btn span10",
                "ng-click" => "addExperience()"
            ), __("Add another experience") . "...");

            if ($experiences AND $experiences[0]['ID_Experience'] !== "") {
                echo formInput(array(
                    "name"  => "actionExperiences", 
                    "class" => "btn btn-success", 
                    "value" => __("Update"), 
                    "type"  => "submit"
                ));
            } else {
                echo formInput(array(
                    "name"  => "actionExperiences", 
                    "class" => "btn btn-success", 
                    "value" => __("Save"), 
                    "type"  => "submit"
                ));
            }

            echo formInput(array(
                "name"  => "infoExp", 
                "type"  => "hidden",
                "value" => $exp
            ));

        echo formClose();
        echo htmlTag("div", false);

    echo htmlTag("div", false);

    echo htmlTag("div", array(
        "ng-controller" => "CvEducation",
        "class" => "add-form"
    ));

    echo div("edit-profile", "class");
        echo formOpen($href, "form-add", "form-add");
            echo isset($alertEducation) ? $alertEducation : null;

            echo span("field", "&raquo; " . __("Education") . " ({{education.length}})");
            
            echo htmlTag("div", array(
                "class"     => "well span10",
                "ng-repeat" => "school in education"
            ));

                echo htmlTag("span", array(
                    "class" => "field field-right",
                ), "#{{\$index + 1}}");

                echo formInput(array(
                    "name"  => "school[]",
                    "type"  => "hidden",
                    "value" => "{{school.idschool}}"
                ));

                echo formInput(array(
                    "name"     => "nameschool[]", 
                    "id"       => "nameschool{{\$index}}", 
                    "class"    => "required", 
                    "field"    => __("School"), 
                    "p"        => true,
                    "ng-model" => "school.nameschool"
                ));

                echo formInput(array(
                    "name"     => "degree[]", 
                    "id"       => "degree{{\$index}}", 
                    "class"    => "required", 
                    "field"    => __("Degree"), 
                    "p"        => true,
                    "ng-model" => "school.degree"
                ));

                $months = array(__("January"), __("February"), __("March"), __("April"), __("May"), __("June"), __("July"), __("August"), __("September"), __("October"), __("November"), __("December"));

                echo formInput(array(
                    "name"     => "school_periodfrom[]", 
                    "id"       => "school_periodfrom{{\$index}}", 
                    "class"    => "required jdpicker", 
                    "field"    => __("Time Period"), 
                    "ng-model" => "school.periodfrom",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo " -- ";

                echo formInput(array(
                    "name"     => "school_periodto[]", 
                    "id"       => "school_periodto{{\$index}}", 
                    "class"    => "required jdpicker", 
                    "ng-model" => "school.periodto",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo formTextArea(array(
                    "id"        => "school_description{{\$index}}", 
                    "name"      => "school_description[]",
                    "class"     => "required noresize",
                    "style"     => "height: 200px;width:100%", 
                    "ng-model"  => "school.description", 
                    "field"     => __("Description"), 
                    "p"         => true
                ));

                echo htmlTag("div", array(
                    "class" => "remove remove-{{\$index > 0}}"
                ));

                echo htmlTag("a", array(
                    "class"    => "btn btn-danger",
                    "ng-click" => "removeSchool(\$index)"
                ), __("Remove institute"));

                echo htmlTag("div", false);
            echo htmlTag("div", false);

            echo htmlTag("div", array(
                "id"       => "add",
                "class"    => "btn span10",
                "ng-click" => "addSchool()"
            ), __("Add another institute") . "...");

            echo htmlTag("div", false);

            if ($education AND $education[0]['ID_School'] !== "") {
                echo formInput(array(
                    "name"  => "actionEducation", 
                    "class" => "btn btn-success", 
                    "value" => __("Update"), 
                    "type"  => "submit"
                ));
            } else {
                echo formInput(array(
                    "name"  => "actionEducation", 
                    "class" => "btn btn-success", 
                    "value" => __("Save"), 
                    "type"  => "submit"
                ));
            }

            echo formInput(array(
                "name"  => "infoEdu", 
                "type"  => "hidden",
                "value" => $edu
            ));

        echo formClose();

    echo htmlTag("div", false);

    echo htmlTag("div", array(
        "class" => "add-form"
    ));

    echo div("edit-profile", "class");
        echo formOpen($href, "form-add", "form-add");
            echo isset($alertSkills) ? $alertSkills : null;

            echo formInput(array(
                "name"        => "skills",
                "class"       => "span10 required",
                "field"       => __("Skills"), 
                "p"           => true, 
                "placeholder" => __("Write the tags separated by commas"),
                "value"       => $skills
            ));

            echo formInput(array("name" => "ID_Skills", "type" => "hidden", "value" => $ID_Skills));

            if ($skills != null) {
                echo formInput(array(
                    "name"  => "actionSkills", 
                    "class" => "btn btn-success",
                    "value" => __("Update"), 
                    "type"  => "submit"
                ));
            } else {
                echo formInput(array(
                    "name"  => "actionSkills", 
                    "class" => "btn btn-success", 
                    "value" => __("Save"), 
                    "type"  => "submit"
                ));
            }

        echo formClose();

    echo htmlTag("div", false);

    echo htmlTag("div", false);

?>
<script type="text/javascript">
/*$(document).ready(function() {
    <?php
        $exp = "";
        for ($experience = 0; $experience < count($experiences); $experience++) {
            $exp .= recoverPOST("experiences", $experiences[$experience]["ID_Experience"]).",";
        }
    ?>
    $('.infoExperiences').val("<?php print $exp;?>");
})*/
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