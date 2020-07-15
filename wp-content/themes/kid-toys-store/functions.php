<?php
/**
 * Kid Toys Store functions and definitions
 *
 * @package Kid Toys Store
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'kid_toys_store_setup' ) ) :

/* Theme Setup */
function kid_toys_store_setup() {

	$GLOBALS['content_width'] = apply_filters( 'kid_toys_store_content_width', 640 );

	load_theme_textdomain( 'kid-toys-store', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
	) );
	add_image_size('kid-toys-store-homepage-thumb',240,145,true);
	
       register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kid-toys-store' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
		)	
	);

	/* Selective refresh for widgets */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			'sidebar-2' => array(
				'text_business_info',
			),
			'sidebar-3' => array(
				'text_about',
				'search',
			),
			'footer-1' => array(
				'text_about',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'text_business_info',
			),
			'footer-4' => array(
				'search',
			),
		),

		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
		),

		'theme_mods' => array(
			'kid_toys_store_mail' => __('example@gmail.com', 'kid-toys-store' ),
			'kid_toys_store_call' => __('987456311', 'kid-toys-store' ),
			'kid_toys_store_facebook_url' => 'www.facebook.com',
			'kid_toys_store_twitter_url' => 'www.twitter.com',
			'kid_toys_store_rss_url' => 'www.rss.com',
			'kid_toys_store_youtube_url' => 'www.youtube.com',
			'kid_toys_store_footer_copy' => __('By Luzuk', 'kid-toys-store' )
		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'kid-toys-store' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
    ));

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', kid_toys_store_font_url() ) );

	// Dashboard Theme Notification
	global $pagenow;
	
	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'kid_toys_store_activation_notice' );
	}	
}
endif;
add_action( 'after_setup_theme', 'kid_toys_store_setup' );

// Dashboard Theme Notification
function kid_toys_store_activation_notice() {
	echo '<div class="welcome-notice notice notice-success is-dimdissible">';
		echo '<h2>'. esc_html__( 'Thank You!!!!!', 'kid-toys-store' ) .'</h2>';
		echo '<p>'. esc_html__( 'Much grateful to you for choosing our Kids Toys Store theme from themescaliber. we praise you for opting our services over others. we are obliged to invite you on our welcome page to render you with our outstanding services.', 'kid-toys-store' ) .'</p>';
		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=kid_toys_store_guide' ) ) .'" class="button button-primary">'. esc_html__( 'Click Here...', 'kid-toys-store' ) .'</a></p>';
	echo '</div>';
}

