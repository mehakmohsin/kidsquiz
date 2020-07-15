<?php 

/* ===== Frontend quiz form  ====== */
    
    /* ===== Not run if accessed directly ===== */
    if( ! defined('ABSPATH' ) ){
        die("Not Allowed");
    }

    /*===== Get style settings for quiz frontend ======*/
    $quizz_setting 	= new WQT_Questions($quiz_id );

    $header_clr 	= $quizz_setting->get_option('wqt_question_header_color') != ''?
				  	  $quizz_setting->get_option('wqt_question_header_color') : '#49d1e2c4;';
    
    $bg_color   	= $quizz_setting->get_option('wqt_background_color') != ''?
    			  	  $quizz_setting->get_option('wqt_background_color') : '#b6bd710d;';
    
	$btn_clr        = $quizz_setting->get_option('wqt_button_clr') != '' ? 
				      $quizz_setting->get_option('wqt_button_clr') : '#72dbe7';


	$btn_text_clr   = $quizz_setting->get_option('wqt_button_text_clr') != '' ?
					  $quizz_setting->get_option('wqt_button_text_clr') : 'white';


	$wqt_quiz_message   = $quizz_setting->get_option('wqt_quiz_message')!= ''?
					      $quizz_setting->get_option('wqt_quiz_message') :'Your Quiz Completed!';

    $show_msg_filed      = $quizz_setting->get_option('wqt_admin_msg_field');

    $loader_icon         = WQT_URL.'/images/setting-loader.gif';

?>

<!-- ========= After Quiz Template From Submit ========== -->
<div class="card register_card register_hide" style="background: <?php echo $bg_color?>;" >
	<div class="form-body register_form">
		<div class="wqt-form-msg" style="background: <?php echo $header_clr?>;" >
			<h4><?php echo esc_html($wqt_quiz_message);?></h4>
		</div>
		<div class="wqt-form-input">
			<div class="form-group">
				<span><?php _e('User Name:','wqt') ?></span>
				<input type="name" class="form-control" placeholder="Enter Full Name" name="username" required>
			</div>
			<div class="form-group">
				<span><?php _e('User Email:','wqt') ?></span>
				<input type="email" class="form-control" placeholder="Enter Email" name="email" required>
			</div>
			<?php if ($show_msg_filed == 'yes') { ?>
				
			<div class="form-group">
				<span><?php _e('Message:','wqt') ?></span>
				<textarea type="text" class="form-control" placeholder="Enter Message for admin" name="admin_msg" required></textarea>
			</div>

			<?php } ?>
		</div>
		<div class="sub_btn">
			<input name="commit" style="background: <?php echo $btn_clr?> !important; color:<?php echo $btn_text_clr?>" type="submit" value="Submit">
			<img src="<?php echo esc_url($loader_icon); ?>" alt="loader1"
			     id="form_submit">
		</div>
	</div>