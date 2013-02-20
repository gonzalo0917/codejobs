!function($) {
	var jcrop_api, avatar_file, avatar_coordinate;

	$('input[name="browse"]').click(function () {
		$('input.avatar-file').click();
	});

	$('input.avatar-file').change(function () {
		if ('files' in this) {
			selectFile(this.files);
		}
	});

	$('input[name="resume"]').click(function () {
		restoreImage();
	});

	$('input[name="delete"]').click(function () {
		return removeImage();
	});

	$('#form-add').submit(function (event) {
		createAvatar();
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

				setFile(result, file.name, file.size);

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
			
			setFile();

			destroyMark();

			if (coordinate !== undefined) {
				markImage(coordinate);
			} else {
				markImage();
			}
		}
	}

	function createAvatar() {
		if (! /default\.png$/ .test($("img.avatar").attr("src"))) {
			var cnv1, ctx1, cnv2, ctx2, coor;

			cnv1 = document.createElement("canvas");
			cnv2 = document.createElement("canvas");
			ctx1 = cnv1.getContext("2d");
			ctx2 = cnv2.getContext("2d");
			coor = $("#coordinate").val().split(",");

			cnv1.width  = $("img.avatar").width();
			cnv1.height = $("img.avatar").height();

			cnv2.width = cnv2.height = "90";

			ctx1.drawImage($("img.avatar").get(0), 0, 0, cnv1.width, cnv1.height);
			ctx2.drawImage(cnv1, parseInt(coor[0]), parseInt(coor[1]), parseInt(coor[2]) - parseInt(coor[0]), parseInt(coor[3]) - parseInt(coor[1]), 0, 0, 90, 90);

			if ($("#file").val()) {
				$("#file").val(cnv1.toDataURL("image/png"));
			}
			
			$("#resized").val(cnv2.toDataURL("image/png"));

			document.body.appendChild(cnv2);

		} else {
			alert("El src del avatar es: " + $("img.avatar").attr("src"));
		}
	}

	function setFile(file, name, size) {
		$("#file").val(file || "");
		$("#name").val(name || "");
		$("#size").val(size || "");
	}

	function markImage(coordinate) {
		if(jcrop_api === undefined) {
			jcrop_api = $.Jcrop("#avatar-image", {
				minSize: 	 [90, 90],
				aspectRatio: 1,
				onChange:    setCoords,
		        onSelect:    setCoords,
		        onRelease:   delCoords
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

	function setCoords(coor) {
		$("#coordinate").val(parseInt(coor.x) + "," + parseInt(coor.y) + "," + parseInt(coor.x2) + "," + parseInt(coor.y2));
	}

	function delCoords(coor) {
		$("#coordinate").val("");
	}

	$(window).load(function () {
		markImage(avatar_coordinate);

	});

	$(document).on("dragover", function (event) {
		event.stopPropagation();
		event.preventDefault();

		$("#filedrag").slideDown("fast");
	});

	$("#filedrag").on("dragover", function (event) {
		$(this).css({'color': "#555", 'border-color': "#555"});
	});

	$("#filedrag").on("dragleave", function (event) {
		$(this).css({'color': "", 'border-color': ""});
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

		if ($("#filedrag").css("display") === "block") {
			$("#filedrag").css("display", "none");
		}
	});
}(jQuery);