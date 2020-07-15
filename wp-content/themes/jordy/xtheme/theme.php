<?php

namespace Xtheme_Club;

use Xtheme_Club\Widgets\Author;
use Xtheme_Club\Widgets\Better_Menu;
use Xtheme_Club\Widgets\Instagram;

final class Theme extends Core {
	public function register_scripts() {
		add_theme_support( GOOGLE_FONTS, 'Poppins=400,500,600,700&Playfair_Display=700' );

		add_theme_support( 'css', [
			handle( GOOGLE_FONTS ) => [
				'src' => get_gg_fonts_url(),
			],
			THEME_SLUG             => [
				'src'     => parent_theme_uri( 'style.css' ),
				'has_rtl' => true,
			],
		] );

		add_theme_support( 'js', [
			THEME_SLUG => [
				'src'      => parent_theme_uri( 'assets/js/theme.js' ),
				'have_min' => true,
			],
		] );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( handle( GOOGLE_FONTS ) );
		wp_enqueue_style( THEME_SLUG );

		wp_enqueue_script( THEME_SLUG );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

		wp_localize_script( THEME_SLUG, 'themeScriptParams', [
			'nav' => $GLOBALS['wp_query']->max_num_pages,
		] );
	}

	public function register_widgets() {
		add_theme_support( 'widget_areas', [
			'sidebar' => [
				'name'        => esc_html__( 'Sidebar', 'jordy' ),
				'description' => esc_html__( 'Add widgets here.', 'jordy' ),
			],
			'instagram' => [
				'name'        => esc_html__( 'Instagram', 'jordy' ),
				'description' => esc_html__( 'Add widgets here.', 'jordy' ),
			],
		] );

		add_theme_support( 'widgets', [
			Better_Menu::class,
			Instagram::class,
			Author::class,
		] );
	}

	public function register_features() {
		add_theme_support( 'menus', [
			'primary' => esc_html__( 'Primary', 'jordy' ),
		] );

		add_theme_support( 'recommend_plugins', [
			'one-click-demo-import' => esc_html__( 'One Click Demo Import', 'jordy' ),
		] );

		add_theme_support( 'social_menu', 'hint=bottom' );

		add_theme_support( 'breadcrumb' );
	}

	public function register_image_sizes() {
		add_image_size( 'hero', [
			'desktop' => false,
			'tablet'  => false,
			'mobile'  => [
				'width'  => baseline( 53 ),
				'height' => baseline( 30 ),
			],
		] );

		add_image_size( 'large', [
			'desktop' => false,
			'tablet'  => false,
			'mobile'  => [
				'width'  => 670,
				'height' => 451,
			],
		] );

		add_image_size( 'single', [
			'desktop' => false,
			'tablet' => false,
			'mobile' => [
				'width'  => baseline( 35 ),
				'height' => baseline( 20 ),
			],
		] );

		add_image_size( 'blog', [
			'desktop' => false,
			'tablet'  => false,
			'mobile'  => [
				'width'  => baseline( 16.5 ),
				'height' => baseline( 11 ),
			],
		] );
	}
}
