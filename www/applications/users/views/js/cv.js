alert("cv.js");
$("#update-personal-information").click(function () {
	var userid = $('#userid').val();
	var name = $('#name').val();
	var birthday = $('#birthday').val();

	alert(name);
	//Validaciones

	$.ajax({
		type: 'POST',
		url:   PATH + '/users/cv/'+ userid,
		data: 'name='+ name + '&birthday=' + birthday,
		success: function(response) {
			alert("Datos actualizados");
		}
	});
});