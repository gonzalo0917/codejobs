<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

if (!function_exists("getOnlineUsers")) {
	function getOnlineUsers()
	{
		global $Load;

		$Db = $Load->core("Db");

		$Load->helper("security");

		$date = time();
		$time = 10;
		$time = $date - $time * 60;
		$IP = getIP();
		$user = SESSION("ZanUser");

		$Db->deleteBySQL("Start_Date < $time", "users_online_anonymous");

		$Db->deleteBySQL("Start_Date < $time", "users_online");

		if ($user) {
			$users = $Db->findBy("User", $user, "users_online");
			
			if (!$users) {
				$Db->insert("users_online", array("User" => $user, "Start_Date" => $date));
			} else {
				$Db->updateBySQL("users_online", "Start_Date = '$date' WHERE User = '$user'");
			}
		} else {
			$users = $Db->findBy("IP", $IP, "users_online_anonymous");

			if (!$users) {
				$Db->insert("users_online_anonymous", array("IP" => $IP, "Start_Date" => $date));
			} else {
				$Db->updateBySQL("users_online", "Start_Date = '$date' WHERE IP = '$IP'");
			}
		}
	}
}

if (!function_exists("linesWrap")) {
    function linesWrap($text, $maxLines = 3)
    {
        return implode("\r\n", array_slice(explode("\r\n", $text), 0, $maxLines));
    }
}

if (!function_exists("removeBreaklines")){
    function removeBreaklines($text, $replace = " ")
    {
        return preg_replace("/\r\n+/", $replace, $text);
    }
}

if (!function_exists("recoverExperiences")) {
    function recoverExperiences()
    {
        list($idexperience, $company, $title, $location, $periodfrom, $periodto, $description) = 
         array(recoverPOST("experience"), recoverPOST("company"), recoverPOST("title"), recoverPOST("location"), recoverPOST("periodfrom"), recoverPOST("periodto"), recoverPOST("description"));
        
        if (is_array($idexperience) and is_array($company) and is_array($title) and is_array($periodfrom) and is_array($periodto) and is_array($description)) {
            $return = array();
            
            for ($i = 0; $i < count($idexperience); $i++) {
                $return[] = array(
                    "ID_Experience" => $idexperience[$i],
		            "Company" => $company[$i],
		            "Job_Title" => $title[$i],
		            "Location" => $location[$i],
		            "Period_From" => $periodfrom[$i],
		            "Period_To" => $periodto[$i],
		            "Description" => $description[$i]
                );
            }
            
            return $return;
        }
        
        return array(array(
            "ID_Experience" => "",
            "Company" => "",
            "Job_Title" => "",
            "Location" => "",
            "Period_From" => "",
            "Period_To" => "",
            "Description" => ""
        ));
    }
}

if (!function_exists("recoverEducation")) {
    function recoverEducation()
    {
        list($idschool, $school, $degree, $periodfrom, $periodto, $description) = 
         array(recoverPOST("school"), recoverPOST("school"), recoverPOST("degree"), recoverPOST("periodfrom"), recoverPOST("periodto"), recoverPOST("description"));
        
        if (is_array($idschool) and is_array($school) and is_array($degree) and is_array($periodfrom) and is_array($periodto) and is_array($description)) {
            $return = array();
            
            for ($i = 0; $i < count($idschool); $i++) {
                $return[] = array(
                    "ID_School" => $idschool[$i],
		            "School" => $school[$i],
		            "Degree" => $degree[$i],
		            "Period_From" => $periodfrom[$i],
		            "Period_To" => $periodto[$i],
		            "Description" => $description[$i]
                );
            }
            
            return $return;
        }
        
        return array(array(
            "ID_School" => "",
            "School" => "",
            "Degree" => "",
            "Period_From" => "",
            "Period_To" => "",
            "Description" => ""
        ));
    }
}

if (!function_exists("getFlag")) {
    function getFlag($country)
    {
        $country = strtolower($country);
        
        switch ($country) {
            case "argentina":
            case "chile":
            case "colombia":
            case "ecuador":
            case "mexico":
            case "panama":
            case "paraguay":
            case "peru":
            case "spain":
            case "uruguay":
            case "venezuela":
                return '<span class="flag '. $country .'-flag"></span>';
                break;
            
            default:
                return '<span class="flag world-flag"></span>';
                break;
        }
    }
}

if (!function_exists("getAvatar")) {
    function getAvatar($avatar, $username, $link = true, $path = "www/lib/files/images/users/")
    {
        $prepended = "";
        $appended = "";
        $url = preg_match('/^https?:/', $avatar);

        if ($avatar !== "default.png" and $link === true) {
            if ($url) {
                $prepended = '<a href="'. $avatar .'" target="_blank">';
            } else {
                $prepended = '<a href="'. path($path . sha1($username ."_O") .".png", true) .'" target="_blank">';
            }
            $appended = '</a>';
        }

        if ($url) {
            return $prepended .'<img src="'. $avatar .'" alt="'. $username .'" class="avatar" />'. $appended;
        } else {
            return $prepended .'<img src="'. path($path . $avatar, true) . '" alt="'. $username .'" class="avatar" />'. $appended;
        }
    }
}