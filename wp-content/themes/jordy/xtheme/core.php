<?php

namespace Xtheme_Club;

abstract class Core {
	/**
	 * @var Setup
	 */
	public static $setup;

	/**
	 * @var Welcome
	 */
	public static $welcome;

	/**
	 * @var Widgets
	 */
	public static $widgets;

	/**
	 * @var Customize
	 */
	public static $customize;

	/**
	 * @var Comment_Setup
	 */
	public static $comment;

	/**
	 * @var Extras
	 */
	public static $extras;

	/**
	 * @var Import
	 */
	public static $import;

	/**
	 * @var Social
	 */
	public static $social;

	/**
	 * @var Icons
	 */
	public static $icons;

	/**
	 * @var Menus
	 */
	public static $menus;

	public static $transient_names, $theme_info, $cached_theme_info, $sass_vars, $image_sizes;

	public function __construct() {
		new Constants();
		$this->setup_vars();
		$this->get_scss_vars();
		$this->clear_transients();
		new Helper();
		$this->register_scripts();
		$this->register_widgets();
		$this->register_features();
		$this->register_image_sizes();
		do_action( 'xtheme/h/before_load' );
		$this->load_core();
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		$this->load_features();
		do_action( 'xtheme/h/after_load' );
	}

	private function setup_vars() {
		self::$transient_names = [
			'theme_info' => 'theme_info',
			'icons'      => 'icons',
			'icons_ver'  => 'icons_ver',
			'sass_vars'  => 'sass_vars',
			'sass_ver'   => 'sass_ver',
			'categories' => 'categories',
		];
		self::$transient_names = preg_filter( '/^/', THEME_SLUG . '_', self::$transient_names );

		self::$theme_info = [
			'siteurl'              => get_option( 'siteurl' ),
			'child_theme_slug'     => get_option( 'stylesheet' ),
			'theme_version'        => wp_get_theme( get_template() )->get( 'Version' ),
			'parent_directory'     => trailingslashit( get_template_directory() ),
			'child_directory'      => trailingslashit( get_stylesheet_directory() ),
			'parent_directory_uri' => trailingslashit( get_template_directory_uri() ),
			'child_directory_uri'  => trailingslashit( get_stylesheet_directory_uri() ),
		];

		if ( ! empty( get_transient( self::$transient_names['theme_info'] ) ) ) {
			self::$cached_theme_info = get_transient( self::$transient_names['theme_info'] );
		} else {
			self::$cached_theme_info = self::$theme_info;
			set_transient( self::$transient_names['theme_info'], self::$cached_theme_info );
		}
	}

	protected function get_scss_vars() {
		self::$sass_vars = get_transient( self::$transient_names['sass_vars'] );
		$db_ver          = (int) get_transient( self::$transient_names['sass_ver'] );
		$path            = get_theme_file_path( 'assets/scss/01.settings/__config.scss' );

		if ( empty( $path ) ) return;

		$live_version = $db_ver;

		if ( filemtime( $path ) > $db_ver ) {
			$live_version = filemtime( $path );
		}

		if ( $db_ver === $live_version ) return;

		$vars         = [];
		$file_content = file( $path, FILE_SKIP_EMPTY_LINES );

		foreach ( $file_content as $line ) {
			$line    = trim( $line );
			$pattern = '/^\\$([\w\-]+):([\s]+)([^;]+);(.*)$/';
			if ( preg_match( $pattern, $line, $matches ) === 1 ) {
				$val                 = substr( $matches[3], 0, 1 ) === '$' ? $vars[ substr( $matches[3], 1 ) ] : $matches[3];
				$vars[ $matches[1] ] = $val;
			}
		}

		if ( count( $vars ) > 0 ) {
			self::$sass_vars = $vars;
			set_transient( self::$transient_names['sass_vars'], $vars );
			set_transient( self::$transient_names['sass_ver'], $live_version );
		}
	}

	protected function clear_transients() {
		if (
			self::$cached_theme_info['child_theme_slug'] !== self::$theme_info['child_theme_slug'] ||
			self::$cached_theme_info['siteurl'] !== self::$theme_info['siteurl'] ||
			self::$cached_theme_info['theme_version'] !== self::$theme_info['theme_version']
		) {
			foreach ( self::$transient_names as $name => $value ) delete_transient( $value );
		}
	}

	abstract public function register_scripts();

	abstract public function register_widgets();

	abstract public function register_features();

	abstract public function register_image_sizes();

	public function load_core() {
		new Wrapper();
		new KSES();
		new Misc();
		new Enqueue();
		new Live_Preview();
		self::$setup     = new Setup();
		self::$welcome   = new Welcome();
		self::$widgets   = new Widgets();
		self::$customize = new Customize();
		self::$comment   = new Comment_Setup();
		self::$extras    = new Extras();
		if ( class_exists( 'OCDI_Plugin' ) ) {
			self::$import = new Import();
		}
	}

	abstract public function enqueue_scripts();

	public function load_features() {
		if ( current_theme_supports( 'menus' ) ) {
			self::$menus = new Menus();
		}
		if ( current_theme_supports( 'social_menu' ) ) {
			self::$social = new Social();
		}
	}
}
