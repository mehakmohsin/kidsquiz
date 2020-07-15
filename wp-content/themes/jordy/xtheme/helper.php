<?php

namespace Xtheme_Club;

function get_all_post_tags() {
	$tags = get_tags( [
		'hide_empty' => true,
	] );

	$all_tags = [];

	foreach ( $tags as $tag ) {
		$all_tags[ $tag->slug ] = $tag->name;
	}

	return $all_tags;
}

/*
 * SVG HELPERS
 */
function the_svg_icon( $args ) {
	echo wp_kses( get_svg_icon( $args ), 'svg' );
}

function get_svg_icon( $args ) {
	if ( ! is_array( $args ) ) {
		$args = [ 'icon' => $args ];
	}

	$args = wp_parse_args( $args, [
		'icon'        => 'email',
		'title'       => '',
		'desc'        => '',
		'aria_hidden' => true, // Hide from screen readers.
	] );

	$aria_hidden     = $args['aria_hidden'] === true ? 'aria-hidden="true"' : '';
	$aria_labelledby = $args['title'] && $args['desc'] ? 'aria-labelledby="title desc"' : '';

	// Begin SVG markup.
	$svg = sprintf( '<svg class="icon icon--%1$s" %2$s %3$s role="img">', $args['icon'], $aria_hidden, $aria_labelledby );
	$svg .= $args['title'] ? sprintf( '<title>%s</title>', $args['title'] ) : '';
	$svg .= $args['desc'] ? sprintf( '<desc>%s</desc>', $args['desc'] ) : '';
	$svg .= sprintf( '<use xlink:href="#%s"></use>', $args['icon'] );
	$svg .= '</svg>';

	return wp_kses( $svg, 'svg' );
}

/*
 * CUSTOM CONDITIONAL HELPERS
 */
function is_page_builder( $post_id = null ) {
	global $post;

	if ( empty( $post ) ) return false;

	if ( ! $post_id ) {
		$post_id = $post->ID;
	}

	$panels_data = get_post_meta( $post_id, 'panels_data', false );

	if ( empty( $panels_data ) ) return false;

	return true;
}

function is_post_type( $post_type ) {
	if ( get_post_type() === $post_type ) return true;

	return false;
}

function is_woo() {
	if ( function_exists( 'is_woocommerce' ) ) return (bool) is_woocommerce();

	return false;
}

function is_ajax() {
	return defined( 'DOING_AJAX' );
}

function is_use_permalink() {
	global $wp_rewrite;

	if ( $wp_rewrite->permalink_structure === '' ) return false;

	return true;
}

function is_url( $url ) {
	return filter_var( $url, FILTER_VALIDATE_URL ) !== false;
}

function is_blog_page() {
	return is_home() && ! is_front_page();
}

function is_live_preview() {
	$preview_theme = get_option( 'template' );
	$active_theme  = get_cached_option( 'template' );
	$is_wp_org     = strpos( home_url(), 'wp-themes.com' );

	return ( $active_theme !== $preview_theme || ( $preview_theme === 'jordy' && $is_wp_org !== false  ) ) && ! is_child_theme();
}

/*
 * SANITIZE HELPERS
 */
function sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function sanitize_checkbox( $input ) {
	if ( isset( $input ) ) return true;

	return false;
}

/*
 * CORE HELPERS
 */
function baseline( $level ) {
	return (int) Core::$sass_vars['base_line_height'] * $level;
}

function convert_to_snake_string( $input, $after = '', $before = '' ) {
	$output = str_replace( [ '\\', '/', '-' ], '_', $input );
	$output = strtolower( $output );
	$output = $before . $output . $after;

	return $output;
}

function convert_to_hyphen_string( $input, $after = '', $before = '' ) {
	$output = str_replace( [ '\\', '/', '_', ' ' ], '-', $input );
	$output = strtolower( $output );
	$output = $before . $output . $after;

	return $output;
}

