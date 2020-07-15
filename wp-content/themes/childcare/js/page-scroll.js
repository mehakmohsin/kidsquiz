/*
* Author: Asiathemes Theme
* Created by: Asiathemes
* Copyright (c) 2015 Asiathemes
* Date: 15 Dec, 2015
* http://www.asiathemes.com
*/

/*-- Page Scroll To Top Section ---------------*/
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.hc_scrollup').fadeIn();
			} else {
				jQuery('.hc_scrollup').fadeOut();
			}
		});
	
		jQuery('.hc_scrollup').click(function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	