<?php
/*
Plugin Name: N-Media WP Simple Quiz
Plugin URI: http://najeebmedia.com/
Description: Simple Wordpress Plugin to create Multiple Choice Questions.
Version: 1.5
Author: Najeeb Ahmad
Text Domain: wqt
Author URI: http://www.najeebmedia.com/
*/

    
/* ====== Exit if accessed directly ===== */
    if( ! defined('ABSPATH' ) ){  exit; }


/* ====== Create global variable ====== */
define( 'WQT_PATH', untrailingslashit(plugin_dir_path( __FILE__ )) );
define( 'WQT_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define( 'WQT_VERSION', 1.5 );

/* ======= Files includes ======== */
if( file_exists( dirname(__FILE__).'/inc/helpers.php' )) include_once dirname(__FILE__).'/inc/helpers.php';
if( file_exists( dirname(__FILE__).'/inc/cpt.php' )) include_once dirname(__FILE__).'/inc/cpt.php';
if( file_exists( dirname(__FILE__).'/inc/hooks.php' )) include_once dirname(__FILE__).'/inc/hooks.php';
if( file_exists( dirname(__FILE__).'/inc/admin.php' )) include_once dirname(__FILE__).'/inc/admin.php';
if( file_exists( dirname(__FILE__).'/inc/shortcodes.php' )) include_once dirname(__FILE__).'/inc/shortcodes.php';
if( file_exists( dirname(__FILE__).'/inc/classes/class.admin.php' )) include_once dirname(__FILE__).'/inc/classes/class.admin.php';
if( file_exists( dirname(__FILE__).'/inc/classes/class.question.php' )) include_once dirname(__FILE__).'/inc/classes/class.question.php';

/* ===== Main class ==== */
class NM_WQT {

    function __construct(){

        // actation run on plugin initialized
        /**
         * =====================================
         * Admin releated hooks and action 
         * =====================================
        **/

        add_action( 'init', 'wqt_cpt_register_post' );
        
        // Localize
        add_action( 'init', array($this, 'localize') );

        /* ==== Showing columns in wqt post type ====*/
        add_filter( 'manage_wqt_posts_columns', 'wqt_admin_add_columns' );
        add_action( 'manage_wqt_posts_custom_column' , 'wqt_admin_add_columns_data', 10, 2 );

        /* ==== Showing colums in wqt result cpt ==== */
        add_filter( 'manage_wqt_result_posts_columns', 'wqt_result_admin_add_columns' );
        add_action( 'manage_wqt_result_posts_custom_column' , 'wqt_result_admin_add_columns_data', 10,2);

        
        /* ==== Action add question meta fields saved ==== */
        add_action( 'save_post_wqt',  'wqt_admin_questions_fields_saved', 10, 3 );

        /* ==== All plugin menu add  ==== */
        add_action( 'admin_menu', 'wqt_add_admin_menu', 0 );
        
        /* ==== Frontend form submitted hook ==== */
        add_action( 'wp_ajax_wqt_submit_frontend', 'wqt_submit_frontend' );
        add_action( 'wp_ajax_nopriv_wqt_submit_frontend', 'wqt_submit_frontend' );
        
        /* ==== Frontend Form render ==== */
        add_shortcode( 'wqt-question', 'wqt_shortcodes_render_frontend' );

        /* ========= wqt change title ============*/
        add_filter( 'enter_title_here', 'wqt_cpt_title_change' );  

    }
    
    
    function localize() {
        
        // Language support
        $locale_dir = dirname( plugin_basename( dirname(__FILE__) ) ) . '/languages';
        load_plugin_textdomain('wqt', false, $locale_dir);
    }

}

/* ==== lets start plugin ==== */
add_action('plugins_loaded', 'wqt_start');
function wqt_start() {
    return new NM_WQT();
}