/* Theme Widgets Setup */
function kid_toys_store_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'kid-toys-store' ),
		'description'   => __( 'Appears on blog page sidebar', 'kid-toys-store' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'kid-toys-store' ),
		'description'   => __( 'Appears on page sidebar', 'kid-toys-store' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Thid Column Sidebar', 'kid-toys-store' ),
		'description'   => __( 'Appears on page sidebar', 'kid-toys-store' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$kid_toys_store_widget_areas = get_theme_mod('kid_toys_store_footer_widget_layout', '4');
	for ($i=1; $i<=$kid_toys_store_widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Nav ', 'kid-toys-store' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'kid_toys_store_widgets_init' );

/* Theme Font URL */
function kid_toys_store_font_url() {
	$font_url = '';
	$font_family = array();
	$font_family[] = 'PT Sans:300,400,600,700,800,900';
	$font_family[] = 'Roboto:400,700';
	$font_family[] = 'Roboto Condensed:400,700';
	$font_family[] = 'Open Sans';
	$font_family[] = 'Overpass';
	$font_family[] = 'Montserrat:300,400,600,700,800,900';
	$font_family[] = 'Playball:300,400,600,700,800,900';
	$font_family[] = 'Alegreya:300,400,600,700,800,900';
	$font_family[] = 'Julius Sans One';
	$font_family[] = 'Arsenal';
	$font_family[] = 'Slabo';
	$font_family[] = 'Lato';
	$font_family[] = 'Overpass Mono';
	$font_family[] = 'Source Sans Pro';
	$font_family[] = 'Raleway';
	$font_family[] = 'Merriweather';
	$font_family[] = 'Droid Sans';
	$font_family[] = 'Rubik';
	$font_family[] = 'Lora';
	$font_family[] = 'Ubuntu';
	$font_family[] = 'Cabin';
	$font_family[] = 'Arimo';
	$font_family[] = 'Playfair Display';
	$font_family[] = 'Quicksand';
	$font_family[] = 'Padauk';
	$font_family[] = 'Muli';
	$font_family[] = 'Inconsolata';
	$font_family[] = 'Bitter';
	$font_family[] = 'Pacifico';
	$font_family[] = 'Indie Flower';
	$font_family[] = 'VT323';
	$font_family[] = 'Dosis';
	$font_family[] = 'Frank Ruhl Libre';
	$font_family[] = 'Fjalla One';
	$font_family[] = 'Oxygen';
	$font_family[] = 'Arvo';
	$font_family[] = 'Noto Serif';
	$font_family[] = 'Lobster';
	$font_family[] = 'Crimson Text';
	$font_family[] = 'Yanone Kaffeesatz';
	$font_family[] = 'Anton';
	$font_family[] = 'Libre Baskerville';
	$font_family[] = 'Bree Serif';
	$font_family[] = 'Gloria Hallelujah';
	$font_family[] = 'Josefin Sans';
	$font_family[] = 'Abril Fatface';
	$font_family[] = 'Varela Round';
	$font_family[] = 'Vampiro One';
	$font_family[] = 'Shadows Into Light';
	$font_family[] = 'Cuprum';
	$font_family[] = 'Rokkitt';
	$font_family[] = 'Vollkorn';
	$font_family[] = 'Francois One';
	$font_family[] = 'Orbitron';
	$font_family[] = 'Patua One';
	$font_family[] = 'Acme';
	$font_family[] = 'Satisfy';
	$font_family[] = 'Josefin Slab';
	$font_family[] = 'Quattrocento Sans';
	$font_family[] = 'Architects Daughter';
	$font_family[] = 'Russo One';
	$font_family[] = 'Monda';
	$font_family[] = 'Righteous';
	$font_family[] = 'Lobster Two';
	$font_family[] = 'Hammermdith One';
	$font_family[] = 'Courgette';
	$font_family[] = 'Permanent Marker';
	$font_family[] = 'Cherry Swash';
	$font_family[] = 'Cormorant Garamond';
	$font_family[] = 'Poiret One';
	$font_family[] = 'BenchNine';
	$font_family[] = 'Economica';
	$font_family[] = 'Handlee';
	$font_family[] = 'Cardo';
	$font_family[] = 'Alfa Slab One';
	$font_family[] = 'Averia Serif Libre';
	$font_family[] = 'Cookie';
	$font_family[] = 'Chewy';
	$font_family[] = 'Great Vibes';
	$font_family[] = 'Coming Soon';
	$font_family[] = 'Philosopher';
	$font_family[] = 'Days One';
	$font_family[] = 'Kanit';
	$font_family[] = 'Shrikhand';
	$font_family[] = 'Tangerine';
	$font_family[] = 'IM Fell English SC';
	$font_family[] = 'Boogaloo';
	$font_family[] = 'Bangers';
	$font_family[] = 'Fredoka One';
	$font_family[] = 'Bad Script';
	$font_family[] = 'Volkhov';
	$font_family[] = 'Shadows Into Light Two';
	$font_family[] = 'Marck Script';
	$font_family[] = 'Sacramento';
	$font_family[] = 'Unica One';
	$font_family[] = 'Kavoon';
	$font_family[] = 'Poppins';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}
/* Theme enqueue scripts */
function kid_toys_store_scripts() {
	wp_enqueue_style( 'kid-toys-store-font', kid_toys_store_font_url(), array() );	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );	
	wp_style_add_data( 'kid-toys-store-style', 'rtl', 'replace' );
	wp_enqueue_style( 'kid-toys-store-effect', get_template_directory_uri().'/css/effect.css' );
	wp_enqueue_style( 'kid-toys-store-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/fontawesome-all.css' );

	// Paragraph
    $kid_toys_store_paragraph_color = get_theme_mod('kid_toys_store_paragraph_color', '');
    $kid_toys_store_paragraph_font_family = get_theme_mod('kid_toys_store_paragraph_font_family', '');
    $kid_toys_store_paragraph_font_size = get_theme_mod('kid_toys_store_paragraph_font_size', '');
	// "a" tag
	$kid_toys_store_atag_color = get_theme_mod('kid_toys_store_atag_color', '');
    $kid_toys_store_atag_font_family = get_theme_mod('kid_toys_store_atag_font_family', '');
	// "li" tag
	$kid_toys_store_li_color = get_theme_mod('kid_toys_store_li_color', '');
    $kid_toys_store_li_font_family = get_theme_mod('kid_toys_store_li_font_family', '');
	// H1
	$kid_toys_store_h1_color = get_theme_mod('kid_toys_store_h1_color', '');
    $kid_toys_store_h1_font_family = get_theme_mod('kid_toys_store_h1_font_family', '');
    $kid_toys_store_h1_font_size = get_theme_mod('kid_toys_store_h1_font_size', '');
	// H2
	$kid_toys_store_h2_color = get_theme_mod('kid_toys_store_h2_color', '');
    $kid_toys_store_h2_font_family = get_theme_mod('kid_toys_store_h2_font_family', '');
    $kid_toys_store_h2_font_size = get_theme_mod('kid_toys_store_h2_font_size', '');
	// H3
	$kid_toys_store_h3_color = get_theme_mod('kid_toys_store_h3_color', '');
    $kid_toys_store_h3_font_family = get_theme_mod('kid_toys_store_h3_font_family', '');
    $kid_toys_store_h3_font_size = get_theme_mod('kid_toys_store_h3_font_size', '');
	// H4
	$kid_toys_store_h4_color = get_theme_mod('kid_toys_store_h4_color', '');
    $kid_toys_store_h4_font_family = get_theme_mod('kid_toys_store_h4_font_family', '');
    $kid_toys_store_h4_font_size = get_theme_mod('kid_toys_store_h4_font_size', '');
	// H5
	$kid_toys_store_h5_color = get_theme_mod('kid_toys_store_h5_color', '');
    $kid_toys_store_h5_font_family = get_theme_mod('kid_toys_store_h5_font_family', '');
    $kid_toys_store_h5_font_size = get_theme_mod('kid_toys_store_h5_font_size', '');
	// H6
	$kid_toys_store_h6_color = get_theme_mod('kid_toys_store_h6_color', '');
    $kid_toys_store_h6_font_family = get_theme_mod('kid_toys_store_h6_font_family', '');
    $kid_toys_store_h6_font_size = get_theme_mod('kid_toys_store_h6_font_size', '');
    $kid_toys_store_theme_color_first = get_theme_mod('kid_toys_store_theme_color_first', '');
    $kid_toys_store_theme_color_second = get_theme_mod('kid_toys_store_theme_color_second', '');
    $kid_toys_store_theme_color_third = get_theme_mod('kid_toys_store_theme_color_third', '');


	$kid_toys_store_custom_css ='
		p,span{
		    color:'.esc_html($kid_toys_store_paragraph_color).'!important;
		    font-family: '.esc_html($kid_toys_store_paragraph_font_family).';
		    font-size: '.esc_html($kid_toys_store_paragraph_font_size).';
		}
		a{
		    color:'.esc_html($kid_toys_store_atag_color).'!important;
		    font-family: '.esc_html($kid_toys_store_atag_font_family).';
		}
		li{
		    color:'.esc_html($kid_toys_store_li_color).'!important;
		    font-family: '.esc_html($kid_toys_store_li_font_family).';
		}
		h1{
		    color:'.esc_html($kid_toys_store_h1_color).'!important;
		    font-family: '.esc_html($kid_toys_store_h1_font_family).'!important;
		    font-size: '.esc_html($kid_toys_store_h1_font_size).'!important;
		}
		h2{
		    color:'.esc_html($kid_toys_store_h2_color).'!important;
		    font-family: '.esc_html($kid_toys_store_h2_font_family).'!important;
		    font-size: '.esc_html($kid_toys_store_h2_font_size).'!important;
		}
		h3{
		    color:'.esc_html($kid_toys_store_h3_color).'!important;
		    font-family: '.esc_html($kid_toys_store_h3_font_family).'!important;
		    font-size: '.esc_html($kid_toys_store_h3_font_size).'!important;
		}
		h4{
		    color:'.esc_html($kid_toys_store_h4_color).'!important;
		    font-family: '.esc_html($kid_toys_store_h4_font_family).'!important;
		    font-size: '.esc_html($kid_toys_store_h4_font_size).'!important;
		}
		h5{
		    color:'.esc_html($kid_toys_store_h5_color).'!important;
		    font-family: '.esc_html($kid_toys_store_h5_font_family).'!important;
		    font-size: '.esc_html($kid_toys_store_h5_font_size).'!important;
		}
		h6{
		    color:'.esc_html($kid_toys_store_h6_color).'!important;
		    font-family: '.esc_html($kid_toys_store_h6_font_family).'!important;
		    font-size: '.esc_html($kid_toys_store_h6_font_size).'!important;
		}

		input[type="submit"],.metabox,.primary-navigation ul ul a,.cart_icon i, span.cart-value, .woocommerce span.onsale, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, #comments input[type="submit"].submit, .pagination a:hover,.page-links a:hover, .pagination .current,.page-links .current, #header .nav ul li:hover > ul, #slider a.read-more:hover, .toggle-menu i{
		    background-color:'.esc_html($kid_toys_store_theme_color_first).';
		}
		#comments a.comment-reply-link:hover{
		background-color:'.esc_html($kid_toys_store_theme_color_first).'!important;
		}
		.middle-align h1,a,.entry-content a,.primary-navigation ul li a, span.post-title, .hvr-sweep-to-right:hover,.logo p a,.hvr-sweep-to-right:focus, .hvr-sweep-to-right:active,#our-products strong, span.woocommerce-Price-amount.amount, .woocommerce .woocommerce-ordering select, .postbox h2, #sidebar td#prev a, #sidebar caption, #sidebar h3, #header .logo h1 a, .woocommerce a,h3.widget-title a, .logo p, .entry-content a, .textwidget a, .middle-align p a, .scrollup{
		    color:'.esc_html($kid_toys_store_theme_color_first).';
		}
		.primary-navigation ul ul a:hover{
		    color:'.esc_html($kid_toys_store_theme_color_first).'!important;
		}
		hr.titlehr{
		    border-top-color:'.esc_html($kid_toys_store_theme_color_first).';
		}
		.serach_inner form.search-form, input[type="submit"],input.search-field, .primary-navigation ul ul{
		    border-color:'.esc_html($kid_toys_store_theme_color_first).';
		}
		@media screen and (max-width: 1000px){
			.toggle-menu, .sidebar{
			    background-color:'.esc_html($kid_toys_store_theme_color_first).';
			}
			.primary-navigation li a:hover, .primary-navigation .current_page_item > a, .primary-navigation .current-menu-item > a, .primary-navigation .current_page_ancestor > a{
			    color:'.esc_html($kid_toys_store_theme_color_first).'!important;
			}
		}
		@media screen and (max-width: 720px){
			.topbar{
			    background-color:'.esc_html($kid_toys_store_theme_color_first).';
			}
		}
		.footertown input[type="submit"],#comments a.comment-reply-link, #header .nav ul li:hover > ul li:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, #sidebar .tagcloud a, #sidebar .tagcloud a, .pagination span,.pagination a, #sidebar input[type="submit"], .footertown .tagcloud a:hover, .tags a:hover, .woocommerce-product-search button[type="submit"], .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
		    background-color:'.esc_html($kid_toys_store_theme_color_second).'!important;
		}
		.products h2.woocommerce-loop-product__title,.tags a,.woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .product_title,#tab-description h2,.woocommerce #reviews #comments h2, .woocommerce div.product .woocommerce-tabs ul.tabs li, .footertown .widget h3 a.rsswidget, .footertown .widget h3, #sidebar td, #sidebar th, #sidebar ul li a,.blogbutton-mdall, nav.woocommerce-MyAccount-navigation ul li a:hover,  .footertown .widget p a{
		    color:'.esc_html($kid_toys_store_theme_color_second).';
		}
		#header,.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .products h2.woocommerce-loop-product__title{
		    border-bottom-color:'.esc_html($kid_toys_store_theme_color_second).';
		}
		.postbox, #sidebar .widget, .blogbutton-mdall, .woocommerce .quantity .qty,.woocommerce .woocommerce-ordering select, .woocommerce div.product .woocommerce-tabs ul.tabs li, .tags a:hover{
		    border-color:'.esc_html($kid_toys_store_theme_color_second).';
		}

		.hvr-sweep-to-right:before,.woocommerce span.onsale:hover, #footer, #slider a.read-more{
		    background-color:'.esc_html($kid_toys_store_theme_color_third).';
		}
		#our-products strong, #sidebar h3{
		    border-bottom-color:'.esc_html($kid_toys_store_theme_color_third).';
		}
	';
			
	wp_add_inline_style( 'kid-toys-store-basic-style',$kid_toys_store_custom_css );
	
	require get_parent_theme_file_path( '/tc-style.php' );
	wp_add_inline_style( 'kid-toys-store-basic-style',$kid_toys_store_custom_css );
	wp_enqueue_script( 'kid-toys-store-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery') ,'',true);
	wp_enqueue_script( 'jquery.min', get_template_directory_uri() . '/js/jquery.min.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kid_toys_store_scripts' );

