<?php

namespace Xtheme_Club;

class Welcome {
	public $config, $recommend_plugins;

	public function __construct() {
		$this->recommend_plugins = get_support( 'recommend_plugins' );
		$this->config = [
			'page_title'           => sprintf(
				/* translators: %s: theme name */
				esc_html__( 'About %s', 'jordy' ),
				THEME_NAME
			),
			'menu_slug'            => THEME_SLUG . '-welcome',
			'menu_title'           => THEME_NAME,
			'welcome_title'        => sprintf(
				/* translators: 1: theme name, 2: theme version */
				esc_html__( 'Welcome to %1$s - Version %2$s', 'jordy' ),
				THEME_NAME,
				THEME_VERSION
			),
			'welcome_admin_notice' => [
				'content'  => sprintf(
					/* translators: %s: theme name */
					__( 'Thank you for choosing %s! To fully take advantage of the best our theme can offer please make sure you visit our welcome page.', 'jordy' ),
					THEME_NAME
				),
				'url_text' => __( 'Go to Welcome Page', 'jordy' ),
			],
			'text'                 => [
				'install'  => __( 'Install Now', 'jordy' ),
				'activate' => __( 'Activate', 'jordy' ),
				'detail'   => __( 'Detail', 'jordy' ),
			],
			'tabs_nav'             => [
				__( 'Getting Started', 'jordy' ),
				__( 'Recommended Plugins', 'jordy' ),
				__( 'Import Demo Data', 'jordy' ),
				__( 'Changelog', 'jordy' ),
			],
			'getting_started'      => [
				'customizer' => [
					'title'   => __( 'Go to the Customizer', 'jordy' ),
					'content' => sprintf(
						/* translators: %s: theme name */
						__( 'Using the WordPress Customizer you can easily customize every aspect of %s theme.', 'jordy' ),
						THEME_NAME
					),
					'link'    => [
						'url'    => admin_url( 'customize.php' ),
						'text'   => __( 'Start Customize', 'jordy' ),
						'target' => '_self',
						'class'  => 'button-primary',
					],
				],
				'support'    => [
					'title'   => __( 'Having Trouble, Need Support?', 'jordy' ),
					'content' => sprintf(
						/* translators: %s: theme name */
						__( 'Support for %s theme is conducted through WordPress forum system.', 'jordy' ),
						THEME_NAME
					),
					'link'    => [
						'url'    => sprintf( 'https://wordpress.org/support/theme/%s/', THEME_SLUG ),
						'text'   => __( 'Create a New Topic', 'jordy' ),
						'target' => '_blank',
						'class'  => 'button-secondary',
					],
				],
			],
		];

		add_action( 'admin_menu', [ $this, 'create_welcome_menu' ] );

		add_action( 'load-themes.php', [ $this, 'activation_admin_notice' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	public function create_welcome_menu() {
		$count = $this->get_recommended_action_count();

		if ( $count > 0 ) {
			/* translators: 1: actions count */
			$update_label = sprintf( _n( '%1$s recommend action', '%1$s recommend actions', $count, 'jordy' ), $count );
			$number       = sprintf( '<span class="update-plugins count-%1$s" title="%2$s"><span class="update-count">%3$s</span></span>', esc_attr( $count ), esc_attr( $update_label ), number_format_i18n( $count ) );
			$menu_title   = sprintf( '%1$s %2$s', $this->config['menu_title'], $number );
		} else {
			$menu_title = $this->config['menu_title'];
		}

		add_theme_page( $this->config['page_title'], $menu_title, 'edit_theme_options', $this->config['menu_slug'], [
			$this,
			'theme_info',
		] );
	}

	public function activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ( 'themes.php' === $pagenow ) && isset( $_GET['activated'] ) ) { // WPCS: CSRF ok.
			add_action( 'admin_notices', [ $this, 'welcome_admin_notice' ], 99 );
		}
	}

	public function enqueue_admin_scripts( $hook ) {
		if ( $hook === 'widgets.php' || $hook === 'appearance_page_' . $this->config['menu_slug'] ) {
			wp_enqueue_style( THEME_SLUG, parent_theme_uri( CORE_CSS_DIR . 'admin.css' ) );
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_script( 'plugin-install' );
			wp_enqueue_script( 'updates' );
			add_thickbox();
		}
	}

	public function welcome_admin_notice() {
		$html = '<div class="updated notice is-dismissible">';
		$html .= '<p>';
		$html .= $this->config['welcome_admin_notice']['content'];
		$html .= '</p>';
		$html .= '<p>';
		$html .= sprintf( '<a href="?page=%1$s" class="button button-primary">%2$s</a>', $this->config['menu_slug'], $this->config['welcome_admin_notice']['url_text'] );
		$html .= '</p>';
		$html .= '</div>';

		echo wp_kses_post( $html );
	}

	public function theme_info() {
		$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : null; // WPCS: CSRF ok.

		$html = '<div class="wrap about-wrap theme_info_wrapper">';
		$html .= sprintf( '<h1>%s</h1>', $this->config['welcome_title'] );
		$html .= sprintf( '<div class="about-text">%s</div>', THEME_DESCRIPTION );
		$html .= sprintf( '<h2 class="nav-tab-wrapper">%s</h2>', $this->tabs_navigation( $active_tab ) );

		if ( is_null( $active_tab ) ) {
			$html .= $this->tab_getting_started();
		} elseif ( $active_tab === 'recommended_actions' ) {
			$html .= $this->tab_recommended_actions( $this->recommend_plugins );
		} elseif ( $active_tab === 'ocdi' ) {
			$html .= $this->tab_ocdi();
		} elseif ( $active_tab === 'changelog' ) {
			$html .= $this->tab_changelog();
		}

		$html .= '</div>';

		echo wp_kses( $html, 'default' );
	}

	public function tabs_navigation( $active_tab ) {
		$count = $this->get_recommended_action_count();

		$tabs = sprintf(
			'<a href="?page=%1$s" class="nav-tab %2$s">%3$s</a>',
			$this->config['menu_slug'],
			is_null( $active_tab ) ? 'nav-tab-active' : null,
			$this->config['tabs_nav'][0]
		);

		if ( $count > 0 ) {
			$tabs .= sprintf(
				'<a href="?page=%1$s&tab=recommended_actions" class="nav-tab %2$s">%3$s%4$s</a>',
				$this->config['menu_slug'],
				$active_tab === 'recommended_actions' ? 'nav-tab-active' : null,
				$this->config['tabs_nav'][1],
				"<span class='theme-action-count'>$count</span>"
			);
		}

		$tabs .= sprintf(
			'<a href="?page=%1$s" class="nav-tab %2$s">%3$s</a>',
			class_exists( 'OCDI_Plugin' ) ? Beginning::$import->settings['menu_slug'] : $this->config['menu_slug'] . '&tab=ocdi',
			$active_tab === 'ocdi' ? 'nav-tab-active' : null,
			$this->config['tabs_nav'][2]
		);

		$tabs .= sprintf(
			'<a href="?page=%1$s&tab=changelog" class="nav-tab %2$s">%3$s</a>',
			$this->config['menu_slug'],
			$active_tab === 'changelog' ? 'nav-tab-active' : null,
			$this->config['tabs_nav'][3]
		);

		return $tabs;
	}

	public function tab_getting_started() {
		$html = '<div class="theme_info info-tab-content"><div class="theme_info_column clearfix">';
		$html .= '<div class="theme_info_left">';
		foreach ( $this->config['getting_started'] as $block ) {
			$html .= '<div class="theme_link">';
			$html .= sprintf( '<h3>%s</h3>', $block['title'] );
			$html .= sprintf( '<p class="about">%s</p>', $block['content'] );
			$html .= sprintf( '<p><a href="%1$s" class="button %2$s" target="%3$s">%4$s</a></p>', $block['link']['url'], $block['link']['class'], $block['link']['target'], $block['link']['text'] );
			$html .= '</div>';
		}
		$html .= '</div>';
		$html .= '<div class="theme_info_right">';
		$html .= sprintf( '<img src="%s" alt="" />', parent_theme_uri( 'screenshot.jpg' ) );
		$html .= '</div>';
		$html .= '</div></div>';

		return $html;
	}

	public function tab_recommended_actions( $recommend_plugins ) {
		$html = '<div class="action-required-tab info-tab-content"><div id="plugin-filter" class="recommend-plugins action-required">';
		foreach ( $recommend_plugins as $plugin_slug => $plugin_name ) :
			$html .= $this->render_recommend_plugin( $plugin_slug, $plugin_name );
		endforeach;
		$html .= '</div></div>';

		return $html;
	}

	public function tab_ocdi() {
		$link = sprintf( '<a class="thickbox open-plugin-details-modal" href="%1$s">%2$s</a>', $this->create_detail_link( 'one-click-demo-import' ), __( 'One Click Demo Import', 'jordy' ) );
		$html = '<div class="demo-import-tab-content info-tab-content"><div id="plugin-filter" class="demo-import-boxed">';
		$html .= '<p>';
		/* translators: %s: plugin detail popup link */
		$html .= sprintf( __( 'Hey, you will need to install and activate the %s plugin first.', 'jordy' ), $link );
		$html .= '</p>';
		$html .= $this->render_recommend_plugin( 'one-click-demo-import', '', [
			'before'                  => '',
			'after'                   => '',
			'show_plugin_name'        => false,
			'show_plugin_detail_link' => false,
		] );
		$html .= '</div></div>';

		return $html;
	}

	public function tab_changelog() {
		$html = '<div class="changelog info-tab-content">';
		$html .= $this->get_changelog();
		$html .= '</div>';

		return $html;
	}

	private function render_recommend_plugin( $plugin_slug, $plugin_name, $args = [] ) {
		$plugin_path = $this->get_plugin_path( $plugin_slug );

		if ( is_plugin_active( $plugin_path ) ) return null;

		$args = wp_parse_args( $args, [
			'before'                  => '<div class="rcp">',
			'after'                   => '</div>',
			'show_plugin_name'        => true,
			'show_plugin_detail_link' => true,
		] );

		$plugin_is_installed = is_dir( WP_PLUGIN_DIR . DS . $plugin_slug );

		if ( $plugin_is_installed ) {
			$action_link = sprintf(
				'<a href="%1$s" data-slug="%2$s" class="activate-now button-primary">%3$s</a>',
				$this->create_action_link( 'activate', $plugin_path, $plugin_slug ),
				$plugin_slug,
				$this->config['text']['activate']
			);
		} else {
			$action_link = sprintf(
				'<a href="%1$s" data-slug="%2$s" class="install-now button">%3$s</a>',
				$this->create_action_link( 'install', $plugin_path, $plugin_slug ),
				$plugin_slug,
				$this->config['text']['install']
			);
		}

		$render_html = $args['before'];

		if ( ! empty( $args['show_plugin_name'] ) ) {
			$render_html .= sprintf( '<h4 class="rcp-name">%s</h4>', $plugin_name );
		}

		$render_html .= sprintf( '<p class="action-btn plugin-card-%1$s">%2$s</p>', $plugin_slug, $action_link );

		if ( ! empty( $args['show_plugin_detail_link'] ) ) {
			$render_html .= sprintf(
				'<a class="plugin-detail thickbox open-plugin-details-modal" href="%1$s">%2$s</a>',
				$this->create_detail_link( $plugin_slug ),
				$this->config['text']['detail']
			);
		}

		$render_html .= $args['after'];

		return $render_html;
	}

	private function create_detail_link( $plugin_slug ) {
		$query = [
			'tab'       => 'plugin-information',
			'plugin'    => $plugin_slug,
			'TB_iframe' => 'true',
			'width'     => '772',
			'height'    => '349',
		];

		$detail_link = add_query_arg( $query, network_admin_url( 'plugin-install.php' ) );

		return $detail_link;
	}

	private function get_recommended_action_count( $action_count = 0 ) {
		if ( empty( $this->recommend_plugins ) ) return $action_count;

		foreach ( $this->recommend_plugins as $plugin_slug => $plugin_name ) {
			$plugin_path = $this->get_plugin_path( $plugin_slug );

			if ( ! is_plugin_active( $plugin_path ) ) $action_count++;
		}

		return $action_count;
	}

	private function get_changelog( $html = '' ) {
		$readme_content = get_file_content( parent_theme_path( 'readme.txt' ) );

		if ( is_wp_error( $readme_content ) ) return null;

		$readme_content = explode( PHP_EOL, $readme_content );

		foreach ( $readme_content as $readme_line ) {
			if ( substr( $readme_line, 0, 2 ) === '= ' ) {
				$changelog_line = str_replace( '= ', 'Version ', $readme_line );
				$changelog_line = str_replace( ' =', '', $changelog_line );

				$html .= "<h2>$changelog_line</h2>";
			} elseif ( substr( $readme_line, 0, 1 ) === '*' ) {
				$changelog_line = str_replace( '*', '-', $readme_line );

				$html .= "<p>$changelog_line</p>";
			}
		}

		return $html;
	}

	private function get_plugin_path( $plugin_slug ) {
		return sprintf( '%1$s/%1$s.php', $plugin_slug );
	}

	private function create_action_link( $state, $plugin_path, $plugin_slug ) {
		switch ( $state ) {
			case 'install':
				$query       = [
					'action' => 'install-plugin',
					'plugin' => $plugin_slug,
				];
				$install_url = add_query_arg( $query, network_admin_url( 'update.php' ) );
				$install_url = wp_nonce_url( $install_url, 'install-plugin_' . $plugin_slug );

				return $install_url;

			case 'activate':
				$query        = [
					'action'        => 'activate',
					'plugin'        => rawurlencode( $plugin_path ),
					'plugin_status' => 'all',
					'paged'         => '1',
					'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $plugin_path ),
				];
				$activate_url = add_query_arg( $query, network_admin_url( 'plugins.php' ) );

				return $activate_url;
		}
	}
}
