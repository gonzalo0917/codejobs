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
			}

			reader.readAsDataURL(file);
		}
	}
}(jQuery);