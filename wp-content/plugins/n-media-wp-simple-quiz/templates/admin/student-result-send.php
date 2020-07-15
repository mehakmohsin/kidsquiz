<?php

/* ===== Quiz-result send into email ===== */

	/* ===== Not run if accessed directly ===== */
    if( ! defined("ABSPATH" ) )
    	die("Not Allewed");

	global $post;
	
	
	$quizz_setting 	   = new WQT_Questions($post->ID);
	
	$wqt_student_result 	   = $quizz_setting->get_option('wqt_student_result') != false ? 
    					 $quizz_setting->get_option('wqt_student_result') : 'no';
    					 
    					 
    $wqt_student_subject 	   = $quizz_setting->get_option('wqt_student_subject') != '' ? 
    					 $quizz_setting->get_option('wqt_student_subject') : '';
    					 
    					 
    $wqt_student_message 	   = $quizz_setting->get_option('wqt_student_message') != false ? 
    					 $quizz_setting->get_option('wqt_student_message') : '';
?>

<div class="wqt_wrapper wrap wqt-student-wrapper">
	<div class=""> 
		<label><?php _e('Result Send' , 'wqt'); ?>
    		<span class="wqt-label-color" title="<?php _e('Quiz result will be sent in email after quiz submission','wqt'); ?>">
    			<i class="dashicons dashicons-editor-help"></i>
    		</span>
    	</label>
    	<br>
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default btn-on btn-sm">
				<input type="radio" value="yes" name="wqt_student_result" class="edit_ok"
				<?php checked($wqt_student_result , 'yes'); ?>><?php _e('Yes' , 'wqt'); ?>
			</label>
			<label class="btn btn-default btn-off btn-sm">
				<input type="radio" value="no" name="wqt_allow_result" class="edit_ok"
				<?php checked( $wqt_student_result , 'no'); ?>><?php _e('No' , 'wqt'); ?>
			</label>
    	</div>
    	<div class="row wqt-email-subject" style="margin-top:10px">
			<div class="col-md-6">
				<label><?php _e('Email Subject' , 'wqt'); ?>
					<span class="wqt-label-color" title="<?php _e('Emails subject to send in emails','wqt'); ?>">
						<i class="dashicons dashicons-editor-help"></i>
					</span>
				</label>
				<input name="wqt_student_subject" id="wqt_student_subject" class="form-control" value="<?php echo $wqt_student_subject; ?>"/>
			</div>
	    </div>
		<div class="row" style="margin-top:10px">
			<div class="col-md-6">
				<label><?php _e('Email Message' , 'wqt'); ?>
					<span class="wqt-label-color" title="<?php _e('send the email to user','wqt'); ?>">
						<i class="dashicons dashicons-editor-help"></i>
					</span>
				</label>
				<textarea placeholder="Enter the message here" name="wqt_student_message" id="wqt_student_message" class="form-control" value=""><?php echo $wqt_student_message;?></textarea>
			</div>
			<div class="col-md-6">
				<p class="wqt_email_desc"><?php _e('You also send using these vars Quiz result: %DISPLAY_NAME%, %OBTAINED_MARKS%, %TOTAL_MARKS%, %PERCENTAGE%, %RESULT_DATE%', 'wqt') ?></p>
			</div>		
		</div>
</div>