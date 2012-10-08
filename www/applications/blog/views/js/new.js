$(document).ready(function() {
	switchEditor(1);
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
		var settings;

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

		settings = {
			focus: true,
			buttons:['formatting', '|', 'bold', 'italic', 'deleted', '|',
				    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
				    'image', 'video', 'file', 'table', 'link', '|',
				    'fontcolor', 'backcolor', '|',
				    'alignleft', 'aligncenter', 'alignright', 'justify'],
			buttonsAdd: ["|", "button1", "button2"],
			buttonsCustom: {
				button1: {
					title: label1,
					callback: function(obj, event, key) {
						$("textarea[name='content']").insertHtml('<hr /><p></p>');
					}
				},
				button2: {
					title: label2,
					callback: function(obj, event, key) {
						$("textarea[name='content']").execCommand("formatblock", '<pre>');
					}
				}
			}
		};

		if (language !== "en") {
			settings["lang"] = language;
		}

		$("textarea[name='content']").redactor(settings);
	}
}