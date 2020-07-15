<?php

/* ========= Setting of question form design meta =========*/


/* ======= Not run if accessed directly =======*/
    if( ! defined("ABSPATH" ) )
    	die("Not Allewed");


/* ======= Get all settings relative meta =======*/
    global $post;

    $quizz_setting 	   = new WQT_Questions($post->ID);
    $question_lab_size = wqt_questions_label_size();
    $question_label    = $quizz_setting->get_option('wqt_question_label_size');
    $answer_label      = $quizz_setting->get_option('wqt_answer_label_size');
    
?>
<div class="wqt_wrapper wrap wqt-quiz-design-wrapper">
	<label><?php _e('Header Color' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Change the form header color','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<input  name="wqt_question_header_color" class="wp-color" value="<?php echo esc_attr($quizz_setting->get_option('wqt_question_header_color')); ?>">

	<label><?php _e('Form Color' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Change the Question form background color','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<input  name="wqt_background_color" class="wp-color" value="<?php echo esc_attr($quizz_setting->get_option('wqt_background_color')); ?>">

	<label><?php _e('Button Color' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Change the button background color','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<input  name="wqt_button_clr" class="wp-color" value="<?php echo esc_attr($quizz_setting->get_option('wqt_button_clr')); ?>">

	<label><?php _e('Button Label Color' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Change the button text color','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<input  name="wqt_button_text_clr" class="wp-color" value="<?php echo esc_attr($quizz_setting->get_option('wqt_button_text_clr')); ?>">

	<label><?php _e('Select Answer Color' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Change the selected answer color','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<input  name="wqt_selected_option_clr" class="wp-color" value="<?php echo esc_attr($quizz_setting->get_option('wqt_selected_option_clr')); ?>">
    <div class="row">
    	<div class="col-md-12">
		    <label><?php _e('Form Width' , 'wqt'); ?>
				<span class="wqt-label-color" title="<?php _e('change the form width ','wqt'); ?>">
					<i class="dashicons dashicons-editor-help"></i>
				</span>
			</label>
			<input placeholder="100%" name="wqt_quiz_form_width" class="wqt_time form-control" value="<?php echo esc_attr($quizz_setting->get_option('wqt_quiz_form_width')); ?>">
    	</div>
    </div>
	<label><?php _e('Question Label Size' , 'wqt'); ?>
		<span class="wqt-label-color" title="<?php _e('Select font size for questions','wqt'); ?>">
			<i class="dashicons dashicons-editor-help"></i>
		</span>
	</label>
	<select class="wqt-selecter" name="wqt_question_label_size">
		<?php 
			foreach ($question_lab_size as $size => $val) {
		?>
			<option value="<?php echo esc_attr($size); ?>" <?php selected( $question_label, $size) ?> ><?php echo $val; ?></option>
		<?php 
			}
	 	?>
	</select>
</div>