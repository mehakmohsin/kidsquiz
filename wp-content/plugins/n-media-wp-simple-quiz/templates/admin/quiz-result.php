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
      

?>
    <div class="wqt_wrapper">
        <ul class="list-group display-ul">
            <li class="list-group-item Design-li"><?php _e('Total Marks : ' , 'wqt'); ?>
                <?php echo $total_marks; ?>
            </li>
            <li class="list-group-item Design-li"><?php _e('Obtained Marks : ' , 'wqt'); ?>
                <?php echo $obtained_marks; ?>
            </li>
            <li class="list-group-item Design-li"><?php _e('Percentage Marks : ' , 'wqt'); ?>
                <?php echo $percentage; ?>
            </li>

            <?php if ($allow_time == 'yes') { ?>

            <li class="list-group-item Design-li"><?php _e('Time Elapsed : ' , 'wqt'); ?>
                <?php echo $total_quiz_time; ?>
            </li>

            <?php } ?>
        
            <li class="list-group-item Design-li"><?php _e('Total Correct Answers : ' , 'wqt'); ?> 
                <?php echo $correct_question; ?>
            </li>
        </ul>
    
        <table class="table table-bordered">
            <thead>
                <tr class="table-border-color">
                    <th><?php _e('Questions' , 'wqt'); ?></th>
                    <th><?php _e('User Selected Answers' , 'wqt'); ?></th>
                    <th><?php _e('Correct Answers' , 'wqt'); ?></th>
                    <th><?php _e('Obtained Marks' , 'wqt'); ?></th>
                    <th><?php _e('Total Marks' , 'wqt'); ?></th>
                    <?php if ($allow_time == 'yes') { ?>
                        <th><?php _e('Time Taken' , 'wqt'); ?></th>
                    <?php } ?>
                </tr>
            </thead>
            </tbody>

            <?php            
                $counter         = 0;
                $ans_total_marks = 0;
                $total_mk        = 0;


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
                    
                    ?>
                        <tr>
                            <td><?php echo esc_html($the_question); ?></td>
                            <td><?php echo $selected_ans_strng; ?></td>
                            <td><?php wqt_display_correct_ans($submit_qID ,$correct_answers); ?></td>
                            <td><?php echo $user_ans_marks; ?></td>
                            <td><?php echo $que_marks; ?></td>
                            <?php  
                            if ($allow_time == 'yes') { ?>
                                <td><?php echo $the_time; ?></td>
                            <?php } ?>
                        </tr>

                    <?php
                        $counter++; 
                        $ans_total_marks+= $user_ans_marks;
                }
            } ?>      
                <tr>
                    <td colspan="3"><strong><?php _e('Grand Total' , 'wqt'); ?></strong></td>
                    <td><strong><?php echo $ans_total_marks; ?></strong></td>
                    <td><strong><?php echo $total_mk; ?></strong></td>
                    <?php if ($allow_time == 'yes') { ?>
                        <td><strong><?php echo $total_quiz_time; ?></strong></td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <?php if ($show_msg_filed == 'yes') { ?>
            <div>
                <span class="wqt-email-message"><?php echo _e('User Message:', 'wqt'); ?></span>
                <p><?php echo esc_html($admin_msg); ?></p>
            </div>
        <?php } ?>
    </div>