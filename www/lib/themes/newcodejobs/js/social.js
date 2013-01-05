window.___gcfg = {lang: 'es'};

(function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/plusone.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if(d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=323728064351205";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
	
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

$(document).ready(function() {
    $(".fb-comments-count").each(function (index) {
        var $next, $target, singular;
        $(this).on("DOMNodeInserted", function (event) {
            $target = $(event.target);
            $next   = $target.parent().next();
            
            if(parseInt($target.text()) == 1) {
                singular = $next.data("singular");
               
                if(singular) {
                    $next.text(singular);
                }
            }
        });
    });
});

