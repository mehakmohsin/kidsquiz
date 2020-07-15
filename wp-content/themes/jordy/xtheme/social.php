<?php

namespace Xtheme_Club;

class Social {
	public $args;

	public $icons;

	protected static $default_icons = [
		'500px.com'       => '500px',
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'email',
		'medium.com'      => 'medium',
		'meetup.com'      => 'meetup',
		'pinterest.com'   => 'pinterest',
		'reddit.com'      => 'reddit',
		'smugmug.net'     => 'smugmug',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	];

	public function __construct() {
		$this->args = wp_parse_args( get_support( 'social_menu' ), [
			'theme_location' => 'social',
			'menu_desc'      => esc_html__( 'Social', 'jordy' ),
			'menu_class'     => 'social-menu',
			'widget'         => false,
		] );

		$this->icons = wp_parse_args( get_support( 'icons' ), self::$default_icons );

		// Register social menu.
		register_nav_menus( [ $this->args['theme_location'] => $this->args['menu_desc'] ] );

		// Change SVG icon inside social links menu if there is supported URL.
		add_filter( 'walker_nav_menu_start_el', [ $this, 'nav_menu_social_icons' ], 10, 4 );

		add_action( 'xtheme/h/social_menu', [ $this, 'the_menu' ] );
	}

	public function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
		if ( $args->theme_location !== $this->args['theme_location'] ) return $item_output;

		foreach ( $this->icons as $icon_uri => $icon_name ) {
			if ( strpos( $item_output, $icon_uri ) !== false ) {
				if ( empty( $this->args['hint'] ) ) {
					$icon = sprintf( '<i class="fab fa-%s"></i>', $icon_name );
				} else {
					$icon = sprintf(
						'<span class="hint--%s" aria-label="%s"><i class="fab fa-%s"></i></span>',
						$this->args['hint'],
						ucfirst( str_replace( '-', ' ', $icon_name ) ),
						$icon_name
					);
				}

				$item_output = str_replace( $args->link_after, $args->link_after . $icon, $item_output );
			}
		}

		return $item_output;
	}

	public function the_menu() {
		return wp_nav_menu( [
			'theme_location' => $this->args['theme_location'],
			'menu_class'     => $this->args['menu_class'],
			'container'      => '',
			'depth'          => 1,
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
			'fallback_cb'    => apply_filters( 'xtheme/f/social_menu/fallback', [ $this, 'fallback' ] ),
		] );
	}

	public function fallback() {
		printf(
			'<div>%1$s <a href="%2$s">%3$s</a>.</div>',
			esc_html__( 'No social menu have been created yet.', 'jordy' ),
			$GLOBALS['wp_customize'] instanceof \WP_Customize_Manager ? "javascript: wp.customize.panel( 'nav_menus' ).focus();" : esc_url( admin_url( 'nav-menus.php' ) ),
			esc_html__( 'Create one', 'jordy' )
		);
	}
}
