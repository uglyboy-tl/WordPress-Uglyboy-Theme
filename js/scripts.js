$(document).ready(function(){

	// 设置 Logo 区固定
	var logo_height = $("nav").offset().top;
	var nav_height = $("nav").get(0).offsetHeight;

	$('nav').prepend('<div id="nav-space"><b>1</b></div>');	
	$('#nav-space').css({"visibility":"hidden","height":"0px"});
	
	// 菜单吸顶
	$(window).scroll(function() {
		var nav = $("nav>div.pure-menu");
		if($(this).scrollTop()>logo_height){
			nav.addClass("pure-menu-fixed");
			$('#nav-space').css("height",nav_height+"px");
		}
		else{
			nav.removeClass("pure-menu-fixed");
			$('#nav-space').css("height","0px");
		} 
	});

	// Lightbox 
	if(typeof(eval($.lightbox))=="function"){
		$('.typo').lightbox({selector:'p:not(.read-more) a'});
	}
});
