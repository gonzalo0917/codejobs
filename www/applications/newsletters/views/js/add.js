// <!--

+function ($, window, document, undefined) {
	var transparent = {};

	$("input[name='large'], input[name='miniature']").val("");

	function changeDate (enabled) {
		$(".jdpicker").attr("disabled", enabled);
		$(".date_clearer").css("visibility", (enabled ? "hidden" : "visible"));
	}

	function previewImage(file, id) {
		if (typeof FileReader !== "undefined") {
			var reader = new FileReader();

			reader.onload = function (event) {
				var result = event.target.result, image = new Image();
				
				image.src = result;

				image.onload = function (event) {
					if (this.height > this.width) {
						alert($("#orientation-error").val());
						$("input[name='" + id + "']:first").val("");
					} else {
						var canvas = $("#" + id).get(0), context = canvas.getContext("2d"), ratio, dimensions, attr, width = $("#" + id).width(), height = $("#" + id).height();

						if (this.width / this.height < 2.5) {
							// Stretch to height
							ratio = height / this.height;
							attr = {
								"height" : height,
								"width"  : ratio * this.width,
								"top"    : 0,
								"left"   : (width - ratio * this.width) / 2
							};
						} else {
							// Stretch to width
							ratio = width / this.width;
							attr = {
								"width"  : width,
								"height" : ratio * this.height,
								"left"   : 0,
								"top"    : (height - ratio * this.height) / 2
							};
						}

						if (id == "large") {
							clearCanvas(true, false);
						}

						if (id == "miniature") {
							clearCanvas(false, true);
						}

						context.drawImage(this, 0, 0, this.width, this.height, attr.left, attr.top, attr.width, attr.height);
						
						$("input[name='" + id + "']:last").val(canvas.toDataURL("image/png"));

						if (id == "large" && $("#copy").attr("checked")) {
							changeCopy(true);
						}
						
						if ($("#transparent").data("on") == "1") {
							$("#transparent").click();
						}

						$("#transparent").slideDown("fast");
					}
				};

			};

			reader.readAsDataURL(file);
		}
	}

	function selectFile(files, name) {
		if (files.length === 1) {
			var file = files[0];
			
			if (! /image/i .test(file.type)) {
				alert($("#type-error").val());
			} else if (file.size < 1024) {
				alert($("#small-error").val());
			} else if (file.size > 2097152) {
				alert($("#big-error").val());
			} else {
				previewImage(file, name);
			}
		}
	}

	function findPos(obj) {
	    var curleft = 0, curtop = 0;
	    
	    if (obj.offsetParent) {
	        do {
	            curleft += obj.offsetLeft;
	            curtop += obj.offsetTop;
	        } while (obj = obj.offsetParent);

	        return { x: curleft, y: curtop };
	    }

	    return undefined;
	}

	function changeType(main) {
		clearCanvas(true, true);

		if (main == 0) {
			$(".preview:first, .preview:last .field, .preview:last .copy-label").hide();
			$(".preview:last .browse, .preview:last .browse input").attr("disabled", false);
		} else {
			$(".preview:first, .preview:last .field, .preview:last .copy-label").show();
			$(".preview:last .browse, .preview:last .browse input").attr("disabled", true);
			$("#copy").attr("checked", true);
		}
	}

	function clearCanvas(large, miniature) {
		if (large) {
			document.querySelector("#large").width = document.querySelector("#large").width;
		}
		if (miniature) {
			document.querySelector("#miniature").width = document.querySelector("#miniature").width;
		}
	}

	function changeCopy(copy) {
		clearCanvas(false, true);

		if (copy) {
			var canvas = document.querySelector("#miniature"),
			context = canvas.getContext("2d");

			context.drawImage(document.querySelector("#large"), 0, 0, canvas.width, canvas.height);
			$("input[name='miniature']:last").val(canvas.toDataURL("image/png"));

			$(".preview:last .browse, .preview:last .browse input").attr("disabled", true);
		} else {
			$(".preview:last .browse, .preview:last .browse input").attr("disabled", false);
			$("input[name='miniature']:last").val("");
		}
	}

	function loadImages(banner) {
		var large = new Image(), miniature = new Image();

		if ($("select[name='principal']").val() == "1") {
			large.src = banner + ".png";

			large.onload = function (event) {
				var large_context = document.querySelector("#large").getContext("2d");
				large_context.drawImage(this, 0, 0, this.width, this.height);
			};
		}

		miniature.src = banner + "_small.png";

		miniature.onload = function (event) {
			var miniature_context = document.querySelector("#miniature").getContext("2d");
			miniature_context.drawImage(this, 0, 0, this.width, this.height);
		};
	}

	$("#never").change(function () { changeDate(true); });
	$("#date").change(function () { changeDate(false); });
	$("select[name='principal']").change(function () { changeType($(this).val()); });
	$("#copy").change(function () { changeCopy($(this).attr("checked")); });
	$(".browse").mouseup(function (e) { if(e.target.tagName === "SPAN") $("input[name='" + $(this).data("input") + "']:first").click(); e.preventDefault(); });
	$(window).keyup(function (e) { if (e.keyCode == 27 && $("#transparent").data("on") == "1") $("#transparent").click(); });

	$(document).ready(function (event) {
		if ($("#never").attr("checked")) {
			changeDate(true);
		} else if ($("#date").attr("checked")) {
			changeDate(false);
		}

		changeType($("select[name='principal']").val());

		if (banner_url.length > 0) {
			document.querySelector("#copy").checked = false;
			changeCopy(false);
			loadImages(banner_url);
		}
	});

	$("input[name='large']:first, input[name='miniature']:first").change(function (event) {
		if ("files" in this) {
			selectFile(this.files, $(this).attr("name"));
		}
	});

	$("#transparent").click(function (event) {
		if ($(this).data("on") == "0") {
			$(this).html($(this).data("select") + ' <span class="color"></span>');
			$("#large").css("cursor", "crosshair");
			if (!$("#copy").attr("checked")) $("#miniature").css("cursor", "crosshair");
			$(this).data("on", "1");
		} else {
			$(this).text($(this).data("set"));
			$("#large, #miniature").css("cursor", "default");
			$(this).data("on", "0");
		}
	});

	$("#large, #miniature").mousemove(function (e) {
		if ($("#transparent").data("on") == "1" && $(this).css("cursor") === "crosshair") {
		    var pos = findPos(this);
		    var x = e.pageX - pos.x;
		    var y = e.pageY - pos.y;
		    var context = this.getContext("2d");
		    
		    transparent = context.getImageData(x, y, 1, 1).data;
		    $("#transparent .color").css("background-color", "rgba(" + transparent[0] + "," + transparent[1] + "," + transparent[2] + "," + transparent[3] + ")");
		}
	});

	$("#large, #miniature").click(function (e) {
		if ($("#transparent").data("on") == "1" && $(this).css("cursor") === "crosshair" && transparent[3] > 0) {
			var context = this.getContext("2d"), data = context.getImageData(0, 0, 250, 100), pos;

			for (var x = 0; x < 250; x++) {
			    for (var y = 0; y < 100; y++) {
			        pos = (x + y * 250) * 4;

			        if (data.data[pos + 3] > 0) {
				        if (data.data[pos] == transparent[0] && data.data[pos + 1] == transparent[1] && data.data[pos + 2] == transparent[2]) {
				        	data.data[pos] = data.data[pos + 1] = data.data[pos + 2] = data.data[pos + 3] = 0;
				        }
			       	}
			    }
			}

			context.putImageData(data, 0, 0);

			if ($(this).attr("id") === "large" && $("#copy").attr("checked")) {
				changeCopy(true);
			}
			
			$("#transparent").click();
		}
	});
} (jQuery, window, document);

//-->
