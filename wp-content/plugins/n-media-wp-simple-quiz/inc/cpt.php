<?php

/* ========== not run if accessed directly ============ */
    if( ! defined('ABSPATH' ) ){
  	    die("Not Allowed");
    }

	/* ========== Register all custom post type ============ */
	function wqt_cpt_register_post() {

		register_post_type( 'wqt', array(
				'labels' => array(
					'name' 			=> __( 'Quiz' ),
					'singular_name' => __( 'Quiz' ),
					'add_new' 		=> __( 'Add New' ),
					'add_new_item'  => __('Add New Quiz' ),
					'edit_item'     => __('Edit Quiz'),
					'not_found'     => __('You did not create any Quiz yet'),
					'search_items'  => __('Search Quiz')
				),

				'public'       => false,
				'show_ui' 	   => true,
				'supports'     => array('title'),
				'show_in_menu' => false,
			)
		);

		register_post_type( 'wqt_result', array(
				'labels' => array(
						'name' 		=> __( 'Quiz Results' ),
					'singular_name' => __( 'Result' ),
					'map_meta_cap'  => true,
					'edit_item'     => __('Edit Result'),
					'not_found'     => __('You did not create any Result yet'),
					'search_items'  => __('Search Results'),
				),

				'public'       => false,
				'show_ui'      => true,
				'supports' => array(''),
				'show_in_menu' => false,
			)
		);
	}