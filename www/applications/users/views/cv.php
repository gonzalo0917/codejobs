<?php 
    if (!defined("ACCESS")) {
    	die("Error: You don't have permission to access here..."); 
    }
    
    $ID_Experience  = isset($data) ? recoverPOST("ID", $data[0]["ID_Code"]) : 0;
    $ID_School      = isset($data) ? recoverPOST("ID", $data[0]["ID_Code"])              : 0;
    $summary        = isset($data) ? recoverPOST("summary", $data[0]["Summary"]) : recoverPOST("summary");
    $skills         = isset($data) ? recoverPOST("skills", $data[0]["Skills"]) : recoverPOST("Skills");
    $edit           = isset($data) ? true : false;
    $experiences    = isset($data) ? $data[0]["Experiences"] : false;
    $education      = isset($data) ? $data[0]["Education"] : false;
    //$action      = isset($data) ? "edit" : "save";
    //$href        = isset($data) ? path(whichApplication() ."/cpanel/edit/") : path(whichApplication() ."/cpanel/add/");


    if (!$experiences) {
        $experiences = recoverExperiences();
    }

     if (!$education) {
        $education = recoverEducation();
    }

    echo htmlTag("div", array(
        "ng-controller" => "CvExperience",
        "class" => "add-form"
    ));

    echo div("edit-profile", "class");
        echo formOpen($href, "form-add", "form-add");
            echo isset($alert) ? $alert : null;

            echo formTextArea(array(
                "name"  => "summary",
                "class" => "span10 required",
                "field" => __("Summary"), 
                "p"     => true, 
                "style" => "resize: none; height: 100px;",
                "value" => $summary
            ));

            echo formInput(array(   
                "name" => "saveExtract", 
                "class" => "btn btn-success", 
                "value" => __("Save"), 
                "type" => "submit"
            ));
            
                        
            echo span("field", "&raquo; " . __("Experience") . " ({{experiences.length}})");
            
            //echo div("sectionExperience", "class");

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
                    "class"    => "required jdpicker dateinline", 
                    "ng-model" => "experience.periodto",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo formTextArea(array(	
                    "id"    => "description{{\$index}}", 
                    "name"  => "description[]",
                    "class" => "required noresize",
                    "style" => "height: 200px;width:100%", 
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
            //echo htmlTag("div", false);
            echo htmlTag("div", false);

            echo htmlTag("div", array(
                "id"       => "add",
                "class"    => "btn span10",
                "ng-click" => "addExperience()"
            ), __("Add another experience") . "...");

            echo formInput(array(   
                "name" => "saveExperiences", 
                "class" => "btn btn-success", 
                "value" => __("Save"), 
                "type" => "submit"
            ));
            
            echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID_Experience));

        echo formClose();
        echo htmlTag("div", false);

    echo htmlTag("div", false);


    echo htmlTag("div", array(
        "ng-controller" => "CvEducation",
        "class" => "add-form"
    ));

    echo div("edit-profile", "class");
        echo formOpen($href, "form-add", "form-add");
            echo isset($alert) ? $alert : null;

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
                    "name"     => "school[]", 
                    "id"       => "school{{\$index}}", 
                    "class"    => "required", 
                    "field"    => __("School"), 
                    "p"        => true,
                    "ng-model" => "school.school"
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
                    "name"     => "school_period_from[]", 
                    "id"       => "school_period_from{{\$index}}", 
                    "class"    => "required jdpicker", 
                    "field"    => __("Time Period"), 
                    "ng-model" => "school.period_from",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo " -- ";
                
                echo formInput(array(   
                    "name"     => "school_period_to[]", 
                    "id"       => "school_period_to{{\$index}}", 
                    "class"    => "required jdpicker", 
                    "ng-model" => "school.period_to",
                    "data-options" => '{"date_format": "dd/mm/YYYY", "month_names": ["'. implode('", "', $months) .'"], "short_month_names": ["'. implode('", "', array_map(create_function('$month', 'return substr($month, 0, 3);'), $months)) .'"], "short_day_names": ['. __('"S", "M", "T", "W", "T", "F", "S"') .']}'
                ));

                echo formTextArea(array(    
                    "id"    => "school_description{{\$index}}", 
                    "name"  => "school_description[]",
                    "class" => "required noresize",
                    "style" => "height: 200px;width:100%", 
                    "field" => __("Description"), 
                    "p"     => true
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

            echo formInput(array(   
                "name" => "saveEducation", 
                "class" => "btn btn-success", 
                "value" => __("Save"), 
                "type" => "submit"
            ));
            
            echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID_School));

        echo formClose();

    echo htmlTag("div", false);

    echo htmlTag("div", false);

