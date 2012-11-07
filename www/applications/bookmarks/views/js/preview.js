var needToConfirm = true;

$(document).ready(function () {
	$(".preview").fadeIn("fast").delay(400).fadeOut("slow");
});

$(window).on("beforeunload", function () {
	if (needToConfirm) {
	    return "The changes you have made have not been saved yet.";
	}
});