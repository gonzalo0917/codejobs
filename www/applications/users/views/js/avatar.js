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
			
			if (! /image/i .test(file.type)) {
				alert($("#type-error").val());
			} else if (file.size < 1024) {
				alert($("#small-error").val());
			} else if (file.size > 5242880) {
				alert($("#big-error").val());
			} else {
				previewImage(file);
			}
		}
	}

	function previewImage(file, coordinate) {
		if (typeof FileReader !== "undefined" && typeof file !== "string") {
			var reader = new FileReader();

			reader.onload = function (event) {
				var result = event.target.result;

				$("#avatar-image").attr("src", result);

				setFile(result, file.name, file.type, file.size);

				destroyMark();

				resizeFont();

				if (coordinate !== undefined) {
					window.setTimeout('markImage("' + coordinate + '")', 0);
				} else {
					window.setTimeout(markImage, 0);
				}
			}

			reader.readAsDataURL(file);
		} else if (typeof file === "string") {
			$("#avatar-image").attr("src", file);
			
			setFile();

			destroyMark();

			resizeFont();

			if (coordinate !== undefined) {
				markImage(coordinate);
			} else {
				markImage();
			}
		}
	}

	function setFile(file, name, type, size) {
		$("#file").val(file || "");
		$("#name").val(name || "");
		$("#type").val(type || "");
		$("#size").val(size || "");
	}

	function markImage(coordinate) {
		if(jcrop_api === undefined) {
			$("#avatar-image").Jcrop({
				minSize: 	 [90, 90],
				aspectRatio: 1,
				onChange:    setCoords,
		        onSelect:    setCoords,
		        onRelease:   delCoords
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

	function resizeFont() {
		console.log ("Se resizeara la fuente");

		var width = $("#avatar-image").width(), size = 1;

		if (width > 150 && width <= 350) {
			size = 2;
		} else if (width > 350 && width < 500) {
			size = 3.5;
		} else if (width >= 500) {
			size = 5;
		}

		$("#filedrag").css("fontSize", size + "em");
	}

	function restoreImage() {
		previewImage(avatar_file, avatar_coordinate);
	}

	function removeImage() {
		restoreImage();

		return confirm($("#delete-message").val());
	}

	function setCoords(coor) {
		$("#coordinate").val(parseInt(coor.x) + "," + parseInt(coor.y) + "," + parseInt(coor.w) + "," + parseInt(coor.h));
	}

	function delCoords(coor) {
		$("#coordinate").val("");
	}

	markImage(avatar_coordinate);

	$(document).on("dragover", function (event) {
		event.stopPropagation();
		event.preventDefault();

		$("#filedrag").css({
			display: "table",
			left: $("#avatar-container").offset().left,
			top: $("#avatar-container").offset().top,
			width: $("#avatar-container").width(),
			height: $("#avatar-container").height()
		});
	});

	document.addEventListener("drop", function (event) {
		event.stopPropagation();
		event.preventDefault();

		if (event.target.id == "avatar-image" || event.target.className === "textdrag" || /^jcrop.*/img .test(event.target.className))	{
			var files = event.dataTransfer.files, file;

			if (files.length > 0) {
				selectFile(files);
			}
		}
	}, false);

	$(document).mouseenter(function (event) {
		event.stopPropagation();
		event.preventDefault();

		if ($("#filedrag").css("display") === "table") {
			$("#filedrag").css("display", "none");
		}
	});
}(jQuery);