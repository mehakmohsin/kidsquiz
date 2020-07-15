<?php

namespace Xtheme_Club;

class Wrapper {
	private static $main_template;

	private static $base;

	public function __construct() {
		add_filter( 'template_include', [ $this, 'wrap' ], 99 );
	}

	public function wrap( $template ) {
		self::$main_template = $template;

		self::$base = substr( wp_basename( self::$main_template ), 0, -4 );

		if ( 'index' === self::$base ) {
			self::$base = false;
		}

		$templates = [ 'wrapper.php' ];

		if ( self::$base ) {
			array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );
		}

		return locate_template( $templates );
	}

	public static function get_main_template() {
		return self::$main_template;
	}

	public static function get_base() {
		return self::$base;
	}
}
