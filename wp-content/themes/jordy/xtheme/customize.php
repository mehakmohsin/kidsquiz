<?php

namespace Xtheme_Club;

class Customize {
	public function __construct() {
		add_action( 'customize_preview_init', [ $this, 'enqueue_scripts' ] );

		add_action( 'customize_register', [ $this, 'live_edit_title_desc' ] );
		add_action( 'customize_register', [ $this, 'add_hero_section' ] );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( handle( 'live-customize' ), parent_theme_uri( CORE_JS_DIR . 'live_customize.js' ), [ 'customize-preview' ], false, true );
		wp_enqueue_script( handle( 'live-title-desc' ), parent_theme_uri( CORE_JS_DIR . 'live_title_desc.js' ), [ 'customize-preview' ], false, true );
	}

	public function live_edit_title_desc( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	public function add_hero_section( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section( 'hero', [
			'title'       => esc_html__( 'Hero', 'jordy' ),
			'description' => esc_html__( 'Choose a tag for hero block', 'jordy' ),
			'priority'    => 1,
			'capability'  => 'edit_theme_options',
		] );

		$wp_customize->add_setting( 'hero_tag', [
			'default'           => 'featured',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'Xtheme\sanitize_select',
		] );

		$wp_customize->add_control( 'hero_tag', [
			'label'    => esc_html__( 'Hero Tag', 'jordy' ),
			'section'  => 'hero',
			'type'     => 'select',
			'choices'  => get_all_post_tags(),
		] );

		$wp_customize->selective_refresh->add_partial( 'hero_tag', [
			'selector'            => '.hero',
			'settings'            => 'hero_tag',
			'container_inclusive' => true,
			'render_callback'     => function() {
				get_template_part( 'template-parts/hero' );
			},
		] );
	}
}
