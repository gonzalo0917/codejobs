$(document).ready(function() {

	$('.show-section h3').on('click',function() {
		$(this).next('div').toggle();
	})
    /*var listSkills = [ 'c++', 'java', 'php', 'jquery'];

    $('input[name=skills]').tagit({
        availableTags: listSkills,
        itemName: 'item',
        fieldName: 'skills'
    });

    $('ul.tagit').addClass("span10");*/
});