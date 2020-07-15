<?php 

/* ===== Frontend quiz form template ====== */
    
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

    $quiz_font_size = $quizz_setting->get_option('wqt_question_label_size') != ''?
    				  $quizz_setting->get_option('wqt_question_label_size') : '20px';

	$allow_time     = $quizz_setting->get_option('wqt_allow_time');

	$time_limit     = $quizz_setting->get_option('wqt_time_limit');
	$allow_result   = $quizz_setting->get_option('wqt_allow_result');

    $wqt_quiz_message       = $quizz_setting->get_option('wqt_quiz_message')!= ''?
    						  $quizz_setting->get_option('wqt_quiz_message') :'Your Quiz Completed!';

    $quiz_form_width        = $quizz_setting->get_option('wqt_quiz_form_width') != ''?
    					      $quizz_setting->get_option('wqt_quiz_form_width') : '100%';

    $selected_option_clr    = $quizz_setting->get_option('wqt_selected_option_clr') != ''?
    					      $quizz_setting->get_option('wqt_selected_option_clr') : 'white';

    $wqt_instruction_quiz   = $quizz_setting->get_option('wqt_instruction_quiz')!= ''?
    						  $quizz_setting->get_option('wqt_instruction_quiz') :'Welcome';

    $wqt_redirect_url       = $quizz_setting->get_option('wqt_form_redirect_url');

    $show_msg_filed         = $quizz_setting->get_option('wqt_admin_msg_field');
    $assign_user_role       = get_post_meta($quiz_id, 'wqt_assign_role', true);

    $quiz_icon              = WQT_URL.'/images/quiz-icon.png';
    $loader_icon            = WQT_URL.'/images/setting-loader.gif';


    /*======= Get question meta fields =======*/
    $quiz_meta  = $quizz_setting->get_quiz_saved_field();
	if( empty($quiz_meta) ) {
	    $quiz_meta = array();
	    $quiz_meta[] = array('id' => 0,'question'=>'','mark'=>'', 'answer_meta'=> array(array('answer'=>'','correct'=>'')));
	}

	$total_questions   = count($quiz_meta);
	$total_correct_ans =  wqt_get_total_correct_ans($quiz_id);

?>

<!-- ===== Before start quiz show any information or instruction ======= -->
<div class="wqt_wrapper container wqt-instruction-wrapper" style="background:<?php echo $bg_color; ?>">
	<div class="row">
		<div class="col-md-2">
		    <div class="wqt-instruction-img" style="background:<?php echo $header_clr; ?>">
		    	<img src="<?php echo esc_url($quiz_icon); ?>"/>
		    </div>
		</div>
		<div class="col-md-10"> 
		    <div class="wqt-instruction-heading">
		        <p class="text-center">
		        	<?php echo $wqt_instruction_quiz;  ?>
		        </p>
			</div>
		</div>
	</div>
    <div class="panel-body wqt-panel-body">
    	<label style="background:<?php echo $header_clr; ?>"> 
    		<?php _e('Total Questions:', 'wqt'); ?> 
    		<span><?php echo $total_questions;  ?> </span>
    	</label>
        <label style="background: <?php echo $header_clr?>; color:<?php echo $btn_text_clr?>" 
        		id="wqt_instruction_box"><?php _e('Start', 'wqt'); ?>
        </label>
    </div>
</div>

