<?php
/**
 * Admin  class will handle quiz
 **/

 if( ! defined("ABSPATH" ) )
        die("Not Allewed");

class WQT_Admin {

	private static $ins = null;

	function __construct() {
 
        /* ========== cpt result and quiz metaboxes ========= */
        add_action( 'add_meta_boxes', array($this,  'wqt_admin_questions_metabox') );
        add_action( 'add_meta_boxes', array($this,  'wqt_question_shortcode_display_metabox') );
        add_action( 'add_meta_boxes', array($this,  'wqt_question_style_display_metabox') );
        add_action( 'add_meta_boxes', array($this,  'wqt_question_instruction_or_message') );
        add_action( 'add_meta_boxes', array($this,  'wqt_admin_quiz_result_metabox') );
        add_action( 'add_meta_boxes', array($this,  'wqt_admin_quiz_user_info') );

        add_action('admin_enqueue_scripts', array($this, 'wqt_add_scripts'));
         
	}

	public static function get_instance() {
	    // create a new object if it doesn't exist.
		is_null(self::$ins) && self::$ins = new self;
		return self::$ins;
	}


     /* ====== load css and js files ====== */
    function wqt_add_scripts($hook) {

       global $post;

       if (! isset($post->post_type)) { return ''; }
       if ( $post->post_type == 'wqt' ||  $post->post_type == 'wqt_result') {

           wp_enqueue_style('wqt-admin-style', WQT_URL."/css/wqt-admin.css");
           wp_enqueue_style('wqt-bootstrap', WQT_URL."/css/bootstrap.min.css");


           // ====== style file load =============
           // wp_enqueue_style('wqt-admin-style', WQT_URL."/css/wqt-admin.css");
           wp_enqueue_style('wqt-awsm-font', WQT_URL."/css/font-awesome/css/font-awesome.css");
           wp_enqueue_style('wqt-swlt', WQT_URL."/css/sweetalert.css");

           // ====== wordpress color picker ===========
           wp_enqueue_style('wp-color-picker');
           wp_enqueue_script('wp-color-picker');

            // ========= select2 ===========
           wp_enqueue_style('mqt-select2', WQT_URL."/css/select2.css");
           wp_enqueue_script('wqt-bootstrap-js', WQT_URL."/js/bootstrap.min.js", array('jquery'), WQT_VERSION, true);
           wp_enqueue_script('mqt-select2', WQT_URL."/js/select2.js", array('jquery'), WQT_VERSION, true);

           //=========== js file load ===========
           wp_enqueue_script('wqt-admin-js', WQT_URL."/js/wqt-admin.js", array('jquery'), '1.0', true);

           wp_enqueue_script('wqt-accordian', WQT_URL."/js/accordion.js", array('jquery'), WQT_VERSION, true);
           wp_enqueue_script('wqt-swlt', WQT_URL."/js/sweetalert.js", array('jquery'), WQT_VERSION, true);
        }
    }
    
    
    /* -------------------------------------------------------
     This metabox function send the result to user
     ---------------------------------------------------------*/
    function wqt_student_result_send(  ){
    
        add_meta_box( 
            'wqt_student_result_send',
            __( 'Result Send Via Email' , ' wqt'),
            array($this,'wqt_student_result'),
            'wqt',
            'normal',
            'default'
        );
    }
    
    
    function wqt_student_result(){
        // wp_enqueue_style('wqt-admin-styless', WQT_URL."/css/wqt-admin.css");
        wqt_load_templates("admin/student-result-send.php");
    }


    /* -----------------------------------------------
     This metabox function use to create new questions
     -----------------------------------------------*/
    function wqt_admin_questions_metabox(  ){
    
        add_meta_box( 
            'wqt_questions',
            __( 'Add Questions' , ' wqt'),
            array($this, 'wqt_admin_question_box_display'),
            'wqt',
            'normal',
            'default'
        );
    }

    function wqt_admin_question_box_display( ){
        // load admin templatse
        wqt_load_templates("admin/add-questions.php" );

    }

    /*
    *** 
    */

    /* ------------------------------------------------------
     This metabox function use to display questions shorcodes 
     --------------------------------------------------------*/
    function wqt_question_shortcode_display_metabox(  ){
    
        add_meta_box( 
            'wqt_shortcodes',
            __( 'Shortcode' , ' wqt'),
            array($this,'wqt_question_shortcodes_display'),
            'wqt',
            'side',
            'default'
        );
    }

