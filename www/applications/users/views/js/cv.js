$(document).ready(function() {

	$('.editor').each(function(e){
        CKEDITOR.replace($(this).attr('id'), {
						toolbar: [
							{name:'group1', items:['Bold','Italic','Underline','StrikeThrough','PasteFromWord']},
							{name:'group2', items:['Outdent','Indent','NumberedList','BulletedList','Blockquote']},
						 	{name:'group3', items:['Image','Link','Unlink','InsertPre']}  
						]
		});
    });

	$('.show-section h3').toggle(
		function() {
			$(this).removeClass('inactive-section').addClass('active-section');
			$(this).next('div').show();
		}, function() {
			$(this).removeClass('active-section').addClass('inactive-section');
			$(this).next('div').hide();
	})

	$('#expand-collapse').toggle(
		function(e) {
			e.preventDefault();
			$('.show-section h3').removeClass('inactive-section').addClass('active-section');
			$('.show-section h3').next('div').show();
			$(this).text('Collapse All');
		}, function(e) {
			e.preventDefault();
			$('.show-section h3').removeClass('active-section').addClass('inactive-section');
			$('.show-section h3').next('div').hide();
			$(this).text('Expand All');
		})
    /*var listSkills = [ 'c++', 'java', 'php', 'jquery'];

    $('input[name=skills]').tagit({
        availableTags: listSkills,
        itemName: 'item',
        fieldName: 'skills'
    });

    $('ul.tagit').addClass("span10");*/
});