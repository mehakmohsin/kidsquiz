<?php 

    /* ===== not run if accessed directly ==== */
    if( ! defined('ABSPATH' ) ){
        die("Not Allowed");
    }


    /* ======= loading template files ======*/
    function wqt_load_templates( $template_name, $vars = null) {
        if( $vars != null && is_array($vars) ){
            extract( $vars );
        };

        $template_path =  WQT_PATH . "/templates/{$template_name}";
        if( file_exists( $template_path ) ){
        	include_once( $template_path );
        } else {
            die( "Error while loading file {$template_path}" );
        }
    }


    /* ==== print defualt array ==== */
    function wqt_pa($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    // Sanitizing submitted data after submitted quiz
    function wqt_front_sanitize_data( $submitted_data ) {

        $answer_meta   = array();
        $sanitize_meta = array();

        foreach($submitted_data as  $answer) {
           
            foreach ($answer as $selected_ans ) {
                
                $answer_meta[]   = array_map('sanitize_text_field', $selected_ans);
            }
            
           $answer = $answer_meta;
           $sanitize_meta    = $answer;
        }

        return $submitted_data;
    }

    /* ==== create the quiz form link ==== */
    function quiz_form_link($quiz_id, $quiz_name){
        $link = "<a title ='onclick to open this quiz' target ='_blank' href='".admin_url("post.php")."?post=".$quiz_id."&action=edit'> ". $quiz_name."</a>";

        return $link;
    }

    /* ==== create the result form link ==== */
    function result_form_link($result_id, $result_name){
        $link = "<a title ='See result' target ='_blank' href='".admin_url("post.php")."?post=".$result_id."&action=edit'> ". $result_name."</a>";
        
        return $link;
    }


    /* ==== get the user info ==== */
    function get_user_info($post_id){
        $full_name   = get_post_meta($post_id, 'full_name', true);
        $user_email  = get_post_meta($post_id, 'user_email', true);

         return $full_name.', '.$user_email; 
    }


    /* ==== check role visibility ==== */
    function restrictly_show_quiz_assign_role($quiz_id) {
    
        $assign_user_role   = get_post_meta($quiz_id, 'wqt_assign_role', true);
        
        
        if( is_admin() ) return true;

        if( ! $assign_user_role ) return true;


        if( in_array('guest', $assign_user_role) ) return true;

        //Get all capabilities of the current user
        $user = get_userdata( wqt_current_user_id() );
        $caps = ( is_object( $user) ) ? array_keys($user->allcaps) : array();
        //All capabilities/roles listed here are not able to see the dashboard
        if(array_intersect($assign_user_role, $caps)) {
            // show_admin_bar(false);
            return true;
        }
    }      


    /* ==== get current user id ==== */
    function wqt_current_user_id(){
        
        $user_id = '';
        if( is_user_logged_in() ) {
            $user_id = get_current_user_id();
        }
        return $user_id;
    }

    /* ==== Question Label size define ==== */
    function wqt_questions_label_size(){
        $lb_size = array('20px'=>'20px',
                         '18px'=>'18px',
                         '16px'=>'16px',
                         '14px'=>'14px',
                         '12px'=>'12px',
                        );
        
        return apply_filters('wqt_question_label_size', $lb_size); 
    }

    /* ===== update the cpt result ===== */
    function wqt_update_value_result_cpt($wqt_result_date , $username ,$email, $time_taken, $single_time, $quiz_id){

        $quiz_name  = get_the_title($quiz_id);
        $result = array(
            'post_title'    => $username .esc_html('  submitted on this quiz  ','wqt').$wqt_result_date,
            'post_type'     => 'wqt_result',
            'comment_status'     => $quiz_name
        );
        
        $wqt_result_id = wp_insert_post($result); 
       
        update_post_meta($wqt_result_id, 'results', $_POST['wp_quiz']);
        update_post_meta($wqt_result_id, 'full_name', $username);
        update_post_meta($wqt_result_id, 'user_email', $email);
        update_post_meta($wqt_result_id, 'overall_time', $time_taken);
        update_post_meta($wqt_result_id, 'single_time', $single_time);
        
        return $wqt_result_id;
    }

    /* =====  get id of quiz answers ===== */
    function convert_answers_to_array($answers) {

        $answer = isset($answers['answer']) ? $answers['answer'] : '';
        $new_ans = array();
        foreach($answer as $id => $on){

            $new_ans[] = $id;
        }
        return $new_ans;
    }

    /* ==== check one by one question and return count ==== */
    function wqt_get_total_correct_ans($question_id){

        $wqt_answers = get_post_meta($question_id ,'question_meta_fields' , true );

        if( ! $wqt_answers ) return 0;

        $ans_count = 0;
        $arr_ans   = array();

        foreach ($wqt_answers as $id => $answers ) {
                
            $total_ans_correct = 0;
            $answer_array      = isset($answers['answer_meta']) ? $answers['answer_meta'] : '';

            if (is_array($answer_array)) {
                
                foreach ($answer_array as $key => $value) {
            
                    $correct  = isset( $value['correct'] ) ?  $value['correct']: '';
                    $answer   = isset($value['answer']) ? $value['answer'] : array();

                    if ($correct == 'on') {

                            $ans_count          = 1;
                            $total_ans_correct +=  $ans_count;
                            $arr_ans[$id]       =  $total_ans_correct;
                    }
                }
            }

        }
        
        return $arr_ans;
    }

    /* ==== Get user selected answer ==== */
    function wqt_user_selected_ans($post_id, $quiz_meta){

        $selected_answer = array();
        $correct_answers = get_post_meta($post_id , 'results' , true);
        $wqt_current_id  = get_post_meta($post_id , 'wqt_current_id' , true);
        if (is_array($quiz_meta)) {
            
            foreach ($quiz_meta as $key => $value) {
                foreach ($correct_answers[$wqt_current_id]['answer'] as $question_key => $answer) {
                    foreach ($value['answer_meta'] as $index => $answers_value) {

                        $q_key = 'q_'.$key.'_ans_'.$index;
                        if ($q_key == $question_key) {
                            $selected_answer[$key][] = $answer;
                        }
                    }
                } 
            }
        }
                
        return $selected_answer;
    }

    /* === selected option check correct one return marks === */
    function wqt_correct_ans_marks($correct_ans, $submitted_correct_ans_count, $correct_count, $user_selected){
        
        $ans_obtained_marks = 0;
        foreach ($correct_ans as $correct => $answer_marks) {
                if(in_array($correct, $user_selected)) {
            $submitted_correct_ans_count++;
            if ($submitted_correct_ans_count === $correct_count) {
                    $ans_obtained_marks = $answer_marks;
                }
            }     
        }

        return $ans_obtained_marks;
    }

    /* ==== display correct wqt answers ==== */
    function wqt_display_correct_ans($submit_qID, $correct_answers){

        foreach ($correct_answers as $q_id => $ansMarks) {
            if ($submit_qID == $q_id) {
                foreach ($ansMarks as $ans => $marks) {
                    echo  $ans.',';
                }
            }
        }
    }

    /* ==== display correct wqt answers ==== */
    function wqt_display_correct_ansss($submit_qID, $correct_answers){

        foreach ($correct_answers as $q_id => $ansMarks) {
            if ($submit_qID == $q_id) {
                foreach ($ansMarks as $ans => $marks) {
                    return  $ans;
                }
            }
        }
    }

    /* ===== Getting message after result submitted ===== */
    function wqt_get_message_after_submit($wqt_result_id) {
        
        $quiz_id         = get_post_meta($wqt_result_id, 'wqt_current_id', true);
        $quizz_setting   = new WQT_Questions($quiz_id);
        $wqt_message     = $quizz_setting->get_option('wqt_submit_meg');

        if( empty($wqt_message) ) {
            $wqt_message = __('Your quizz has been sent successfully', 'wqt');
        }
        return $wqt_message;
    }
    
    /* ===== Check setting after submit result show ===== */
    function wqt_check_result_show_enable($wqt_result_id) {

        $quiz_id = get_post_meta($wqt_result_id, 'wqt_current_id', true);

        
        $result_option  = new WQT_Questions( $quiz_id);
        $result_option  = $result_option->get_option('wqt_allow_result');
        
        if ( isset( $result_option ) && $result_option == 'yes') {
            return true;
        }else{
            return false;
        }
    }
    
    /* ===== Check setting after submit result show ===== */
    function wqt_student_result($wqt_result_id) {

        $quiz_id = get_post_meta($wqt_result_id, 'wqt_current_id', true);

        
        $result_option  = new WQT_Questions( $quiz_id);
        $result_option  = $result_option->get_option('wqt_student_result');
        
        if ( isset( $result_option ) && $result_option == 'yes') {
            return true;
        }else{
            return false;
        }
    }

    
    /* ==== after form submit result show =====*/
    function wqt_result_table_display( $wqt_result_id ){

        $question_class  = new WQT_Questions($wqt_result_id);
    	
        $total_marks     = $question_class->wqt_get_total_marks();
        $percentage      = $question_class->wqt_get_quiz_marks_percentage();
        $obtained_marks  = $question_class->wqt_get_obtain_marks();

        $sumbit_result  ='<div class="wqt_wrapper">';
        $sumbit_result .= '<table id="table" class="table table-hover" border=1>';
        $sumbit_result .='<thead>';
        $sumbit_result .='<tr>';
        $sumbit_result .='<th>'.esc_html__( 'Obtained Marks', 'wqt' ).'</th>';
        $sumbit_result .='<th>'.esc_html__( 'Total Marks', 'wqt' ).'</th>';
        $sumbit_result .='<th>'.esc_html__( 'Percentage Marks', 'wqt' ).'</th>';
        $sumbit_result .='</tr>';
        $sumbit_result .='<thead>';
        $sumbit_result .='<tbody>';
        $sumbit_result .='<tr>';
        $sumbit_result .='<td>'.$obtained_marks.'</td>';
        $sumbit_result .='<td>'.$total_marks.'</td>';
        $sumbit_result .='<td>'.$percentage.'</td>';
        $sumbit_result .='</tr>';
        $sumbit_result .='</tbody>';
        $sumbit_result .='</table>';
        $sumbit_result .='</div>';

        echo $sumbit_result;
    }
    
    /* ==== Send email to written emails ==== */
    function wqt_student_result_send_email($wqt_result_id) {
        
        /* ==== Get email header ==== */
        $site_title = get_bloginfo('name');
        $admin_email = get_bloginfo('admin_email');
        
        $headers[] = "From: {$site_title} <{$admin_email}>";
        $headers[] = "Content-Type: text/html";
        $headers[] = "MIME-Version: 1.0\r\n";
        
        $user_id      = wqt_current_user_id();

        $user_info    = get_userdata($user_id);
        $username     = $user_info->display_name;
        $email        = $user_info->user_email;
        
        $quiz_id = get_post_meta($wqt_result_id, 'wqt_current_id', true);

        
        
        $subject 	   = get_post_meta($quiz_id, 'wqt_student_subject', true) != '' ? 
    					 get_post_meta($quiz_id, 'wqt_student_subject', true) : 'Your Result';
    					 
    					 
        $message 	   = get_post_meta($quiz_id, 'wqt_student_message', true) != '' ? 
    					 get_post_meta($quiz_id, 'wqt_student_message', true) : 'Contact your teacher for result';
    					 

        $question_id = $wqt_result_id;
       
      
        $email_template = get_email_template_html($message, $question_id);
        
        
        if (wp_mail($email, $subject, $email_template, $headers)) {
      
            $response = array('status'=>'success', 'message'=>__("Email Send Successfully!", 'wqt'));
            return $response ;  
        }else {
            $response = array('status'=>'error', 'message'=>__("Problem in server please chack!", 'wqt'));
        }

            return $response ;  
    }
        
   
 
    
    /* ==== Load email template ==== */ 
    function get_email_template_html($message, $question_id){

        // Replacing placehorders
        ob_start();
        
        $email_template = "email-template.php";
        $class_object   = new NM_MCQS_PRO();
        $class_object->wqt_load_templates_pro($email_template);
        
        $email_string = ob_get_clean();
        
        $email_vars = get_email_vars($question_id);
        
        $email_string = str_replace("%WQT_EMAIL_CONTENT%", $message, $email_string);
        
        foreach( $email_vars as $var => $value ) {
                
                $email_string = str_replace( $var, $value, $email_string);
        }
        
        return apply_filters('wqt_email_student_html', $email_string, $message);
        
    }

    function get_email_vars($question_id){
        
        $user_id      = wqt_current_user_id();

        $user_info    = get_userdata($user_id);
        $username     = $user_info->display_name;
        $email        = $user_info->user_email;
        
        $question_class = new WQT_Questions($question_id);
        

        $obtained_marks = $question_class->wqt_get_obtain_marks();
        $total_marks    = $question_class->wqt_get_total_marks();
        $percentage     = $question_class->wqt_get_quiz_marks_percentage();
        $date           = date('F j, Y');
        
        $message_placeholders = array('%TOTAL_MARKS%'=>$total_marks,
                                    '%OBTAINED_MARKS%'=>$obtained_marks,
                                    '%PERCENTAGE%'=>$percentage,
                                    '%RESULT_DATE%'=>$date,
                                    '%DISPLAY_NAME%'=>$username,
                                    );
                                        
        
        return apply_filters('wqt_emaildf_vars', $message_placeholders);
    }
        