<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_kids_first_color = get_theme_mod('vw_kids_first_color');

	$vw_kids_custom_css = '';

	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='.cart-value, #menu-box, #slider .view-more:hover, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .scrollup i, input[type="submit"], #sidebar .custom-social-icons i, #footer .custom-social-icons i, #footer .tagcloud a:hover, #footer-2, .view-more:hover, .pagination .current, .pagination a:hover, #sidebar .tagcloud a:hover, #comments input[type="submit"], nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .header-fixed, #comments a.comment-reply-link, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #sidebar #respond input#submit:hover, #sidebar a.button:hover, #sidebar button.button:hover, #footer input.button:hover, #footer #respond input#submit.alt:hover, #footer a.button.alt:hover, #footer button.button.alt:hover, #footer input.button.alt:hover, #footer #respond input#submit:hover, #footer a.button:hover, #footer button.button:hover, #footer input.button:hover, #footer #respond input#submit.alt:hover, #footer a.button.alt:hover, #footer button.button.alt:hover, #footer input.button.alt:hover, #footer .woocommerce-product-search button, #sidebar .more-button a:hover, #footer a.custom_read_more{';
			$vw_kids_custom_css .='background-color: '.esc_html($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='.products li:hover, .products li:hover span.onsale{';
			$vw_kids_custom_css .='background-color: '.esc_html($vw_kids_first_color).'!important;';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='a, #footer .custom-social-icons i:hover, #footer li a:hover, .post-main-box:hover h2, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, .main-navigation ul.sub-menu a:hover, #footer .more-button a:hover, #footer .more-button:hover i{';
			$vw_kids_custom_css .='color: '.esc_html($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='#slider .view-more:hover, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .products li:hover a.button, .view-more:hover, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, #sidebar .more-button a:hover{';
			$vw_kids_custom_css .='border-color: '.esc_html($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='#slider hr, #popular-toys hr, .main-navigation ul ul{';
			$vw_kids_custom_css .='border-top-color: '.esc_html($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='#footer h3:after, .main-navigation ul ul{';
			$vw_kids_custom_css .='border-bottom-color: '.esc_html($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='.post-main-box, #sidebar .widget{
		box-shadow: 0px 15px 10px -15px '.esc_html($vw_kids_first_color).';
		}';
	}

	/*---------------------------Second highlight color-------------------*/

	$vw_kids_second_color = get_theme_mod('vw_kids_second_color');

	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='#topbar, .categry-title, #sidebar .custom-social-icons i:hover, .pagination span, .pagination a, .woocommerce span.onsale, .products li, .woocommerce ul.products li.product{';
			$vw_kids_custom_css .='background-color: '.esc_html($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='h1,h2,h3,h4,h5,h6, .custom-social-icons i:hover, .logo h1 a, .logo p.site-title a, .cart_no i, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, #slider .inner_carousel h1, #slider .view-more, .view-more, .post-main-box h2, #sidebar caption, #sidebar h3, .post-navigation a, .woocommerce div.product .product_title, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce .quantity .qty, .woocommerce-message::before,.woocommerce-info::before, #comments a.comment-reply-link, .main-navigation a:hover, .main-navigation ul ul a, #sidebar a.custom_read_more{';
			$vw_kids_custom_css .='color: '.esc_html($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='.products li:hover .star-rating span{';
			$vw_kids_custom_css .='color: '.esc_html($vw_kids_second_color).'!important;';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='.cart_no i, #slider .carousel-control-prev-icon,#slider .carousel-control-next-icon, #slider .view-more, .view-more, a.button.product_type_simple.add_to_cart_button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce .quantity .qty, #sidebar a.custom_read_more{';
			$vw_kids_custom_css .='border-color: '.esc_html($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='.post-info hr, .woocommerce-message,.woocommerce-info{';
			$vw_kids_custom_css .='border-top-color: '.esc_html($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='nav.woocommerce-MyAccount-navigation ul li{
		box-shadow: 2px 2px 0 0 '.esc_html($vw_kids_second_color).';
		}';
	}
	/*---------------------------Width Layout -------------------*/

	$vw_kids_theme_lay = get_theme_mod( 'vw_kids_width_option','Full Width');
    if($vw_kids_theme_lay == 'Boxed'){
		$vw_kids_custom_css .='body{';
			$vw_kids_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_theme_lay == 'Wide Width'){
		$vw_kids_custom_css .='body{';
			$vw_kids_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_theme_lay == 'Full Width'){
		$vw_kids_custom_css .='body{';
			$vw_kids_custom_css .='max-width: 100%;';
		$vw_kids_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_kids_theme_lay = get_theme_mod( 'vw_kids_slider_opacity_color','0.5');
	if($vw_kids_theme_lay == '0'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.1'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.1';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.2'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.2';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.3'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.3';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.4'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.4';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.5'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.5';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.6'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.6';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.7'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.7';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.8'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.8';
		$vw_kids_custom_css .='}';
		}else if($vw_kids_theme_lay == '0.9'){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='opacity:0.9';
		$vw_kids_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_kids_theme_lay = get_theme_mod( 'vw_kids_slider_content_option','Left');
    if($vw_kids_theme_lay == 'Left'){
		$vw_kids_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kids_custom_css .='text-align:left; left:10%; right:22%; top: 40%;';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_theme_lay == 'Center'){
		$vw_kids_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kids_custom_css .='text-align:center; left:20%; right:20%; top: 35%;';
		$vw_kids_custom_css .='}';
		$vw_kids_custom_css .='#slider hr{';
			$vw_kids_custom_css .='margin: 0 15em;';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_theme_lay == 'Right'){
		$vw_kids_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kids_custom_css .='text-align:right; left:22%; right:17%; top: 40%;';
		$vw_kids_custom_css .='}';
		$vw_kids_custom_css .='#slider hr{';
			$vw_kids_custom_css .='margin: 0 30em;';
		$vw_kids_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_kids_slider_height = get_theme_mod('vw_kids_slider_height');
	if($vw_kids_slider_height != false){
		$vw_kids_custom_css .='#slider img{';
			$vw_kids_custom_css .='height: '.esc_html($vw_kids_slider_height).';';
		$vw_kids_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_kids_theme_lay = get_theme_mod( 'vw_kids_blog_layout_option','Default');
    if($vw_kids_theme_lay == 'Default'){
		$vw_kids_custom_css .='.post-main-box{';
			$vw_kids_custom_css .='';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_theme_lay == 'Center'){
		$vw_kids_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn{';
			$vw_kids_custom_css .='text-align:center;';
		$vw_kids_custom_css .='}';
		$vw_kids_custom_css .='.post-info{';
			$vw_kids_custom_css .='margin-top:10px;';
		$vw_kids_custom_css .='}';
		$vw_kids_custom_css .='.post-info hr{';
			$vw_kids_custom_css .='margin:15px auto;';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_theme_lay == 'Left'){
		$vw_kids_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_kids_custom_css .='text-align:Left;';
		$vw_kids_custom_css .='}';
		$vw_kids_custom_css .='.post-info hr{';
			$vw_kids_custom_css .='margin-bottom:10px;';
		$vw_kids_custom_css .='}';
		$vw_kids_custom_css .='.post-main-box h2{';
			$vw_kids_custom_css .='margin-top:10px;';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_header_cart = get_theme_mod( 'vw_kids_my_account_hide_show',true);
    if($vw_kids_header_cart == true){	
		$vw_kids_custom_css .='.cart-value{';
			$vw_kids_custom_css .='right: 28px;';
		$vw_kids_custom_css .='}';
	}else if($vw_kids_header_cart == false){
		$vw_kids_custom_css .='.cart-value{';
			$vw_kids_custom_css .='left: 50px;';
		$vw_kids_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_kids_resp_topbar = get_theme_mod( 'vw_kids_resp_topbar_hide_show',false);
    if($vw_kids_resp_topbar == true){
    	$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='#topbar{';
			$vw_kids_custom_css .='display:block;';
		$vw_kids_custom_css .='} }';
	}else if($vw_kids_resp_topbar == false){
		$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='#topbar{';
			$vw_kids_custom_css .='display:none;';
		$vw_kids_custom_css .='} }';
	}

	$vw_kids_resp_stickyheader = get_theme_mod( 'vw_kids_stickyheader_hide_show',false);
    if($vw_kids_resp_stickyheader == true){
    	$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='.header-fixed{';
			$vw_kids_custom_css .='display:block;';
		$vw_kids_custom_css .='} }';
	}else if($vw_kids_resp_stickyheader == false){
		$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='.header-fixed{';
			$vw_kids_custom_css .='display:none;';
		$vw_kids_custom_css .='} }';
	}

	$vw_kids_resp_slider = get_theme_mod( 'vw_kids_resp_slider_hide_show',false);
    if($vw_kids_resp_slider == true){
    	$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='#slider{';
			$vw_kids_custom_css .='display:block;';
		$vw_kids_custom_css .='} }';
	}else if($vw_kids_resp_slider == false){
		$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='#slider{';
			$vw_kids_custom_css .='display:none;';
		$vw_kids_custom_css .='} }';
	}

	$vw_kids_metabox = get_theme_mod( 'vw_kids_metabox_hide_show',true);
    if($vw_kids_metabox == true){
    	$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='.post-info{';
			$vw_kids_custom_css .='display:block;';
		$vw_kids_custom_css .='} }';
	}else if($vw_kids_metabox == false){
		$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='.post-info{';
			$vw_kids_custom_css .='display:none;';
		$vw_kids_custom_css .='} }';
	}

	$vw_kids_sidebar = get_theme_mod( 'vw_kids_sidebar_hide_show',true);
    if($vw_kids_sidebar == true){
    	$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='#sidebar{';
			$vw_kids_custom_css .='display:block;';
		$vw_kids_custom_css .='} }';
	}else if($vw_kids_sidebar == false){
		$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='#sidebar{';
			$vw_kids_custom_css .='display:none;';
		$vw_kids_custom_css .='} }';
	}

	$vw_kids_resp_scroll_top = get_theme_mod( 'vw_kids_resp_scroll_top_hide_show',true);
    if($vw_kids_resp_scroll_top == true){
    	$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='display:block;';
		$vw_kids_custom_css .='} }';
	}else if($vw_kids_resp_scroll_top == false){
		$vw_kids_custom_css .='@media screen and (max-width:575px) {';
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='display:none !important;';
		$vw_kids_custom_css .='} }';
	}

	/*------------- Top Bar Settings ------------------*/

	$vw_kids_topbar_padding_top_bottom = get_theme_mod('vw_kids_topbar_padding_top_bottom');
	if($vw_kids_topbar_padding_top_bottom != false){
		$vw_kids_custom_css .='#topbar{';
			$vw_kids_custom_css .='padding-top: '.esc_html($vw_kids_topbar_padding_top_bottom).'; padding-bottom: '.esc_html($vw_kids_topbar_padding_top_bottom).';';
		$vw_kids_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_kids_button_padding_top_bottom = get_theme_mod('vw_kids_button_padding_top_bottom');
	$vw_kids_button_padding_left_right = get_theme_mod('vw_kids_button_padding_left_right');
	if($vw_kids_button_padding_top_bottom != false || $vw_kids_button_padding_left_right != false){
		$vw_kids_custom_css .='.post-main-box .view-more{';
			$vw_kids_custom_css .='padding-top: '.esc_html($vw_kids_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_kids_button_padding_top_bottom).';padding-left: '.esc_html($vw_kids_button_padding_left_right).';padding-right: '.esc_html($vw_kids_button_padding_left_right).';';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_button_border_radius = get_theme_mod('vw_kids_button_border_radius');
	if($vw_kids_button_border_radius != false){
		$vw_kids_custom_css .='.post-main-box .view-more{';
			$vw_kids_custom_css .='border-radius: '.esc_html($vw_kids_button_border_radius).'px;';
		$vw_kids_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_kids_copyright_alingment = get_theme_mod('vw_kids_copyright_alingment');
	if($vw_kids_copyright_alingment != false){
		$vw_kids_custom_css .='.copyright p{';
			$vw_kids_custom_css .='text-align: '.esc_html($vw_kids_copyright_alingment).';';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_copyright_padding_top_bottom = get_theme_mod('vw_kids_copyright_padding_top_bottom');
	if($vw_kids_copyright_padding_top_bottom != false){
		$vw_kids_custom_css .='#footer-2{';
			$vw_kids_custom_css .='padding-top: '.esc_html($vw_kids_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_kids_copyright_padding_top_bottom).';';
		$vw_kids_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_kids_scroll_to_top_font_size = get_theme_mod('vw_kids_scroll_to_top_font_size');
	if($vw_kids_scroll_to_top_font_size != false){
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='font-size: '.esc_html($vw_kids_scroll_to_top_font_size).';';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_scroll_to_top_padding = get_theme_mod('vw_kids_scroll_to_top_padding');
	$vw_kids_scroll_to_top_padding = get_theme_mod('vw_kids_scroll_to_top_padding');
	if($vw_kids_scroll_to_top_padding != false){
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='padding-top: '.esc_html($vw_kids_scroll_to_top_padding).';padding-bottom: '.esc_html($vw_kids_scroll_to_top_padding).';';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_scroll_to_top_width = get_theme_mod('vw_kids_scroll_to_top_width');
	if($vw_kids_scroll_to_top_width != false){
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='width: '.esc_html($vw_kids_scroll_to_top_width).';';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_scroll_to_top_height = get_theme_mod('vw_kids_scroll_to_top_height');
	if($vw_kids_scroll_to_top_height != false){
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='height: '.esc_html($vw_kids_scroll_to_top_height).';';
		$vw_kids_custom_css .='}';
	}

	$vw_kids_scroll_to_top_border_radius = get_theme_mod('vw_kids_scroll_to_top_border_radius');
	if($vw_kids_scroll_to_top_border_radius != false){
		$vw_kids_custom_css .='.scrollup i{';
			$vw_kids_custom_css .='border-radius: '.esc_html($vw_kids_scroll_to_top_border_radius).'px;';
		$vw_kids_custom_css .='}';
	}