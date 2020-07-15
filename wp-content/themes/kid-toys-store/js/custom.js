jQuery(function($){
	"use strict";
	jQuery('.main-menu-navigation > ul').superfish({
		delay:       500,                            
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'                        
	});

});

function kid_toys_store_menu_open() {
	window.respMenu=true;
	jQuery(".side-menu").addClass('open');
}
function kid_toys_store_menu_close() {
	window.respMenu=false;
	jQuery(".side-menu").removeClass('open');
}

(function( $ ) {

	$(window).scroll(function(){
		var sticky = $('.sticky-header'),
		scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('fixed-header');
		else sticky.removeClass('fixed-header');
	});

	// Back to top
	jQuery(document).ready(function () {
	    jQuery(window).scroll(function () {
	        if (jQuery(this).scrollTop() > 0) {
	            jQuery('.scrollup').fadeIn();
	        } else {
	            jQuery('.scrollup').fadeOut();
	        }
	    });
	    jQuery('.scrollup').click(function () {
	        jQuery("html, body").animate({
	            scrollTop: 0
	        }, 600);
	        return false;
	    });
	});

	$(window).load(function() {
		$(".preloader").delay(2000).fadeOut("slow");
	});

})( jQuery );

jQuery(window).load(function() {
	window.currentfocus=null;
	kid_toys_store_checkfocusdElement();
	var body = document.querySelector('body');
	body.addEventListener('keyup', kid_toys_store_check_tab_press);
	var gotoHome = false;
	var gotoClose = false;
	window.respMenu=false;
	function kid_toys_store_checkfocusdElement(){
	    if(window.currentfocus=document.activeElement.className){
	        window.currentfocus=document.activeElement.className;
	    }
	}
	function kid_toys_store_check_tab_press(e) {
	    "use strict";
	    e = e || event;
	    var activeElement;

	    if(window.innerWidth < 999){
		    if (e.keyCode == 9) {
		        if(window.respMenu){
				    if (!e.shiftKey) {
				        if(gotoHome) {
				            jQuery( ".main-menu-navigation ul:first li:first a:first-child" ).focus();
				        }
				    }
				    if (jQuery("a.closebtn").is(":focus")) {
				        gotoHome = true;
				    } else {
				        gotoHome = false;
				    }
		    	}
		    }
	    }
	    if (e.shiftKey && e.keyCode == 9) {
		    if(window.innerWidth < 999){
			    if(window.currentfocus=="header-search"){
			        jQuery("button.mobiletoggle").focus();
			    }else{
				    if(window.respMenu){
				        if(gotoClose){
				        	jQuery("a.closebtn").focus();
				        }
				        if(jQuery( ".main-menu-navigation ul:first li:first a:first-child" ).is(":focus")) {
				            gotoClose = true;
				        } else {
				            gotoClose = false;
				        }
				    }
			    }
		    }
	    }
	    kid_toys_store_checkfocusdElement();
	}
});