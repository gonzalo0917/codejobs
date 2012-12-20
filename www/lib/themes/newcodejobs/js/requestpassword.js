;+function($, window, document, undefined) {
	var $form = $("form:last"),
		acceptLabel = acceptLabel || 'Ok',
		cancelLabel = cancelLabel || 'Cancel',
		inputLabel  = inputLabel  || 'Input your password',
		btnSelector = btnSelector || 'input[type="submit"]:first';

	$form.find(btnSelector).get(0).dataset.toggle = "modal";
	$form.find(btnSelector).get(0).dataset.target = "#request-password";

	$form.after(' \
		<div id="request-password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> \
			<div class="modal-header"> \
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> \
				<h3 id="myModalLabel">' + inputLabel + '</h3> \
			</div> \
			<div class="modal-body"> \
				<p><input type="password" /></p> \
			</div> \
			<div class="modal-footer"> \
				<button class="btn btn-primary" onclick="requestPasswordAccepted()">' + acceptLabel + '</button> \
				<button class="btn" data-dismiss="modal" aria-hidden="true">' + cancelLabel + '</button> \
			</div> \
		</div> \
	');

	$("#request-password").on("shown", function () {
		$("#request-password input").focus();
		if(!$("#request-password input").data("onkeypress")) {
			$("#request-password input").on("keypress", function(e) {
				if (e.keyCode === 13) {
					requestPasswordAccepted();
				}
			});

			$("#request-password input").data("onkeypress", true);
		}
	});

	$("#request-password").on("hidden", function () {
		$("#request-password input").val("");
	});

	function requestPasswordAccepted() {
		if($("#request-password input").val().length > 0) {
			$("#request-password").modal("hide");
			$('<input name="password" type="hidden" value="' + $("#request-password input").val() + '" />').appendTo($form.find("fieldset"));
			$form.submit();
		} else {
			$("#request-password input").focus();
		}
	}
}(jQuery, window, document);