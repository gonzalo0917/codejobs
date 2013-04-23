!function($) {
	$("select[name='country']").change(function () {
		var $state, $obj;

		$state = $("select[name='state']");
		$obj  = $("select[name='country']");

		$state.attr('disabled', true);
		$state.empty();

		if ($obj.val() !== "") {
			$obj.attr('disabled', true);
			$.ajax({
				url: PATH + "/configuration/world/?country=" + $obj.val(),
				dataType: "json",
				success: function (data) {
					$.each(data, function(val, text) {
					    $state.append(new Option(text, val));
					});

					$state.attr('disabled', false);
					$obj.attr('disabled', false);
				},
				error: function () {
					alert("An error has occurred");
				}
			});
		}
	});

	$('#about-section').on('submit','form',function() {
    	$('.float-msg').css(errorMSG);

    	formData = $(this).serializeArray();

    	formData.push({
    		name: $(this).find('input[type=submit]').attr('name'),
    		value: $(this).find('input[type=submit]').val()
    	});

    	$.ajax({
    			url: PATH + '/users/about',
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
    })
}(jQuery);