<?php

namespace Xtheme_Club;

class Menus {
	public $menu, $main_menu;

	public function __construct() {
		$this->menu      = get_support( 'menus' );
		$this->main_menu = [
			'theme_location' => 'primary',
			'echo'           => false,
		];

		add_action( 'after_setup_theme', [ $this, 'register_nav_menus' ] );
		add_action( 'xtheme/h/main_menu', [ $this, 'main_menu' ] );
		add_action( 'xtheme/h/before/page', [ $this, 'mobile_menu' ] );
	}

	public function register_nav_menus() {
		register_nav_menus( $this->menu );
	}

	public function main_menu( $before = '', $after = '' ) {
		$menu = apply_filters( 'xtheme/f/main_menu', wp_nav_menu( $this->main_menu ) );

		echo wp_kses_post( $before . $menu . $after );
	}

	public function mobile_menu() {
		$this->main_menu( '<nav id="mobile-menu">', '</nav>' );
	}
}
