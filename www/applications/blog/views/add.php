<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

$ID 		= isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) : 0;
$title 		= isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");		
$tags 		= isset($data) ? recoverPOST("tags", $data[0]["Tags"]) : recoverPOST("tags");
$content 	= isset($data) ? encode(recoverPOST("content", $data[0]["Content"])) : recoverPOST("content");	
$situation 	= isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");				
$language 	= isset($data) ? recoverPOST("language", $data[0]["Language"]) : recoverPOST("language");
$author 	= isset($data) ? recoverPOST("author", $data[0]["Author"]) : SESSION("ZanUser");
$userID 	= isset($data) ? recoverPOST("ID_User", $data[0]["ID_User"]) : SESSION("ZanUserID");
$buffer 	= isset($data) ? (int) recoverPOST("buffer", $data[0]["Buffer"]) : 1;
$code 		= isset($data) ? recoverPOST("code", $data[0]["Code"]) : recoverPOST("code");
$mural 		= isset($data) ? $data[0]["Image_Mural"] : null;
$image 		= isset($data) ? $data[0]["Image_Medium"] : null;
$edit 		= isset($data) ? true : false;
$action 	= isset($data) ? "edit" : "save";
$href 		= isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
$enable 	= isset($data) ? (int) recoverPOST("enable_comments", $data[0]["Enable_Comments"]) : 1;
$bio 		= isset($data) ? recoverPOST("display_bio", $data[0]["Display_Bio"]) : recoverPOST("display_bio", true);

echo div("add-form", "class");
	echo formOpen($href, "form-add", "form-add", null, "post", "multipart/form-data");
		echo p(__(ucfirst(whichApplication())), "resalt");
		
		echo isset($alert) ? $alert : div("alert-message") . div(false);

		echo formInput(array(	
			"id" 	=> "title",
			"name" 	=> "title", 
			"class" => "span10 required", 
			"field" => __("Title"), 
			"p" 	=> true, 
			"value" => stripslashes($title)
		));

		echo formInput(array(	
			"id" 	=> "tags",
			"name" 	=> "tags", 
			"class" => "span10 required", 
			"field" => __("Tags"), 
			"p" 	=> true, 
			"value" => $tags
		));

		echo formInput(array(	
			"name" 	=> "mural", 
			"type" 	=> "file",
			"class" => "add-img", 
			"field" => __("Mural"), 	
			"p" 	=> true
		));

		if ($action === "edit" and $mural != "") { 
			echo p(img(path($mural, true), array("style" => "max-width:700px;", "class" => "mural")), "left");
			
			echo formInput(array(	
				"name" 	=> "delete_mural", 
				"type" 	=> "checkbox",
				"p" 	=> false
			)) ." ". __("Delete Mural")  . "<br /><br />";
		} 

		echo formTextarea(array(	 
			"id" 	=> "editor",
			"name" 	=> "content", 
			"class" => "ckeditor", 
			"style" => "max-width: 750px;height: 240px;", 
			"field" => __("Content"), 
			"p"		=> true, 
			"value" => stripslashes($content)
		));

		echo '<p><span id="show-multimedia" class="field pointer">&raquo; Multimedia</span></p>';

		echo getFilesFromMultimedia($multimedia);

		echo formInput(array(	
			"name" 	=> "image", 
			"type" 	=> "file",
			"class" => "add-img", 
			"field" => __("Post Image"), 	
			"p" 	=> true
		));

		if ($action === "edit" and $image != "") { 
			echo p(img(path($image, true)), "left");
			
			echo formInput(array(	
				"name" 	=> "delete_image", 
				"type" 	=> "checkbox",
				"p" 	=> false
			)) . " " . __("Delete Image")  . "<br /><br />";
		}

		echo formInput(array(	
			"id" 	=> "author",
			"name" 	=> "author", 
			"class" => "span2 required", 
			"field" => __("Author"), 
			"p" 	=> true, 
			"value" => stripslashes($author)
		));

		echo formField(null, __("Language of the post") ."<br />". getLanguagesInput($language, "language", "select"));

		$options = array(
			array("value" => 1, "option" => __("Yes"), "selected" => ($bio === 1) ? true : false),
			array("value" => 0, "option" => __("No"),  "selected" => ($bio === 0) ? true : false)
		);

		echo formSelect(array(
			"name" 	=> "display_bio", 
			"class" => "required", 
			"p" 	=> true, 
			"field" => __("Display author bio")), 
			$options
		);

		$options = array(
			0 => array("value" => 1, "option" => __("Yes"), "selected" => ($enable === 1) ? true : false),
			1 => array("value" => 0, "option" => __("No"),  "selected" => ($enable === 0) ? true : false)
		);

		echo formSelect(array(
			"name" 	=> "enable_comments", 
			"class" => "required", 
			"p" 	=> true, 
			"field" => __("Enable Comments")), 
			$options
		);

		$options = array(
			0 => array("value" => 1, "option" => __("Active"), "selected" => ($buffer === 1) ? true : false),
			1 => array("value" => 0, "option" => __("Inactive"), "selected" => ($buffer === 0) ? true : false)
		);

		echo formSelect(array(
			"id" 	=> "buffer",
			"name" 	=> "buffer", 
			"p" 	=> true, 
			"class" => "required", 
			"field" => __("Buffer")), 
			$options
		);
		
		$options = array(
			0 => array("value" => "Draft", "option" => __("Draft"), "selected" => ($situation === "Draft") ? true : false),
			1 => array("value" => "Active", "option" => __("Active"), "selected" => ($situation === "Active") ? true : false),
			2 => array("value" => "Inactive", "option" => __("Inactive"), "selected" => ($situation === "Inactive") ? true : false)
		);

		echo formSelect(array(
			"id" 	=> "situation",
			"name" 	=> "situation", 
			"p" 	=> true, 
			"class" => "required", 
			"field" => __("Situation")), 
			$options
		);			

		if (isset($medium)) {
			echo img(path($medium, true));
		}
		
		echo formAction($action, true, $ID);
		echo formInput(array("id" => "ID_Post", 	"name" => "ID", 		"type" => "hidden", "value" => $ID));
		echo formInput(array("id" => "ID_User", 	"name" => "ID_User", 	"type" => "hidden", "value" => $userID));
		echo formInput(array("id" => "code", 		"name" => "code", 		"type" => "hidden", "value" => code(10)));
		echo formInput(array("id" => "temp_title", 	"name" => "temp_title", "type" => "hidden", "value" => addslashes($title)));
		echo formInput(array("id" => "temp_tags", 	"name" => "temp_tags", 	"type" => "hidden", "value" => $tags));
		
	echo formClose();
echo div(false);

echo $ckeditor;