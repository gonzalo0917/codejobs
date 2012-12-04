$(document).ready(function() {
	$("#display-languages").on("click", function(e) {
		e.preventDefault();

		var position = $("#display-languages").offset(),
			width    = $("#display-languages").width(),
			diff 	 = $("#top-box-languages").width() + 5;

		$("#top-box-register").hide();
		$("#top-box-login").hide();
		$("#top-box-languages").css({"left": (position.left + width - diff) + "px"}).slideToggle("slow");
	});

	$("#display-register").on("click", function(e) {
		e.preventDefault();

		var position = $("#display-register").offset(),
			width    = $("#display-register").width(),
			diff 	 = $("#top-box-register").width() + 5;

		$("#top-box-languages").hide();
		$("#top-box-login").hide();
		$("#top-box-register").css({"left": (position.left + width - diff) + "px"}).slideToggle("slow");
	});

	$("#display-login").on("click", function(e) {
		e.preventDefault();

		var position = $("#display-login").offset(),
			width    = $("#display-login").width(),
			diff 	 = $("#top-box-login").width() + 5;

		$("#top-box-register").hide();
		$("#top-box-languages").hide();
		$("#top-box-login").css({"left": (position.left + width - diff) + "px"}).slideToggle("slow");		
	});

	$("#display-profile").on("click", function(e) {
		e.preventDefault();

		var position = $("#display-profile").offset(),
			width    = $("#display-profile").width(),
			diff 	 = $("#top-box-profile").width() + 5;

		$("#top-box-languages").hide();
		$("#top-box-profile").css({"left": (position.left + width - diff) + "px"}).slideToggle("slow");
	});

	$("#register-name").one("click", function() {
		$("#register-name").val("");
	});

	$("#register-email").one("click", function() {
		$("#register-email").val("");
	});

	$("#register-password").one("click", function() {
		$("#register-password").val("");
	});

	$("#login-username").one("click", function() {
		$("#login-username").val("");
	});

	$("#login-password").one("click", function() {
		$("#login-password").val("");
	});

	$(this).mouseup(function(login) {
		if(!($(login.target).parents('.toggle').length > 0)) {
			$(".toggle").hide();
			}
	});
	
	$("#username").focus();	
});