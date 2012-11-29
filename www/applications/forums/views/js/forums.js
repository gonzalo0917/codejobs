$(document).on("ready", function() {
	$("#ftitle").on("click", function() {
		if($("#ftitle").val() == $("#ftitle-temp").val()) {
			$("#ftitle").val("");
		}

		$("#ftags").removeClass("no-display");
		$("#fcontent").removeClass("no-display");

		$("#fpublish").addClass("btn");
		$("#fpublish").removeClass("no-display");

		$("#fcancel").addClass("btn");
		$("#fcancel").removeClass("no-display");
	});

	$("#ftags").on("click", function() {
		if($("#ftags").val() == $("#ftags-temp").val()) {
			$("#ftags").val("");
		}
	});

	$("#fcontent").on("click", function() {
		if($("#fcontent").val() == $("#fcontent-temp").val()) {
			$("#fcontent").val("");
		}
	});

	$("#fpublish").on("click", function() {
		var fid   	= $("#fid").val();
		var title   = $("#ftitle").val();
		var tags  	= $("#ftags").val();
		var content = $("#fcontent").val();

		if(tags == $("#ftags-temp").val()) {
			tags = "";
		}

		if(title.length > 5 && content.length > 10) {
			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publish',
				data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&forumID=' + fid,
				success: function(response) {
					console.log(response);
				}
			});
		}
	});

	$("#fcancel").on("click", function() {
		$("#ftitle").val($("#ftitle-temp").val());

		$("#ftags").val($("#ftags-temp").val());
		$("#ftags").addClass("no-display");

		$("#fcontent").val($("#fcontent-temp").val());
		$("#fcontent").addClass("no-display");

		$("#fpublish").addClass("no-display");
		$("#fpublish").removeClass("btn");

		$("#fcancel").addClass("no-display");
		$("#fcancel").removeClass("btn");
	});
});