    function wqt_question_shortcodes_display(){

        // load shortcode templatse
        wqt_load_templates("admin/quiz-form-id.php");
    }

    /*
    *** 
    */


    /* --------------------------------------------------------------------
     This metabox function use to display questions style settings shorcodes 
     ----------------------------------------------------------------------*/
    function wqt_question_style_display_metabox(  ){
    
        add_meta_box( 
            'wqt_questions_style',
            __( 'Quiz Style' , ' wqt'),
            array($this,'wqt_question_style_display'),
            'wqt',
            'side',
            'default'
        );
    }

    function wqt_question_style_display(){

        // load shortcode templatse
        wqt_load_templates("admin/quiz-form-style.php");
    }

    /*
    *** 
    */
    

    /* ----------------------------------------------------------------
     This metabox function use to display quizz instruction or messages
     ------------------------------------------------------------------*/
    function wqt_question_instruction_or_message(  ){
    
        add_meta_box( 
            'wqt_instruction_box',
            __( 'Quiz messages' , ' wqt'),
            array($this,'wqt_question_instruction_display'),
            'wqt',
            'normal',
            'default'
        );
    }

    function wqt_question_instruction_display(){
        // load shortcode templatse
        wqt_load_templates("admin/quiz-ins-settings.php");
    }


    /* -------------------------------------------------------
     This metabox function use to display submite member list
     ---------------------------------------------------------*/
    function wqt_submit_member_list_quiz(  ){
    
        add_meta_box( 
            'wqt_submit_box',
            __( 'Submit Members' , ' wqt'),
            array($this,'wqt_submit_member_list'),
            'wqt',
            'normal',
            'default'
        );
    }
    
    
    

    function wqt_submit_member_list(){
        // load shortcode templatse
        wqt_load_templates("admin/submit-member-list.php");
    }

    /* ------------------------------------------------------
     This metabox function use display the settings question
     --------------------------------------------------------*/
    function wqt_question_settings_display_metabox(  ){
    
        add_meta_box( 
            'wqt_add_question_settings',
            __( 'Quiz Settings' , ' wqt'),
            array($this, 'wqt_add_questions_settings'),
            'wqt',
            'side',
            'default'
        );
    }

    function wqt_add_questions_settings() {
    
        wqt_load_templates("admin/quiz-form-settings.php");

    }

    //============= Result cpt metaboxes ==============

    /* -----------------------------------------------
     This metabox function use to display quiz result
     -------------------------------------------------*/
    function wqt_admin_quiz_result_metabox(  ){
    
        add_meta_box( 
            'wqt_result',
            __( 'View Result' , ' wqt'),
            array($this, 'wqt_admin_result_display'),
            'wqt_result',
            'normal',
            'default'
        );
    }

    function wqt_admin_result_display(){

        // load admin templatse
        wqt_load_templates("admin/quiz-result.php" );
    }


    /*
    *** 
    */

    /* --------------------------------------------------------------
     This metabox function use to send result to email user or admin
     ----------------------------------------------------------------*/
    function wqt_admin_result_send_metabox(  ){
    
        add_meta_box( 
            'wqt_result_send',
            __( 'Send Result Via Email' , ' wqt'),
            array($this, 'wqt_admin_result_send_display'),
            'wqt_result',
            'normal',
            'default'
        );
    }

    function wqt_admin_result_send_display() {
    
        wqt_load_templates("admin/quiz-result-email.php");

    }

    /* -----------------------------------------------
     This metabox function use to display user info
     -------------------------------------------------*/
    function wqt_admin_quiz_user_info(  ){
    
        add_meta_box( 
            'wqt_user_data',
            __( 'User Info' , ' wqt'),
            array($this, 'wqt_user_info'),
            'wqt_result',
            'side',
            'default'
        );
    }

    function wqt_user_info(){

        // load admin templatse
        wqt_load_templates("admin/user-info.php");
    }

    /* ------------------------------------------------------------
     This metabox function use to display result stat and print pdf
     --------------------------------------------------------------*/
    function wqt_admin_result_print_pdf(  ){
    
        add_meta_box( 
            'wqt_print_pdf',
            __( 'Print Result' , ' wqt'),
            array($this, 'wqt_print_pdf'),
            'wqt_result',
            'normal',
            'default'
        );
    }

    function wqt_print_pdf(){

        // load admin templatse
        wqt_load_templates("admin/result-print-pdf.php");
    }
}

ADMIN();
function ADMIN() {
	return WQT_Admin::get_instance();
}