?>
<script type="text/javascript">
function CvExperience($scope) {
    console.log("CvExperience");
    $scope.experiences = [
        <?php
        for ($experience = 0; $experience < count($experiences); $experience++) {
        ?>
            {
                idexperience: "<?php print recoverPOST("idexperience$experience", $experiences[$experience]["ID_Experience"]); ?>",
                company: "<?php print recoverPOST("company$experience", $experiences[$experience]["Company"]); ?>",
                title: "<?php print recoverPOST("title$experience", $experiences[$experience]["Title"]); ?>",
                location: "<?php print recoverPOST("location$experience", $experiences[$experience]["Location"]); ?>",
                periodfrom: "<?php print recoverPOST("periodfrom$experience", $experiences[$experience]["Period_From"]); ?>",
                periodto: "<?php print recoverPOST("periodto$experience", $experiences[$experience]["Period_To"]); ?>",
                description: "<?php print removeBreaklines(recoverPOST("description$experience", $experiences[$experience]["Description"]), "\\n"); ?>",
                editor: null
            } <?php print $experience < (count($experiences) - 1) ? ',' : '';
        }
        ?>
    ];

    $scope.addExperience = function () {
        console.log("addExperience");
        var index = $scope.experiences.length;
        
        $scope.experiences.push({
            id: "", company: "", title: "", location: "", periodfrom: "", periodto: "", description: "", editor: null
        });
        
        window.setTimeout(function () {
            $('html, body').animate({
                scrollTop: $("#company" + ($scope.experiences.length - 1)).parent().parent().offset().top - 10
            }, 1000, function () {
                $("#experience" + ($scope.experiences.length - 1)).focus();
            });
        }, 0);
    };

    $scope.removeExperience = function (index) {
        console.log("removeExperience");
        if (index > 0) {
            if (confirm("<?php print __("Do you want to remove this experience?"); ?>")) {
                this.experiences.splice(index, 1);
            }
        }
    };
}

function CvEducation($scope) {
    console.log("CvEducation");
     $scope.education = [
        <?php
        for ($school = 0; $school < count($education); $school++) {
        ?>
            {
                idschool: "<?php print recoverPOST("idschool$school", $education[$school]["ID_School"]); ?>",
                school: "<?php print recoverPOST("school$school", $education[$school]["School"]); ?>",
                degree: "<?php print recoverPOST("degree$school", $education[$school]["Degree"]); ?>",
                periodfrom: "<?php print recoverPOST("periodfrom$school", $education[$school]["Period_From"]); ?>",
                periodto: "<?php print recoverPOST("periodto$school", $education[$school]["Period_To"]); ?>",
                description: "<?php print removeBreaklines(recoverPOST("description$school", $education[$school]["Description"]), "\\n"); ?>",
                editor: null
            } <?php print $school < (count($education) - 1) ? ',' : '';
        }
        ?>
    ];

    $scope.addSchool = function () {
        console.log("addSchool");
        var index = $scope.education.length;
        
        $scope.education.push({
            id: "", school: "", degree: "", periodfrom: "", periodto: "", description: "", editor: null
        });
        
        window.setTimeout(function () {
            $('html, body').animate({
                scrollTop: $("#school" + ($scope.education.length - 1)).parent().parent().offset().top - 10
            }, 1000, function () {
                $("#syntax" + ($scope.education.length - 1)).focus();
            });
        }, 0);
    };

    $scope.removeSchool = function (index) {
        console.log("removeSchool"); 
        if (index > 0) {
            if (confirm("<?php print __("Do you want to remove this institute?"); ?>")) {
                this.education.splice(index, 1);
            }
        }
    };
    //Configurar addschool y removeschool para que se utilicen para en school y experience

}
</script>