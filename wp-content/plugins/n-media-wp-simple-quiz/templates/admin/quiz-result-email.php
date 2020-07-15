<?php

/* ===== Quiz-result send into email ===== */

	/* ===== Not run if accessed directly ===== */
    if( ! defined("ABSPATH" ) )
    	die("Not Allewed");

	global $post;
?>

<div class="wqt_wrapper wrap wqt-email-design-wrapper">
	<div class="wqt_result_message_submit"> 
		<input type="hidden" id="result_id" value="<?php echo $post->ID; ?>">
		<div class="row">
			<div class="col-md-6">
				<label><?php _e('Email Message' , 'wqt'); ?>
					<span class="wqt-label-color" title="<?php _e('send the email to user','wqt'); ?>">
						<i class="dashicons dashicons-editor-help"></i>
					</span>
				</label>
				<textarea placeholder="Enter the message here" id="wqt_emails_message" class="form-control" value=""></textarea>
			</div>
			<div class="col-md-6">
				<p class="wqt_email_desc"><?php _e('You also send using these vars Quiz result: %OBTAINED_MARKS%, %TOTAL_MARKS%, %PERCENTAGE%, %RESULT_DATE%', 'wqt') ?></p>
			</div>		
		</div>
		<div class="row wqt-email-subject">
			<div class="col-md-6">
				<label><?php _e('Email Subject' , 'wqt'); ?>
					<span class="wqt-label-color" title="<?php _e('Emails subject to send in emails','wqt'); ?>">
						<i class="dashicons dashicons-editor-help"></i>
					</span>
				</label>
				<input id="wqt_email_subject" class="form-control" value=""/>
			</div>
			<div class="col-md-6">
				<label><?php _e('Enter Emails' , 'wqt'); ?>
					<span class="wqt-label-color" title="<?php _e('enter multiple email separated by commas','wqt'); ?>">
						<i class="dashicons dashicons-editor-help"></i>
					</span>
				</label>
				<input  type="email" id="wqt_user_email" id="user_email" 
						class="form-control" placeholder="add email by separated commas" required>
			</div>
		</div>
			<button type="submit" value="Send" class="wqt_email_btn btn btn-email-style btn-success btn-sm loading_btn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> sending.."> 
				<?php _e('Send', 'wqt'); ?> </button>
			<span class="wqt_result_form_alert"></span>
	</div>
</div>