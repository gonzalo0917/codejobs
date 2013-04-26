;+function($, window, document, undefined) {
	var $form = $("form:last");

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
				<button id="doChangePassword" class="btn btn-danger">' + acceptLabel + '</button> \
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

	$('#doChangePassword').on('click', function() {
		if($("#request-password input").val().length > 0) {
			$("#request-password").modal("hide");
			$('<input name="password" type="hidden" value="' + $("#request-password input").val() + '" />').appendTo($form.find("fieldset"));
			$('<input name="' + $form.find(btnSelector).attr("name") + '" type="hidden" value="1" />').appendTo($form.find("fieldset"));
			//$form.submit();
			console.log($('#request-password').find('input:password').val());
			formData = {
				'password' : $('#request-password').find('input:password').val(),
				'new_password' : $('input[name=new_password]').val(),
				're_new_password' : $('input[name=re_new_password]').val(),
				'save' : 'Guardar'
			}
			$.ajax({
                url: PATH + '/users/password',
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    if (data.status) {
                        $('.float-msg').animate({top: 0}, 800, null);
                        $('.float-msg').text("(+) "+data.status).css(successMSG);
                    } else {
                        $('.float-msg').animate({top: 0}, 800, null);
                        $('.float-msg').text("(X) "+data.fail).css(errorMSG);
                    }
                }
            });

        	return false;
		} else {
			$("#request-password input").focus();
		}
	})
}(jQuery, window, document);