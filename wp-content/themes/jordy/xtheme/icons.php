<?php

namespace Xtheme_Club;

class Icons {
	public $svg_icons_path;

	public function __construct() {
		$this->svg_icons_path = parent_theme_path( 'assets/images/sprite.symbol.svg' );

		add_action( 'xtheme/h/before/page', [ $this, 'include_svg_icons' ] );
	}

	public function include_svg_icons() {
		$db_ver = (int) get_transient( name( 'icons_ver' ) );

		$live_version = $db_ver;

		if ( filemtime( $this->svg_icons_path ) > $db_ver ) {
			$live_version = filemtime( $this->svg_icons_path );
		}

		if ( $db_ver === $live_version ) {
			echo get_transient( name( 'icons' ) ); // WPCS: xss ok.

			return;
		}

		$svg_content = get_file_content( $this->svg_icons_path );
		$svg_content = str_replace( '<?xml version="1.0" encoding="utf-8"?>', '', $svg_content );

		set_transient( name( 'icons' ), $svg_content );
		set_transient( name( 'icons_ver' ), $live_version );

		echo $svg_content; // WPCS: xss ok.
	}
}
