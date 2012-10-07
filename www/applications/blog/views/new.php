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
		$textarea = $("textarea[name='content']");
		$textarea.destroyEditor();
		$parentEditor = $textarea.parent();
		$textarea.val($textarea.val().replace(/(<pre>)/img, "[code]"));
		$textarea.val($textarea.val().replace(/(<\/pre>)/img, "[/code]"));
		$textarea.val($textarea.val().replace(/(<hr\s*\/?>)/img, "------"));
		$textarea.markItUp(mySettings);
	} else {
		if ($parentEditor !== null) {
			$textarea = $parentEditor.find("textarea").detach();
			$parentEditor.find(".markItUp").parent().remove();
			$textarea.attr("className", "required");
			$parentEditor.append($textarea);
		} else {
			$textarea = $("textarea[name='content']");
		}
		
		$textarea.val($textarea.val().replace(/(\[code\])/img, "<pre>"));
		$textarea.val($textarea.val().replace(/(\[\/code\])/img, "</pre>"));
		$textarea.val($textarea.val().replace(/\-{6}/img, "<hr />"));
		$textarea.val($textarea.val().replace(/<\!\-{4}>/img, "<hr />"));
		$textarea.val($textarea.val().replace("<p><!-- pagebreak --></p>", "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: center;"><!-- pagebreak --></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: left;"><!-- pagebreak --></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: right;"><!-- pagebreak --></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: justify;"><!-- pagebreak --></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: center;"><span style="color: #ff0000;"><!----></span></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: center;"><em><!-- pagebreak --></em></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: center;"><strong><!-- pagebreak --></strong></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: center;"><span style="text-decoration: underline;"><!-- pagebreak --></span></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p style="text-align: justify;"><!-- pagebreak --></p>', "<hr />"));
		$textarea.val($textarea.val().replace('<p><!-- pagebreak -->', "<hr />"));
		$textarea.val($textarea.val().replace("<p><!-- pagebreak --></p>", "<hr />"));
		$textarea.val($textarea.val().replace('<!-- pagebreak -->', "<hr />"));
		$textarea.val($textarea.val().replace('<!-- Pagebreak -->', "<hr />"));
		$textarea.val($textarea.val().replace('<!--Pagebreak-->', "<hr />"));

		$("textarea[name='content']").redactor({
			focus: true,
	<?php
		if(get("webLang") !== "en")	{
			echo 'lang: "'. get("webLang") .'",';
		}
	?>
			buttons:['formatting', '|', 'bold', 'italic', 'deleted', '|',
				    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
				    'image', 'video', 'file', 'table', 'link', '|',
				    'fontcolor', 'backcolor', '|',
				    'alignleft', 'aligncenter', 'alignright', 'justify'],
			buttonsAdd: ["|", "button1", "button2"],
			buttonsCustom: {
				button1: {
					title: "<?php echo __("Insert Break Line"); ?>",
					callback: function(obj, event, key) {
						$("textarea[name='content']").insertHtml('<hr /><p></p>');
					}
				},
				button2: {
					title: "<?php echo __("Insert Code"); ?>",
					callback: function(obj, event, key) {
						$("textarea[name='content']").execCommand("formatblock", '<pre>');
					}
				}
			}
		});
	}
}
</script>