<?php

/* ===== Show Submit Member List  ===== */

    /* ===== Not run if accessed directly ====*/
    if( ! defined("ABSPATH" ) )
        die("Not Allewed");
    
 	global $post;

 	$dashboard_class = WQTDASHBOARD();
 	$quiz_name       = get_the_title($post->ID);
	$result_form     = $dashboard_class->get_all_cpt_wqt_result();
	
?>
<div class="wqt_submit_member_list">
	<?php
	if (is_array($result_form)) {
		
		foreach ($result_form as $index => $post_meta) {
		
			$quiz_title  = get_post_meta($post_meta->ID, 'quiz_name', true);
			$result_url  = admin_url('post.php').'?post='.$post_meta->ID.'&action=edit';

			if ($quiz_name == $quiz_title ) { ?>
				<div>
					<div class="wqr_submit_member_check" >
				        <label>
				             <?php echo $post_meta->post_title; ?>
				        </label>
				        <span>
				        	<a href="<?php 	echo esc_url($result_url); ?>" target ="_blank" title="See result">
				        		<i class="fa fa-external-link" aria-hidden="true"></i>
				        	</a>
				       </span>
				    </div>
				</div>
				<?php
			}
		}
	}
	if (empty($quiz_name)) {
		echo "No one Submitted This Quiz yet";
	}
?>
</div>