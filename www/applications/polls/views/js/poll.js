$("#send-vote").click(function(e) {
	var found = false;
	$("#polls input[type='radio']").each(function() {
		if (this.checked) found = this.value;
	});

	if (found) {
		$(this).val(sending_message + "...");
		$(this).attr("disabled", true);
		$(poll_selector).load(PATH + "/polls/vote/", {
			"answer": found,
			"ID_Poll": $("input[name='ID_Poll']").val()
		});
	} else {
		alert(empty_message);
	}
});