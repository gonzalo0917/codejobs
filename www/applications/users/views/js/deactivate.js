$("#getPassword").on("shown", function () {
	$("#getPassword input").focus();
	if(!$("#getPassword input").data("onkeypress")) {
		$("#getPassword input").on("keypress", function(e) {
			if (e.keyCode === 13) {
				acceptedPass();
			}
		});

		$("#getPassword input").data("onkeypress", true);
	}
});

$("#getPassword").on("hidden", function () {
	$("#getPassword input").val("");
});

function acceptedPass() {
	if($("#getPassword input").val().length > 0) {
		$("#getPassword").modal("hide");
		$('<input name="password" type="hidden" value="' + $("#getPassword input").val() + '" />').appendTo($("form.deleteForm > fieldset"));
		$("form.deleteForm").submit();
	} else {
		$("#getPassword input").focus();
	}
}