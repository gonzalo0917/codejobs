$(document).on("ready", function() {
	$("#ftags").hide();
	$("#fcontent").hide();
	$("#fpublish").hide();
	$("#fcancel").hide();

	$("#ftitle").on("focus", function() {
		$("#ftags").show();
		$("#fcontent").show();
		$("#fpublish").show();
		$("#fcancel").show();
	});

	$("#cpublish").on("click", function() {
		var content = $('#ccontent').val();
		var fid = $('#fid').val();
		var fname = $('#fname').val();
		var needContent = '<div id="alert-message" class="alert alert-error">' + $("#needcontent").val() + '</div>';
			if(content.length == 0) {
				$("#comment-alert").html(needContent);
				$("#comment-alert").show();
				$("#comment-alert").hide(4000);
			}

		if(content != '' && fid > 0) {
			var newComment = '';

			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publishComment',
				dataType: 'json',
				data: 'fid=' + fid + '&content=' + content + '&fname=' + fname,
				success: function(response) {	
					console.log(response);

					$("#comment-alert").html(response.alert);
					var oldComments = $("#forum-content").html();

					newComment = newComment + '<div class="comments">';
					newComment = newComment + '	<div class="comments-author">';
					newComment = newComment + '	  <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash4/372155_100002559760317_1123013291_q.jpg" /> ';
					newComment = newComment + '	</div>';
					newComment = newComment + '	<div class="comments-content">';
					newComment = newComment + '   <p class="comment-data">' + response.date + '</p>';
					newComment = newComment + '   <p class="comment-post">' + response.content + '</p>';
					newComment = newComment + '	</div>';
					newComment = newComment + '</div>';	

					$("#forum-content").html(oldComments + newComment);
					$("#comment-alert").show();
					$("#comment-alert").hide(4000);
					$("#ccontent").val("");
				}
			});
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
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else if(content.length < 30 || content == $("#fcontent-temp").val()) { 
			$("#fmessage").html(needContent);
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else if(tags.length == 0 || tags == $("#ftags-temp").val()) { 
			$("#fmessage").html(needTags);
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else {
			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publish',
				data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&forumID=' + fid + '&fname=' + forumName,
				success: function(response) {	
					window.location.href = response;
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

	$("#ppublish").on("click", function() {

		var pid = $("#pid").val();
		var fid = $("#fid").val();
		var forumName = $("#fname").val();
		var title = $("#ptitle").val();
		var tags = $("#ptags").val();
		var content = $("#pcontent").val();

		var needTitle = '<div id="alert-message" class="alert alert-error">' + $("#needtitle").val() + '</div>';
		var needContent = '<div id="alert-message" class="alert alert-error">' + $("#needcontent").val() + '</div>';
		var needTags = '<div id="alert-message" class="alert alert-error">' + $("#needtags").val() + '</div>';			
				
		if(tags == $("#ftags-temp").val()) {
			tags = "";
		}

		if(title.length == 0 || title == $("#ptitle-temp").val()) { 
			$("#fmessage").html(needTitle);
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else if(content.length < 30 || content == $("#pcontent-temp").val()) { 
			$("#fmessage").html(needContent);
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else if(tags.length == 0 || tags == $("#ptags-temp").val()) { 
			$("#fmessage").html(needTags);
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else {
			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/updatePost',
				data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&postID=' + pid + '&forumID=' + fid + '&fname=' + forumName,
				success: function(response) {	
					window.location.href = response;
				}
			});
		}
	});
	
	$("#cedit").on("click", function() {

		var pid = $("#pid").val();
		var fid = $("#fid").val();
		var forumName = $("#fname").val();
		var content = $("#pcontent").val();

		var needContent = '<div id="alert-message" class="alert alert-error">' + $("#needcontent").val() + '</div>';

		if(content.length == 0 || content == $("#pcontent-temp").val()) { 
			$("#fmessage").html(needContent);
			$("#fmessage").show();
			$("#fmessage").hide(4000);
		} else {
			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/updateComment',
				data: 'content=' + content + '&postID=' + pid + '&forumID=' + fid + '&fname=' + forumName,
				success: function(response) {	
					console.log(response);
					window.location.href = response;
				}
			});
		}
	});
	
});