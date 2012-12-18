var loading = false;

$("#send-vote").click(function(e) {
	var found = false;
	$("#polls input[type='radio']").each(function() {
		if (this.checked) found = this.value;
	});

	if (found) {
		$("#polls input[type='button']").fadeOut(function() {
			$("#warningGradientOuterBarG").fadeIn(function() {
				if (!loading) {
					loading = true;

					$(poll_selector).load(PATH + "/polls/vote/?answer=" + found + "&ID_Poll=" + $("input[name='ID_Poll']").val(), new Function("loading = false"));
				}
			});
		});
	} else {
		alert(empty_message);
	}
});

$("#results").click(function(e) {
	$("#polls input[type='button']").fadeOut(function() {
		$("#warningGradientOuterBarG").fadeIn(function() {
			if (!loading) {
				loading = true;

				$(poll_selector).load(PATH + "/polls/last/results/", new Function("loading = false"));
			}
		});
	});
});