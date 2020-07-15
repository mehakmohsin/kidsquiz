<?php

namespace Xtheme_Club;

define( __NAMESPACE__ . '\DS', DIRECTORY_SEPARATOR );

define( __NAMESPACE__ . '\HOME_URL', home_url( '/' ) );
define( __NAMESPACE__ . '\THEME_SLUG', get_option( 'template' ) );
define( __NAMESPACE__ . '\THEME_NAME', wp_get_theme( THEME_SLUG )->get( 'Name' ) );
define( __NAMESPACE__ . '\THEME_VERSION', wp_get_theme( THEME_SLUG )->get( 'Version' ) );
define( __NAMESPACE__ . '\THEME_DESCRIPTION', wp_get_theme( THEME_SLUG )->get( 'Description' ) );
define( __NAMESPACE__ . '\THEME_AUTHOR', wp_get_theme( THEME_SLUG )->get( 'Author' ) );
define( __NAMESPACE__ . '\THEME_AUTHOR_URI', esc_url( wp_get_theme( THEME_SLUG )->get( 'AuthorURI' ) ) );

define( __NAMESPACE__ . '\XTHEME', 'xtheme' );
define( __NAMESPACE__ . '\CORE_ASSETS_DIR', XTHEME . DS . 'assets/' );
define( __NAMESPACE__ . '\CORE_IMAGES_DIR', CORE_ASSETS_DIR . 'images/' );
define( __NAMESPACE__ . '\CORE_JS_DIR', CORE_ASSETS_DIR . 'js/' );
define( __NAMESPACE__ . '\CORE_CSS_DIR', CORE_ASSETS_DIR . 'css/' );

define( __NAMESPACE__ . '\GOOGLE_FONTS', 'google-fonts' );

define( __NAMESPACE__ . '\SO_WIDGETS_DIR', 'so-widgets/' );

class Constants {}
