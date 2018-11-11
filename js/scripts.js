$(document).ready(function(){
	// Lightbox 
	if(typeof(eval($.lightbox))=="function"){
		$('.typo').lightbox({selector:'p:not(.read-more) a'});
	}
});
