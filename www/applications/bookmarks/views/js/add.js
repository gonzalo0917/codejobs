!function ($, window, document, undefined) {
	var requesting = false, path = PATH;

	$("input[name='URL']").change(function (event) {
		var url = $(this).val();

		if (/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/ .test(url) && !requesting) {
			$("#form-add").find("input, textarea, select").attr("disabled", true);

			$(this).addClass("loading");

			requesting = true;

			$.ajax({
				"type" 	  : "json",
				"url"  	  : path + "/bookmarks/request/?url=" + encodeURIComponent(url),
				"success" : loaded,
				"error"	  : function () {
					loaded({"Title": "", "Description": "", "Keywords": ""})
				}
			});
		}
	});

	function loaded(data) {
		data = JSON.parse(data);

		$("#form-add").find("input, textarea, select").attr("disabled", false);

		$("input[name='URL']").removeClass("loading");
		$("input[name='title']").val(data.Title);
		$("textarea[name='description']").val(data.Description);
		$("input[name='tags']").val(data.Keywords);

		requesting = false;
	}
} (jQuery, window, document);