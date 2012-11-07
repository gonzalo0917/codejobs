function addslashes(str) {
    str = str.replace(/\'/g,'\\\'');
    str = str.replace(/\"/g,'\\"');
    str = str.replace(/\\/g,'\\\\');
    str = str.replace(/\0/g,'\\0');
    
    return str;
}

function stripslashes(str) {
    str = str.replace(/\\'/g,'\'');
    str = str.replace(/\\"/g,'"');
    str = str.replace(/\\\\/g,'\\');
    str = str.replace(/\\0/g,'\0');
    
    return str;
}

function saveDraft() {		
	var title 	  	 = $('#title').val();
	var tags 	  	 = $('#tags').val();
	var editor    	 = $('#editor').val();
	var code      	 = $('#code').val();
	var buffer    	 = $('#buffer').val();
	var pwd       	 = $('#pwd').val();	
	var postID	  	 = $('#ID_Post').val();
	var language  	 = $('#language').val();
	var situation 	 = $('#situation').val();
	var temp_title   = stripslashes($('#temp_title').val());
	var temp_tags    = stripslashes($('#temp_tags').val());
	var temp_content = stripslashes($('#temp_content').val());

	if(editor == 1) {
		var content = $('#redactor').getCode();
	} else {
		var content = $('#redactor').val();
	}

	if(title.length > 5 && content.length > 30 && (content != temp_content || title != temp_title || tags != temp_tags)) {		
		$.ajax({
			type: 'POST',
			url:   PATH + '/blog/cpanel/draft',
			data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&language=' + language + '&buffer=' + buffer + '&code=' + code + '&postID=' + postID + '&situation=' + situation,
			success: function(response) {
				$('#alert-message').show();
				$('#alert-message').removeClass('no-display');
				$('#alert-message').html(response);
				$('#alert-message').fadeOut(10000);
				$('#temp_title').val(addslashes(title));
				$('#temp_tags').val(addslashes(tags));
				$('#temp_content').val(addslashes(content));
			}
		});
	}		
}

setInterval(function() {
    saveDraft();
}, 5 * 60 * 1000);