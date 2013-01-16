!function($) {
	var jcrop_api, avatar_file, avatar_coordinate;

	$('input[name="browse"]').click(function () {
		$('input.avatar-file').click();
	});

	$('input.avatar-file').change(function() {
		selectFile(this.files);
	});

	$('input[name="resume"]').click(function () {
		restoreImage();
	});

	$('input[name="delete"]').click(function () {
		return removeImage();
	});

	avatar_file 	  = $("#avatar-image").attr("src");
	avatar_coordinate = $("#coordinate").val();

	function selectFile(files) {
		if (files.length === 1) {
			var file = files[0];
			console.log(file);
			if (file.size < 1024) {
				alert($("#small-error").val());
			} else if (file.size > 5242880) {
				alert($("#big-error").val());
			} else if (/image/i .test(file.type)) {
				previewImage(file);
			} else {
				alert($("#type-error").val());
			}
		}
	}

	function previewImage(file, coordinate) {
		console.log("Se solicita imagen previa de (" + file + ", " + coordinate + ")");
		if (typeof FileReader !== "undefined" && typeof file !== "string") {
			var reader = new FileReader();

			reader.onload = function (event) {
				$("#avatar-image").attr("src", event.target.result);

				destroyMark();

				if (coordinate !== undefined) {
					window.setTimeout('markImage("' + coordinate + '")', 0);
				} else {
					window.setTimeout(markImage, 0);
				}
			}

			reader.readAsDataURL(file);
		} else if (typeof file === "string") {
			$("#avatar-image").attr("src", file);

			destroyMark();

			if (coordinate !== undefined) {
				markImage(coordinate);
			} else {
				markImage();
			}
		}
	}

	function markImage(coordinate) {
		if(jcrop_api === undefined) {
			$("#avatar-image").Jcrop({
				minSize: [90, 90],
				aspectRatio: 1
			}, function() {
				jcrop_api = this;
			});
		}

		var width  = $("#avatar-image").width(),
			height = $("#avatar-image").height(),
			small  = (width <= 90 && height <= 90),
			square = (width === height);

		if(!square || !small) {
			if(coordinate === undefined) {
				if(square) {
					jcrop_api.setSelect([0, 0, width, width]);
				} else if(width > height) {
					var pos_left = parseInt((width - height)/2) + 10;
					jcrop_api.setSelect([pos_left, 0, height, height]);
				} else {
					var pos_top = parseInt((height - width)/2) + 10;
					jcrop_api.setSelect([0, pos_top, width, width]);
				}
			} else {
				jcrop_api.setSelect(coordinate.split(","));
			}
		} else {
			destroyMark();
		}
	}

	function destroyMark() {
		if (jcrop_api !== undefined) {
			jcrop_api.destroy();
			$("#avatar-image").css({height: "", width: "", visibility: "visible"});
			jcrop_api = undefined;
		}
	}

	function restoreImage() {
		previewImage(avatar_file, avatar_coordinate);
	}

	function removeImage() {
		restoreImage();

		return confirm($("#delete-message").val());
	}

	markImage();
}(jQuery);