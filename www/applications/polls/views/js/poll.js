$("#send-vote").click(function(e) {
	var found = false;
	$("#polls input[type='radio']").each(function() {
		if (this.checked) found = this.value;
	});

	if (found) {
		$("#polls input[type='button']").fadeOut(function() {
			$("#warningGradientOuterBarG").fadeIn(function() {
				$(poll_selector).load(PATH + "/polls/vote/", {
					"answer": found,
					"ID_Poll": $("input[name='ID_Poll']").val()
				});
			});
		});
	} else {
		alert(empty_message);
	}
});

$("#results").click(function(e) {
	$("#polls input[type='button']").fadeOut(function() {
		$("#warningGradientOuterBarG").fadeIn(function() {
			
		});
	});
});