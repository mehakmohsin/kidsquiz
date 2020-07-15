<?php 

/* ===== Frontend quiz form  ====== */
    
    /* ===== Not run if accessed directly ===== */
    if( ! defined('ABSPATH' ) ){
        die("Not Allowed");
    }

     /*===== Get style settings for quiz frontend ======*/
    $quizz_setting 	= new WQT_Questions($quiz_id );

    $wqt_quiz_message       = $quizz_setting->get_option('wqt_quiz_message')!= ''?
    						  $quizz_setting->get_option('wqt_quiz_message') :'Your Quiz Completed!';

    $show_msg_filed         = $quizz_setting->get_option('wqt_admin_msg_field');

    $loader_icon            = WQT_URL.'/images/setting-loader.gif';

?>

<!-- ========= After Quiz Template From Submit ========== -->
<div class="card register_card register_card_alart register_hide">
	<div class="form-body register_form">
	</br>
		<div class="wqt-alert-btn">
			<span><?php _e('Done', 'wqt'); ?></span>
		</div>
		<div class="wqt-form-msg-alert">
			<h4><?php echo esc_html($wqt_quiz_message);?></h4>
		</div>
			<?php if ($show_msg_filed == 'yes') { ?>
		<div class="wqt-form-input">	
			<div class="form-group">
				<span><?php _e('Message:','wqt') ?></span>
				<textarea type="text" class="form-control" placeholder="Enter Message for admin" name="admin_msg" required></textarea>
			</div>
		<div class="wqt-form-input">
			<?php } ?>
		<div class="sub_btn1">
			<input name="commit" type="submit" value="Submit">
			<img src="<?php echo esc_url($loader_icon); ?>" alt="loader1"
			     id="form_submit">
		</div>
	</div>