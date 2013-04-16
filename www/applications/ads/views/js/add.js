// <!--

+function ($, window, document, undefined) {
	
	function changeDate (enabled) {
		$(".jdpicker").attr("disabled", enabled);
		$(".date_clearer").css("visibility", (enabled ? "hidden" : "visible"));
	}

	function previewImage(file) {
		if (typeof FileReader !== "undefined") {
			var reader = new FileReader();

			reader.onload = function (event) {
				var result = event.target.result, image = new Image();
				
				image.src = result;
				image.onload = function (event) {
					var canvas = $("#preview").get(0), context = canvas.getContext("2d");
					context.drawImage(this, 0, 0);
				};

			};

			reader.readAsDataURL(file);
		}
	}

	function selectFile(files) {
		if (files.length === 1) {
			var file = files[0];
			
			if (! /image/i .test(file.type)) {
				alert($("#type-error").val());
			} else if (file.size < 1024) {
				alert($("#small-error").val());
			} else if (file.size > 2097152) {
				alert($("#big-error").val());
			} else {
				previewImage(file);
			}
		}
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

	$("input[name='image']").change(function (event) {
		if ("files" in this) {
			selectFile(this.files);
		}
	});
} (jQuery, window, document);

//-->
