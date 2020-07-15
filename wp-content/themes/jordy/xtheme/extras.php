<?php

namespace Xtheme_Club;

class Extras {
	public $config;

	public function __construct() {
		$this->config = [
			'excerpt_length' => 25,
			'excerpt_more'   => '&hellip;',
			'cat_count_span' => true,
		];

		add_filter( 'get_the_archive_title', [ $this, 'archive_title' ] );

		add_filter( 'excerpt_length', [ $this, 'custom_excerpt_length' ], 999 );
		add_filter( 'excerpt_more', [ $this, 'custom_excerpt_more' ] );

		add_filter( 'post_class', [ $this, 'post_class' ] );
		add_filter( 'body_class', [ $this, 'body_class' ] );

		add_filter( 'the_content', [ $this, 'no_p_tag_around_img' ] );

		add_filter( 'get_archives_link', [ $this, 'cat_count_span' ] );
		add_filter( 'wp_list_categories', [ $this, 'cat_count_span' ] );

		add_action( 'wp_head', [ $this, 'pingback_header' ] );

		add_action( 'wp_head', [ $this, 'theme_meta_generator' ], 1 );

		add_filter( 'wp_resource_hints', [ $this, 'resource_hints' ], 10, 2 );
		add_action( 'script_loader_tag', [ $this, 'add_async' ], 10, 2 );
	}


	public function archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = get_the_author();
		}

		return $title;
	}

	public function custom_excerpt_length() {
		if ( ! is_admin() ) return $this->config['excerpt_length'];
	}

	public function custom_excerpt_more() {
		if ( ! is_admin() ) return $this->config['excerpt_more'];
	}

	public function post_class( $classes ) {
		$classes = str_replace( 'hentry', 'entry', $classes );

		return $classes;
	}

	public function body_class( $classes ) {
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( ! is_singular() ) {
			$classes[] = 'feed';
		}

		if ( is_customize_preview() ) {
			$classes[] = 'customize-preview';
		}

		if ( is_front_page() && is_page_builder() ) {
			$classes[] = 'fixed-header';
		}

		if ( is_page() && ! is_page_builder() ) {
			$classes[] = 'normal-page';
		}

		return $classes;
	}

	public function no_p_tag_around_img( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}

	public function cat_count_span( $links ) {
		if ( ! $this->config['cat_count_span'] ) return null;

		preg_match_all( '#\((.*?)\)#', $links, $matches );
		if ( ! empty( $matches ) ) {
			$i = 0;
			foreach ( $matches[0] as $value ) {
				$links = str_replace( "</a> $value", "</a><span>$value</span>", $links );
				$i++;
			}
		}

		return $links;
	}

	public function pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function theme_meta_generator() {
		$content = sprintf(
			/* translators: 1: theme name, 2: theme version, 3, theme author, 4: child theme active text */
			__( 'This site use %1$s theme v%2$s by %3$s. %4$s', 'jordy' ),
			THEME_NAME,
			THEME_VERSION,
			THEME_AUTHOR,
			is_child_theme() ? __( 'Child theme is activated.', 'jordy' ) : ''
		);

		printf( "\r\n" . '<meta name="generator" content="%s" />' . "\r\n", esc_attr( $content ) );
	}

	public function resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( handle( GOOGLE_FONTS ), 'queue' ) && $relation_type === 'preconnect' ) {
			$urls[] = [
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			];
		}

		return $urls;
	}

	public function add_async( $tag, $handle ) {
		if ( $handle === THEME_SLUG ) return preg_replace( '/(><\/[a-zA-Z][^0-9](.*)>)$/', ' async $1 ', $tag );
		return $tag;
	}
}
