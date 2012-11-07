<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); 		

header("Content-Type: application/json");
?>
{
	"return": <?php echo (int)$data; ?>
}