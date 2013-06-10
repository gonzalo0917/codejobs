;+function($, window, document, undefined) {
	var $form = $("form:last");
	var successMSG = { 'background' : 'rgba(92,164,81,1)' };
	var errorMSG = { 'background' : 'rgba(203,33,34,0.8)' };

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
		requestPasswordAccepted();
	})

	function requestPasswordAccepted() {
		if($("#request-password input").val().length > 0) {
			$("#request-password").modal("hide");
			/*$('<input name="password" type="hidden" value="' + $("#request-password input").val() + '" />').appendTo($form.find("fieldset"));
			$('<input name="' + $form.find(btnSelector).attr("name") + '" type="hidden" value="1" />').appendTo($form.find("fieldset"));*/
			//$form.submit();

			/*$($form).validate({
	            rules: {
	                new_password: {
	                    required: true,
	                    minlength: 6
	                },
	                re_new_password: {
	                    required: true,
	                    minlength: 6
	                },
	                messages: {
	                   new_password: {
	                           required: "Dude, enter a name",
	                           minlength: $.format("Keep typing, at least {0} characters required!")
		            	}
		            }
		        }
	        });*/

	  		formData = $form.serializeArray();

			formData.push({ name: 'password', value: $('#request-password').find('input:password').val() })
			formData.push({ name: 'save', value: 'Guardar' })

			$.ajax({
                url: PATH + '/users/password',
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function (data) {
                	if (data.status) {
	                    $('.float-msg').animate({top: 0}, 800, null);

	                    if ($(data["status"].msg).text() != "")
	                    	$('.float-msg').text("(+) "+$(data["status"].msg).text());
	                    else 
	                    	$('.float-msg').text("(+) "+data["status"].msg);

	                    if (data["status"].type == "success") 
	                       	$('.float-msg').css(successMSG);
	                    else 
	                     	$('.float-msg').css(errorMSG);
	                }
                }
            });

        	return false;
		} else {
			$("#request-password input").focus();
		}
	}
}(jQuery, window, document);