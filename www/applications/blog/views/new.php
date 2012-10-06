<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID  	     = isset($data) ? recoverPOST("ID", 0) 								: 0;
	$title       = isset($data) ? recoverPOST("title", $data["Title"]) 				: recoverPOST("title");
	$content 	 = isset($data) ? recoverPOST("content", $data["Content"])		 	: recoverPOST("content");
	$tags    	 = isset($data) ? recoverPOST("tags", $data["Tags"]) 				: recoverPOST("tags");
	$language  	 = isset($data) ? recoverPOST("language", $data["Language"])  	 	: recoverPOST("language");
	$edit        = isset($data) ? TRUE 												: FALSE;
	$action	     = isset($data) ? "edit"											: "save";
	$href	     = path("blog/add/");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Add new post"), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 		=> "title", 
				"style" 	=> "width: 100%;", 
				"field" 	=> __("Title"), 
				"p" 		=> TRUE, 
				"autofocus" => "autofocus", 
				"value" 	=> stripslashes($title)
			));

			$options = array(
				0 => array("value" => 1, "option" => "Redactor", "selected" => TRUE),
				1 => array("value" => 0, "option" => "markItUp!")
			);

			echo formSelect(array(
				"name" 		=> "editor", 
				"p" 		=> TRUE, 
				"field" 	=> __("Editor"), 
				"onchange" 	=> 'switchEditor($(this).val())'),
				$options
			);
			
			echo formTextarea(array(
				"name" 	 => "content", 
				"style"  => "width: 100%; height: 240px;", 
				"field"  => __("Content"), 
				"p" 	 => TRUE, 
				"value"  => stripslashes($content)
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"style" => "width: 300px;", 
				"field" => __("Tags"), 
				"p" 	=> TRUE, 
				"value" => $tags
			));

			echo tagHTML("p", span("field", "&raquo; " . __("Language of the post")) . "<br />" . getLanguagesInput($language, "language", "select"));

			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

			echo formInput(array(	
				"name" 	=> "preview", 
				"class" => "btn", 
				"value" => __("Preview"), 
				"type"  => "submit"
			));
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(FALSE);
?>
<script>
var $parentEditor = null;

$(document).ready(function() {
	switchEditor(1)
});

function switchEditor(id) {
	var $textarea;

	if (id == 0) {
		$("textarea[name='content']").destroyEditor();
		$parentEditor = $("textarea[name='content']").parent();
		$("textarea[name='content']").markItUp(mySettings);
	} else {
		if ($parentEditor !== null) {
			$textarea = $parentEditor.find("textarea").detach();
			$parentEditor.find(".markItUp").parent().remove();
			$textarea.attr("className", "required");
			$parentEditor.append($textarea);
		}
		$("textarea[name='content']").redactor({
			focus: true,
			lang: "es",
			buttonsAdd: ["|", "button1"],
			buttonsCustom: {
				button1: {
					title: "<?php echo __("Insert Break Line"); ?>",
					callback: function(obj, event, key) { void(0); }
				}
			}
		});
	}
}
</script>