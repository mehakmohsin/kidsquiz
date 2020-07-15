<?php

namespace Xtheme_Club;

class Loader {
	public function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );
	}

	public function autoload( $class_name ) {
		if ( stripos( $class_name, __NAMESPACE__ ) !== 0 ) return;
		$path = get_theme_file_path( strtolower( str_replace( [ '\\', '_Club' ], [ '/', '', ], $class_name ) ) . '.php' );
		if ( file_exists( $path ) ) require_once $path;
	}
}

new Loader();
new Theme;