function human_time_diff_maybe( $timestamp, $day = 1 ) {
	$how_long = DAY_IN_SECONDS * $day;

	if ( abs( time() - $timestamp ) < $how_long ) {
		/* translators: %s: human time */
		return sprintf( __( '%s ago', 'jordy' ), human_time_diff( $timestamp ) );
	} else {
		return date( get_option( 'date_format' ), $timestamp );
	}
}

function get_gg_fonts_url( $args = [] ) {
	if ( empty( $args ) ) {
		$args = wp_parse_args( get_support( GOOGLE_FONTS ) );
	}

	$fonts = [];

	foreach ( $args as $family => $weight ) :
		$weight = str_replace( ' ', '', $weight );
		$family = str_replace( [ ' ', '_' ], '+', $family );

		$fonts[] = "$family:$weight";
	endforeach;

	return sprintf( 'https://fonts.googleapis.com/css?family=%s', implode( '|', $fonts ) );
}

function get_support( $feature ) {
	if ( empty( get_theme_support( $feature )[0] ) ) return [];

	return get_theme_support( $feature )[0];
}

function std( $name ) {
	return Core::$sass_vars[ $name ];
}

function handle( $name ) {
	return THEME_SLUG . '-' . $name;
}

function child_theme_path( $path = '' ) {
	if ( empty( $path ) ) return Core::$cached_theme_info['child_directory'];

	return Core::$cached_theme_info['child_directory'] . $path;
}

function child_theme_uri( $path = '' ) {
	if ( empty( $path ) ) return Core::$cached_theme_info['child_directory_uri'];

	return Core::$cached_theme_info['child_directory_uri'] . $path;
}

function parent_theme_path( $path = '' ) {
	if ( empty( $path ) ) return Core::$cached_theme_info['parent_directory'];

	return Core::$cached_theme_info['parent_directory'] . $path;
}

function parent_theme_uri( $path = '' ) {
	if ( empty( $path ) ) return Core::$cached_theme_info['parent_directory_uri'];

	return Core::$cached_theme_info['parent_directory_uri'] . $path;
}

function get_cached_option( $opt_name ) {
	$alloptions = wp_load_alloptions();

	return isset( $alloptions[ $opt_name ] ) ? $alloptions[ $opt_name ] : false;
}

function strip_namespace( $class ) {
	$index = strrchr( $class, '\\' );
	if ( $index ) return substr( $index, 1 );

	return $class;
}

function name( $name ) {
	return Core::$transient_names[ $name ];
}

function add_image_size( $name, $args ) {
	Core::$image_sizes[ $name ] = $args;
}

function filesystem() {
	global $wp_filesystem;

	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';

		WP_Filesystem();
	}

	return $wp_filesystem;
}

function get_file_content( $file ) {
	return filesystem()->get_contents( $file );
}

function categorized_blog() {
	$all_cats = get_transient( name( 'categories' ) );

	if ( $all_cats === false ) {
		$all_cats = get_categories( [
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2, // We only need to know if there is more than one category.
		] );

		$all_cats = count( $all_cats );

		set_transient( name( 'categories' ), $all_cats );
	}

	if ( $all_cats > 1 ) return true;

	return false;
}

class Helper {
	public function __construct() {
		add_filter( 'image_downsize', [ $this, 'media' ], 10, 3 );
		add_action( 'edit_category', 'Xtheme\category_transient_flusher' );
		add_action( 'save_post', [ $this, 'category_transient_flusher' ] );
	}

