!function($) {
	var jcrop_api;

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
				if(jcrop_api === undefined) {
					$("#avatar-image").Jcrop({
						minSize: [90, 90],
						aspectRatio: 1
					}, function() {
						console.log("Se creara la imagen desde previewImage()");
						jcrop_api = this;
					});
				}

				jcrop_api.setImage(event.target.result);
				//$("#avatar-image").attr("src", event.target.result);

				window.setTimeout(markImage, 0);
			}

			reader.readAsDataURL(file);
		}
	}

	function markImage() {
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
			if(square) {
				jcrop_api.setSelect([0, 0, width - 6, width - 6]);
				//$("#marker").width(height - 6).height(height - 6).css({top: "10px", left: "10px"});
			} else if(width > height) {
				var pos_left = parseInt((width - height)/2) + 10;
				jcrop_api.setSelect([pos_left, 0, height - 6, height - 6]);
				//$("#marker").width(height - 6).height(height - 6).css({top: "10px", left: pos_left + "px"});
			} else {
				var pos_top = parseInt((height - width)/2) + 10;
				jcrop_api.setSelect([0, pos_top, width - 6, width - 6]);
				//$("#marker").width(width - 6).height(width - 6).css({top: pos_top + "px", left: "10px"});
			}

			//$("#marker").css("display", "block");
		} else {
			console.log("SE LIBERARA");
			jcrop_api.release();
		}
	}

	markImage();
}(jQuery);