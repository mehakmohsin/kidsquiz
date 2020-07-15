<?php
/**
** all admin related settings
*/

/* ====== not run if accessed directly ===== */
if( ! defined('ABSPATH' ) ){
    die("Not Allowed");
}

/* ======== change the wqt cpt title  ======= */ 
function wqt_cpt_title_change($title){

    $screen = get_current_screen();

    if  ( 'wqt' == $screen->post_type ) {
        $title = __('Enter Quiz Name','wqt');
    }
        return $title;

}


/*========== Quiz admin menus =========== */
function wqt_add_admin_menu() {
    
    add_menu_page( __('Wordpress Simple Quiz','wqt'), __('WP Simple Quiz','wqt'), 'manage_options','edit.php?post_type=wqt', '',  WQT_URL.'/images/logo.png', 21);
    add_submenu_page('edit.php?post_type=wqt', __('Quiz Result','wqt'), __('Result','wqt'), 'manage_options', 'edit.php?post_type=wqt_result', '', '' );     
}


/* ==== columns show in quiz cpt ==== */
function wqt_admin_add_columns($columns) {

    unset($columns['date']);
    $columns['quiz_id']       = __( 'Shortcode', 'wqt' );
    $columns['quiz_question'] = __( 'Total Questions', 'wqt' );
    $columns['quiz_marks']    = __( 'Total Marks', 'wqt' );
    $columns['ans_select']    = __( 'Answer Selection', 'wqt' );
    $columns['enable_time']   = __( 'Enable Time', 'wqt' );
    $columns['show_result']   = __( 'Show Result', 'wqt' );
    $columns['date']          = __( 'Date', 'wqt' );

    return $columns;
}

/* ==== showing columns data wqt cpt ===== */
function wqt_admin_add_columns_data($column, $question_id) {
    
    $question_class = new WQT_Questions($question_id );
    $allow_time     = __( 'Pro Feature', 'wqt' ); 
    $allow_result   = __( 'Pro Feature', 'wqt' );
    $ans_selection  = __( 'Pro Feature', 'wqt' );

    if( class_exists('NM_MCQS_PRO') ) {
        $allow_time     = $question_class->get_option('wqt_allow_time') != ''?
                          $question_class->get_option('wqt_allow_time') : 'NO';
        
        $allow_result   = $question_class->get_option('wqt_allow_result') != ''?
                          $question_class->get_option('wqt_allow_result') : 'NO';
      
        $ans_selection  = $question_class->get_option('wqt_question_check_ans_0');
    }

    if ($ans_selection == 'single_ans') {  $ans_selection = __('Single Answers','wqt');  }

    if ($ans_selection == 'multiple_ans') { $ans_selection = __('Multiple Answers', 'wqt'); }

    $total_marks    = $question_class->wqt_cpt_total_marks_before_sumbit();
    $question_count = $question_class->wqt_total_question_of_quiz();


    switch ( $column ) {

        case 'quiz_id' :
              echo sprintf(__('[wqt-question id="%s"]',"wqt"),$question_id);
        break;

        case 'quiz_question':
              echo $question_count;
        break;
        case 'quiz_marks':
              echo $total_marks;
        break;
        case 'ans_select':
              echo strtoupper($ans_selection);
        break;
        case 'enable_time':
              echo strtoupper($allow_time);
        break;
        case 'show_result':
              echo strtoupper($allow_result);
        break;
    }
}

/* ==== Showing columns wqt_result post type ==== */
function wqt_result_admin_add_columns($columns) {
    
    unset($columns['date']);
    $columns['result_stat']   = __( 'Marks & Percentage', 'wqt' );
    $columns['correct_ques']  = __( 'Total Correct Question', 'wqt' );
    $columns['wqt_time']      = __( 'Time Elapsed', 'wqt' );
    $columns['user_info']     = __( 'User Info', 'wqt' );
    $columns['form_name']     = __( 'Form Name', 'wqt' );

    return $columns;
}

