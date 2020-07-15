<?php 
	$kid_toys_store_custom_css ='';

	/*------------------Width Layout -------------------*/
	$kid_toys_store_theme_lay = get_theme_mod( 'kid_toys_store_width_options','Full Layout');
    if($kid_toys_store_theme_lay == 'Full Layout'){
		$kid_toys_store_custom_css .='body{';
			$kid_toys_store_custom_css .='max-width: 100%;';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_theme_lay == 'Contained Layout'){
		$kid_toys_store_custom_css .='body{';
			$kid_toys_store_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_theme_lay == 'Boxed Layout'){
		$kid_toys_store_custom_css .='body{';
			$kid_toys_store_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$kid_toys_store_custom_css .='}';
	}

	/*------------- Slider Opacity -------------------*/
	$kid_toys_store_slider_layout = get_theme_mod( 'kid_toys_store_slider_opacity','0.7');
	if($kid_toys_store_slider_layout == '0'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.1'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.1';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.2'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.2';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.3'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.3';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.4'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.4';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.5'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.5';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.6'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.6';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.7'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.7';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.8'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.8';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == '0.9'){
		$kid_toys_store_custom_css .='#slider img{';
			$kid_toys_store_custom_css .='opacity:0.9';
		$kid_toys_store_custom_css .='}';
	}

	/*-------------Slider Content Layout ------------*/
	$kid_toys_store_slider_layout = get_theme_mod( 'kid_toys_store_slider_content_option','Left');
    if($kid_toys_store_slider_layout == 'Left'){
		$kid_toys_store_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .read-btn{';
			$kid_toys_store_custom_css .='text-align:left;';
		$kid_toys_store_custom_css .='}';
		$kid_toys_store_custom_css .='#slider .carousel-caption{';
		$kid_toys_store_custom_css .='left:15%; right:45%;';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == 'Center'){
		$kid_toys_store_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .read-btn{';
			$kid_toys_store_custom_css .='text-align:center;';
		$kid_toys_store_custom_css .='}';
		$kid_toys_store_custom_css .='#slider .carousel-caption{';
		$kid_toys_store_custom_css .='left:25%; right:25%;';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_slider_layout == 'Right'){
		$kid_toys_store_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .read-btn{';
			$kid_toys_store_custom_css .='text-align:right;';
		$kid_toys_store_custom_css .='}';
		$kid_toys_store_custom_css .='#slider .carousel-caption{';
		$kid_toys_store_custom_css .='left:45%; right:15%;';
		$kid_toys_store_custom_css .='}';
	}

	/* Slider content spacing */
	$kid_toys_store_top_spacing = get_theme_mod('kid_toys_store_slider_top_spacing');
	$kid_toys_store_bottom_spacing = get_theme_mod('kid_toys_store_slider_bottom_spacing');
	$kid_toys_store_left_spacing = get_theme_mod('kid_toys_store_slider_left_spacing');
	$kid_toys_store_right_spacing = get_theme_mod('kid_toys_store_slider_right_spacing');
	if($kid_toys_store_top_spacing != false || $kid_toys_store_bottom_spacing != false || $kid_toys_store_left_spacing != false || $kid_toys_store_right_spacing != false){
		$kid_toys_store_custom_css .='#slider .carousel-caption{';
			$kid_toys_store_custom_css .='top: '.esc_html($kid_toys_store_top_spacing).'%; bottom: '.esc_html($kid_toys_store_bottom_spacing).'%; left: '.esc_html($kid_toys_store_left_spacing).'%; right: '.esc_html($kid_toys_store_right_spacing).'%;';
		$kid_toys_store_custom_css .='}';
	}

	/*------ Button Style -------*/
	$kid_toys_store_top_buttom_padding = get_theme_mod('kid_toys_store_top_button_padding');
	$kid_toys_store_left_right_padding = get_theme_mod('kid_toys_store_left_button_padding');
	if($kid_toys_store_top_buttom_padding != false || $kid_toys_store_left_right_padding != false ){
		$kid_toys_store_custom_css .='.blogbutton-mdall, #slider a.read-more, #comments input[type="submit"].submit{';
			$kid_toys_store_custom_css .='padding-top: '.esc_html($kid_toys_store_top_buttom_padding).'px; padding-bottom: '.esc_html($kid_toys_store_top_buttom_padding).'px; padding-left: '.esc_html($kid_toys_store_left_right_padding).'px; padding-right: '.esc_html($kid_toys_store_left_right_padding).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_button_border_radius = get_theme_mod('kid_toys_store_button_border_radius');
	$kid_toys_store_custom_css .='.blogbutton-mdall, #slider a.read-more, #comments input[type="submit"].submit, .hvr-sweep-to-right:before{';
		$kid_toys_store_custom_css .='border-radius: '.esc_html($kid_toys_store_button_border_radius).'px;';
	$kid_toys_store_custom_css .='}';

	/*-------------- Woocommerce Button  -------------------*/
	$kid_toys_store_woocommerce_button_padding_top = get_theme_mod('kid_toys_store_woocommerce_button_padding_top');
	if($kid_toys_store_woocommerce_button_padding_top != false){
		$kid_toys_store_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled]{';
			$kid_toys_store_custom_css .='padding-top: '.esc_html($kid_toys_store_woocommerce_button_padding_top).'px; padding-bottom: '.esc_html($kid_toys_store_woocommerce_button_padding_top).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_button_padding_right = get_theme_mod('kid_toys_store_woocommerce_button_padding_right');
	if($kid_toys_store_woocommerce_button_padding_right != false){
		$kid_toys_store_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled]{';
			$kid_toys_store_custom_css .='padding-left: '.esc_html($kid_toys_store_woocommerce_button_padding_right).'px; padding-right: '.esc_html($kid_toys_store_woocommerce_button_padding_right).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_button_border_radius = get_theme_mod('kid_toys_store_woocommerce_button_border_radius');
	if($kid_toys_store_woocommerce_button_border_radius != false){
		$kid_toys_store_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled]{';
			$kid_toys_store_custom_css .='border-radius: '.esc_html($kid_toys_store_woocommerce_button_border_radius).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_related_product = get_theme_mod('kid_toys_store_related_product',true);

	if($kid_toys_store_related_product == false){
		$kid_toys_store_custom_css .='.related.products{';
			$kid_toys_store_custom_css .='display: none;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_product_border = get_theme_mod('kid_toys_store_woocommerce_product_border',false);

	if($kid_toys_store_woocommerce_product_border == true){
		$kid_toys_store_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$kid_toys_store_custom_css .='border: 1px solid #dcdcdc;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_product_padding_top = get_theme_mod('kid_toys_store_woocommerce_product_padding_top');
	if($kid_toys_store_woocommerce_product_padding_top != false){
		$kid_toys_store_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$kid_toys_store_custom_css .='padding-top: '.esc_html($kid_toys_store_woocommerce_product_padding_top).'px; padding-bottom: '.esc_html($kid_toys_store_woocommerce_product_padding_top).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_product_padding_right = get_theme_mod('kid_toys_store_woocommerce_product_padding_right',10);
	if($kid_toys_store_woocommerce_product_padding_right != false){
		$kid_toys_store_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$kid_toys_store_custom_css .='padding-left: '.esc_html($kid_toys_store_woocommerce_product_padding_right).'px; padding-right: '.esc_html($kid_toys_store_woocommerce_product_padding_right).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_product_border_radius = get_theme_mod('kid_toys_store_woocommerce_product_border_radius');
	if($kid_toys_store_woocommerce_product_border_radius != false){
		$kid_toys_store_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$kid_toys_store_custom_css .='border-radius: '.esc_html($kid_toys_store_woocommerce_product_border_radius).'px;';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_woocommerce_product_box_shadow = get_theme_mod('kid_toys_store_woocommerce_product_box_shadow');
	if($kid_toys_store_woocommerce_product_box_shadow != false){
		$kid_toys_store_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$kid_toys_store_custom_css .='box-shadow: '.esc_html($kid_toys_store_woocommerce_product_box_shadow).'px '.esc_html($kid_toys_store_woocommerce_product_box_shadow).'px '.esc_html($kid_toys_store_woocommerce_product_box_shadow).'px #aaa;';
		$kid_toys_store_custom_css .='}';
	}

	/*---- Preloader Color ----*/
	$kid_toys_store_preloader_color = get_theme_mod('kid_toys_store_preloader_color');
	$kid_toys_store_preloader_bg_color = get_theme_mod('kid_toys_store_preloader_bg_color');

	if($kid_toys_store_preloader_color != false){
		$kid_toys_store_custom_css .='.preloader-squares .square, .preloader-chasing-squares .square{';
			$kid_toys_store_custom_css .='background-color: '.esc_html($kid_toys_store_preloader_color).';';
		$kid_toys_store_custom_css .='}';
	}
	if($kid_toys_store_preloader_bg_color != false){
		$kid_toys_store_custom_css .='.preloader{';
			$kid_toys_store_custom_css .='background-color: '.esc_html($kid_toys_store_preloader_bg_color).';';
		$kid_toys_store_custom_css .='}';
	}

	/*---- Copyright css ----*/
	$kid_toys_store_copyright_fontsize = get_theme_mod('kid_toys_store_copyright_fontsize',16);
	if($kid_toys_store_copyright_fontsize != false){
		$kid_toys_store_custom_css .='#footer p{';
			$kid_toys_store_custom_css .='font-size: '.esc_html($kid_toys_store_copyright_fontsize).'px; ';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_copyright_top_bottom_padding = get_theme_mod('kid_toys_store_copyright_top_bottom_padding',15);
	if($kid_toys_store_copyright_top_bottom_padding != false){
		$kid_toys_store_custom_css .='#footer {';
			$kid_toys_store_custom_css .='padding-top:'.esc_html($kid_toys_store_copyright_top_bottom_padding).'px; padding-bottom: '.esc_html($kid_toys_store_copyright_top_bottom_padding).'px; ';
		$kid_toys_store_custom_css .='}';
	}

	$kid_toys_store_copyright_alignment = get_theme_mod( 'kid_toys_store_copyright_alignment','Center');
    if($kid_toys_store_copyright_alignment == 'Left'){
		$kid_toys_store_custom_css .='#footer p{';
			$kid_toys_store_custom_css .='text-align:left;';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_copyright_alignment == 'Center'){
		$kid_toys_store_custom_css .='#footer p{';
			$kid_toys_store_custom_css .='text-align:center;';
		$kid_toys_store_custom_css .='}';
	}else if($kid_toys_store_copyright_alignment == 'Right'){
		$kid_toys_store_custom_css .='#footer p{';
			$kid_toys_store_custom_css .='text-align:right;';
		$kid_toys_store_custom_css .='}';
	}