// <!--

+function ($, window, document, undefined) {
	var transparent = {};

	$("input[name='image']").val("");

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
					if (this.height > this.width) {
						alert($("#orientation-error").val());
						$("input[name='image']").val("");
					} else {
						var canvas = $("#preview").get(0), context = canvas.getContext("2d"), ratio, dimensions, attr;

						if (this.width / this.height < 2.5) {
							// Stretch to height
							ratio = 100 / this.height;
							attr = {
								"height" : 100,
								"width"  : ratio * this.width,
								"top"    : 0,
								"left"   : (250 - ratio * this.width) / 2
							};
						} else {
							// Stretch to width
							ratio = 250 / this.width;
							attr = {
								"width"  : 250,
								"height" : ratio * this.height,
								"left"   : 0,
								"top"    : (100 - ratio * this.height) / 2
							};
						}

						document.querySelector("#preview").width = "250";
						context.drawImage(this, 0, 0, this.width, this.height, attr.left, attr.top, attr.width, attr.height);
						
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

	$("#transparent").click(function (event) {
		if ($(this).data("on") == "0") {
			$(this).html($(this).data("select") + ' <span class="color"></span>');
			$("#preview").css("cursor", "crosshair");
			$(this).data("on", "1");
		} else {
			$(this).text($(this).data("set"));
			$("#preview").css("cursor", "default");
			$(this).data("on", "0");
		}
	});

	$("#preview").mousemove(function (e) {
		if ($("#transparent").data("on") == "1") {
		    var pos = findPos(this);
		    var x = e.pageX - pos.x;
		    var y = e.pageY - pos.y;
		    var context = this.getContext("2d");
		    
		    transparent = context.getImageData(x, y, 1, 1).data;
		    $("#transparent .color").css("background-color", "rgba(" + transparent[0] + "," + transparent[1] + "," + transparent[2] + "," + transparent[3] + ")");
		}
	});

	$("#preview").click(function (e) {
		if ($("#transparent").data("on") == "1" && transparent[3] > 0) {
			var context = document.querySelector("#preview").getContext("2d"), data = context.getImageData(0, 0, 250, 100), pos;

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
		}

		$("#transparent").click();
	});
} (jQuery, window, document);

//-->