	public function category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		delete_transient( name( 'categories' ) );
	}

	public function media( $out, $id, $size ) {
		global $all_image_sizes;

		if ( ! isset( $all_image_sizes ) ) {
			global $_wp_additional_image_sizes;

			$all_image_sizes = [];
			$interim_sizes   = get_intermediate_image_sizes();

			foreach ( $interim_sizes as $size_name ) {
				if ( in_array( $size_name, [ 'thumbnail', 'medium', 'large' ], true ) ) {
					$all_image_sizes[ $size_name ]['width']  = get_option( $size_name . '_size_w' );
					$all_image_sizes[ $size_name ]['height'] = get_option( $size_name . '_size_h' );
					$all_image_sizes[ $size_name ]['crop']   = (bool) get_option( $size_name . '_crop' );
				} elseif ( isset( $_wp_additional_image_sizes[ $size_name ] ) ) {
					$all_image_sizes[ $size_name ] = $_wp_additional_image_sizes[ $size_name ];
				}
			}
		}

		$all_sizes = $all_image_sizes;

		$image_data = wp_get_attachment_metadata( $id );

		if ( ! is_array( $image_data ) ) return false;

		if ( is_string( $size ) ) {
			if ( empty( $all_sizes[ $size ] ) ) return false;

			if ( ! empty( $image_data['sizes'][ $size ] ) && ! empty( $all_sizes[ $size ] ) ) {
				if ( $all_sizes[ $size ]['width'] === $image_data['sizes'][ $size ]['width'] && $all_sizes[ $size ]['height'] === $image_data['sizes'][ $size ]['height'] ) {
					return false;
				}

				if ( ! empty( $image_data['sizes'][ $size ]['width_query'] ) && ! empty( $image_data['sizes'][ $size ]['height_query'] ) ) {
					if ( $image_data['sizes'][ $size ]['width_query'] === $all_sizes[ $size ]['width'] && $image_data['sizes'][ $size ]['height_query'] === $all_sizes[ $size ]['height'] ) {
						return false;
					}
				}
			}

			$resized = image_make_intermediate_size( get_attached_file( $id ), $all_sizes[ $size ]['width'], $all_sizes[ $size ]['height'], $all_sizes[ $size ]['crop'] );

			if ( ! $resized ) return false;

			$image_data['sizes'][ $size ] = $resized;

			$image_data['sizes'][ $size ]['width_query']  = $all_sizes[ $size ]['width'];
			$image_data['sizes'][ $size ]['height_query'] = $all_sizes[ $size ]['height'];

			wp_update_attachment_metadata( $id, $image_data );

			$att_url = wp_get_attachment_url( $id );

			return [ dirname( $att_url ) . DS . $resized['file'], $resized['width'], $resized['height'], true ];

		} elseif ( is_array( $size ) ) {
			$image_path = get_attached_file( $id );
			$crop       = array_key_exists( 2, $size ) ? $size[2] : true;
			$new_width  = $size[0];
			$new_height = $size[1];

			if ( ! $crop ) {
				if ( class_exists( 'Jetpack' ) && \Jetpack::is_module_active( 'photon' ) ) {
					add_filter( 'jetpack_photon_override_image_downsize', '__return_true' );
					$true_data = wp_get_attachment_image_src( $id, 'large' );
					remove_filter( 'jetpack_photon_override_image_downsize', '__return_true' );
				} else {
					$true_data = wp_get_attachment_image_src( $id, 'large' );
				}

				if ( $true_data[1] > $true_data[2] ) {
					$ratio      = $true_data[1] / $size[0];
					$new_height = round( $true_data[2] / $ratio );
					$new_width  = $size[0];
				} else {
					$ratio      = $true_data[2] / $size[1];
					$new_height = $size[1];
					$new_width  = round( $true_data[1] / $ratio );
				}
			}

			$image_ext  = pathinfo( $image_path, PATHINFO_EXTENSION );
			$image_path = preg_replace( '/^(.*)\.' . $image_ext . '$/', sprintf( '$1-%sx%s.%s', $new_width, $new_height, $image_ext ), $image_path );
			$att_url    = wp_get_attachment_url( $id );

			if ( file_exists( $image_path ) ) {
				return [ dirname( $att_url ) . DS . basename( $image_path ), $new_width, $new_height, $crop ];
			}

			$resized = image_make_intermediate_size( get_attached_file( $id ), $size[0], $size[1], $crop );

			$image_data = wp_get_attachment_metadata( $id );

			$image_data['sizes'][ $size[0] . 'x' . $size[1] ] = $resized;

			wp_update_attachment_metadata( $id, $image_data );

			if ( ! $resized ) return false;

			return [ dirname( $att_url ) . DS . $resized['file'], $resized['width'], $resized['height'], $crop ];
		}

		return false;
	}
}
