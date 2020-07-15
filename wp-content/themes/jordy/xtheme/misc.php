<?php

namespace Xtheme_Club;

/*
 * FRONTEND FUNCTIONS
 */
function first_content_character() {
	if ( post_password_required() ) return null;

	$content = get_the_content();
	$content = trim( preg_replace( "/\[caption.*\[\/caption\]/si", '', $content ) );

	if ( empty( $content ) ) return null;

	$content = preg_replace( "/<figure.*<\/figure>/siU", '', $content );
	$content = preg_replace( "/<div.*embed.*<\/div>/siU", '', $content );

	$content = wp_strip_all_tags( html_entity_decode( $content ) );

	preg_match( '/[\p{Xan}]/u', $content, $results );

	$first_letter = '';

	if ( ! empty( $results ) ) {
		$first_letter = reset( $results );
	} else {
		preg_match( '/[a-zA-Z\d]/', $content, $results );

		if ( ! empty( $results ) ) {
			$first_letter = reset( $results );
		}
	}

	return $first_letter;
}

function the_related_posts( $args = [] ) {
	$args = wp_parse_args( $args, [
		'post_id'       => get_the_ID(),
		'number_posts'  => 3,
		'template_slug' => 'template-parts/post/content',
		'template_name' => get_post_format(),
		'before'        => '',
		'after'         => '',
	] );

	$query_params = [
		'ignore_sticky_posts' => 0,
		'category__in'        => wp_get_post_categories( $args['post_id'] ),
		'posts_per_page'      => $args['number_posts'],
		'post__not_in'        => [ $args['post_id'] ],
	];

	if ( $args['number_posts'] === 0 ) {
		$related_posts = new \WP_Query();
	} else {
		$related_posts = new \WP_Query( $query_params );
	}

	if ( $related_posts->have_posts() ) :
		echo wp_kses( $args['before'], 'default' );

		while ( $related_posts->have_posts() ) :
			$related_posts->the_post();

			get_template_part( $args['template_slug'], $args['template_name'] );
		endwhile;

		wp_reset_postdata();

		echo wp_kses( $args['after'], 'default' );
	endif;
}

function get_featured_image_class() {
	$url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

	list( $width, $height ) = getimagesize( $url );

	$content = get_the_content();

	if ( $width > $height || $width === $height ) {
		$thumb_class = 'featured-landscape';
	} elseif ( empty( $content ) ) {
		$thumb_class = 'featured-no-content';
	} else {
		$thumb_class = 'featured-portrait';
	}

	return $thumb_class;
}

function site_logo() {
	printf( '<a href="%1$s" rel="home">%2$s</a>', esc_url( HOME_URL ), esc_html( get_bloginfo( 'name', 'display' ) ) );
}

function copyright() {
	/* translators: 1: heart symbol, 2: theme author */
	$text = sprintf( __( 'Made with %1$s by %2$s.', 'jordy' ), '<i class="fas fa-heart"></i>', THEME_AUTHOR );

	echo wp_kses_post( $text );
}

function go_to_top() {
	printf( '<span class="go-to-top"><span class="screen-reader-text">%s</span><i class="fas fa-angle-double-up"></i></span>', esc_html__( 'Go to top', 'jordy' ) );
}

/*
 * LAYOUT FUNCTIONS
 */
function get_site_layout() {
	if ( is_page() ) {
		$layout = 'fullwidth';
	} else {
		$layout = 'content-sidebar';
	}

	return $layout;
}

function get_site_mode() {
	return 'container';
}

/*
 * TEMPLATE TAGS FUNCTIONS
 */
function the_post_thumbnail( $args ) {
	if ( ! is_array( $args ) ) {
		$args = Core::$image_sizes[ $args ];
	}

	do_action( 'xtheme/h/thumbnail' );
	new Image( $args );
}

function entry_footer() {
	if ( get_post_type() !== 'post' ) return;

	echo wp_kses_post( post_tags() );
}

function edit() {
	edit_post_link( esc_html__( 'Edit', 'jordy' ), '<span class="edit-link">', '</span>' );
}

function post_date( $atts = [], $echo = true ) {
	$atts = wp_parse_args( $atts, [
		'after'     => '',
		'before'    => '',
		'relative'  => true,
		'format'    => get_option( 'date_format' ),
		'label'     => '',
		'day_depth' => 7,
	] );

	if ( empty( $atts['relative'] ) ) {
		$display = get_the_time( $atts['format'] );
	} else {
		$display = human_time_diff_maybe( get_the_time( 'U' ), $atts['day_depth'] );
	}

	$output = '<time class="entry-time">' . $atts['before'] . $atts['label'] . $display . $atts['after'] . '</time>';
	$output = apply_filters( 'xtheme/f/post/date', $output, $atts );

	if ( empty( $echo ) ) return $output;

	echo wp_kses( $output, 'default' );
}

function post_author( $atts = [] ) {
	if ( ! post_type_supports( get_post_type(), 'author' ) ) return null;

	if ( ! get_the_author() ) return null;

	$atts = wp_parse_args( $atts, [
		'label'  => '',
		'before' => '',
		'after'  => '',
	] );

	$output = '<span class="entry-author">' . $atts['before'] . $atts['label'] . get_the_author() . $atts['after'] . '</span>';

	return apply_filters( 'xtheme/f/post/author', $output, $atts );
}

function post_tags( $atts = [] ) {
	if ( ! is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) return null;

	$atts = wp_parse_args( $atts, [
		'after'  => '',
		'before' => esc_html__( 'Tagged With: ', 'jordy' ),
		'sep'    => ', ',
	] );

	$tags = get_the_tag_list( $atts['before'], trim( $atts['sep'] ) . ' ', $atts['after'] );

	if ( ! $tags ) return null;

	$output = '<span class="entry-tags">' . $tags . '</span>';

	return apply_filters( 'xtheme/f/post/tags', $output, $atts );
}

function post_categories( $atts = [], $echo = true ) {
	if ( ! is_object_in_taxonomy( get_post_type(), 'category' ) ) return null;

	$atts = wp_parse_args( $atts, [
		'sep'    => ', ',
		'before' => '',
		'after'  => '',
	] );

	$cats = get_the_category_list( trim( $atts['sep'] ) . ' ' );

	if ( ! $cats || ! categorized_blog() ) return null;

	$output = '<span class="entry-categories">' . $atts['before'] . $cats . $atts['after'] . '</span>';
	$output = apply_filters( 'xtheme/f/post/categories', $output, $atts );

	if ( empty( $echo ) ) return $output;

	echo wp_kses_post( $output );
}

function post_comments( $atts = [] ) {
	if ( ! post_type_supports( get_post_type(), 'comments' ) ) return null;

	$atts = wp_parse_args( $atts, [
		'after'  => '',
		'before' => '',
		'more'   => esc_html__( '% Comments', 'jordy' ),
		'one'    => esc_html__( '1 Comment', 'jordy' ),
		'zero'   => esc_html__( 'Leave a Comment', 'jordy' ),
	] );

	if ( ! comments_open() ) return null;

	// Darn you, WordPress!
	ob_start();
	comments_number( $atts['zero'], $atts['one'], $atts['more'] );
	$comments = ob_get_clean();

	$comments = sprintf( '<a href="%1$s">%2$s</a>', get_comments_link(), $comments );

	$output = '<span class="entry-comments-link">' . $atts['before'] . $comments . $atts['after'] . '</span>';

	return apply_filters( 'xtheme/f/post/comments', $output, $atts );
}

class Misc {
}