<!-- ========= Quiz Template ========== -->
<div class="wqt_wrapper container-fluid wqt-quiz-render">
    <div class="modal-dialog wqt-quiz-design" style="width:<?php echo $quiz_form_width; ?>">
  		<form id="mcqs-front-quizz">
  			<input type="hidden" name="action" value="wqt_submit_frontend">
			<input type="hidden" name="wqt_nonce" value="<?php echo wp_create_nonce('wqt_nonce_value'); ?>">
			
      		<div class="modal-content modal_hide wqt-accordion"> 
      			<?php 
      				$mcqs_counter = 1;
      				foreach ($quiz_meta as $index => $meta) {
      					$chck_correct_ans_no = 0;
  						if (!empty($total_correct_ans)) {
  							$chck_correct_ans_no = $total_correct_ans[$index];
  						}
      		
						$question 	 = isset($meta['question']) ? $meta['question'] : '';
						$mark        = isset($meta['mark']) ? $meta['mark'] : '';
						$answer_meta = isset($meta['answer_meta']) ? $meta['answer_meta'] : array();
						$desc        = isset($meta['desc']) ? $meta['desc'] : '';
	
      			?>
      			<div class="wqt_next_question" style="background: <?php echo $bg_color; ?>" dat-maxans="<?php echo esc_attr($chck_correct_ans_no)?>" >

	        		<div class="modal-header wqt-quiz-header wqt-acc-head" style="background: 
	        												   <?php echo $header_clr; ?>">
	            		<h2 class="questions" style="font-size: <?php echo $quiz_font_size; ?>">
	            			<span class="label wqt-number-clr" 
	            				style="background:<?php echo $header_clr; ?> font-size: <?php echo $quiz_font_size; ?>"> 
	            				<?php echo $mcqs_counter; ?>	
	            			</span>
	            			<?php echo $question; ?>
	                    	<?php 
                  		 		if (!empty($desc)) { ?>
                  		
                  				<span class="wqt-descption-text"> <?php echo "( ".$desc." ) "; ?> 
                  				</span>
                  		 	
                  		 	<?php } ?>
                  		</h2>
                  		 <!--get the content from description meta-->
	        		</div>	
                    	<p class="wqt-ans-note">
                    		<?php echo sprintf( __( "Please select %d answer", "wqt"), $chck_correct_ans_no); ?>
                    	</p> 
		        	<div class="modal-body">
						<div class="quiz" id="quiz" data-toggle="buttons">
							<ul class="demo element-animation1" id="sn-list">
								<?php 
									foreach ($answer_meta as $ans_indx => $ans_meta) {
										$answer       = isset($ans_meta['answer']) ? $ans_meta['answer'] : '';
										$correct      = isset($ans_meta['correct']) ? $ans_meta['correct'] : '';
										$ans_id       = 'q_'.$index.'_ans_'.$ans_indx;
								 ?>
	               		 		<li class="input-lg li-clr input_check btn btn-block btn-social btn-default" style=""><?php echo $answer?>

                            		<i class="fa  fa-square-o" aria-hidden="true"></i>
                            		<input type="checkbox" class="togglecheck" name="wp_quiz[<?php echo esc_attr($quiz_id); ?>][answer][<?php echo esc_attr($ans_id); ?>]"  autocomplete="off" value="<?php echo esc_attr($answer); ?>" hidden>
	               		 		</li> 
	               		 		<?php } ?> 
							</ul>
                            		<input type="hidden" id="wqt_url" value="<?php echo $wqt_redirect_url; ?>"/>

                            		<input type="hidden" id="quiz_id" value="<?php echo $quiz_id; ?>"/>

							<div class="quiz-btn next-btn-hide">
		             			<button class="btn btn_check nextQuestion" style="
		             					background:<?php echo $btn_clr; ?>!important; color:<?php echo $btn_text_clr; ?>"><?php echo __('Next', 'wqt'); ?>
		             			</button>
							</div>
	 						<div class="modal-footer quiz-footer">
	                			<span class="wqt-mcqs-counter">
									<?php echo sprintf( __( "Question %d of %d", "wqt"), $mcqs_counter, $total_questions	); ?>
	                			</span>
							</div/>
						</div>		
					</div>
				</div>
				<?php 
				$mcqs_counter++;
			} 

			if (isset( $allow_time ) && $allow_time == 'yes') { ?>
	    		<div class="control_timer text-center"><?php echo _e('Time: ' , 'wqt') ?>
    			    <span class="timer"><?php echo _e('0:00','wqt') ?></span>
    			</div>
        		<?php  } ?>
    			
			</div>
			
				<?php 

					$template_vars = array( "quiz_id" => $quiz_id );
					if (!class_exists('NM_MCQS_PRO') ) {
						
						wqt_load_templates('admin/quiz-form.php',$template_vars);  
					}elseif (class_exists('NM_MCQS_PRO') && $assign_user_role == '') {

						wqt_load_templates('admin/quiz-form.php',$template_vars);  
					}elseif (class_exists('NM_MCQS_PRO') && $assign_user_role != '') {

						if (wqt_current_user_id()) {
							wqt_load_templates('admin/quiz-form-alert.php',$template_vars);
						}else {
							wqt_load_templates('admin/quiz-form.php',$template_vars); 
						}
						
					}
 
				?>
				<div class="end_quiz">
					<p><?php echo esc_html($wqt_quiz_message); ?></p>
				</div>
			</div>
  		</form>
	</div>
</div>