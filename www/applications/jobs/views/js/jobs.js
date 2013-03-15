$(document).on("ready", function() {
	$("#apply").on("click", function() { 
		var jauthor = $("#jauthor").val();
		var jname =$("#jname").val();
		var jemail = $("#jemail").val();
		var message = $("#message").val();
		var success = '<div id="success-message" class="alert alert-success">' + $("#success").val() + '</div>';
		var needContent = '<div id="alert-message" class="alert alert-error">' + $("#needcontent").val() + '</div>';
		
		if (message.length == 0) {
			$("#message-alert").html(needContent);
			$("#message-alert").show();
			$("#message-alert").hide(4000);
		} else {
			$("#message-alert").html(success);
			$("#message-alert").show();
			$("#message-alert").hide(4000);
		}

		$.ajax({
			type: 'POST',
			url: PATH + '/jobs/apply',
			data: 'jname=' + jname + '&jauthor=' + jauthor + '&jemail=' + jemail + '&message=' + message,
			success: function(response) {
			console.log(response);
			location.reload();
			}
		});	
	});
});