<?php
/**
 * Access from index.php:
 */
if(!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

define("MURAL_SIZE", "940x320px");

if(!defined("MAX_LIMIT")) {
	define("MAX_LIMIT", 10);
}

define("LOCK", "www/lib/images/icons/blog/lock.png");