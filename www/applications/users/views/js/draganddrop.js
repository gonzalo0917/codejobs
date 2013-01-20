!function($) {
	$(document).on("dragover", function (event) {
		event.stopPropagation();
		event.preventDefault();

		$("#filedrag").css({
			display: "table",
			left: $("#avatar-container").offset().left,
			top: $("#avatar-container").offset().top,
			width: $("#avatar-container").width(),
			height: $("#avatar-container").height()
		});
	});

	$(document).mouseenter(function(event) {
		event.stopPropagation();
		event.preventDefault();

		if ($("#filedrag").css("display") === "table") {
			$("#filedrag").css("display", "none");
		}
	});
}(jQuery);