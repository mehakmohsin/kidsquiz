<?php

namespace Xtheme_Club;

class Setup {
	public $config;

	public function __construct() {
		$this->config = [
			'content_width'   => 910,
			'post_formats'    => [ 'quote' ],
			'pagination'      => [
				'prev_text'          => '&larr;',
				'next_text'          => '&rarr;',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'jordy' ) . ' </span>',
			],
			'post_navigation' => [
				'prev_text' => esc_html__( 'Previous Post', 'jordy' ),
				'next_text' => esc_html__( 'Next Post', 'jordy' ),
			],
		];

		add_action( 'xtheme/h/before/content__wrapper', [ $this, 'hero' ] );
		add_action( 'xtheme/h/before/content__wrapper', [ $this, 'instagram' ] );

		add_action( 'xtheme/h/after/content__wrapper', [ $this, 'single_instagram' ] );
		add_action( 'xtheme/h/single/bottom', [ $this, 'related_posts' ] );

		add_action( 'xtheme/h/index/bottom', [ $this, 'pagination' ] );
		add_action( 'xtheme/h/general/bottom', [ $this, 'pagination' ] );

		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );
		add_action( 'after_setup_theme', [ $this, 'content_width' ], 0 );

		add_action( 'wp_head', [ $this, 'head' ], -1 );
	}

	public function hero() {
		if ( is_home() && ! is_paged() ) get_template_part( 'template-parts/hero' );
	}

	public function instagram() {
		if ( is_home() && ! is_paged() ) dynamic_sidebar( 'instagram' );
	}

	public function single_instagram() {
		if ( is_single() ) dynamic_sidebar( 'instagram' );
	}

	public function related_posts() {
		the_related_posts( [
			'number_posts' => 2,
			'before'       => '<div class="related-posts" ><h2>' . __( 'You might also like', 'jordy' ) . '</h2>',
			'after'        => '</div>',
		] );
	}

	public function pagination() {
		the_posts_pagination( $this->config['pagination'] );
	}

	public function theme_support() {
		load_theme_textdomain( THEME_SLUG );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', $this->config['post_formats'] );

		add_post_type_support( 'page', 'excerpt' ); // Allow excerpt in page

		add_editor_style( [ 'editor-style.css', get_gg_fonts_url() ] );
	}

	public function content_width() {
		$GLOBALS['content_width'] = $this->config['content_width'];
	}

	public function head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
}
