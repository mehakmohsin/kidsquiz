<?php
/**
 * Our Courses options.
 *
 * @package Grand Academy
 */

$default = grand_academy_get_default_theme_options();

// Featured Our Courses Section
$wp_customize->add_section( 'section_our_courses',
	array(
		'title'      => __( 'Our Weekly Classes', 'grand-academy' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Our Courses Section
$wp_customize->add_setting('theme_options[enable_our_courses_section]', 
	array(
	'default' 			=> $default['enable_our_courses_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'grand_academy_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_our_courses_section]', 
	array(		
	'label' 	=> __('Enable Our Courses Section', 'grand-academy'),
	'section' 	=> 'section_our_courses',
	'settings'  => 'theme_options[enable_our_courses_section]',
	'type' 		=> 'checkbox',	
	)
);

// Section Title
$wp_customize->add_setting('theme_options[our_courses_section_title]', 
	array(
	'default'           => $default['our_courses_section_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[our_courses_section_title]', 
	array(
	'label'       => __('Section Title', 'grand-academy'),
	'section'     => 'section_our_courses',   
	'settings'    => 'theme_options[our_courses_section_title]',	
	'active_callback' => 'grand_academy_our_courses_active',		
	'type'        => 'text'
	)
);

// Number of items
$wp_customize->add_setting('theme_options[number_of_cs_items]', 
	array(
	'default' 			=> $default['number_of_cs_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'grand_academy_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_cs_items]', 
	array(
	'label'       => __('Number Of Items', 'grand-academy'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 4.', 'grand-academy'),
	'section'     => 'section_our_courses',   
	'settings'    => 'theme_options[number_of_cs_items]',		
	'type'        => 'number',
	'active_callback' => 'grand_academy_our_courses_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 4,
			'step'	=> 1,
		),
	)
);

$wp_customize->add_setting('theme_options[cs_content_type]', 
	array(
	'default' 			=> $default['cs_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'grand_academy_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[cs_content_type]', 
	array(
	'label'       => __('Content Type', 'grand-academy'),
	'section'     => 'section_our_courses',   
	'settings'    => 'theme_options[cs_content_type]',		
	'type'        => 'select',
	'active_callback' => 'grand_academy_our_courses_active',
	'choices'	  => array(
			'cs_page'	  => __('Page','grand-academy'),
			'cs_post'	  => __('Post','grand-academy'),
		),
	)
);

$number_of_cs_items = grand_academy_get_option( 'number_of_cs_items' );

for( $i=1; $i<=$number_of_cs_items; $i++ ){

	// Page
	$wp_customize->add_setting('theme_options[our_courses_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'grand_academy_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[our_courses_page_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Page #%1$s', 'grand-academy'), $i),
		'section'     => 'section_our_courses',   
		'settings'    => 'theme_options[our_courses_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'grand_academy_our_courses_page',
		)
	);

	// Posts
	$wp_customize->add_setting('theme_options[our_courses_post_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'grand_academy_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[our_courses_post_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Post #%1$s', 'grand-academy'), $i),
		'section'     => 'section_our_courses',   
		'settings'    => 'theme_options[our_courses_post_'.$i.']',		
		'type'        => 'select',
		'choices'	  => grand_academy_dropdown_posts(),
		'active_callback' => 'grand_academy_our_courses_post',
		)
	);
}