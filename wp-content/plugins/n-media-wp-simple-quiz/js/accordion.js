jQuery(document).ready(function($){
	$(".wqt-accordion").each(function(){
		$(".wqt-minus",this).hide(),
		$(".wqt-acc-panel",this).hide(),
		$('.wqt-questions-wrapper').on('click', '.wqt-quiz-slider', function(){
			var i=$(this).parent().parent().parent(),
			s=$(this),
			a=s.find(".wqt-plus"),
			e=s.find(".wqt-minus"),
			c=s.closest(".wqt-acc-head").siblings(".wqt-acc-panel");

			i.find(".wqt-plus").show(),
			i.find(".wqt-minus").hide(),
			i.find(".wqt-quiz-slider").not(this).removeClass("active"),
			i.find(".wqt-acc-panel").not(this).removeClass("active").slideUp(),
			s.hasClass("active")?(s.removeClass("active"),
				a.show(),
				e.hide(),
				c.removeClass("active").slideUp()
				):(s.addClass("active"),
				a.hide(),
				e.show(),
				c.addClass("active").slideDown()
				)
			})
	})
});