+function ($, window, document, undefined) {
	function changeDate (enabled) {
		$(".jdpicker").attr("disabled", enabled);
		$(".date_clearer").css("visibility", (enabled ? "hidden" : "visible"));
	}

	$("#never").change(function () { changeDate(true); });
	$("#date").change(function () { changeDate(false); });

	$(document).ready(function (event) {
		if ($("#never").attr("checked")) {
			changeDate(true);
		} else if ($("#date").attr("checked")) {
			changeDate(false);
		}
	});
} (jQuery, window, document);