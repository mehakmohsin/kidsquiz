<?php

if ( post_password_required() ) {
	return;
}

echo '<div id="comments" class="comments-area">';

if ( have_comments() ) {
	$title = '<h4 class="comments-title">';
	$title .= sprintf(
		/* translators: 1: number of comments */
		_nx( '%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'jordy' ),
		number_format_i18n( get_comments_number() )
	);
	$title .= '</h4>';

	echo wp_kses_post( $title );

	the_comments_navigation( [
		'prev_text' => '<span>&larr;</span>' . esc_html__( 'Older comments', 'jordy' ),
		'next_text' => esc_html__( 'Newer comments', 'jordy' ) . '<span>&rarr;</span>',
	] );

	echo '<ol class="comment-list">';
	wp_list_comments();
	echo '</ol>';

	the_comments_navigation( [
		'prev_text' => '<span>&larr;</span>' . esc_html__( 'Older comments', 'jordy' ),
		'next_text' => esc_html__( 'Newer comments', 'jordy' ) . '<span>&rarr;</span>',
	] );
}

if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	printf( '<p class="no-comments">%s</p>', esc_html__( 'Comments are closed.', 'jordy' ) );
}

comment_form();

echo '</div>';
