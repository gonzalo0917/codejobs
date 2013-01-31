$("#search").click(function () {
	var app = $('#search-app').val();
	var term = $('#search-term').val();
	
	$.ajax({
		type: 'POST',
		url:   PATH + '/search',		
		data: 'app=' + app + '&term=' + term,
		success: function(response) {	
			console.log(response);			
			window.location.href = response;
		}
	});
});