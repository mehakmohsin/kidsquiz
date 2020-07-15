<?php
if ( ! function_exists( 'childcare_comment' ) ) :
    
function childcare_comment( $comment, $args, $depth ) 

{
	global $comment_data;
	
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	esc_html__('REPLY','childcare');?>

			<a class="pull_left_comment" href="#">
			    
			   <?php echo get_avatar($comment,$size = '75'); ?>

			</a>

			<div class="media-body">

				<div class="comment_detail">

				<h4 class="comment_detail_title"><?php comment_author();?></h4>

				<div class="reply"><a href="#"><i class="fa fa-comment-o"></i><?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a></div>

				<span class="comment_date"><?php comment_date('F j, Y');?>&nbsp;<?php esc_html_e('at','childcare');?>&nbsp;<?php comment_time('g:i a'); ?></span>

				<?php comment_text() ;?>

			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'childcare' ); ?></em>

				<br/>

				<?php endif; ?>

			</div>

<?php

}

endif;

add_filter('get_avatar','childcare_add_gravatar_class');

function childcare_add_gravatar_class($class) {

    $class = str_replace("class='comment_img'", "class='author-image'", $class);

    return $class;

} ?>