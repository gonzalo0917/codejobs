var $parentEditor = null;

function switchEditor(id, selector) {
	var $textarea;

	if (!selector) selector = "textarea";

	if (id == 2) {
		$textarea = $(selector);
		if ($textarea.data("redactor")) $textarea.destroyEditor();
		
		$parentEditor = $textarea.parent();
		$textarea.val($textarea.val().replace(/(<code>)/img, "[code]"));
		$textarea.val($textarea.val().replace(/(<\/code>)/img, "[/code]"));
		$textarea.val($textarea.val().replace(/(<hr\s*\/?>)/img, "<!---->"));
		$textarea.markItUp(mySettings);
	} else if (id == 1) {
		if ($parentEditor !== null) {
			$textarea = $parentEditor.find("textarea").detach();
			$parentEditor.find(".markItUp").parent().remove();
			$textarea.attr("className", "required");
			$parentEditor.append($textarea);
		} else {
			$textarea = $(selector);
		}
		
		$textarea.val($textarea.val().replace(/(\[code\])/img, "<code>"));
		$textarea.val($textarea.val().replace(/(\[\/code\])/img, "</code>"));
		$textarea.val($textarea.val().replace(/\-{6}/img, "<hr />"));
		$textarea.val($textarea.val().replace(/<\!\-{4}>/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<p[^<]*><!--\s*pagebreak\s*-->(<\/p>)?)/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<p[^<]*><(span|em|strong)[^<]*><!--\s*pagebreak\s*--><\/(span|em|strong)><\/p>)/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<!--\s*pagebreak\s*-->)/img, "<hr />"));

		$(selector).redactor(redactorSettings);
	}
}