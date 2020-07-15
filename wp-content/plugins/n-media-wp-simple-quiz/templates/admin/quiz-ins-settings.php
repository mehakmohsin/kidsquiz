<?php

/* ===== Setting of quiz instruction meta ===== */

    /* ===== Not run if accessed directly ====*/
    if( ! defined("ABSPATH" ) )
        die("Not Allewed");
    
    global $post;
    $quizz_setting  = new WQT_Questions($post->ID);
?>

<div class="wqt_wrapper container-fluid wqt-instruction-wrapper">	
	<label><?php _e('Instruction Before Quiz' , 'wqt'); ?></label>
	<div class="row">
		<div class="col-md-6">
			<textarea name="wqt_instruction_quiz" class="form-control"><?php echo esc_attr($quizz_setting->get_option('wqt_instruction_quiz')); ?></textarea>	
		</div>
		<div class="col-md-6">
			<p><?php _e('Write the instruction before quiz for member' , 'wqt'); ?></p>
		</div>
	</div>
	<label><?php _e('Message on Complete Quiz' , 'wqt'); ?> </label>
	<div class="row">
		<div class="col-md-6">
			<textarea name="wqt_quiz_message" class="form-control"><?php echo esc_attr($quizz_setting->get_option('wqt_quiz_message')); ?></textarea>	
		</div>
		<div class="col-md-6">
			<p><?php _e('Message show when all questions completed' , 'wqt'); ?></p>
		</div>
	</div>
	<label><?php _e('Submit Message' , 'wqt'); ?> </label>
	<div class="row">
		<div class="col-md-6">
			<textarea name="wqt_submit_meg" class="form-control "><?php echo esc_attr($quizz_setting->get_option('wqt_submit_meg')); ?></textarea>	
		</div>
		<div class="col-md-6">
			<p><?php _e('Message show when he submit information after quiz' , 'wqt'); ?></p>
		</div>
	</div>
</div>