/* ==== Showing columns wqt_result post type data ==== */
function wqt_result_admin_add_columns_data($column, $question_id) {

    $question_class = new WQT_Questions ($question_id);
    $quiz_id        = get_post_meta($question_id,'wqt_current_id', true);
    $consume_time   = __( 'PRO VERSION', 'wqt' );
    $quiz_name      = get_the_title($quiz_id);

    $total_marks    =  $question_class->wqt_get_total_marks();
    $obtain_marks   =  $question_class->wqt_get_obtain_marks();
    $percenatge     =  $question_class->wqt_get_quiz_marks_percentage();

    
    if( class_exists('NM_MCQS_PRO') ) {
        $consume_time =  $question_class->wqt_get_overall_time();
    }

    switch ( $column ) {

        case 'result_stat':
            echo $obtain_marks.'/'.$total_marks.'  ('. $percenatge .')';
        break;
        case 'wqt_time':
              echo $consume_time;
        break;
        case 'correct_ques':
             echo $question_class->wqt_get_correct_question();
        break;
        case 'user_info':   
            echo get_user_info($question_id);
        break;
        case 'form_name':   
            echo quiz_form_link($quiz_id, $quiz_name);
        break;
    }

}


/* ===== cpt quiz all fields saved ===== */
function wqt_admin_questions_fields_saved($post_id, $update) {



    // If this is a revision, don't send the email.
    if ( wp_is_post_revision( $post_id ) )
        return;
        
    if ( isset($_POST['wqt']) || isset($_POST['wqt_assign_role']) ) {
        
        $wqt_posted_data = wqt_admin_sanitize_data( $_POST['wqt'] );
       
        $role = isset($_POST['wqt_assign_role']) ? $_POST['wqt_assign_role'] :array('guest');
        $wpt_sanitized_roles    = array_map('sanitize_text_field', $role);
        
  
        update_post_meta( $post_id, 'question_meta_fields', $wqt_posted_data );
        update_post_meta( $post_id, 'wqt_assign_role', $wpt_sanitized_roles );
    }


    /*====== All questions setting keys saved array =======*/
    $question_settings = array (

                        'wqt_button_clr',
                        'wqt_allow_time',
                        'wqt_time_limit',
                        'wqt_button_text_clr',
                        'wqt_allow_result',
                        'wqt_question_color',
                        'wqt_background_color',
                        'wqt_answer_label_size',
                        'wqt_question_label_size',
                        'wqt_question_header_color',
                        'wqt_selected_option_clr',
                        'wqt_quiz_form_width',
                        'wqt_admin_msg_field',
                        'wqt_form_redirect_url',
                        'wqt_question_check_ans_0',

                        /* === emails settings metabox === */
                        'wqt_allow_email',
                        'wqt_send_email',
                        'wqt_email_subject',
                        'wqt_emails_message',

                        /* === quiz instruction === */
                        'wqt_instruction_quiz',
                        'wqt_quiz_message',
                        'wqt_submit_meg',
                        // 'submit_member_list',
                        
                        //student email
                        'wqt_student_result',
                        'wqt_student_subject',
                        'wqt_student_message'
                    );
                        
    /* ===== Saving settings in questions meta =====*/
    foreach ($question_settings as $key) {
        
        if( isset($_POST[$key]) ) {
        
            $sentized_val = sanitize_text_field($_POST[$key]);
            update_post_meta($post_id, $key, $sentized_val);
        }
            
    }                
}

// Sanitizing posted data before saving
function wqt_admin_sanitize_data( $posted_data ) {

    $sanitized_array = array();
    foreach ($posted_data as $question) {
        
        $question['question']   = sanitize_text_field($question['question']);
        $question['mark']       = sanitize_text_field($question['mark']);
        $question['desc']       = sanitize_text_field($question['desc']);
        
        $answer_meta            = array();
        foreach($question['answer_meta'] as $asnwer) {

            $answer_meta[]      = array_map('sanitize_text_field', $asnwer);
        }

        $question['answer_meta']= $answer_meta;

        $sanitized_array[]      = $question;
    }

    return $sanitized_array;
}