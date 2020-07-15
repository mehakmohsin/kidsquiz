<?php
/**
 * Kid Toys Store Theme Customizer
 *
 * @package Kid Toys Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kid_toys_store_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'kid_toys_store_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'kid_toys_store_customize_partial_blogdescription',
		)
	);

	//add home page setting pannel
	$wp_customize->add_panel( 'kid_toys_store_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'kid-toys-store' ),
	    'description' => __( 'Description of what this panel does.', 'kid-toys-store' )
	) );

	/**
	 * Upsells
	 */
	load_template( trailingslashit( get_template_directory() ) . 'inc/class-customizer-theme-info-control.php' );

	$wp_customize->add_section(
		'kid_toys_store_theme_info_main_section', array(
			'title'    => __( 'View PRO version', 'kid-toys-store' ),
			'priority' => 1,
		)
	);
	$wp_customize->add_setting(
		'kid_toys_store_theme_info_main_control', array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Kid_Toys_Store_Theme_Info(
			$wp_customize, 'kid_toys_store_theme_info_main_control', array(
				'section'     => 'kid_toys_store_theme_info_main_section',
				'priority'    => 100,
				'options'     => array(
					esc_html__( 'Enable-Disable options on every section', 'kid-toys-store' ),
					esc_html__( 'Background Color & Image Option', 'kid-toys-store' ),
					esc_html__( '100+ Font Family Options', 'kid-toys-store' ),
					esc_html__( 'Advanced Color options', 'kid-toys-store' ),
					esc_html__( 'Translation ready', 'kid-toys-store' ),
					esc_html__( 'Gallery, Banner, Post Type Plugin Functionality', 'kid-toys-store' ),
					esc_html__( 'Integrated Google map', 'kid-toys-store' ),
					esc_html__( '1 Year Free Support', 'kid-toys-store' ),
				),
				'button_url'  => esc_url( 'https://www.themescaliber.com/themes/premium-kids-wordpress-theme' ),
				'button_text' => esc_html__( 'View PRO version', 'kid-toys-store' ),
			)
		)
	);

	//Layouts
	$wp_customize->add_section( 'kid_toys_store_left_right', array(
    	'title' => __('Theme Layout Settings', 'kid-toys-store' ),
		'priority'   => 30,
		'panel' => 'kid_toys_store_panel_id'
	) );

	// Preloader
	$wp_customize->add_setting( 'kid_toys_store_preloader_hide',array(
		'default' => true,
      	'sanitize_callback'	=> 'sanitize_text_field'
    ) );
    $wp_customize->add_control('kid_toys_store_preloader_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Preloader','kid-toys-store' ),
        'section' => 'kid_toys_store_left_right'
    ));

    $wp_customize->add_setting('kid_toys_store_preloader_type',array(
        'default'   => 'center-square',
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control( 'kid_toys_store_preloader_type', array(
		'label' => __( 'Preloader Type','kid-toys-store' ),
		'section' => 'kid_toys_store_left_right',
		'type'  => 'select',
		'settings' => 'kid_toys_store_preloader_type',
		'choices' => array(
		    'center-square' => __('Center Square','kid-toys-store'),
		    'chasing-square' => __('Chasing Square','kid-toys-store'),
	    ),
	));

	$wp_customize->add_setting( 'kid_toys_store_preloader_color', array(
	    'default' => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_preloader_color', array(
  		'label' => 'Preloader Color',
	    'section' => 'kid_toys_store_left_right',
	    'settings' => 'kid_toys_store_preloader_color',
  	)));

  	$wp_customize->add_setting( 'kid_toys_store_preloader_bg_color', array(
	    'default' => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_preloader_bg_color', array(
  		'label' => 'Preloader Background Color',
	    'section' => 'kid_toys_store_left_right',
	    'settings' => 'kid_toys_store_preloader_bg_color',
  	)));

	$wp_customize->add_setting('kid_toys_store_width_options',array(
        'default' => __('Full Layout','kid-toys-store'),
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control('kid_toys_store_width_options',array(
        'type' => 'select',
        'label' => __('Select Site Layout','kid-toys-store'),
        'section' => 'kid_toys_store_left_right',
        'choices' => array(
            'Full Layout' => __('Full Layout','kid-toys-store'),
            'Contained Layout' => __('Contained Layout','kid-toys-store'),
            'Boxed Layout' => __('Boxed Layout','kid-toys-store'),
        ),
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('kid_toys_store_theme_options',array(
        'default' =>  __('Right Sidebar','kid-toys-store'),	
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	) );
	$wp_customize->add_control('kid_toys_store_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __('Do you want this section','kid-toys-store'),
	        'section' => 'kid_toys_store_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','kid-toys-store'),
	            'Right Sidebar' => __('Right Sidebar','kid-toys-store'),
	            'One Column' => __('One Column','kid-toys-store'),
	            'Three Columns' => __('Three Columns','kid-toys-store'),
	            'Four Columns' => __('Four Columns','kid-toys-store'),
	            'Grid Layout' => __('Grid Layout','kid-toys-store')
	        ),
	    )
    );

    $kid_toys_store_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammermdith One' =>'Hammermdith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Kavoon' =>'Kavoon',
        'Poppins' => 'Poppins',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

    //Typography
	$wp_customize->add_section( 'kid_toys_store_typography', array(
    	'title' => __( 'Color / Font Pallete', 'kid-toys-store' ),
		'priority'   => 30,
		'panel' => 'kid_toys_store_panel_id'
	) );

	// Add the Theme Color Option section.
	$wp_customize->add_setting( 'kid_toys_store_theme_color_first', array(
	    'default' => '#d52478',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_theme_color_first', array(
  		'label' => 'Theme Color Option',
	    'section' => 'kid_toys_store_typography',
	    'settings' => 'kid_toys_store_theme_color_first',
  	)));

  	$wp_customize->add_setting( 'kid_toys_store_theme_color_second', array(
	    'default' => '#017bc2',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_theme_color_second', array(
  		'label' => 'Theme Color Option',
	    'section' => 'kid_toys_store_typography',
	    'settings' => 'kid_toys_store_theme_color_second',
  	)));

  	$wp_customize->add_setting( 'kid_toys_store_theme_color_third', array(
	    'default' => '#ffde3f',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_theme_color_third', array(
  		'label' => 'Theme Color Option',
	    'section' => 'kid_toys_store_typography',
	    'settings' => 'kid_toys_store_theme_color_third',
  	)));
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_paragraph_color', array(
		'label' => __('Paragraph Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_paragraph_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'Paragraph Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	$wp_customize->add_setting('kid_toys_store_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_atag_color', array(
		'label' => __('"a" Tag Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_atag_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( '"a" Tag Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_li_color', array(
		'label' => __('"li" Tag Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_li_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( '"li" Tag Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_h1_color', array(
		'label' => __('H1 Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_h1_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'H1 Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('kid_toys_store_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_h1_font_size',array(
		'label'	=> __('H1 Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_h2_color', array(
		'label' => __('H2 Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_h2_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'H2 Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('kid_toys_store_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_h2_font_size',array(
		'label'	=> __('H2 Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_h3_color', array(
		'label' => __('H3 Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_h3_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'H3 Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('kid_toys_store_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_h3_font_size',array(
		'label'	=> __('H3 Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_h4_color', array(
		'label' => __('H4 Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_h4_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'H4 Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('kid_toys_store_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_h4_font_size',array(
		'label'	=> __('H4 Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_h5_color', array(
		'label' => __('H5 Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_h5_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'H5 Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('kid_toys_store_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_h5_font_size',array(
		'label'	=> __('H5 Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'kid_toys_store_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kid_toys_store_h6_color', array(
		'label' => __('H6 Color', 'kid-toys-store'),
		'section' => 'kid_toys_store_typography',
		'settings' => 'kid_toys_store_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('kid_toys_store_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'kid_toys_store_h6_font_family', array(
	    'section'  => 'kid_toys_store_typography',
	    'label'    => __( 'H6 Fonts','kid-toys-store'),
	    'type'     => 'select',
	    'choices'  => $kid_toys_store_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('kid_toys_store_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_h6_font_size',array(
		'label'	=> __('H6 Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_typography',
		'setting'	=> 'kid_toys_store_h6_font_size',
		'type'	=> 'text'
	));

    //Topbar
	$wp_customize->add_section('kid_toys_store_topbar',array(
		'title'	=> __('Top Header','kid-toys-store'),
		'description'	=> __('Add Header Content here','kid-toys-store'),
		'priority'	=> null,
		'panel' => 'kid_toys_store_panel_id',
	));

	//Show /Hide Topbar
	$wp_customize->add_setting( 'kid_toys_store_topbar_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'sanitize_text_field'
    ) );
    $wp_customize->add_control('kid_toys_store_topbar_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Topbar','kid-toys-store' ),
        'section' => 'kid_toys_store_topbar'
    ));

	//Sticky Header
	$wp_customize->add_setting( 'kid_toys_store_sticky_header',array(
      	'sanitize_callback'	=> 'sanitize_text_field'
    ) );
    $wp_customize->add_control('kid_toys_store_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Sticky Header','kid-toys-store' ),
        'section' => 'kid_toys_store_topbar'
    ));

    $wp_customize->selective_refresh->add_partial(
		'kid_toys_store_mail',
		array(
			'selector'        => '.baricon',
			'render_callback' => 'kid_toys_store_customize_partial_kid_toys_store_mail',
		)
	);

    $wp_customize->add_setting('kid_toys_store_mail',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_mail',array(
		'label'	=> __('Email','kid-toys-store'),
		'section'	=> 'kid_toys_store_topbar',
		'setting'	=> 'kid_toys_store_mail',
		'type'	=> 'text'
	));

    $wp_customize->add_setting('kid_toys_store_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_call',array(
		'label'	=> __('Phone','kid-toys-store'),
		'section'	=> 'kid_toys_store_topbar',
		'setting'	=> 'kid_toys_store_call',
		'type'	=> 'text'
	));

	//Social Icons
	$wp_customize->add_section('kid_toys_store_topbar_header',array(
		'title'	=> __('Social Icon Section','kid-toys-store'),
		'description'	=> __('Add Header Content here','kid-toys-store'),
		'priority'	=> null,
		'panel' => 'kid_toys_store_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'kid_toys_store_youtube_url',
		array(
			'selector'        => '.social-media',
			'render_callback' => 'kid_toys_store_customize_partial_kid_toys_store_youtube_url',
		)
	);

	$wp_customize->add_setting('kid_toys_store_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('kid_toys_store_youtube_url',array(
		'label'	=> __('Add Youtube link','kid-toys-store'),
		'section'	=> 'kid_toys_store_topbar_header',
		'setting'	=> 'kid_toys_store_youtube_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('kid_toys_store_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('kid_toys_store_facebook_url',array(
		'label'	=> __('Add Facebook link','kid-toys-store'),
		'section'	=> 'kid_toys_store_topbar_header',
		'setting'	=> 'kid_toys_store_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('kid_toys_store_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('kid_toys_store_twitter_url',array(
		'label'	=> __('Add Twitter link','kid-toys-store'),
		'section'	=> 'kid_toys_store_topbar_header',
		'setting'	=> 'kid_toys_store_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('kid_toys_store_rss_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('kid_toys_store_rss_url',array(
		'label'	=> __('Add RSS link','kid-toys-store'),
		'section'	=> 'kid_toys_store_topbar_header',
		'setting'	=> 'kid_toys_store_rss_url',
		'type'	=> 'url'
	));

	//home page slider
	$wp_customize->add_section( 'kid_toys_store_slidersettings' , array(
    	'title'  => __( 'Slider Settings', 'kid-toys-store' ),
		'priority' => null,
		'panel' => 'kid_toys_store_panel_id'
	) );

	$wp_customize->selective_refresh->add_partial(
		'kid_toys_store_slider_arrows',
		array(
			'selector'        => '#slider .inner_carousel h1',
			'render_callback' => 'kid_toys_store_customize_partial_kid_toys_store_slider_arrows',
		)
	);

	$wp_customize->add_setting('kid_toys_store_slider_arrows',array(
      'default' => false,
      'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_slider_arrows',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide slider','kid-toys-store'),
		'section' => 'kid_toys_store_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'kid_toys_store_slidersettings_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'kid_toys_store_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'kid_toys_store_slidersettings_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'kid-toys-store' ),
			'section'  => 'kid_toys_store_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}	

	$wp_customize->add_setting('kid_toys_store_slider_title',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_slider_title',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Title','kid-toys-store'),
	   'section' => 'kid_toys_store_slidersettings',
	));

	$wp_customize->add_setting('kid_toys_store_slider_content',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_slider_content',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Content','kid-toys-store'),
	   'section' => 'kid_toys_store_slidersettings',
	));

	$wp_customize->add_setting('kid_toys_store_slider_button',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_slider_button',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Button','kid-toys-store'),
	   'section' => 'kid_toys_store_slidersettings',
	));

    //Slider excerpt
	$wp_customize->add_setting( 'kid_toys_store_slider_excerpt', array(
		'default'              => 15,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_excerpt', array(
		'label' => esc_html__( 'Slider Excerpt length','kid-toys-store' ),
		'section'     => 'kid_toys_store_slidersettings',
		'type'        => 'number',
		'settings'    => 'kid_toys_store_slider_excerpt',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	$wp_customize->add_setting( 'kid_toys_store_slider_button_text', array(
		'default'   => 'SHOP NOW',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_button_text', array(
		'label'       => esc_html__( 'Slider Button text','kid-toys-store' ),
		'section'     => 'kid_toys_store_slidersettings',
		'type'        => 'text',
		'settings'    => 'kid_toys_store_slider_button_text'
	) );

	//Opacity
	$wp_customize->add_setting('kid_toys_store_slider_opacity',array(
        'default'   => 0.7,
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control( 'kid_toys_store_slider_opacity', array(
		'label'       => esc_html__( 'Slider Image Opacity','kid-toys-store' ),
		'section'    => 'kid_toys_store_slidersettings',
		'type'        => 'select',
		'settings'   => 'kid_toys_store_slider_opacity',
		'choices' => array(
	      '0' =>  esc_attr('0','kid-toys-store'),
	      '0.1' =>  esc_attr('0.1','kid-toys-store'),
	      '0.2' =>  esc_attr('0.2','kid-toys-store'),
	      '0.3' =>  esc_attr('0.3','kid-toys-store'),
	      '0.4' =>  esc_attr('0.4','kid-toys-store'),
	      '0.5' =>  esc_attr('0.5','kid-toys-store'),
	      '0.6' =>  esc_attr('0.6','kid-toys-store'),
	      '0.7' =>  esc_attr('0.7','kid-toys-store'),
	      '0.8' =>  esc_attr('0.8','kid-toys-store'),
	      '0.9' =>  esc_attr('0.9','kid-toys-store')
	  ),
	));

	//content Alignment
    $wp_customize->add_setting('kid_toys_store_slider_content_option',array(
    	'default' => __('Left','kid-toys-store'),
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control('kid_toys_store_slider_content_option',array(
        'type' => 'select',
        'label' => __('Slider Content Alignment','kid-toys-store'),
        'section' => 'kid_toys_store_slidersettings',
        'choices' => array(
            'Center' => __('Center','kid-toys-store'),
            'Left' => __('Left','kid-toys-store'),
            'Right' => __('Right','kid-toys-store'),
        ),
	) );

	$wp_customize->add_setting('kid_toys_store_content_spacing',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('kid_toys_store_content_spacing',array(
		'label'	=> esc_html__('Slider Content Spacing','kid-toys-store'),
		'section'=> 'kid_toys_store_slidersettings',
	));

	$wp_customize->add_setting( 'kid_toys_store_slider_top_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_top_spacing', array(
		'label' => esc_html__( 'Top','kid-toys-store' ),
		'section' => 'kid_toys_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'kid_toys_store_slider_bottom_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_bottom_spacing', array(
		'label' => esc_html__( 'Bottom','kid-toys-store' ),
		'section' => 'kid_toys_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'kid_toys_store_slider_left_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_left_spacing', array(
		'label' => esc_html__( 'Left','kid-toys-store'),
		'section' => 'kid_toys_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'kid_toys_store_slider_right_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_right_spacing', array(
		'label' => esc_html__('Right','kid-toys-store'),
		'section' => 'kid_toys_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'kid_toys_store_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_slider_speed', array(
		'label' => esc_html__('Slider Speed','kid-toys-store'),
		'section' => 'kid_toys_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 500,
			'min' => 500,
			'max' => 5000,
		),
	) );

	//Our Product
	$wp_customize->add_section('kid_toys_store_product',array(
		'title'	=> __('Featured Products','kid-toys-store'),
		'description'=> __('This section will appear below the slider.','kid-toys-store'),
		'panel' => 'kid_toys_store_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'kid_toys_store_sec1_title',
		array(
			'selector'        => '#our-products strong',
			'render_callback' => 'kid_toys_store_customize_partial_kid_toys_store_sec1_title',
		)
	);

	$wp_customize->add_setting('kid_toys_store_sec1_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('kid_toys_store_sec1_title',array(
		'label'	=> __('Section Title','kid-toys-store'),
		'section'=> 'kid_toys_store_product',
		'setting'=> 'kid_toys_store_sec1_title',
		'type'=> 'text'
	));	
	
	$wp_customize->add_setting( 'kid_toys_store_servicesettings_page', array(
		'default'           => '',
		'sanitize_callback' => 'kid_toys_store_sanitize_dropdown_pages'
	));
	$wp_customize->add_control( 'kid_toys_store_servicesettings_page', array(
		'label'    => __( 'Select Product Page', 'kid-toys-store' ),
		'section'  => 'kid_toys_store_product',
		'type'     => 'dropdown-pages'
	));

	//Blog Post
	$wp_customize->add_section('kid_toys_store_blog_post',array(
		'title'	=> __('Post Settings','kid-toys-store'),
		'panel' => 'kid_toys_store_panel_id',
	));	

	$wp_customize->add_setting('kid_toys_store_date_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_date_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Date','kid-toys-store'),
       'section' => 'kid_toys_store_blog_post'
    ));

    $wp_customize->add_setting('kid_toys_store_author_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_author_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Author','kid-toys-store'),
       'section' => 'kid_toys_store_blog_post'
    ));

    $wp_customize->add_setting('kid_toys_store_comment_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_comment_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Comments','kid-toys-store'),
       'section' => 'kid_toys_store_blog_post'
    ));

    $wp_customize->add_setting('kid_toys_store_post_content',array(
    	'default' => __('Excerpt Content','kid-toys-store'),
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control('kid_toys_store_post_content',array(
        'type' => 'radio',
        'label' => __('Post Content Type','kid-toys-store'),
        'section' => 'kid_toys_store_blog_post',
        'choices' => array(
            'No Content' => __('No Content','kid-toys-store'),
            'Full Content' => __('Full Content','kid-toys-store'),
            'Excerpt Content' => __('Excerpt Content','kid-toys-store'),
        ),
	) );

    $wp_customize->add_setting( 'kid_toys_store_post_excerpt_length', array(
		'default'              => 20,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_post_excerpt_length', array(
		'label' => esc_html__( 'Post Excerpt Length','kid-toys-store' ),
		'section'  => 'kid_toys_store_blog_post',
		'type'  => 'number',
		'settings' => 'kid_toys_store_post_excerpt_length',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'kid_toys_store_button_excerpt_suffix', array(
		'default'   => '[...]',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Excerpt Suffix','kid-toys-store' ),
		'section'     => 'kid_toys_store_blog_post',
		'type'        => 'text',
		'settings' => 'kid_toys_store_button_excerpt_suffix'
	) );

	$wp_customize->add_setting( 'kid_toys_store_post_button_text', array(
		'default'   => 'Read Full',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_post_button_text', array(
		'label' => esc_html__('Post Button Text','kid-toys-store' ),
		'section'     => 'kid_toys_store_blog_post',
		'type'        => 'text',
		'settings'    => 'kid_toys_store_post_button_text'
	) );

	$wp_customize->add_setting('kid_toys_store_top_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_top_button_padding',array(
		'label'	=> __('Top Bottom Button Padding','kid-toys-store'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'kid_toys_store_blog_post',
		'type'=> 'number',
	));

	$wp_customize->add_setting('kid_toys_store_left_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_left_button_padding',array(
		'label'	=> __('Left Right Button Padding','kid-toys-store'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'kid_toys_store_blog_post',
		'type'=> 'number',
	));

	$wp_customize->add_setting( 'kid_toys_store_button_border_radius', array(
		'default'=> '0',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control('kid_toys_store_button_border_radius', array(
        'label'  => __('Button Border Radius','kid-toys-store'),
        'type'=> 'number',
        'section'  => 'kid_toys_store_blog_post',
        'input_attrs' => array(
        	'step' => 1,
            'min' => 0,
            'max' => 50,
        ),
    ));

    //Single Post Settings
	$wp_customize->add_section('kid_toys_store_single_post',array(
		'title'	=> __('Single Post Settings','kid-toys-store'),
		'panel' => 'kid_toys_store_panel_id',
	));	

	$wp_customize->add_setting('kid_toys_store_feature_image',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_feature_image',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Feature Image','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_tags',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_tags',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Tags','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comment','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_nav_links',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_nav_links',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Nav Links','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_prev_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_prev_text',array(
       'type' => 'text',
       'label' => __('Previous Navigation Text','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_next_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_next_text',array(
       'type' => 'text',
       'label' => __('Next Navigation Text','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related Posts','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting('kid_toys_store_related_posts_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','kid-toys-store'),
       'section' => 'kid_toys_store_single_post'
    ));

    $wp_customize->add_setting( 'kid_toys_store_related_post_count', array(
		'default' => 3,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'kid_toys_store_related_post_count', array(
		'label' => esc_html__( 'Related Posts Count','kid-toys-store' ),
		'section' => 'kid_toys_store_single_post',
		'type' => 'number',
		'settings' => 'kid_toys_store_related_post_count',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	) );

    $wp_customize->add_setting( 'kid_toys_store_post_order', array(
        'default' => 'categories',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'kid_toys_store_post_order', array(
        'section' => 'kid_toys_store_single_post',
        'type' => 'radio',
        'label' => __( 'Related Posts Order By', 'kid-toys-store' ),
        'choices' => array(
            'categories'  => __('Categories', 'kid-toys-store'),
            'tags' => __( 'Tags', 'kid-toys-store' ),
    )));

    //404 page settings
	$wp_customize->add_section('kid_toys_store_404_page',array(
		'title'	=> __('404 Page Settings','kid-toys-store'),
		'priority'	=> null,
		'panel' => 'kid_toys_store_panel_id',
	));

	$wp_customize->add_setting('kid_toys_store_404_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_404_title',array(
       'type' => 'text',
       'label' => __('404 Page Title','kid-toys-store'),
       'section' => 'kid_toys_store_404_page'
    ));

    $wp_customize->add_setting('kid_toys_store_404_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_404_text',array(
       'type' => 'text',
       'label' => __('404 Page Text','kid-toys-store'),
       'section' => 'kid_toys_store_404_page'
    ));

    $wp_customize->add_setting('kid_toys_store_404_button_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_404_button_text',array(
       'type' => 'text',
       'label' => __('404 Page Button Text','kid-toys-store'),
       'section' => 'kid_toys_store_404_page'
    ));

	//Footer
	$wp_customize->add_section('kid_toys_store_footer',array(
		'title'	=> __('Footer Section','kid-toys-store'),
		'description'=> __('This section will appear in the footer.','kid-toys-store'),
		'panel' => 'kid_toys_store_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'kid_toys_store_show_back_to_top',
		array(
			'selector'        => '.scrollup',
			'render_callback' => 'kid_toys_store_customize_partial_kid_toys_store_show_back_to_top',
		)
	);

	$wp_customize->add_setting('kid_toys_store_show_back_to_top',array(
        'default' => 'true',
        'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_show_back_to_top',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Back to Top Button','kid-toys-store'),
      	'section' => 'kid_toys_store_footer',
	));

	$wp_customize->add_setting('kid_toys_store_back_to_top_alignment',array(
        'default' => __('Right','kid-toys-store'),
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control('kid_toys_store_back_to_top_alignment',array(
        'type' => 'select',
        'label' => __('Back to Top Button Alignment','kid-toys-store'),
        'section' => 'kid_toys_store_footer',
        'choices' => array(
            'Left' => __('Left','kid-toys-store'),
            'Right' => __('Right','kid-toys-store'),
            'Center' => __('Center','kid-toys-store'),
        ),
	) );

	$wp_customize->add_setting('kid_toys_store_footer_widget_layout',array(
        'default'           => '4',
        'sanitize_callback' => 'kid_toys_store_sanitize_choices',
    ));
    $wp_customize->add_control('kid_toys_store_footer_widget_layout',array(
        'type'        => 'radio',
        'label'       => __('Footer widget layout', 'kid-toys-store'),
        'section'     => 'kid_toys_store_footer',
        'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'kid-toys-store'),
        'choices' => array(
            '1'     => __('One', 'kid-toys-store'),
            '2'     => __('Two', 'kid-toys-store'),
            '3'     => __('Three', 'kid-toys-store'),
            '4'     => __('Four', 'kid-toys-store')
        ),
    ));

    $wp_customize->add_setting('kid_toys_store_copyright_alignment',array(
        'default' => __('Center','kid-toys-store'),
        'sanitize_callback' => 'kid_toys_store_sanitize_choices'
	));
	$wp_customize->add_control('kid_toys_store_copyright_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Alignment','kid-toys-store'),
        'section' => 'kid_toys_store_footer',
        'choices' => array(
            'Left' => __('Left','kid-toys-store'),
            'Right' => __('Right','kid-toys-store'),
            'Center' => __('Center','kid-toys-store'),
        ),
	) );

	$wp_customize->add_setting('kid_toys_store_copyright_fontsize',array(
		'default'	=> 16,
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('kid_toys_store_copyright_fontsize',array(
		'label'	=> __('Copyright Font Size','kid-toys-store'),
		'section'	=> 'kid_toys_store_footer',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('kid_toys_store_copyright_top_bottom_padding',array(
		'default'	=> 15,
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('kid_toys_store_copyright_top_bottom_padding',array(
		'label'	=> __('Copyright Top Bottom Padding','kid-toys-store'),
		'section'	=> 'kid_toys_store_footer',
		'type'		=> 'number'
	));

    $wp_customize->selective_refresh->add_partial(
		'kid_toys_store_footer_copy',
		array(
			'selector'        => '#footer p',
			'render_callback' => 'kid_toys_store_customize_partial_kid_toys_store_footer_copy',
		)
	);

	$wp_customize->add_setting('kid_toys_store_footer_copy',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('kid_toys_store_footer_copy',array(
		'label'	=> __('Text','kid-toys-store'),
		'section'=> 'kid_toys_store_footer',
		'setting'=> 'kid_toys_store_footer_copy',
		'type'=> 'text'
	));	

	//Woocommerce Section
	$wp_customize->add_section( 'kid_toys_store_woocommerce_options' , array(
    	'title'      => __( 'Additional WooCommerce Options', 'kid-toys-store' ),
		'priority'   => null,
		'panel' => 'kid_toys_store_panel_id'
	) );

	// Product Columns
	$wp_customize->add_setting( 'kid_toys_store_products_per_row' , array(
		'default'           => '3',
		'transport'         => 'refresh',
		'sanitize_callback' => 'kid_toys_store_sanitize_choices',
	) );

	$wp_customize->add_control('kid_toys_store_products_per_row', array(
		'label' => __( 'Product per row', 'kid-toys-store' ),
		'section'  => 'kid_toys_store_woocommerce_options',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	$wp_customize->add_setting('kid_toys_store_product_per_page',array(
		'default'	=> '9',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('kid_toys_store_product_per_page',array(
		'label'	=> __('Product per page','kid-toys-store'),
		'section'	=> 'kid_toys_store_woocommerce_options',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('kid_toys_store_shop_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_shop_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Shop page sidebar','kid-toys-store'),
       'section' => 'kid_toys_store_woocommerce_options',
    ));

    $wp_customize->add_setting('kid_toys_store_product_page_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_product_page_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Product page sidebar','kid-toys-store'),
       'section' => 'kid_toys_store_woocommerce_options',
    ));

    $wp_customize->add_setting('kid_toys_store_related_product',array(
       'default' => true,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_related_product',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related product','kid-toys-store'),
       'section' => 'kid_toys_store_woocommerce_options',
    ));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_button_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( 'kid_toys_store_woocommerce_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_button_padding_right',array(
	 	'default' => 20,
	 	'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_woocommerce_button_padding_right',	array(
	 	'label' => esc_html__( 'Button Right Left Padding','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_button_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_woocommerce_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

    $wp_customize->add_setting('kid_toys_store_woocommerce_product_border',array(
       'default' => false,
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('kid_toys_store_woocommerce_product_border',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product border','kid-toys-store'),
       'section' => 'kid_toys_store_woocommerce_options',
    ));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_product_padding_top',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_woocommerce_product_padding_top', array(
		'label' => esc_html__( 'Product Top Bottom Padding','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_product_padding_right',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_woocommerce_product_padding_right', array(
		'label' => esc_html__( 'Product Right Left Padding','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_product_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('kid_toys_store_woocommerce_product_border_radius',array(
		'label' => esc_html__( 'Product Border Radius','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'kid_toys_store_woocommerce_product_box_shadow',array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( 'kid_toys_store_woocommerce_product_box_shadow',array(
		'label' => esc_html__( 'Product Box Shadow','kid-toys-store' ),
		'type' => 'number',
		'section' => 'kid_toys_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));
}

add_action( 'customize_register', 'kid_toys_store_customize_register' );

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-width.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Kid_Toys_Store_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . 'inc/customize-theme-info-main.php' );
		load_template( trailingslashit( get_template_directory() ) . 'inc/customize-upsell-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Kid_Toys_Store_Customizer_Theme_Info_Main' );

		// Main Documentation Link In Customizer Root.
		$manager->add_section(
			new Kid_Toys_Store_Customizer_Theme_Info_Main(
				$manager, 'kid-toys-store-theme-info', array(
					'theme_info_title' => __( 'Kid Toys Store', 'kid-toys-store' ),
					'label_url'        => esc_url( 'https://www.themescaliber.com/demo/doc/free-kid-toys-store/' ),
					'label_text'       => __( 'Documentation', 'kid-toys-store' ),
				)
			)
		);

		// Frontpage Sections Upsell.
		$manager->add_section(
			new Kid_Toys_Store_Customizer_Upsell_Section(
				$manager, 'kid-toys-store-upsell-frontpage-sections', array(
					'panel'       => 'kid_toys_store_panel_id',
					'priority'    => 500,
					'options'     => array(
						esc_html__( 'Product Box Section', 'kid-toys-store' ),
						esc_html__( 'Services section', 'kid-toys-store' ),
						esc_html__( 'View Collection section', 'kid-toys-store' ),
						esc_html__( 'New Arrivals & Best Sellers Section', 'kid-toys-store' ),
						esc_html__( 'On Sale Products section', 'kid-toys-store' ),
						esc_html__( 'From The Blog section', 'kid-toys-store' ),
						esc_html__( 'Testimonials section', 'kid-toys-store' ),
						
					),
					'button_url'  => esc_url( 'https://www.themescaliber.com/themes/premium-kids-wordpress-theme' ),
					'button_text' => esc_html__( 'View PRO version', 'kid-toys-store' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'kid-toys-store-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/js/kid-customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'kid-toys-store-theme-info-style', trailingslashit( get_template_directory_uri() ) . 'inc/css/customize-control.css' );
	}
}

Kid_Toys_Store_Customizer_Upsell::get_instance();