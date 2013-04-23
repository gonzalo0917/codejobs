$(document).ready(function() {

	var successMSG = { 'background' : 'rgba(92,164,81,1)' };
	var errorMSG = { 'background' : 'rgba(203,33,34,0.8)' };
	var submitPressed;

	window.loadCalendar = function() {
		$('.jdpicker').each(function(){
			if ($(this).parent('div').attr('class') != "jdpicker_w") {
	        	$(this).jdPicker();
	    	}
	    });
	}

	$('.editor').each(function(e){
        CKEDITOR.replace($(this).attr('id'), {
					toolbar: [
						{ name:'group1', items:['Bold','Italic','Underline','StrikeThrough','PasteFromWord'] },
						{ name:'group2', items:['Outdent','Indent','NumberedList','BulletedList','Blockquote'] },
					 	{ name:'group3', items:['Image','Link','Unlink','InsertPre'] }  
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

	/*$('#expand-collapse').toggle(
		function(e) {
			e.preventDefault();
			$('.show-section h3').removeClass('inactive-section').addClass('active-section');
			$('.show-section h3').next('div').show();
			//$(this).text('"__("Collapse All")"');
		}, function(e) {
			e.preventDefault();
			$('.show-section h3').removeClass('active-section').addClass('inactive-section');
			$('.show-section h3').next('div').hide();
			//$(this).text('Expand All');
		})*/
	$('#expand').click(function(e){
		e.preventDefault();
		$('.show-section h3').removeClass('inactive-section').addClass('active-section');
		$('.show-section h3').next('div').show();
	})

	$('#collapse').click(function(e) {
		e.preventDefault();
		$('.show-section h3').removeClass('active-section').addClass('inactive-section');
		$('.show-section h3').next('div').hide();
	})

    /*var listSkills = [ 'c++', 'java', 'php', 'jquery'];

    $('input[name=skills]').tagit({
        availableTags: listSkills,
        itemName: 'item',
        fieldName: 'skills'
    });

    $('ul.tagit').addClass("span10");*/

     $('.btn').click(function() {
    	submitPressed = $(this).attr('name');
    })

    $('.show-section form').on('submit', function() {
		section = $(this).parent('div').parent('div').attr('id');
		app = section.substring(0,section.indexOf('-'));

        $('.float-msg').css(errorMSG);

        formData = $(this).serializeArray();

        if (app == "avatar") {
			editOrSave = submitPressed == "saveAvatar" ? "save" : "delete" ;

	    	formData.push({
	    		name: 'action',
	    		value: editOrSave
	    	});
		} else {
	        formData.push({
	            name: $(this).find('input[type=submit]').attr('name'),
	            value: $(this).find('input[type=submit]').val()
	        });
	    }

        console.log(formData);
        $.ajax({
                url: PATH + '/users/' + app,
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    if (data.status) {
                        $('.float-msg').animate({top: 0}, 800, null);
                        $('.float-msg').text("(+) "+data.status).css(successMSG);
                    } else {
                        $('.float-msg').animate({top: 0}, 800, null);
                        $('.float-msg').text("(X) "+data.fail).css(errorMSG);
                    }
                }
            });

        return false;
	})

    $('.float-msg').on('click', function() {
		$(this).animate({top: -50}, 1000, null);
	})
});