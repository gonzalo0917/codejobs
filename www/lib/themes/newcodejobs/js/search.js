$("#search").on("click", function() {
	var app = $('#search-app').val();
	var term = $('#search-term').val();
	var lastTerm = $('#search-term-hidden').val();
	var lastApp = $('#search-app-hidden').val();

	if(term.length >= 2) {
		$('#search-results').fadeIn("slow");
		
		if(lastTerm != term || lastApp != app) {
			$('#search-term-hidden').val(term);
			$('#search-app-hidden').val(app);

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
	}
});

function cleanSearch() {
	$('#search-term').val("").focus();
	$('#search-results').fadeOut("slow");
}