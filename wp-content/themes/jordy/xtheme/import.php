<?php

namespace Xtheme_Club;

class Import {
	public $settings, $import_files;

	public function __construct() {
		$this->settings = [
			'parent_slug' => 'themes.php',
			'page_title'  => esc_html__( 'One Click Demo Import', 'jordy' ),
			'menu_title'  => esc_html__( 'Import Demo Data', 'jordy' ),
			'capability'  => 'import',
			'menu_slug'   => XTHEME . '-demo-import',
		];

		$this->import_files = [
			[
				'import_file_name'           => 'Demo Import',
				'import_file_url'            => parent_theme_uri( 'demo/content.xml' ),
				'import_widget_file_url'     => parent_theme_uri( 'demo/widgets.json' ),
				'import_customizer_file_url' => parent_theme_uri( 'demo/customizer.dat' ),
			],
		];

		add_filter( 'pt-ocdi/import_files', [ $this, 'import_files' ] );
		add_action( 'pt-ocdi/after_import', [ $this, 'import_menus' ] );
		add_action( 'pt-ocdi/after_import', [ $this, 'import_homepage_settings' ] );

		add_filter( 'pt-ocdi/plugin_page_setup', [ $this, 'plugin_page_setup' ] );

		add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	}

	public function import_files() {
		return $this->import_files;
	}

	public function plugin_page_setup() {
		return $this->settings;
	}

	public function import_homepage_settings() {
		$pages = $this->get_data( 'homepage' );

		if ( is_array( $pages ) ) {
			if ( ! empty( $pages['show_on_front'] ) ) {
				update_option( 'show_on_front', $pages['show_on_front'] );
			}

			if ( ! empty( $pages['page_on_front'] ) ) {
				$page = get_page_by_title( $pages['page_on_front'] );

				update_option( 'page_on_front', $page->ID );
			}

			if ( ! empty( $pages['page_for_posts'] ) ) {
				$page = get_page_by_title( $pages['page_for_posts'] );

				update_option( 'page_for_posts', $page->ID );
			}

			wp_trash_post( 1 ); // Move Hello World post to trash
			wp_trash_post( 2 ); // Move Sample Page to trash
		}
	}

	public function import_menus() {
		$menu_data  = $this->get_data( 'menus' );
		$menu_array = [];

		if ( ! empty( $menu_data ) ) {
			foreach ( $menu_data as $registered_menu => $menu_slug ) {
				$menu_array[ $registered_menu ] = get_term_by( 'slug', $menu_slug, 'nav_menu' )->term_id;
			}

			set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );
		}
	}

	private function get_data( $type ) {
		$file = parent_theme_path( "demo/$type.json" );

		if ( ! file_exists( $file ) ) return '';

		return json_decode( get_file_content( $file ), true );
	}
}
