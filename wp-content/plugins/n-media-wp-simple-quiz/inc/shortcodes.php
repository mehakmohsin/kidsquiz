<?php 
/*
*** Here is all shortcodes callbacks
*/

    // not run if accessed directly
    if( ! defined('ABSPATH' ) ){
        die("Not Allowed");
    }

function wqt_shortcodes_render_frontend($attr){

    $wqt_sc_params = shortcode_atts(
    array(
        'id' => null,        
    ), $attr );

    $form_id = $wqt_sc_params['id'];
    if( $form_id == null ) die( __("No form id found","wq-test") );

    /* ===== get visibility role and check curent role to visible quiz ==== */


    $curent_user_role   = restrictly_show_quiz_assign_role($form_id);
    
    
    if ($curent_user_role == true) {


        $quizz_setting          = new WQT_Questions($form_id);
        $allow_time             = $quizz_setting->get_option('wqt_allow_time');
        $time_limit             = $quizz_setting->get_option('wqt_time_limit') != '' ? 
                                   $quizz_setting->get_option('wqt_time_limit') : 60;

        $ans_check2             = $quizz_setting->get_option('wqt_question_check_ans_0');
        
        // css file load
        wp_enqueue_style('wqt-bootstrap', WQT_URL."/css/bootstrap.min.css");
        wp_enqueue_style('wqt-style', WQT_URL."/css/wqt-frontend.css");
        wp_enqueue_style('wqt-font', WQT_URL."/css/font-awesome/css/font-awesome.css");
        wp_enqueue_style('wqt-sweetalert-style', WQT_URL."/css/sweetalert.css");
            
        // js files load
        wp_enqueue_script('wqt-sweetalert-js', WQT_URL."/js/sweetalert.js", array('jquery'), '1.0', true);
        wp_enqueue_script('wqt-script', WQT_URL."/js/wqt-frontend.js", array('jquery'), '1.0', true);

            
        if (isset( $allow_time ) && $allow_time == 'yes') { 
            wp_enqueue_script('wqt-stopwatch-script', WQT_URL."/js/stopwatch.js", array('jquery'), '1.0', true); 
        }

        // ajax load
        wp_localize_script( 'wqt-script', 'wqt_vars', array(
          'ajax_url' => admin_url( 'admin-ajax.php') ,
          'show_timer'  => $allow_time,
          'time_limit'  => $time_limit,
          'multiple_answers'  => $ans_check2,
          'onclose_msg'  => __('New information not saved. Do you wish to leave the page?','wqt'),
        ));

        // ajax load
        wp_localize_script( 'wqt-stopwatch-script', 'wqt_var', array(
          
          'time_limit'  => $time_limit,
        ));

        $form_id = array( "quiz_id" => $form_id );
    	wqt_load_templates("shortcodes/quiz-rander.php", $form_id);
    }
}