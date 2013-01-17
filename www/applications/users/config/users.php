<?php

if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

define("_fbAppID", "324953487621707");
define("_fbAppSecret", "77d85e535c01319c86f4b150bbf87f8a");
define("_fbAppScope", "email,user_birthday,read_stream");
define("_fbAppFields", "id,name,email,birthday,picture,username");
define("_fbAppURL", "http://www.codejobs.biz/es/users/service/facebook/");

define("_bootstrap", TRUE);
define("_hideRight", TRUE);
define("_showLeft", TRUE);