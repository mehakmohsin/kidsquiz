<?php

namespace Xtheme_Club;

use Xtheme_Club\Live\Live_Image;
use Xtheme_Club\Live\Live_Page;
use Xtheme_Club\Widgets\Instagram;

class Live_Preview {
	public $rest_url = 'http://jordy.xtheme.net/wp-json/wp/v2/pages';
	public $config   = [
		'widget_params'          => 'before_widget=<section class="widget %s">&after_widget=</section>&before_title=<h3 class="widget__title">&after_title=</h3>',
		'live_social_networks'   => [ 'facebook', 'twitter', 'instagram', 'youtube' ],
		'live_pages'             => [
			'Sample Page' => [
				'ID' => -2,
			],
			'Style Guide' => [
				'ID' => -73,
			],
		],
		'live_sidebar_widgets'   => [
			'WP_Widget_Recent_Posts' => 'title=Recent Posts&number=4',
			'WP_Widget_Text'         => 'title=Connect&text=<p>2005 Stokes Isle Apt. 896, Venaville 10010, USA<br> info@yourdomain.com<br> (+68) 120034509</p>',
		],
		'live_instagram_widgets' => [
			Instagram::class => 'title=Instagram Feeds&username=unsplash&number=6&size=large',
		],
	];

	public function __construct() {
		if ( ! is_live_preview() ) return;

		foreach ( $this->config['live_pages'] as $title => $params ) {
			$args          = [];
			$args['title'] = $title;

			if ( empty( $params['content'] ) ) {
				$args['content'] = $this->rest_url( abs( $params['ID'] ) );
			}

			$args = wp_parse_args( $args, $params );

			new Live_Page( $args );
		}

		if ( ! is_active_sidebar( 'sidebar' ) ) {
			add_action( 'dynamic_sidebar_before', [ $this, 'live_sidebar_widgets' ] );
		}

		if ( ! is_active_sidebar( 'instagram' ) ) {
			add_action( 'dynamic_sidebar_before', [ $this, 'live_instagram_widgets' ] );
		}

		add_action( 'xtheme/h/thumbnail', [ $this, 'live_thumbnail' ] );
		add_filter( 'xtheme/f/image/args', [ $this, 'disable_real_thumbnail' ] );

		add_filter( 'xtheme/f/social_menu/fallback', [ $this, 'live_social_menu' ] );
		add_filter( 'xtheme/f/main_menu', [ $this, 'live_main_menu' ] );
	}

	public static function hero() {
		if ( ! is_live_preview() ) {
			return;
		}

		$hello = new \WP_Query( 'posts_per_page=2' );

		if ( $hello->have_posts() ) :
			echo '<div class="hero"><div class="swiper-container"><div class="swiper-wrapper">';
			while ( $hello->have_posts() ) :
				$hello->the_post();
				get_template_part( 'template-parts/post/content', 'hero' );
			endwhile;
			echo '</div><div class="swiper-button-prev"></div> <div class="swiper-button-next"></div>';
			echo '</div></div>';
		endif;
	}

	public function live_instagram_widgets( $index ) {
		if ( $index !== 'instagram' ) return;

		foreach ( $this->config['live_instagram_widgets'] as $widget_name => $params ) {
			the_widget( $widget_name, $params, $this->config['widget_params'] );
		}
	}

	public function live_sidebar_widgets( $index ) {
		if ( $index !== 'sidebar' ) return;

		foreach ( $this->config['live_sidebar_widgets'] as $widget_name => $params ) {
			the_widget( $widget_name, $params, $this->config['widget_params'] );
		}
	}

	public function live_thumbnail() {
		$random = mt_rand( 1, 9 );
		new Live_Image( get_theme_file_uri( "demo/images/blog-$random.jpg" ) );
	}

	public function disable_real_thumbnail( $args ) {
		$args['img_ID'] = null;

		return $args;
	}

	public function live_social_menu() {
		$html = '<ul id="menu-social" class="social-menu">';
		foreach ( $this->config['live_social_networks'] as $network ) {
			$html .= sprintf( '<li><a href="http://%1$s.com"><span class="screen-reader-text">%1$s</span><span class="hint--bottom" aria-label="%1$s"><i class="fab fa-%1$s"></i></span></a></li>', $network );
		}
		$html .= '</ul>';

		echo wp_kses( $html, 'default' );
	}

	public function live_main_menu() {
		$html = '<div class="menu-primary-container"><ul class="menu">';
		$html .= sprintf( '<li class="page_item"><a href="%s">Home</a></li>', $this->menu_link() );
		foreach ( $this->config['live_pages'] as $title => $params ) {
			$html .= sprintf( '<li class="page_item"><a href="%1$s">%2$s</a></li>', $this->menu_link( $params['ID'] ), $title );
		}
		$html .= '</ul></div>';

		return $html;
	}

	private function menu_link( $id = 0 ) {
		if ( $id === 0 ) return HOME_URL;

		return add_query_arg( [ 'page_id' => $id ], HOME_URL );
	}

	private function rest_url( $id ) {
		return trailingslashit( $this->rest_url ) . $id;
	}
}
