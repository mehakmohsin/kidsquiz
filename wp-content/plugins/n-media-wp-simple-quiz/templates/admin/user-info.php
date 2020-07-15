<?php

/* ===== Quiz-user info ===== */

	/* ===== Not run if accessed directly ===== */
    if( ! defined("ABSPATH" ) )
    	die("Not Allewed");

	global $post;
	$full_name     = get_post_meta($post->ID, 'full_name', true);
	$user_email    = get_post_meta($post->ID, 'user_email', true);
    
?>

<div class="wqt-result-email-info">
	<label><?php _e('User Name:','wqt'); ?></label> 
	<span><?php echo esc_html($full_name, 'wqt'); ?></span>
	</br>
	<label><?php _e('User Email:','wqt'); ?></label>
	<span><?php echo esc_html($user_email, 'wqt'); ?></span>
</div>