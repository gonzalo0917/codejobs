$("#search").on("click", function() {
	var app = $('#search-app').val();
	var term = $('#search-term').val();
	
	if(term.length >= 3) {
		$('#search-results').fadeIn("slow");
		
		$.ajax({
			type: 'POST',
			url:   PATH + '/search',		
			data: 'app=' + app + '&term=' + term,
			success: function(response) {	
				term = '';
				var clean = '<a onclick="javascript: cleanSearch();" href="#"><img src="' + URL + '/www/lib/themes/' + THEME + '/images/up.gif" alt="Close" class="no-border" /></a>';

				$('#search-results-wrapper').html(response + clean);
			}
		});
	}
});

function cleanSearch() {
	$('#search-term').val("").focus();
	$('#search-results').fadeOut("slow");
}