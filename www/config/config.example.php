<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

/**
 * Website
 */
$ZP["webURL"] 	    = "http://localhost:8088/codejobs";
$ZP["webName"] 	    = "ZanPHP";
$ZP["webTheme"]     = "default";
$ZP["webSituation"] = "Active";
$ZP["webMessage"]   = "";
$ZP["benchMark"]	= FALSE;

/**
 * Server
 *
 * Environment: 
 *  1. Development 
 *  2. Demo 
 *  3. Stage  
 *  4. Production
 */
$ZP["environment"]  = 1;
$ZP["optimization"] = TRUE;
$ZP["domain"] 	    = FALSE;
$ZP["modRewrite"]   = FALSE;
$ZP["autoRender"]   = TRUE;
$ZP["allowIP"]      = array("127.0.0.1");

/**
 * Applications
 */
$ZP["defaultApplication"] = "default";

/**
 * Languages
 */
$ZP["webLanguage"] = "Spanish";
$ZP["translation"] = "normal";

/**
 * Constants
 */
define("_sh", "/");
define("_corePath", "zan");
define("_index", "index.php");
define("_secretKey", "_eh{Ll&}`<6Y\mg1Qw(;;|C3N9/7*HTpd7SK8t/[}R[vW2)vsPgBLRP2u(C|4]%m_");
define("_defaultTimezone", "America/Mexico_City");
define("_via", "codejobs");

/**
 * Twitter App
 */
define("_twConsumerKey", "Your Twitter Consumer Key");
define("_twConsumerSecret", "Your Twitter Consumer Secret");
define("_twRequestTokenURL", "http://twitter.com/oauth/request_token");
define("_twAuthorizeURL", "http://twitter.com/oauth/authorize");
define("_twAccessTokenURL", "http://twitter.com/oauth/access_token");

/**
 * Facebook App
 */
define("_fbAppID", "Your Facebook App ID");
define("_fbAppSecret", "Your Facebook App Secret");
define("_fbAppScope", "email,user_birthday,read_stream");
define("_fbAppFields", "id,name,email,birthday,picture,username");
define("_fbAppURL", "Your Facebook App URL");

/**
 * Cache
 */
define("_cacheStatus", FALSE);
define("_cacheDriver", "File");
define("_cacheHost", "localhost"); 
define("_cachePort", "11211");
define("_cacheDir", "www/lib/cache");
define("_cacheTime", 3600);
define("_cacheExt", ".cache");

/**
 * E-Mail
 */
define("_gUser", "youremail@gmail.com");
define("_gPwd", "USER PASSWORD");
define("_gSSL", "ssl://smtp.gmail.com");
define("_gPort", 465);

/**
 * Images:
 */
define("_library", "library");
define("_image", "image");
define("_images", "images");
define("_maxWidth", 720);
define("_maxHeight", 380);
define("_minSmall", 60);
define("_maxSmall", 90);
define("_minThumbnail", 90);
define("_maxThumbnail", 90);
define("_minMedium", 220);
define("_maxMedium", 320);
define("_minLarge", 700);
define("_maxLarge", 1024);
define("_fileSize", 10485760);

if(!$ZP["modRewrite"]) {
	$ZP["webBase"] = $ZP["webURL"] . _sh . _index;
} else {
	$ZP["webBase"] = $ZP["webURL"];
}