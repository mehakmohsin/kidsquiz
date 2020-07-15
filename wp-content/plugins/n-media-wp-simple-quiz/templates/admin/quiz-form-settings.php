<?php

/* ========= Setting of question form design meta =========*/


/* ======= Not run if accessed directly =======*/
    if( ! defined("ABSPATH" ) )
    	die("Not Allewed");


/* ======= Quiz form settings =======*/
	global $post;

    $quizz_setting 	   = new WQT_Questions($post->ID);

	$allow_result 	   = $quizz_setting->get_option('wqt_allow_result') != false ? 
    					 $quizz_setting->get_option('wqt_allow_result') : 'no';

    $allow_time        = $quizz_setting->get_option('wqt_allow_time') != false?
    					 $quizz_setting->get_option('wqt_allow_time') : 'no';

    $msg_field          = $quizz_setting->get_option('wqt_admin_msg_field') != false?
    					 $quizz_setting->get_option('wqt_admin_msg_field') : 'no';

    $ans_check2         = $quizz_setting->get_option('wqt_question_check_ans_0');
    
    $user_role          = get_post_meta($post->ID, 'wqt_assign_role', true);
?>

<div class="wqt_wrapper wrap wqt-quiz-settings-wrapper">
	<label><?php _e('Show Result' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('You can show the result after submit the quiz for member','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<br>
	<div class="btn-group" data-toggle="buttons">
		<label class="btn btn-default btn-on btn-sm">
			<input type="radio" value="yes" name="wqt_allow_result" class="edit_ok"
			<?php checked($allow_result , 'yes'); ?>><?php _e('Yes' , 'wqt'); ?>
		</label>
		<label class="btn btn-default btn-off btn-sm">
			<input type="radio" value="no" name="wqt_allow_result" class="edit_ok"
			<?php checked( $allow_result , 'no'); ?>><?php _e('No' , 'wqt'); ?>
		</label>
    </div>
	</br>
	<label><?php _e('Show Notice Field' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Show notice field on frontend user write notice for admin','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<br>
	<div class="btn-group" data-toggle="buttons">
		<label class="btn btn-default btn-on btn-sm">
			<input type="radio" value="yes" name="wqt_admin_msg_field" class="edit_ok"
			<?php checked($msg_field , 'yes'); ?>><?php _e('Yes' , 'wqt'); ?>
		</label>
		<label class="btn btn-default btn-off btn-sm">
			<input type="radio" value="no" name="wqt_admin_msg_field" class="edit_ok"
			<?php checked( $msg_field , 'no'); ?>><?php _e('No' , 'wqt'); ?>
		</label>
    </div>
    </br>
    <label><?php _e('Enable Time' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('You can allow the time for each question','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<br>
	<div class="btn-group" data-toggle="buttons">
		<label class="btn btn-default btn-on btn-sm">
			<input type="radio" value="yes" name="wqt_allow_time" class="edit_ok"
			<?php checked( $allow_time , 'yes'); ?>><?php _e('Yes' , 'wqt'); ?>
		</label>
		<label class="btn btn-default btn-off btn-sm">
			<input type="radio" value="no" name="wqt_allow_time" class="edit_ok"
			<?php checked( $allow_time , 'no'); ?>><?php _e('No' , 'wqt'); ?>
		</label>
    </div>
    </br>
    <label><?php _e('Time Limit' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Enter the time limit in seconds for each question','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
		<input placeholder="60 sec" name="wqt_time_limit" class="wqt_time form-control" value="<?php echo esc_attr($quizz_setting->get_option('wqt_time_limit')); ?>">
   	</br>
	<label><?php _e('Redirect URL' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Redirect url after  form submit','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
		<input  name="wqt_form_redirect_url" class="wqt_time form-control" 
				value="<?php echo esc_attr($quizz_setting->get_option('wqt_form_redirect_url')); ?>">
    </br>
	<label><?php _e('Answer Selection' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('You can select multiple or single answer for each question','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<select class="wqt-selecter wqt-check-ans-list" name="wqt_question_check_ans_0">
		<option value="single_ans" <?php selected( 'single_ans', $ans_check2) ?> >
			<?php _e('Single Answers', 'wqt'); ?></option>
		<option value="multiple_ans" <?php selected( 'multiple_ans', $ans_check2) ?> >
			<?php _e('Multiple Answers', 'wqt'); ?></option>
	</select>
	<label>
        <?php _e('Quiz Visibility' , 'wqt'); ?>
            <span class="wqt-label-color" title="<?php _e('This quiz show only selected role.','wqt'); ?>">
                <i class="dashicons dashicons-editor-help"></i>
            </span>
    </label>
    <select name="wqt_assign_role[]" class="wqt-multple-selecter2 form-control" multiple>
        		<option value="guest" <?php if (!empty($user_role)) { echo implode($user_role); } ?> selected> 
        			
                    <?php echo 'Guest'; ?>
                </option>
        <?php 
            $get_roles = get_editable_roles();
                foreach ($get_roles as $roles => $role_name) {
                    $selected = '';
                    if(!empty($user_role) ) {
                        $selected = in_array($roles, $user_role) ? 'selected="selected"' : '';   
                    }
        ?>		
                <option value="<?php echo esc_attr($roles); ?>" <?php echo $selected; ?> > 
                    <?php echo esc_html($roles); ?>
                </option>
        <?php } ?>
    </select>
</div>