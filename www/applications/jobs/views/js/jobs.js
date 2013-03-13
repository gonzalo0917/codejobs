$(document).on("ready", function() {
	$("#apply").on("click", function() { 
		var jid = $("#jid").val();
		var jname =$("#jname").val();
		var message = $("#message").val();
		var needContent = $("#needcontent").val();
		
		if (content.length == 0) {
			$("#comment-alert").html(needContent);
			$("#comment-alert").show();
			$("#comment-alert").hide(4000);
		}

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