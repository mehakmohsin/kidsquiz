<?php
/**
 * Instagram Widget
 *
 * @version 1.0.0
 */

namespace Xtheme_Club\Widgets;

class Instagram extends Widget {
	public function config() {
		return [
			'id_base'     => 'instagram',
			'classname'   => 'widget-instagram',
			'name'        => __( 'Instagram', 'jordy' ),
			'description' => __( 'Displays your latest instagram photos.', 'jordy' ),
			'fields'      => [
				'title'    => [
					'label'   => __( 'Title:', 'jordy' ),
					'type'    => 'text',
					'default' => __( 'Instagram Feeds', 'jordy' ),
				],
				'username' => [
					'label'   => __( '@username or #tag:', 'jordy' ),
					'type'    => 'text',
					'default' => 'unsplash',
				],
				'number'   => [
					'label'   => __( 'Number of photos:', 'jordy' ),
					'type'    => 'number',
					'options' => [
						'min' => 1,
						'max' => 12,
					],
					'default' => 8,
				],
				'size'     => [
					'label'   => __( 'Photo size:', 'jordy' ),
					'type'    => 'select',
					'options' => [
						'thumbnail' => __( 'Thumbnail', 'jordy' ),
						'small'     => __( 'Small', 'jordy' ),
						'large'     => __( 'Large', 'jordy' ),
						'original'  => __( 'Original', 'jordy' ),
					],
					'default' => 'large',
				],
			],
			'display'     => [
				'content' => '<li class="instagram__photo"><a href="%link_url" rel="nofollow" target="_blank" ><img src="%img_url" alt="%img_alt" /></a></li>',
				'before'  => '<ul class="instagram__photos" data-size="%s">',
				'after'   => '</ul>',
			],
		];
	}

	public function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

		if ( empty( $instance['username'] ) || empty( $instance['number'] ) || empty( $instance['size'] ) ) {
			printf( '<b>%s</b>', esc_html__( 'Please fill all widget settings!', 'jordy' ) );

			$this->widget_end( $args );

			return;
		}

		$html = sprintf( $this->display['before'], esc_attr( $instance['size'] ) );

		foreach ( $this->get_photos( $instance ) as $photo ) {
			if ( file_exists( get_theme_file_path( 'template-parts/shortcode/instagram.php' ) ) ) {
				include get_theme_file_path( 'template-parts/shortcode/instagram.php' );
			} else {
				$content = str_replace( '%link_url', '%1$s', $this->display['content'] );
				$content = str_replace( '%img_url', '%2$s', $content );
				$content = str_replace( '%img_alt', '%3$s', $content );
				$html .= sprintf( $content, esc_url( $photo['link'] ), esc_url( $photo[ $instance['size'] ] ), esc_html( $photo['description'] ) );
			}
		}
		$html .= $this->display['after'];

		echo wp_kses( $html, 'default' );

		$this->widget_end( $args );
	}

	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['username'] = sanitize_text_field( $new_instance['username'] );
		$instance['number']   = ( (int) $new_instance['number'] !== 0 ) ? (int) $new_instance['number'] : null;
		$instance['size']     = ( ( 'thumbnail' === $new_instance['size'] || 'large' === $new_instance['size'] || 'small' === $new_instance['size'] || 'original' === $new_instance['size'] ) ? $new_instance['size'] : 'large' );

		if (
			$old_instance['username'] !== $new_instance['username'] ||
			$old_instance['number'] !== $new_instance['number'] ||
			$old_instance['size'] !== $new_instance['size']
		) {
			delete_transient( $this->id );
		}

		return $instance;
	}

	private function get_photos( $instance ) {
		$cached_images = get_transient( $this->id );

		// If the photos is cached, use them & early exit.
		if ( ! empty( $cached_images ) ) {
			return $cached_images;
		}

		$username = trim( strtolower( $instance['username'] ) );

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
				break;
			default:
				$url = 'https://instagram.com/' . str_replace( '@', '', $username );
				break;
		}

		$remote = wp_remote_get( $url );

		if ( is_wp_error( $remote ) ) {
			return new \WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'jordy' ) );
		}

		if ( wp_remote_retrieve_response_code( $remote ) !== 200 ) {
			return new \WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'jordy' ) );
		}

		$shards      = explode( 'window._sharedData = ', $remote['body'] );
		$insta_json  = explode( ';</script>', $shards[1] );
		$insta_array = json_decode( $insta_json[0], true );

		if ( ! $insta_array ) {
			return new \WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'jordy' ) );
		}

		if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
			$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
		} elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
			$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
		} else {
			return new \WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'jordy' ) );
		}

		if ( ! is_array( $images ) ) {
			return new \WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'jordy' ) );
		}

		$instagram = [];

		foreach ( $images as $image ) {
			if ( true === $image['node']['is_video'] ) {
				$type = 'video';
			} else {
				$type = 'image';
			}

			$caption = esc_html__( 'Instagram Image', 'jordy' );
			if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
				$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], [] );
			}

			$instagram[] = [
				'description' => $caption,
				'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
				'time'        => $image['node']['taken_at_timestamp'],
				'comments'    => $image['node']['edge_media_to_comment']['count'],
				'likes'       => $image['node']['edge_liked_by']['count'],
				'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
				'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
				'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
				'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
				'type'        => $type,
			];
		}

		if ( empty( $instagram ) ) {
			return new \WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'jordy' ) );
		}

		$instagram = array_slice( $instagram, 0, $instance['number'] );

		set_transient( $this->id, $instagram, HOUR_IN_SECONDS ); // Cache for 1 hour using transients.

		return $instagram;
	}
}
