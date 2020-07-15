<?php

namespace Xtheme_Club;

class Comment_Template extends \Walker_Comment {
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-meta">
				<div class="comment-author">
					<?php if ( $args['avatar_size'] !== 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
			</div>

			<div class="comment-content">
				<div class="comment-author-link">
					<?php comment_author_link( $comment ); ?>
				</div>

				<div class="comment-metadata">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php echo esc_html( get_comment_date( '', $comment ) ); ?>
					</time>

					<?php edit_comment_link( __( 'Edit', 'jordy' ), '<span class="edit-link">', '</span>' ); ?>

					<?php
					comment_reply_link( array_merge( $args, [
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					] ) );
					?>
				</div>

				<?php if ( $comment->comment_approved === '0' ) : ?>
					<p class="comment-awaiting-moderation">
						<?php esc_html_e( 'Your comment is awaiting moderation.', 'jordy' ); ?>
					</p>
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>
		</article>
		<?php
	}
}
