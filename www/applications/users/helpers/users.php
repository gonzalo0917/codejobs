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
        list($idfiles, $syntax, $names, $codes) = 
         array(recoverPOST("file"), recoverPOST("syntax"), recoverPOST("name"), recoverPOST("code"));
        
        if (is_array($idfiles) and is_array($syntax) and is_array($names) and is_array($codes)) {
            $return = array();
            
            for ($i = 0; $i < count($idfiles); $i++) {
                $return[] = array(
                    "ID_File" => $idfiles[$i],
                    "Name" => $names[$i],
                    "ID_Syntax" => $syntax[$i],
                    "Code" => $codes[$i]
                );
            }
            
            return $return;
        }
        
        return array(array(
            "ID_File" => "",
            "Name" => "",
            "ID_Syntax" => 1,
            "Code" => ""
        ));
    }
}

if (!function_exists("recoverEducation")) {
    function recoverEducation()
    {
        list($idfiles, $syntax, $names, $codes) = 
         array(recoverPOST("file"), recoverPOST("syntax"), recoverPOST("name"), recoverPOST("code"));
        
        if (is_array($idfiles) and is_array($syntax) and is_array($names) and is_array($codes)) {
            $return = array();
            
            for ($i = 0; $i < count($idfiles); $i++) {
                $return[] = array(
                    "ID_File" => $idfiles[$i],
                    "Name" => $names[$i],
                    "ID_Syntax" => $syntax[$i],
                    "Code" => $codes[$i]
                );
            }
            
            return $return;
        }
        
        return array(array(
            "ID_File" => "",
            "Name" => "",
            "ID_Syntax" => 1,
            "Code" => ""
        ));
    }
}