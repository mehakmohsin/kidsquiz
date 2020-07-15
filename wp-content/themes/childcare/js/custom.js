jQuery(function() {
	 /*--Menu Dropdown--------*/ 
	   jQuery('.nav li.dropdown').hover(function() {
		   jQuery(this).addClass('open');
	   }, function() {
		   jQuery(this).removeClass('open');
	   }); 
	   
  /* Demo Scripts for Bootstrap Carousel and Animate.css */
	function doAnimations( elems ) {
		//Cache the animationend event in a variable
		var animEndEv = 'webkitAnimationEnd animationend';
		
		elems.each(function () {
			var $this = jQuery(this),
				$animationType = $this.data('animation');
			   $this.addClass($animationType).one(animEndEv, function () {
				$this.removeClass($animationType);
			});
		});
	}	
});
			
		