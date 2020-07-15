<?php 

/*===== Dashboard File show stat =====*/  

/* ===== Direct access not allowed ===== */
if( ! defined('ABSPATH' ) ){ exit; }
    
	$dashboard_class  = WQTDASHBOARD();
	$quiz_form        = $dashboard_class->get_all_cpt_wqt();
	$result_form      = $dashboard_class->get_all_cpt_wqt_result();
	
?>

<div class="wqt_wrapper container-fluid wqt-dashboard-wrapper wrap">
	<h3><?php _e('WP Simple Quiz Dashboard' , 'wqt'); ?></h3>
    <div class="row">  
        <div class="col-lg-6 col-md-6 wqt-show-users">
            <div class="panel">
                <div class="panel-heading">
                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                    <span><?php _e('Quiz Stat', 'wqt'); ?></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="wqt-quiz-form-stat">
                            <ul class="list-group">
	                        	<div class="col-md-6">
	                                <li>
	                                    <h5><?php _e('Quiz Form' , 'wqt'); ?>
	                                        <span class="label label-info">
	                                            <?php echo count($quiz_form); ?>
	                                        </span>
	                                    </h5>
	                                </li>
	                        	</div>
	                        	<div class="col-md-6">
	                                <li>
	                                    <h5><?php _e('Attemp Quiz Users' , 'wqt'); ?>
	                                        <span class="label label-info">
	                                            <?php echo count($result_form); ?>
	                                        </span>
	                                    </h5>
	                                </li>            		
	                        	</div>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<table class="table table-bordered wqt-table-stat">
					        	<tr>
					            	<th><?php _e('Quiz Name' , 'wqt'); ?></th>
					            	<th><?php _e('Total Questions', 'wqt'); ?></th>
					            	<th><?php _e('Submission User', 'wqt'); ?></th>
					            	<th><?php _e('Total Marks', 'wqt'); ?></th>
					            	<th><?php _e('Visibilty', 'wqt'); ?></th>
					        	</tr> 
					        	<?php foreach ($quiz_form as $index => $meta) { 

					        		$question_class   = new WQT_Questions($meta->ID); 
					        		$user_role        = get_post_meta($meta->ID, 'wqt_assign_role', 
					        							true); 
					        		$total_sub		  = get_post_meta($meta->ID, 'total_sub', true);

					        		if (empty($total_sub)) {  $total_sub = 0; }

								    if (empty($user_role)) {  $user_role[] = __('Not assign','wqt');  }
					        	?>
					        	<tr class="quiz-form_style">
						            <td><?php echo quiz_form_link($meta->ID,$meta->post_title); ?></td>
						            <td><?php echo $question_class->wqt_total_question_of_quiz(); ?>
						            </td>
						            <td><?php echo $dashboard_class->get_total_submission_against_quiz($meta->ID); ?></td>
						            <td><?php echo $question_class->wqt_cpt_total_marks_before_sumbit(); ?></td>
						            <td><?php echo implode($user_role,","); ?></td>
					        	</tr>
					       		<?php } ?>
			        		</table>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 wqt-show-users">
            <div class="panel">
                <div class="panel-heading">
                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                    <span><?php _e('Result Stat', 'wqt'); ?></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-md-12">
                    		<table class="table table-bordered wqt-table-stat">
					        	<tr>
					            	<th><?php _e('Members Name' , 'wqt'); ?></th>
					            	<th><?php _e('Submitted Quiz' , 'wqt'); ?></th>
					            	<th><?php _e('User Info' , 'wqt'); ?></th>
					            	<th><?php _e('Submitted Date' , 'wqt'); ?></th>
					        	</tr> 
					        	<?php foreach ($result_form as $index => $meta) { 

					        		$quiz_id     = get_post_meta($meta->ID,'wqt_current_id', true);
								    $quiz_name   = get_the_title($quiz_id);

								    $full_name   = get_post_meta($meta->ID, 'full_name', true);
									$createDate  = new DateTime($meta->post_date);
									$sep_date    = $createDate->format('d-m-Y');
					        	?>
					        	<tr class="quiz-form_style">
						            <td><?php echo result_form_link($meta->ID, $full_name );  ?></td>
						            <td><?php echo quiz_form_link($quiz_id,$quiz_name); ?></td>
						            <td><?php echo get_user_info($meta->ID); ?></td>
						            <td><?php echo $sep_date; ?></td>
					        	</tr>
					       		<?php } ?>
			        		</table>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>