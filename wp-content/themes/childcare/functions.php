<?php
/*
	*Theme Name	: childcare
*/

	define('CHILDCARE_TEMPLATE_DIR_URI',esc_url(get_template_directory_uri()));
	define('CHILDCARE_TEMPLATE_DIR',get_template_directory());
	define('CHILDCARE_THEME_FUNCTIONS_PATH',CHILDCARE_TEMPLATE_DIR.'/core-functions');
	require( CHILDCARE_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php' );
	require( CHILDCARE_THEME_FUNCTIONS_PATH . '/menu/childcare_nav_walker.php' );	
	require( CHILDCARE_THEME_FUNCTIONS_PATH . '/comment-section/comment-function.php' );
	require( CHILDCARE_THEME_FUNCTIONS_PATH . '/widgets/register-sidebar.php' );
	require( CHILDCARE_THEME_FUNCTIONS_PATH . '/customizer/customizer-header.php');

	require( CHILDCARE_THEME_FUNCTIONS_PATH . '/metabox/metabox-page-post-sidebar.php'); // For New Feature
	require(get_template_directory().'/childcare_breadcrumbs.php');

	add_action( 'after_setup_theme', 'childcare_setup' ); 	
	function childcare_setup()
		{	
			load_theme_textdomain( 'childcare', CHILDCARE_THEME_FUNCTIONS_PATH . '/lang' );
			add_theme_support( 'custom-background');
	  		add_theme_support( 'woocommerce');
			add_theme_support( 'title-tag' );
			add_theme_support('post-thumbnails');
			register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'childcare' ) );
			add_theme_support( 'automatic-feed-links');
			if ( ! isset( $content_width ) ) $content_width = 900;
			add_theme_support( 'custom-header', apply_filters( 'childcare_custom_header_args', array(
				'width'                  => 1200,
				'height'                 => 280,
				'flex-height'            => true,
				'wp-head-callback'       => 'childcare_header_style',
			) ) );

			add_theme_support( 'custom-logo', array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			) );
		}

	if ( ! function_exists( 'childcare_header_style' ) ) :

	function childcare_header_style() {
		if ( display_header_text() ) {
			return;
		} ?>

		<style type="text/css" id="childcare-header-css">
			.site-branding {
				margin: 0 auto 0 0;
			}

			.site-branding .site-title,
			.site-description {
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
				margin:0 10px 0;
			}
		</style>
	<?php } endif;			

	function childcare_custom_excerpt_length( $length ) {
		return 40;
		}
	add_filter( 'excerpt_length', 'childcare_custom_excerpt_length', 999 );

		require(get_template_directory().'/template-tags.php');
		require(get_template_directory().'/theme_default_data.php');

	function childcare_scripts()
	{	
		wp_enqueue_style('childcare-style', get_stylesheet_uri());
		wp_enqueue_style('bootstrap', CHILDCARE_TEMPLATE_DIR_URI .'/css/bootstrap.css', array(), 'v3.3.5');
		wp_enqueue_style('childcare-default', CHILDCARE_TEMPLATE_DIR_URI .'/css/default.css', array(), null);
		wp_enqueue_style('childcare-media-responsive', CHILDCARE_TEMPLATE_DIR_URI .'/css/media-responsive.css', array(), null);
		wp_enqueue_style('animate', CHILDCARE_TEMPLATE_DIR_URI .'/css/animate.css', array(), '3.5.1');
		wp_enqueue_style('animations', CHILDCARE_TEMPLATE_DIR_URI .'/css/animations.css', array(), 'v1.0');
		wp_enqueue_style('childcare-font', CHILDCARE_TEMPLATE_DIR_URI .'/css/fonts/font.css', array(), null);
		wp_enqueue_style('childcare-ms-staff-style', CHILDCARE_TEMPLATE_DIR_URI .'/css/ms-staff-style.css', array(), null);
		wp_enqueue_style('font-awesome', CHILDCARE_TEMPLATE_DIR_URI .'/css/font-awesome-4.4.0/css/font-awesome.css', array(), '4.4.0');	
		wp_enqueue_style('childcare-google-fonts-style', '//fonts.googleapis.com/css?family=PathwayGothicOne:400,700|Oswald:300,400,700|Fira Sans:300,400,500,700,300Italic|Lobster:400|PT Sans Caption:400,700|Roboto:100,300,400|Arbutus Slab:400');
		wp_enqueue_script('bootstrap', CHILDCARE_TEMPLATE_DIR_URI .'/js/bootstrap.js', array(), 'v3.3.5', true);
		wp_enqueue_script('childcare-custom', CHILDCARE_TEMPLATE_DIR_URI .'/js/custom.js', array('jquery'), null, true);
		wp_enqueue_script('animations', CHILDCARE_TEMPLATE_DIR_URI .'/js/animations.js', array(), 'v1.0', true);
		wp_enqueue_script('childcare-page-scroll', CHILDCARE_TEMPLATE_DIR_URI .'/js/page-scroll.js', array(), null, true);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	    wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action('wp_enqueue_scripts', 'childcare_scripts');

	if (!function_exists('childcare_admin_css_enqueue_new_post')) :
	function childcare_admin_css_enqueue_new_post($hook)
	{
		if ('post-new.php' != $hook) {
			return;
		}
		wp_enqueue_style('childcare-admin', esc_url(get_template_directory_uri()) . '/css/admin.css', array(), '2.0.0');
	}
	add_action('admin_enqueue_scripts', 'childcare_admin_css_enqueue_new_post');
endif;



if (!function_exists('childcare_admin_css_enqueue')) :
	function childcare_admin_css_enqueue($hook)
	{
		if ('post.php' != $hook) {
			return;
		}
		wp_enqueue_style('childcare-admin', esc_url(get_template_directory_uri()) . '/css/admin.css', array(), '2.0.0');

	}
	add_action('admin_enqueue_scripts', 'childcare_admin_css_enqueue');
endif;


/*for sidebar options**/

function childcare_names( $classes ) {
	// add 'class-name' to the $classes array
	$sidebardesignlayout = esc_html( get_post_meta(get_the_ID(), 'childcare_sidebar_layout', true) );
	if (is_singular() && $sidebardesignlayout != "default-sidebar")
	{
		$sidebardesignlayout = esc_html( get_post_meta(get_the_ID(), 'childcare_sidebar_layout', true) );

	} else
	{
		$childcare_options=childcare_theme_default_data(); 
		$layout_setting = wp_parse_args(  get_option( 'childcare_option', array() ), $childcare_options );
		$sidebardesignlayout = esc_attr($layout_setting['childcare_sidebar_layout_option'] );
	}

	$classes[] = $sidebardesignlayout;
	return $classes;

}
add_filter( 'body_class', 'childcare_names' );
?>