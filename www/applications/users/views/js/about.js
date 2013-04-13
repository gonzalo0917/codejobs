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
}(jQuery);