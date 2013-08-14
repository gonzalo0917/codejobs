!function ($, window, document, undefined) {
	var requesting = false, path = PATH;

	$("input[name='URL']").change(function (event) {
		var url = $(this).val();

		if (/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/ .test(url) && !requesting) {
			$("#form-add").find("input, textarea, select").attr("disabled", true);

			$(this).addClass("loading");

			requesting = true;

			$.ajax({
				"type" : "json",
				"url" : path + "/bookmarks/request/?url=" + encodeURIComponent(url),
				"success" : loaded,
				"error"	: function () {
					loaded({"Title": "", "Description": "", "Keywords": ""})
				}
			});
		}
	});

	function loaded(data)
	{
		data = JSON.parse(data);

		$("#form-add").find("input, textarea, select").attr("disabled", false);

		$("input[name='URL']").removeClass("loading");
		$("input[name='title']").val(data.Title);
		$("textarea[name='description']").val(data.Description);
		$("input[name=tags]").val(data.Keywords);

		requesting = false;
	}

	$('input[name=tags]').focusout(function(event){
		if($(this).val()!=''){
			var tags = $(this).val().split(',');
			if(tags.length >2){
				var tags_txt = '';
				tags = unique( tags );
				for(var i in tags ){
					tags_txt+= tags[i] + ( (tags.length-1) ==i?'':',' );
				}
				$(this).val(tags_txt);
			}
		}
	});

	function unique(ar)
	{	    
	    var exist=false,v="",aux=[].concat(ar),r=Array();
	    for (var i in aux){
	        v=aux[i];
	        exist=false;
	        for (var a in aux){	            
	            if ($.trim(v) == $.trim(aux[a]) ){
	                if (exist==false){
	                    exist=true;
	                }
	                else{
	                    aux[a]="";
	                }
	            }
	        }
	    }	    
	    for (var a in aux){
	        if ($.trim(aux[a])!=""){
	            r.push(aux[a]);
	        }
	    }	    
	    return r;
	} 
} (jQuery, window, document);