<?php

namespace Xtheme_Club;

class Image {
	public $args, $full_img_url, $full_width, $full_height;

	public function __construct( $args, $img_id = '', $echo = true ) {
		$defaults = [
			'img_ID'       => ! empty( $img_id ) ? $img_id : get_post_thumbnail_id( get_the_ID() ),
			'desktop'      => [
				'width'  => 0,
				'height' => 0,
			],
			'tablet'       => [
				'width'  => 0,
				'height' => 0,
			],
			'mobile'       => [
				'width'  => 0,
				'height' => 0,
			],
			'ratio'        => 0.05,
			'custom_class' => '',
			'placeholder'  => true,
			'before'       => '<div class="post-thumbnail">',
			'after'        => '</div>',
		];

		$this->args         = wp_parse_args( (array) $args, $defaults );
		$this->args         = apply_filters( 'xtheme/f/image/args', $this->args );
		$this->full_img_url = wp_get_attachment_image_url( $this->args['img_ID'], 'full' );

		if ( empty( $this->full_img_url ) ) return null;

		list( $this->full_width, $this->full_height ) = getimagesize( $this->full_img_url );

		if ( $echo ) echo wp_kses( $this->get_picture(), 'image' );
	}

	public function __toString() {
		return (string) $this->get_picture();
	}

	public function get_picture() {
		$custom_class = $this->args['custom_class'];
		$placeholder  = $this->get_placeholder();
		$size         = $this->get_size();
		$alt          = get_post_meta( $this->args['img_ID'], '_wp_attachment_image_alt', true );

		$picture = $this->args['before'];
		$picture .= '<picture class="lazy-wrapper">';
		$picture .= $this->get_desktop_img();
		$picture .= $this->get_tablet_img();
		$picture .= $this->get_mobile_img();
		$picture .= "<img class='lazy $custom_class' src='$placeholder' alt='$alt' $size />";
		$picture .= '</picture>';
		$picture .= $this->args['after'];

		return $picture;
	}

	public function get_desktop_img() {
		if ( empty( $this->args['desktop'] ) ) return null;

		return $this->get_img( 'desktop', 1200 );
	}

	public function get_tablet_img() {
		if ( empty( $this->args['tablet'] ) ) return null;

		return $this->get_img( 'tablet', 768 );
	}


	public function get_mobile_img() {
		if ( empty( $this->args['mobile'] ) ) return null;

		return $this->get_img( 'mobile', 375 );
	}

	public function get_img( $type, $media_min_width, $unit = 'px' ) {
		$crop = $this->args[ $type ];

		if ( empty( $crop['width'] ) && empty( $crop['height'] ) || ( $this->full_width === $crop['width'] && $this->full_height === $crop['height'] ) ) {
			$normal_img_url = $this->full_img_url;
		} else {
			$normal_img_url = wp_get_attachment_image_url( $this->args['img_ID'], [ $crop['width'], $crop['height'] ] );

			if ( $this->full_width > $crop['width'] * 2 && $this->full_height > $crop['height'] * 2 ) {
				$retina_img_url = wp_get_attachment_image_url( $this->args['img_ID'], [
					$crop['width'] * 2,
					$crop['height'] * 2,
				] );
			} elseif ( $this->full_width === $crop['width'] * 2 ) {
				$retina_img_url = $this->full_img_url;
			} else {
				$retina_img_url = null;
			}
		}

		$retina_img_url = ! empty( $retina_img_url ) ? ", $retina_img_url 2x" : '';

		$source = "<source data-srcset='$normal_img_url 1x $retina_img_url' media='(min-width: $media_min_width$unit)'>";

		return $source;
	}

	public function get_size() {
		if ( ! empty( $this->args['desktop']['width'] ) ) {
			$crop = $this->args['desktop'];
		} elseif ( ! empty( $this->args['tablet']['width'] ) ) {
			$crop = $this->args['tablet'];
		} else {
			$crop = $this->args['mobile'];
		}

		if ( empty( $crop['width'] ) || empty( $crop['height'] ) ) {
			$width  = $this->full_width;
			$height = $this->full_height;
		} else {
			$width  = $crop['width'];
			$height = $crop['height'];
		}

		return sprintf( 'width="%1$s" height="%2$s"', $width, $height );
	}

	public function get_placeholder() {
		if ( empty( $this->args['placeholder'] ) ) return null;

		$crop  = $this->args['desktop'];
		$ratio = $this->args['ratio'];

		if ( empty( $crop['width'] ) || empty( $crop['height'] ) ) {
			$img_placeholder_size = [ $this->full_width * $ratio, $this->full_height * $ratio ];
		} else {
			$img_placeholder_size = [ $crop['width'] * $ratio, $crop['height'] * $ratio ];
		}

		$placeholder = wp_get_attachment_image_url( $this->args['img_ID'], $img_placeholder_size );

		return $placeholder;
	}
}
