<?php 

/*===== Add questions template metabox =====*/  

/* ===== Direct access not allowed ===== */
if( ! defined('ABSPATH' ) ){ exit; }

	global $post;
	$quizz_setting 	   = new WQT_Questions($post->ID);
	$quiz_meta         = get_post_meta($post->ID ,'question_meta_fields' , true );
	$ans_check2        = $quizz_setting->get_option('wqt_question_check_ans_0');
		
	if( empty($quiz_meta) ) {
	    $quiz_meta = array();
	    $quiz_meta[] = array('id' => 0,'question'=>'','mark'=>'', 'answer_meta'=> array(array('answer'=>'','correct'=>'')));
	}
?>

<div class="wqt_wrapper wqt-questions-wrapper">
	<ul id="wqt-accordion-1" class="wqt-accordion wqt-question-append-js">
		<?php 
		foreach ($quiz_meta as $index => $meta) {	
			$question 	 = isset($meta['question']) ? $meta['question'] : '';
			$mark        = isset($meta['mark']) ? $meta['mark'] : '';
			$answer_meta = isset($meta['answer_meta']) ? $meta['answer_meta'] : array();
			$desc        = isset($meta['desc']) ? $meta['desc'] : '';
		?>
		<li class="wqt-questions-section" data-index="<?php echo esc_attr($index); ?>">
			<input type='hidden' class="mcqs-id" name="wqt[<?php echo esc_attr($index); ?>][id]" value="<?php echo esc_attr($index); ?>" required>
			<div class="wqt-acc-head"><?php _e('Question', 'wqt'); 

				do_action('wqt_duplicate_option'); ?> 
				<span class="wqt-question-rm" title="<?php _e('Remove', 'wqt'); ?>">
					<i class="fa fa-times" aria-hidden="true"></i> 
				</span>
				<span title="<?php _e('Slider', 'wqt'); ?>" class="wqt-quiz-slider">
					<i class="fa fa-chevron-down wqt-plus"></i>
					<i class="fa fa-chevron-up wqt-minus"></i>
				</span>
			</div>
			<div class="wqt-acc-panel">
				<div class="card">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label><?php _e('Enter Question', 'wqt'); ?></label>
									<input type="text" name="wqt[<?php echo esc_attr($index); ?>][question]" class="form-control wqt-meta-field" data-metatype="question" value="<?php echo esc_attr($question); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><?php _e('Enter Total Question Marks', 'wqt'); ?></label>
									<input type="text" name="wqt[<?php echo esc_attr($index); ?>][mark]" class="form-control wqt-meta-field" data-metatype="mark" value="<?php echo esc_attr($mark); ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?php _e('Question Description', 'wqt'); ?></label>
									<input type="text" name="wqt[<?php echo esc_attr($index); ?>][desc]" class="form-control wqt-meta-field" data-metatype="desc" value="<?php echo esc_attr($desc); ?>">
								</div>
							</div>
						</div>
						<div class="wqt-answers-section" data-answer-id="<?php echo esc_attr($index); ?>">
							<?php foreach ($answer_meta as $ans_indx => $ans_meta ){

								$answer  = isset($ans_meta['answer']) ? $ans_meta['answer'] : '';
								$correct = isset($ans_meta['correct']) ? $ans_meta['correct'] : '';
								$ansid   = 'q_'.$index.'_ans_'.$ans_indx;

							?>
								<div class="row wqt-answers-clone">
									<div class="col-md-2 wqt-correct-answr">
										<div class="form-group">
											<label>
												<input type="hidden" name="wqt[<?php echo esc_attr($index); ?>][answer_meta][<?php echo esc_attr($ans_indx); ?>][ans_id]" value="<?php echo esc_attr($ansid); ?>" data-metatype="ans_id" class="wqt-meta-ans wqt-handle-ans-val">
												<?php if ($ans_check2 == 'single_ans') {
												?>
												<input type="checkbox" name="wqt[<?php echo esc_attr($index); ?>][answer_meta][<?php echo esc_attr($ans_indx); ?>][correct]" class="wqt-meta-ans wqt-rm-ad-class wqt-meta-ans-check" data-metatype="correct" <?php checked( $correct , 'on' ); ?>>
												<?php
												} else {
												?>
												<input type="checkbox" name="wqt[<?php echo esc_attr($index); ?>][answer_meta][<?php echo esc_attr($ans_indx); ?>][correct]" class="wqt-meta-ans wqt-rm-ad-class" data-metatype="correct" <?php checked( $correct , 'on' ); ?>>
												<?php
												}
												?>
												<span><?php _e('Correct', 'wqt'); ?></span>
											</label>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label><?php _e('Answer', 'wqt'); ?></label>
											<input type="text" name="wqt[<?php echo esc_attr($index); ?>][answer_meta][<?php echo esc_attr($ans_indx); ?>][answer]" class="form-control wqt-meta-ans" data-metatype="answer" value="<?php  echo esc_attr($answer); ?>">
										</div>
									</div>
									<div class="col-md-2 new-ans-add">
										<div class="form-group wqt-add-rm-controle">
											<button class="btn btn-success wqt-add-answers" data-index="<?php echo esc_attr($index); ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>
							<?php } ?>
							<input type="hidden" name="wqt_answer_id0" class="wqt_answer_id0" value="<?php echo esc_attr($ans_indx); ?>">
						</div>
					</div>	
				</div>
			</div>

		</li>
			<input type="hidden" name="wqt_question_id0" class="wqt_question_id0" value="<?php echo esc_attr($index); ?>">
		<?php 
		} 
		?>
	</ul>
</div>
<div class="wqt_wrapper">
	<button class="btn btn-success wqt-add-question"><?php echo _e('Add Questions', 'wqt'); ?></button>
</div>