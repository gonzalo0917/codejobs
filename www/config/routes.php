<?php
if(!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$routes = array(
	0 => array(
		"pattern"	  => "/^tv/",
		"application" => "pages",
		"controller"  => "pages",
		"method"	  => "tv",
		"params"	  => array()
	),
	1 => array(
		"pattern"	  => "/^publicidad/",
		"application" => "pages",
		"controller"  => "pages",
		"method"	  => "getBySlug",
		"params"	  => array("publicidad")
	),
	2 => array(
		"pattern"	  => "/^links/",
		"application" => "pages",
		"controller"  => "pages",
		"method"	  => "getBySlug",
		"params"	  => array("links")
	),
	3 => array(
		"pattern"	  => "/^live/",
		"application" => "pages",
		"controller"  => "pages",
		"method"	  => "getBySlug",
		"params"	  => array("live")
	),
);