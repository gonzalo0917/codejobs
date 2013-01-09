!function($) {
	$('input[name="browse"]').click(function () {
		$('input.avatar-file').click();
	});

	$('input.avatar-file').change(function() {
		selectFile(this.files);
	});

	function selectFile(files) {
		if (files.length === 1) {
			var file = files[0];
			
			if (/image/i .test(file.type)) {
				previewImage(file);
			} else {
				alert("Image type does not supported");
			}
		}
	}

	function previewImage(file) {
		if (typeof FileReader !== "undefined") {
			var reader = new FileReader();

			reader.onload = function (event) {
				$("#avatar-image").attr("src", event.target.result);

				window.setTimeout(markImage, 0);
			}

			reader.readAsDataURL(file);
		}
	}

	function markImage() {
		if($("#marker").get(0) === undefined) {
			$("div.avatar-image").append('<div class="marker" id="marker"></div>');
		}

		var width  = $("#avatar-image").width(),
			height = $("#avatar-image").height(),
			small  = (width <= 90 && height <= 90),
			square = (width === height);

		if(!square || !small) {
			if(square) {
				$("#marker").width(height - 6).height(height - 6).css({top: "10px", left: "10px"});
			} else if(width > height) {
				var pos_left = parseInt((width - height)/2) + 10;
				$("#marker").width(height - 6).height(height - 6).css({top: "10px", left: pos_left + "px"});
			} else {
				var pos_top = parseInt((height - width)/2) + 10;
				$("#marker").width(width - 6).height(width - 6).css({top: pos_top + "px", left: "10px"});
			}

			$("#marker").css("display", "block");
		} else {
			$("#marker").hide();
		}
	}

	markImage();
}(jQuery);