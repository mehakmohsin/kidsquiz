<?php

namespace Xtheme_Club;

class Widgets {
	public $register_widget_areas;
	public $register_widgets;

	public function __construct() {
		$this->register_widgets      = get_support( 'widgets' );
		$this->register_widget_areas = get_support( 'widget_areas' );

		add_action( 'widgets_init', [ $this, 'register_widget_areas' ] );
		add_action( 'widgets_init', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		foreach ( $this->register_widgets as $widget ) register_widget( $widget );
	}

	public function register_widget_areas() {
		foreach ( $this->register_widget_areas as $id => $args ) $this->register_widget_area( $id, $args );
	}

	protected function register_widget_area( $id, $args ) {
		$args = wp_parse_args( $args, [
			'id'            => $id,
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget__title">',
			'after_title'   => '</h3>',
		] );

		return register_sidebar( $args );
	}
}
