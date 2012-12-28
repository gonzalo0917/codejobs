CodeMirror.modeURL = ZAN + "vendors/js/codemirror/mode/%N.js";

$('textarea[name="code"]').each(function() {
    var editor = CodeMirror.fromTextArea(this, {
        lineNumbers: true,
        matchBrackets: true,
        readOnly: "nocursor"
    });

    if (syntax[$(this).data("syntax")].Filename.length > 0) {
        CodeMirror.autoLoadMode(editor, syntax[$(this).data("syntax")].Filename);
    }
    editor.setOption("mode", syntax[$(this).data("syntax")].MIME);
});