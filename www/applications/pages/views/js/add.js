//<!--

+function ($, window, document, undefined) {

	CodeMirror.fromTextArea($("textarea").get(0), {
		lineNumbers: true,
		matchBrackets: true,
		mode: "application/x-httpd-php",
		indentUnit: 4,
		indentWithTabs: true,
		enterMode: "keep",
		tabMode: "shift"
	});

} (jQuery, window, document);

//-->