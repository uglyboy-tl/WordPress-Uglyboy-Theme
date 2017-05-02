(function($){
	'use strict';
	$(window).scroll(function() {
		var navHeight = $("#nav-height").offset().top;
		var navFix = $("#nav-menu");
		if($(this).scrollTop()>navHeight){
			navFix.addClass("pure-menu-fixed");
		}
		else{
			navFix.removeClass("pure-menu-fixed");
		} 
	});
})(Zepto)

$(document).ready(function(){
	$('.typo').rebox({ selector: 'a' });
});