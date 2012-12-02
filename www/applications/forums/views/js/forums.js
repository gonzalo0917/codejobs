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
		var fid = $("#fid").val();
		var title = $("#ftitle").val();
		var tags = $("#ftags").val();
		var content = $("#fcontent").val();
		var needTitle = $("#needtitle").val();
		var needContent = $("#needcontent").val();

		if(tags == $("#ftags-temp").val()) {
			tags = "";
		}

		if(title.length == 0 || title == $("#ftitle-temp").val()) { 
			$("#fmessage").html(needTitle);
		} else if(content.length == 0 || content == $("#fcontent-temp").val()) { 
			$("#fmessage").html(needContent);
		} else {
			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publish',
				data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&forumID=' + fid,
				success: function(response) {
					$("#fmessage").html(response);
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