<?php

namespace Xtheme_Club;

class Enqueue {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_js' ] );
	}

	public function register_css() {
		foreach ( get_support( 'css' ) as $handle => $args ) {
			$args = wp_parse_args( $args, [
				'deps'    => false,
				'version' => null,
				'media'   => 'all',
				'has_rtl' => false,
			] );

			wp_register_style( $handle, esc_url( $args['src'] ), $args['deps'], $this->flatten_version( $args['version'] ), $args['media'] );

			if ( $args['has_rtl'] ) wp_style_add_data( $handle, 'rtl', 'replace' );
		}
	}

	public function register_js() {
		foreach ( get_support( 'js' ) as $handle => $args ) {
			$args = wp_parse_args( $args, [
				'deps'      => [],
				'version'   => null,
				'in_footer' => true,
				'have_min'  => false,
			] );
			$args = apply_filters( 'xtheme/f/enqueue/js/args', $args );

			$src = $args['have_min'] === true ? str_replace( '.js', '.min.js', $args['src'] ) : $args['src'];

			wp_register_script( $handle, esc_url( $src ), $args['deps'], $this->flatten_version( $args['version'] ), $args['in_footer'] );
		}
	}

	private function flatten_version( $version ) {
		if ( empty( $version ) ) return null;

		$parts = explode( '.', $version );

		if ( count( $parts ) === 2 ) {
			$parts[] = '0';
		}

		return implode( '', $parts );
	}
}
