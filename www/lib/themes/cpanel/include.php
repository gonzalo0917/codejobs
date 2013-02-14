<?php 
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here..."); 
}
 
$this->load(isset($view) ? $view : null, true); 
?>