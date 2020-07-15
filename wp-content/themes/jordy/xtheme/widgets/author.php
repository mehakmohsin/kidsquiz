<?php
/**
 * Author Widget
 *
 * @version 1.0.0
 */

namespace Xtheme_Club\Widgets;

class Author extends Widget {
	public function config() {
		return [
			'id_base'     => 'author',
			'classname'   => 'widget-author',
			'name'        => __( 'Author', 'jordy' ),
			'description' => __( 'Display custom menu.', 'jordy' ),
			'fields'      => [
				'title'       => [
					'label'   => __( 'Title:', 'jordy' ),
					'type'    => 'text',
					'default' => esc_html__( 'Author Info', 'jordy' ),
				],
				'user_id'     => [
					'label'   => __( 'Choose an User:', 'jordy' ),
					'type'    => 'select',
					'subtype' => 'users',
					'default' => 1,
				],
				'avatar_size' => [
					'label'   => __( 'Avatar Size:', 'jordy' ),
					'type'    => 'number',
					'options' => [
						'min' => 100,
						'max' => 200,
					],
					'default' => 200,
				],
			],
		];
	}

	public function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

		$this->author_info( $instance );

		$this->widget_end( $args );
	}

	public function author_info( $instance ) {
		$user_id = is_single() ? false : $instance['user_id'];
		$name    = get_the_author_meta( 'display_name', $user_id );
		$desc    = get_the_author_meta( 'user_description', $user_id );
		$avatar  = get_avatar( get_the_author_meta( 'ID', $user_id ), $instance['avatar_size'], '', '', [ 'class' => 'lazy' ] );

		$html = sprintf( '<div class="widget-author__avatar">%s</div>', $avatar );
		$html .= sprintf( '<h3 class="widget-author__title">%s</h3>', esc_html( $name ) );
		$html .= $desc ? sprintf( '<div class="widget-author__content">%s</div>', wp_kses_post( $desc ) ) : null;

		echo wp_kses_post( $html );
	}
}
