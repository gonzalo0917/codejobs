!function($) {
	var total, loading_more, records;

	total 		 = $("#total").val();
	records 	 = $("#count").val();
	loading_more = false;

	$(".results thead th a").mouseenter(function (event) {
		var order = $(this).parent().attr("data-order");

		if (order === "DESC") {
			$(this).attr("title", $("#order-asc").val());
		} else {
			$(this).attr("title", $("#order-desc").val());
		}
	});

	$(".results tbody tr").click(function (event) {
		if (event.target.tagName !== "A" && event.target.name !== "records[]") {
			if ($(this).find("input[name='records[]']").is(":checked")) {
				$(this).find("input[name='records[]']").attr("checked", false);
			} else {
				$(this).find("input[name='records[]']").attr("checked", true);
			}
		}
	});

	$("#records").click(function (event) {
		if ($(this).is(":checked")) {
			$(".results tbody input[name='records[]']").attr("checked", true);
		} else {
			$(".results tbody input[name='records[]']").attr("checked", false);
		}
	});

	$("#delete").click(function (event) {
		event.stopPropagation();
		event.preventDefault();

		var total = $(".results tbody input[name='records[]']:checked").length;

		if (total > 0) {
			if (confirm($("#delete-question").val() + " (" + total + ")")) {

			}
		} else {
			alert("You must select at least one record");
		}

		return false;
	});

	$("#more").appear(function () {
		if (!loading_more) {
			$.ajax({
				"type" 	 : "json",
				"url" 	 : $("#main-url").val() + "more/" + records,
				"success": function (data) {
					$.each(eval(data), function (key, value) {
						addColumn(value);
					});
				}
			});

			loading_more = true;
		}
	});

	function addColumn(data) {
		var tr = $('<tr></tr>');

		tr.append('<td data-center><input name="records[]" value="' + data.ID_Post + '" type="checkbox" /></td>');
		tr.append('<td><a href="' + PATH + '/blog/' + data.Year + '/' + data.Month + '/' + data.Day + '/' + data.Slug + '" target="_blank">' + data.Title + '</a></td>');
		tr.append('<td data-center>' + data.Views + '</td>');
		tr.append('<td data-center>' + data.Language + '</td>');
		tr.append('<td data-center>' + data.Situation + '</td>');
		tr.append('<td data-center title="' + data.Start_Date + '">' + data.Start_Date + '</td>');
		tr.append('<td data-center>-</td>');

		$(".results tbody").append(tr);
	}

}(jQuery);