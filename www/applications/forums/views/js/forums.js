$(document).on("ready", function() {
	$("#ftags").hide();
	$("#fcontent").hide();
	$("#fpublish").hide();
	$("#fcancel").hide();

	$("#ftitle").on("focus", function() {
		if($("#ftitle").val() == $("#ftitle-temp").val()) {
			$("#ftitle").val("");
		}

		$("#ftags").show();
		$("#fcontent").show();
		$("#fpublish").show();
		$("#fcancel").show();
	});

	$("#ftags").on("focus", function() {
		if($("#ftags").val() == $("#ftags-temp").val()) {
			$("#ftags").val("");
		}
	});

	$("#fcontent").on("focus", function() {
		if($("#fcontent").val() == $("#fcontent-temp").val()) {
			$("#fcontent").val("");
		}
	});

	$("#fpublish").on("click", function() {
		var fid = $("#fid").val();
		var forumName = $("#fname").val();
		var title = $("#ftitle").val();
		var tags = $("#ftags").val();
		var content = $("#fcontent").val();

		var needTitle = '<div id="alert-message" class="alert alert-error">' + $("#needtitle").val() + '</div>';
		var needContent = '<div id="alert-message" class="alert alert-error">' + $("#needcontent").val() + '</div>';
		var needTags = '<div id="alert-message" class="alert alert-error">' + $("#needtags").val() + '</div>';			
				
		if(tags == $("#ftags-temp").val()) {
			tags = "";
		}

		if(title.length == 0 || title == $("#ftitle-temp").val()) { 
			$("#fmessage").html(needTitle);
		} else if(content.length == 0 || content == $("#fcontent-temp").val()) { 
			$("#fmessage").html(needContent);
		} else if(tags.length == 0 || tags == $("#ftags-temp").val()) { 
			$("#fmessage").html(needTags);
		} else {
			var newPost = '';

			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publish',
				dataType: 'json',
				data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&forumID=' + fid + '&fname=' + forumName,
				success: function(response) {	
					console.log(response);				
					$("#fmessage").html(response.alert);
					var oldPosts = $("#fposts").html();

					newPost = newPost + '<div class="post">';
					newPost = newPost + '	<div class="post-title">';
					newPost = newPost + '		' + response.title;
					newPost = newPost + '	</div>';
					newPost = newPost + '	<div class="post-left">';
					newPost = newPost + '		' + response.date;
					newPost = newPost + '	</div>';
					newPost = newPost + '	<div class="clear"></div>';
					newPost = newPost + '</div>';

					$("#fposts").html(newPost + oldPosts);	

					$("#ftitle").val($("#ftitle-temp").val());
					$("#ftags").val($("#ftags-temp").val());
					
					$("#ftags").hide();
					$("#fcontent").hide();
					$("#fpublish").hide();
					$("#fcancel").hide();				
				}
			});
		}
	});

	$("#fcancel").on("click", function() {
		$("#ftitle").val($("#ftitle-temp").val());

		$("#ftags").val($("#ftags-temp").val());
		
		$("#ftags").hide();
		$("#fcontent").hide();
		$("#fpublish").hide();
		$("#fcancel").hide();
	});
});