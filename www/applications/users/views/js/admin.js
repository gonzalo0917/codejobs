!function($) {
	var application, table, total, loading_more, records, order_by, search_by, field, found_records, total_records;

	application   = APP;
	table 		  = ".results";
	total_records = parseInt($("#total").val());
	records 	  = parseInt($("#count").val());
	requesting 	  = false;
	loading_more  = false;
	order_by 	  = false;
	search_by 	  = false;
	found_records = false;
	total 		  = total_records;

	$(table + " thead th a").mouseenter(refreshTitle);

	$(table + " tbody tr").click(columnClick);
	$(table + " tbody .tiny-delete").click(deleteClick);
	$(table + " thead th a").click(anchorClick);

	$("#records").click(function (event) {
		if ($(this).is(":checked")) {
			$(table + " tbody input[name='records[]']").attr("checked", true);
		} else {
			$(table + " tbody input[name='records[]']").attr("checked", false);
		}
	});

	$("#delete").click(function (event) {
		event.stopPropagation();
		event.preventDefault();

		var $elems, elems, selected;

		$elems = $(table + " tbody input[name='records[]']:checked");
		selected  = $elems.length;

		if (selected > 0) {
			if (confirm($("#delete-question").val() + " (" + selected + ")")) {
				elems = [];

				$elems.each(function (key, obj) {
					elems.push($(obj).val());
				});

				if (!requesting) {
					shadow(true);

					var uri = "?start=" + records + "&records[]=" + elems.join("&records[]=");

					if (order_by) {
						uri += "&field=" + order_by[0] + "&order=" + order_by[1];
					}

					if (search_by) {
						uri += "&query=" + search_by;
					}

					$.ajax({
						"type" 	  : "json",
						"url"  	  : PATH + "/blog/admin/delete/" + uri,
						"success" : deleted
					});
				}
			}
		} else {
			alert($("#delete-empty-question").val());
		}

		return false;
	});

	$("#more").appear(function () {
		if (!loading_more && !requesting) {
			var uri = "?start=" + records;

			if (order_by) {
				uri += "&field=" + order_by[0] + "&order=" + order_by[1];
			}

			if (search_by) {
				uri += "&query=" + search_by;
			}

			$.ajax({
				"type" 	 : "json",
				"url" 	 : PATH + "/blog/admin/data/" + uri,
				"success": loaded
			});

			loading_more = true;
		}
	});

	$("#search-input").keydown(function (event) {
		if (event.keyCode === 13) {
			event.stopPropagation();
			event.preventDefault();

			search($(this).val());

			return false;
		}
	});

	$("#clear").click(clearResults);

	function deleteClick(event) {
		event.stopPropagation();
		event.preventDefault();

		if (confirm($('#deleting-question').val())) {
			var obj = this, id = $(obj).parent().parent().find("input[name='records[]']").val();

			if (!requesting) {
				shadow(true);

				var uri = "?start=" + records + "&records[]=" + id;

				if (order_by) {
					uri += "&field=" + order_by[0] + "&order=" + order_by[1];
				}

				if (search_by) {
					uri += "&query=" + search_by;
				}

				$.ajax({
					"type" 	  : "json",
					"url"  	  : PATH + "/blog/admin/delete/" + uri,
					"success" : function (data) {
						!$.proxy(deleted, obj)(data, id);
					}
				});
			}
		}

		return false;
	};

	function setTotal(value) {
		total = value;

		if (search_by) {
			found_records = value;
		} else {
			total_records = value;
		}
	}

	function processData(data) {
		var values = (typeof data === "string" ? eval(data) : data);

		if (values.length > 0) {
			$.each(values, function (key, value) {
				addColumn(value);
			});

			records = $(table + " tbody tr").length;
		} else if(records < total) {
			setTotal(records);
		}

		if (records >= total) {
			$("#more").hide();
		} else {
			$("#more").show();
		}
	}

	function loaded(data) {
		processData(data);

		loading_more = false;
	}

	function deleted(data, record) {
		if (record === undefined || record === "success") {
			var $elems = $(table + " tbody input[name='records[]']:checked");

			setTotal(total - $elems.length);

			if (search_by) {
				total_records -= $elems.length;
			}

			$elems.parent().parent().remove();
		} else {
			setTotal(total - 1);

			if (search_by) {
				total_records--;
			}

			$(this).parent().parent().remove();
		}

		processData(data);

		$("#my_" + application).text(total_records);

		shadow(false);
	}

	function ordered(data) {
		$(table + " tbody").empty();

		processData(data);

		shadow(false);
	}

	function found(data) {
		$(table + " tbody").empty();

		data = eval(data);
		
		setTotal(data.shift().Total);

		processData(data);

		shadow(false);
	}

	function addColumn(data) {
		var column = $('<tr></tr>'), actions = $('<td data-center></td>');

		column.append('<td data-center><input name="records[]" value="' + data.ID_Post + '" type="checkbox" /></td>');
		column.append('<td><a href="' + PATH + '/blog/' + data.Year + '/' + data.Month + '/' + data.Day + '/' + data.Slug + '" target="_blank">' + data.Title + '</a></td>');
		column.append('<td data-center>' + data.Views + '</td>');
		column.append('<td data-center>' + data.Language + '</td>');
		column.append('<td data-center>' + data.Situation + '</td>');
		column.append('<td data-center title="' + data.Start_Date + '">' + data.Start_Date + '</td>');
		
		actions.append('<a href="' + PATH + '/blog/add/' + data.ID_Post + '" title="' + $("#edit-label").val() + '" class="tiny-image tiny-edit no-decoration">&nbsp;&nbsp;&nbsp;</a>');
		actions.append($('<a href="#" title="' + $("#delete-label").val() + '" class="tiny-image tiny-delete no-decoration">&nbsp;&nbsp;&nbsp;</a>').click(deleteClick));

		column.append(actions);

		column.click(columnClick);

		$(table + " tbody").append(column);
	}

	function columnClick(event) {
		if (event.target.tagName !== "A" && event.target.name !== "records[]") {
			if ($(this).find("input[name='records[]']").is(":checked")) {
				$(this).find("input[name='records[]']").attr("checked", false);
			} else {
				$(this).find("input[name='records[]']").attr("checked", true);
			}
		}
	}

	function shadow(wait) {
		requesting = wait;

		if (wait) {
			var offset = $(".results").offset();

			$("#table-shadow").css({
				"display": "block",
				"left": offset.left + "px",
				"top": offset.top + "px",
				"width": $(".results").width(),
				"height": $(".results").height()
			});

			$("#more").hide();
		} else {
			$("#table-shadow").css("display", "none");
		}
	}

	function anchorClick(event) {
		event.stopPropagation();
		event.preventDefault();

		if (!requesting) {
			shadow(true);

			var field = $(this).parent().data("field"),
				order = $(this).parent().attr("data-order");

			$(table + " thead th[data-order]").attr("data-order", "");

			if (!order || order === "ASC") {
				$(this).parent().attr("data-order", order = "DESC");
			} else {
				$(this).parent().attr("data-order", order = "ASC");
			}

			+$.proxy(refreshTitle, this)();

			var uri = "?start=0&field=" + field + "&order=" + order;

			if (search_by) {
				uri += "&query=" + search_by;
			}

			$.ajax({
				"type" 	  : "json",
				"url"  	  : PATH + "/blog/admin/data/" + uri,
				"success" : search_by ? found : ordered
			});

			order_by = [field, order];
		}

		return false;
	}

	function search(query) {
		if (query) {
			if (!requesting) {
				shadow(true);

				$("#query").text(search_by = query);
				$("#subtitle").slideDown();
				$("#search-input").val("").blur();

				var uri = "?start=0&query=" + query;

				if (order_by) {
					uri += "&field=" + order_by[0] + "&order=" + order_by[1];
				}

				$.ajax({
					"type" 	  : "json",
					"url"  	  : PATH + "/blog/admin/data/" + uri,
					"success" : found
				});
			}
		}
	}

	function clearResults(event) {
		event.stopPropagation();
		event.preventDefault();

		if (!requesting) {
			shadow(true);

			$("#query").text("");
			$("#subtitle").hide();
			$("#search-input").val("").blur();

			var uri = "?start=0";

			if (order_by) {
				uri += "&field=" + order_by[0] + "&order=" + order_by[1];
			}

			$.ajax({
				"type" 	  : "json",
				"url"  	  : PATH + "/blog/admin/data/" + uri,
				"success" : restored
			});
		}

		return false;
	}

	function restored(data) {
		$(table + " tbody").empty();

		search_by = false;

		setTotal(total_records);
		processData(data);
		shadow(false);
	}

	function refreshTitle() {
		var order = $(this).parent().attr("data-order");

		if (order === "DESC") {
			$(this).attr("title", $("#order-asc").val());
		} else {
			$(this).attr("title", $("#order-desc").val());
		}
	}

}(jQuery);