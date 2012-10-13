<?php
	header('Content-Type: application/javascript');

	if(!isset($_GET['lang']) || !isset($_GET['label1']) || !isset($_GET['label2'])) exit("var redactorSettings = {};") ;

	$lang 	= strip_tags(urldecode($_GET['lang']));
	$label1 = strip_tags(urldecode($_GET['label1']));
	$label2 = strip_tags(urldecode($_GET['label2']));
?>
var redactorSettings = {
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
				obj.$el.insertHtml('<hr /><p></p>');
			}
		},
		button2: {
			title: "<?php echo $label2; ?>",
			callback: function(obj, event, key) {
				obj.$el.execCommand("formatblock", '<pre>');
			}
		}
	}
};