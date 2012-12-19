<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

include "requirements.php";

$Load = new ZP_Load(); 

$Load->helper("users", "users");
$Load->helper(array("i18n", "sessions", "router"));

include "configuration.php";

getOnlineUsers();

if($ZP["benchMark"]) {
	$Load->helper("benchmark");
	
	benchMarkStart();
}

execute();

if($ZP["benchMark"] and SESSION("ZanUserPrivilegeID") === 1) {
	benchMarkEnd();
}