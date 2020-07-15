<?php  
/* ===== Show the question form id ===== */


/* ==== Not run if accessed directly ===== */
    if( ! defined("ABSPATH" ) )
        die("Not Allewed");
    
   	global $post;
?>
<div class="wqt_wrapper wqt-shortcode">
	<p><?php echo sprintf(__('[wqt-question id="%s"]',"wqt"),$post->ID); ?></p>
</div>