function kid_toys_store_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'kid_toys_store_loop_columns');
if (!function_exists('kid_toys_store_loop_columns')) {
	function kid_toys_store_loop_columns() {
		$columns = get_theme_mod( 'kid_toys_store_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'kid_toys_store_shop_per_page', 9 );
function kid_toys_store_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'kid_toys_store_product_per_page', 9 );
	return $cols;
}

/* Excerpt Limit Begin */
function kid_toys_store_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/*radio button sanitization*/
 function kid_toys_store_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// URL DEFINES
define('KID_TOYS_STORE_FREE_THEME_DOC',__('https://themescaliber.com/demo/doc/free-kid-toys-store/','kid-toys-store'));
define('KID_TOYS_STORE_SUPPORT',__('https://wordpress.org/support/theme/kid-toys-store','kid-toys-store'));
define('KID_TOYS_STORE_REVIEW',__('https://wordpress.org/support/theme/kid-toys-store/reviews/','kid-toys-store'));
define('KID_TOYS_STORE_BUY_NOW',__('https://www.themescaliber.com/themes/premium-kids-wordpress-theme','kid-toys-store'));
define('KID_TOYS_STORE_LIVE_DEMO',__('https://www.themescaliber.com/kid-toys-store-pro','kid-toys-store'));
define('KID_TOYS_STORE_PRO_DOC',__('https://themescaliber.com/demo/doc/kid-toys-store-pro/','kid-toys-store'));
define('KID_TOYS_STORE_CHILD_THEME',__('https://developer.wordpress.org/themes/advanced-topics/child-themes/','kid-toys-store'));
define('KID_TOYS_STORE_SITE_URL',__('https://www.themescaliber.com/themes/free-kids-wordpress-theme/','kid-toys-store'));

function kid_toys_store_credit_link() {
    echo "<a href=".esc_url(KID_TOYS_STORE_SITE_URL)." target='_blank'>".esc_html('Toys Store WordPress Theme','kid-toys-store')."</a>";
}

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Implement the get started page */
require get_template_directory() . '/inc/dashboard/getstart.php';