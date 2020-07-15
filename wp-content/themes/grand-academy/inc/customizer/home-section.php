<?php
/**
 * Home Page Options.
 *
 * @package Grand Academy
 */

$default = grand_academy_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'home_page_panel',
	array(
	'title'      => __( 'Front Page Sections', 'grand-academy' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/**
* Section Customizer Options.
*/
require get_template_directory() . '/inc/customizer/home-sections/slider.php';
require get_template_directory() . '/inc/customizer/home-sections/our-services.php';
require get_template_directory() . '/inc/customizer/home-sections/about-us.php';
require get_template_directory() . '/inc/customizer/home-sections/our-courses.php';
require get_template_directory() . '/inc/customizer/home-sections/team.php';
require get_template_directory() . '/inc/customizer/home-sections/blog.php';

