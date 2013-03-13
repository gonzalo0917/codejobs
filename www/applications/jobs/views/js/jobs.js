$(document).on("ready", function() {
	$("#apply").on("click", function() { 
		var jid = $("#jid").val();
		var jname =$("#jname").val();
		var message = $("#message").val();
		$.ajax({
			type: 'POST',
			url: PATH + '/jobs/apply',
			data: 'jid=' + jid + '&message=' + message,
			success: function(response) {
			console.log(response);
			}
		});	
	});
});