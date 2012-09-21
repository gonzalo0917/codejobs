<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) 			 : 0;
	$ID_URL    = isset($data) ? recoverPOST("ID_URL", $data[0]["ID_URL"]) 		 : recoverPOST("ID_URL");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])   		 : recoverPOST("title");		
	$tags      = isset($data) ? recoverPOST("tags", $data[0]["Tags"])   		 : recoverPOST("tags");
	$content   = isset($data) ? $data[0]["Content"] 	 						 : recoverPOST("content");	
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$pwd   	   = isset($data) ? recoverPOST("pwd", $data[0]["Pwd"])				 : recoverPOST("pwd");
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path("blog/data");
	
?>
<form action="<?=$href;?>" method="post">
	<input name="nombre" type="text" />

	<input name="enviar" type="submit" />
</form>