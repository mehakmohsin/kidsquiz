<?php

/* ==== Quiz-results file show all detail of quiz paper ==== */

    /* ===== not run if accessed directly ===== */
    if( ! defined("ABSPATH" ) )
        die("Not Allewed");

    global $post;

    $question_class     =  new WQT_Questions($post->ID);

    $total_marks        = $question_class->wqt_get_total_marks();
    $obtained_marks     = $question_class->wqt_get_obtain_marks();
    $percentage         = $question_class->wqt_get_quiz_marks_percentage();
    $total_quiz_time    = $question_class->wqt_get_overall_time();
    $correct_question   = $question_class->wqt_get_correct_question();

    $quiz_time          = get_post_meta($post->ID, 'single_time', true);
    $single_time        = explode(",",$quiz_time);

    $correct_answers    = get_post_meta($post->ID , 'wqt_correct_answers' , true);
    $quiz_meta          = get_post_meta($post->ID,'wqt_result_meta_fields',true);
    $selected_answers   = wqt_user_selected_ans($post->ID, $quiz_meta);
    
    if (!empty($selected_answers)) {
        $selected_ans_strng = implode("\n", $selected_answers[0]);
    }

    $admin_msg          = get_post_meta($post->ID,'admin_msg',true);
    

    $quiz_id            = get_post_meta($post->ID , 'wqt_current_id' , true);
    $quizz_settings     =  new WQT_Questions($quiz_id);

    $allow_time         = $quizz_settings->get_option('wqt_allow_time');
    $show_msg_filed     = $quizz_settings->get_option('wqt_admin_msg_field');

    $question_no        = 1;
    
    $counter           = 0;
    $ans_total_marks   = 0;
    $total_mk          = 0;

?>
<div class="wqt_wrapper">
    <div class="wqt-print-page-body">
        <?php 
            if ($quiz_meta != '') {
                foreach ($quiz_meta as $submit_qID => $result_data ) {
                    $submitted_correct_ans_count = 0;

                    $selected_ans_strng   = implode("\n", $selected_answers[$submit_qID]);

                    $the_question   = isset( $result_data['question'] ) ?  $result_data['question']
                                      : 'Question Not Found';
                    
                    $que_marks      =  isset( $result_data['mark'] ) ?  $result_data['mark']: '0';
                    $ans_meta_data  =  isset( $result_data['answer_meta'] ) ?  
                                        $result_data['answer_meta']: array();
                    
                    $total_mk      += $que_marks;
                    $the_time       = isset( $single_time[$counter] ) ?  $single_time[$counter]: '0';
                    $correct_count  = wqt_get_total_correct_ans($quiz_id)[$submit_qID];
                   
                    $ans_obtained_marks = 0;
                    $user_ans_marks = wqt_correct_ans_marks($correct_answers[$submit_qID], 
                                       $submitted_correct_ans_count, $correct_count, 
                                       $selected_answers[$submit_qID]);

                       
                    $variable = 'a';
        ?>

        <span><?php echo 'Q'.$question_no++.':'; ?></span>
        <label><?php echo $the_question; ?></label></br>
                    
        <span><?php echo $selected_ans_strng; ?></span>
            <?php  foreach ($ans_meta_data as $index => $options) {
         
 ?>

        <span><?php echo $variable++.')'; ?></span>
        
        <span><?php echo $options['answer']; ?></span></br>

        <?php } }  } ?>
    </div>
</div>