<?php 
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$ID 		 = isset($data) ? recoverPOST("ID", $data[0]["ID_Image"]) : 0;
$title 		 = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
$description = isset($data) ? recoverPOST("description", $data[0]["Description"]) : recoverPOST("description");
$category 	 = isset($data) ? recoverPOST("category", $data[0]["Album"]) : recoverPOST("category");
$ID_Category = isset($data) ? recoverPOST("ID_Category", $data[0]["ID_Category"]) : recoverPOST("ID_Category");
$medium 	 = isset($data) ? recoverPOST("medium", $data[0]["Medium"]) : recoverPOST("medium");
$situation   = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
$edit 		 = isset($data) ? true : false;
$action 	 = isset($data) ? "edit" : "save";
$href 		 = isset($data) ? path(whichApplication() ."/cpanel/edit/$ID") : path(whichApplication() ."/cpanel/add");

echo div("add-form", "class");
	echo formOpen($href, "form-add", "form-add", null, "post", "multipart/form-data");
		echo p(__(ucfirst(whichApplication())), "resalt");
		echo isset($alert) ? $alert : null;

		echo formInput(array(
			"name" 	=> "category", 
			"class" => "span10 required", 	
			"field" => __("Category"),		
			"p" 	=> true
		));

		print formInput(array(
			"type" 	   => "file", 			
			"name" 	   => "images[]",
			"multiple" => "multiple",
			"field"    => __("Upload images"), 
			"p" 	   => true
		)); 		

		echo formAction($action);
		echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
	echo formClose();
echo div(false);