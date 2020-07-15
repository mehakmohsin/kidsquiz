<?php
/**
** will handle all wp hooks callbacks
** actions & filters
**/

    /* ==== Not run if accessed directly ==== */
    if( ! defined('ABSPATH' ) ){
  	    die("Not Allowed");
    }
    
    /* ==== hook frontend quiz submit ==== */
    function wqt_submit_frontend(){

        /* ==== Check nonce for scurity ==== */
        if ( !wp_verify_nonce( $_POST['wqt_nonce'], 'wqt_nonce_value' ) ) 
            die('sorry for security reason');
        
        if (!isset( $_POST['wp_quiz'] )) {
            return;
        }

        $username = '';
        $email    = '';

        $wqt_result_date = date('F j, Y');

        if (isset( $_POST['username'] ) && isset( $_POST['email'] )) {

            $username = sanitize_text_field($_POST['username']);
            $email    = sanitize_email($_POST['email']);
        }

        if (!isset( $_POST['username'] ) && !isset( $_POST['email'] )) {

            $user_id      = wqt_current_user_id();

            $user_info    = get_userdata($user_id);
            $username     = $user_info->display_name;
            $email        = $user_info->user_email;
        }

        $admin_msg       = sanitize_text_field($_POST['admin_msg']);
        $time_taken      = sanitize_text_field($_POST['total_quiz_time']);
        $single_time     = sanitize_text_field($_POST['quiz_time']);
        $quiz_id         = intval($_POST['quiz_id']);

        $submit_quiz_meta = $_POST['wp_quiz'];
       
        /* ===== update the value in result cpt ==== */
        $wqt_result_id    = wqt_update_value_result_cpt($wqt_result_date , $username ,$email,
                            $time_taken, $single_time, $quiz_id);
        
        $obtained_marks   = 0;
        $total_marks      = 0;
        $user_correct_ans = 0;
        $all_correct_answers = array();


        foreach ($submit_quiz_meta as $quizid => $anwsr_meta) {
            
            $anwsr_meta       = wqt_front_sanitize_data($anwsr_meta);
            $saved_quiz_meta  = get_post_meta($quizid ,'question_meta_fields' , true );
            $correct_answers  = array();
            $convert_ans      = convert_answers_to_array($anwsr_meta);

            foreach ($saved_quiz_meta as $index => $meta) {

                $submitted_correct_ans_count = 0;
                $saved_answer = isset($meta['answer_meta']) ? $meta['answer_meta'] : array();
                $marks        = isset($meta['mark']) ? $meta['mark'] : '';
                $total_marks += intval($marks);

                foreach ($saved_answer as $anwsr_indx => $value) {


                    $submit_quiz_id = $anwsr_meta['answer'];
                    $ansr_id        = isset($value['ans_id']) ? $value['ans_id'] : '';
                    
                    if( $value['correct'] == 'on' ) {
                        $correct_answers[$index][$value['answer']] = $marks;
                    }
                    
                    
                    if( in_array($ansr_id, $convert_ans) && $value['correct'] == 'on'){
    
                        $submitted_correct_ans_count++;
                        $correct_count = wqt_get_total_correct_ans($quizid)[$index];

                        if( $correct_count === $submitted_correct_ans_count){


                            $obtained_marks += intval($marks);
                            $user_correct_ans++;

                        }
                    }                                
                }    
            
                $all_correct_answers = $correct_answers;
            }

            
            update_post_meta($wqt_result_id,'wqt_result_meta_fields', $saved_quiz_meta);
            update_post_meta($wqt_result_id,'wqt_total_question', count($saved_quiz_meta));
            update_post_meta($wqt_result_id,'wqt_correct_answers', $all_correct_answers);
            update_post_meta($wqt_result_id,'wqt_user_correct_answers', $user_correct_ans);
        }
            
            
            update_post_meta($wqt_result_id, 'wqt_current_id', $quiz_id);
            update_post_meta($wqt_result_id, 'results', $submit_quiz_meta);
            $overall_percentage =  intval($obtained_marks/$total_marks*100);
            update_post_meta($wqt_result_id, 'marks_obtains', $obtained_marks);
            update_post_meta($wqt_result_id, 'total_marks', $total_marks);
            update_post_meta($wqt_result_id, 'overall_percentage', $overall_percentage);
            update_post_meta($wqt_result_id, 'admin_msg', $admin_msg);

            $quiz_name  = get_the_title($quiz_id);
            update_post_meta($wqt_result_id, 'quiz_name', $quiz_name);

        /* ==== wqt result show after submit the quiz ===== */
    

        if ( wqt_check_result_show_enable($wqt_result_id) != false ) {
            printf(__("%s \n %s", "wqt"), wqt_get_message_after_submit($wqt_result_id), 
                wqt_result_table_display($wqt_result_id));
        }else{
            printf( __("%s", "wqt"), wqt_get_message_after_submit($wqt_result_id) );
        }
       
        if(wqt_student_result($wqt_result_id) !=false){
            
            wqt_student_result_send_email($wqt_result_id);
        }

        die(0);
    }