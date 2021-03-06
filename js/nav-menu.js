// 加载小屏幕的菜单标识
$('nav > div.pure-menu').prepend('<a id="menu" class="pure-menu-heading">M<span aria-hidden="true"></span></a>');
$("nav .pure-menu-allow-hover").prepend('<span class="submenu"></span>');

$(document).ready(function(){
    // 小屏幕的菜单操作响应
    var menu = $("#menu");
    var submenu = $('.submenu');

    var menu_toggle = function(e){
        e.toggleClass('opened');
        e.siblings('div > ul').toggleClass('show-menu');

        e.parent('div').toggleClass('pure-menu-horizontal');		
        e.parent().find('.pure-menu-allow-hover ul').toggleClass('pure-menu-children');
    }
    
    var submenu_toggle = function(e){
        e.toggleClass('opened');
        e.siblings('ul').toggleClass('show-menu');
        
    }

    menu.click(function(){
        menu_toggle($(this));
    });

    submenu.siblings('a').click(function(){
        submenu_toggle($(this).siblings('.submenu'));
    });

    submenu.click(function(){
        submenu_toggle($(this));
    });

    $(window).resize(function(){
        if(menu.hasClass('opened')){
            menu_toggle(menu);
        }

        submenu.each(function(){
            if($(this).hasClass('opened')){
                submenu_toggle($(this));
            }
        });

    });
    
	// 设置 Logo 区固定
	$('nav').prepend('<div id="nav-space"><b>1</b></div>');	
	$('#nav-space').css({"visibility":"hidden","height":"0px"});
	
	// 菜单吸顶
	$(window).scroll(function() {
		var logo_height = $("nav").offset().top;
		var nav_height = $("nav").get(0).offsetHeight;
	
		var nav = $("nav>div.pure-menu");
		if($(this).scrollTop()>=logo_height){
			nav.addClass("pure-menu-fixed");
			$('#nav-space').css("height",nav_height+"px");
		}
		else{
			nav.removeClass("pure-menu-fixed");
			$('#nav-space').css("height","0px");
		} 
	});
	
	$(window).resize(function(){
		if($(this).scrollTop()<$("nav").offset().top){
			$("nav>div.pure-menu").removeClass("pure-menu-fixed");
			$('#nav-space').css("height","0px");
		}
	});
	
});
