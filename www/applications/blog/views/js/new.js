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
		$textarea.val($textarea.val().replace(/(<hr\s*\/?>)/img, "<!---->"));
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
		$textarea.val($textarea.val().replace(/(<p[^<]*><!--\s*pagebreak\s*-->(<\/p>)?)/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<p[^<]*><(span|em|strong)[^<]*><!--\s*pagebreak\s*--><\/(span|em|strong)><\/p>)/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<!--\s*pagebreak\s*-->)/img, "<hr />"));

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