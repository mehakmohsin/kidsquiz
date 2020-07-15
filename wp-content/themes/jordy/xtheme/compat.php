<?php

class Compat {
	public $current_wp_version;
	public $message;
	public $current_php_version = PHP_VERSION;
	public $require_wp_version  = '4.7';
	public $require_php_version = '5.6';
	public $theme_name          = 'Jody';

	public function __construct() {
		$this->current_wp_version = $GLOBALS['wp_version'];

		$this->build_message();

		add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );
		add_action( 'load-customize.php', array( $this, 'customize' ) );
		add_action( 'template_redirect', array( $this, 'preview' ) );
	}

	public function build_message() {
		if ( version_compare( $this->current_wp_version, $this->require_wp_version, '<' ) ) {
			/* translators: 1: theme name, 2: require WordPress version, 3: current WordPress version */
			$this->message = sprintf( __( '%1$s requires at least WordPress version %2$s. You are running version %3$s. Please upgrade and try again.', 'jordy' ), $this->theme_name, $this->require_wp_version, $this->current_wp_version );
		} elseif ( version_compare( $this->current_php_version, $this->require_php_version, '<' ) ) {
			/* translators: 1: theme name, 2: require PHP version, 3: current PHP version */
			$this->message = sprintf( __( '%1$s requires at least PHP version %2$s. You are running version %3$s. Please upgrade and try again.', 'jordy' ), $this->theme_name, $this->require_php_version, $this->current_php_version );
		}
	}

	public function switch_theme() {
		switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

		unset( $_GET['activated'] );

		add_action( 'admin_notices', array( $this, 'notice' ) );
	}

	public function notice() {
		printf( '<div class="error"><p>%s</p></div>', esc_html( $this->message ) );
	}

	public function customize() {
		wp_die( esc_html( $this->message ) );
	}

	public function preview() {
		if ( isset( $_GET['preview'] ) ) wp_die( esc_html( $this->message ) ); // WPCS: CSRF ok.
	}
}

new Compat();
