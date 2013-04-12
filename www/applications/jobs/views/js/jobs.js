$(document).on("ready", function() {
	$("#eapply").on("click", function() { 

		$.ajax({
			window.location = "jobs/applyExternal";
			}
		});	
	});
});