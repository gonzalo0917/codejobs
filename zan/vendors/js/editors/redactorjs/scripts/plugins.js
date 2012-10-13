function setRedactorPlugins() {
	if (typeof redactorPlugins !== 'undefined') {
		$.fn.extend(redactorPlugins);
	}
}

if (typeof redactorPlugins === 'undefined') {
	$(window).on("load", setRedactorPlugins);
} else {
	setRedactorPlugins();
}