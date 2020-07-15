<?php

namespace Xtheme_Club\Live;

class Live_Image {
	public $args, $full_img_url, $full_width, $full_height;

	public function __construct( $img_url, $args = [] ) {
		$this->args = wp_parse_args( $args, [
			'custom_class' => '',
			'before'       => '<div class="post-thumbnail">',
			'after'        => '</div>',
		] );

		$this->full_img_url = $img_url;

		if ( empty( $this->full_img_url ) ) {
			return;
		}

		list( $this->full_width, $this->full_height ) = getimagesize( $this->full_img_url );

		$this->the_picture();
	}

	public function the_picture() {
		$custom_class = $this->args['custom_class'];
		$placeholder  = preg_replace( '/\.(jpe?g|png|gif|bmp)$/i', '.svg', $this->full_img_url );

		$picture = $this->args['before'];
		$picture .= '<picture class="lazy-wrapper">';
		$picture .= "<source data-srcset='$this->full_img_url 1x'>";
		$picture .= "<img class='lazy $custom_class' src='$placeholder' alt='preview demo' width='$this->full_width' height='$this->full_height' />";
		$picture .= '</picture>';
		$picture .= $this->args['after'];

		echo wp_kses( $picture, 'image' );
	}
}
