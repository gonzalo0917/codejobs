<?php
	header('Content-Type: application/javascript');

	if(!isset($_GET['lang']) || !isset($_GET['label1']) || !isset($_GET['label2'])) exit ;

	$lang 	= strip_tags(urldecode($_GET['lang']));
	$label1 = strip_tags(urldecode($_GET['label1']));
	$label2 = strip_tags(urldecode($_GET['label2']));
?>
var $parentEditor = null;

function switchEditor(id) {
	var $textarea, selector = "textarea[name='content']";

	if (id == 2) {
		$textarea = $(selector);
		if ($textarea.data("redactor")) $textarea.destroyEditor();
		
		$parentEditor = $textarea.parent();
		$textarea.val($textarea.val().replace(/(<pre>)/img, "[code]"));
		$textarea.val($textarea.val().replace(/(<\/pre>)/img, "[/code]"));
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
		
		$textarea.val($textarea.val().replace(/(\[code\])/img, "<pre>"));
		$textarea.val($textarea.val().replace(/(\[\/code\])/img, "</pre>"));
		$textarea.val($textarea.val().replace(/\-{6}/img, "<hr />"));
		$textarea.val($textarea.val().replace(/<\!\-{4}>/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<p[^<]*><!--\s*pagebreak\s*-->(<\/p>)?)/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<p[^<]*><(span|em|strong)[^<]*><!--\s*pagebreak\s*--><\/(span|em|strong)><\/p>)/img, "<hr />"));
		$textarea.val($textarea.val().replace(/(<!--\s*pagebreak\s*-->)/img, "<hr />"));

		$(selector).redactor({
			focus: true,
			<?php
				if($lang !== "en") {
					echo "lang: '$lang',\n";
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
					title: "<?php echo $label1; ?>",
					callback: function(obj, event, key) {
						$(selector).insertHtml('<hr /><p></p>');
					}
				},
				button2: {
					title: "<?php echo $label2; ?>",
					callback: function(obj, event, key) {
						$(selector).execCommand("formatblock", '<pre>');
					}
				}
			}
		});
	}
}