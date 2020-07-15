<?php

namespace Xtheme_Club\Live;

use function Xtheme_Club\convert_to_hyphen_string;
use const Xtheme_Club\DS;

class Live_Page {
	public $args;

	public static $conditional = false;

	public function __construct( $args ) {
		$this->args = $args;
		if ( empty( $args['slug'] ) ) {
			$this->args['slug'] = convert_to_hyphen_string( $this->args['title'] );
		}

		add_filter( 'the_posts', [ $this, 'create_virtual_page' ] );
	}

	public function create_virtual_page( $posts ) {
		global $wp, $wp_query;

		// Check if user is requesting our virtual page.
		if ( ( count( $posts ) === 0 && strtolower( $wp->request ) === $this->args['slug'] ) || ( isset( $wp->query_vars['page_id'] ) && $wp->query_vars['page_id'] === (string) $this->args['ID'] ) ) {
			$post                 = new \stdClass();
			$post->post_author    = 1;
			$post->post_name      = $this->args['slug'];
			$post->guid           = get_bloginfo( 'wpurl' . DS . $this->args['slug'] );
			$post->post_title     = $this->args['title'];
			$post->post_content   = json_decode( wp_remote_get( $this->args['content'] )['body'], true )['content']['rendered'];
			$post->ID             = $this->args['ID']; // Just needs to be a number - negatives are fine
			$post->post_type      = 'page';
			$post->post_status    = 'static';
			$post->comment_status = 'closed';
			$post->ping_status    = 'closed';
			$post->comment_count  = 0;
			// Dates may need to be overwritten if you have a "recent posts" widget or similar - set to whatever you want
			$post->post_date     = current_time( 'mysql' );
			$post->post_date_gmt = current_time( 'mysql', 1 );

			$posts   = null;
			$posts[] = (object) $post;

			$wp_query->is_page     = true;
			$wp_query->is_singular = true;
			$wp_query->is_home     = false;
			$wp_query->is_archive  = false;
			$wp_query->is_category = false;
			$wp_query->is_404      = false;

			unset( $wp_query->query['error'] );
			$wp_query->query_vars['error'] = '';

			self::$conditional = ! empty( $this->args['conditional'] ) ? $this->args['conditional'] : false;

			add_filter( 'page_template', [ $this, 'set_page_template' ] );
			add_filter( 'body_class', [ $this, 'add_body_class' ] );
		}

		return $posts;
	}

	public function set_page_template( $template ) {
		if ( empty( $this->args['page_template'] ) ) return $template;

		return get_theme_file_path( $this->args['page_template'] );
	}

	public function add_body_class( $classes ) {
		if ( empty( $this->args['body_class'] ) ) return $classes;

		$classes[] = $this->args['body_class'];

		return $classes;
	}
}
