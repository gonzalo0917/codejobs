<?php
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	    = isset($data) ? recoverPOST("ID", $data[0]["ID_Syntax"])			: 0;
	$name 		= isset($data) ? recoverPOST("name", $data[0]["Name"]) 				: recoverPOST("name");
	$mime 		= isset($data) ? recoverPOST("mime", $data[0]["MIME"]) 				: recoverPOST("mime");
	$filename	= isset($data) ? recoverPOST("filename", $data[0]["Filename"]) 		: recoverPOST("filename");
	$extension	= isset($data) ? recoverPOST("extension", $data[0]["Extension"]) 	: recoverPOST("extension");
	$href		= path("codes/cpanel/language");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Programming languages"), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "name", 
				"class" => "span10 required", 
				"field" => __("Name"), 
				"p" 	=> TRUE, 
				"value" => $name
			));
			
			echo formInput(array(	
				"name" 	=> "mime", 
				"class" => "span10 required", 
				"field" => "MIME", 
				"p" 	=> TRUE, 
				"value" => $mime
			));
			
			echo formInput(array(	
				"name" 	=> "filename", 
				"class" => "span10 required", 
				"field" => __("Filename"), 
				"p" 	=> TRUE, 
				"value" => $filename
			));
			
			echo formInput(array(	
				"name" 	=> "extension", 
				"class" => "span10 required", 
				"field" => __("Extension"), 
				"p" 	=> TRUE, 
				"value" => $extension
			));

			$action  = $edit ? "edit" : "save";
			$onclick = 'onclick="$(\'#form-add\').attr(\'target\', \'\'); $(\'#form-add\').attr(\'action\', \''. $href .'\'"';
?>
			<p class="save-cancel">
				<input id="<?php echo $action; ?>" name="<?php echo $action == "edit" ? "editLanguage" : $action; ?>" value="<?php echo __(ucfirst($action)); ?>" <?php echo $onclick; ?> type="submit" class="btn btn-success">
				<input id="cancel" name="cancel" value="<?php echo __("Cancel"); ?>" type="submit" class="btn btn-danger" />
			</p>
<?php
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);

?>