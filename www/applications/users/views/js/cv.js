$(document).ready(function() {

	$('.show-section h3').toggle(
		function() {
			$(this).removeClass('inactive-section').addClass('active-section');
			$(this).next('div').show();
		}, function() {
			$(this).removeClass('active-section').addClass('inactive-section');
			$(this).next('div').hide();
		})
    /*var listSkills = [ 'c++', 'java', 'php', 'jquery'];

    $('input[name=skills]').tagit({
        availableTags: listSkills,
        itemName: 'item',
        fieldName: 'skills'
    });

    $('ul.tagit').addClass("span10");*/
});