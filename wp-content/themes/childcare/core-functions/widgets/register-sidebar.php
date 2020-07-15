<?php	
add_action( 'widgets_init', 'asiathemes_widgets');
function asiathemes_widgets() {

/*sidebar*/
register_sidebar( array(

		'name' => esc_html__( 'Sidebar Data', 'childcare' ),

		'id' => 'sidebar-data',

		'description' => esc_html__( 'The primary widget area', 'childcare' ),

		'before_widget' => '',

		'after_widget' => '</ul></div>',

		'before_title' => '<div class="sm-widget-title animate fadeInleft" data-anim-type="fadeInLeft"><h3>',

		'after_title' => '</h3></div><div class="sm-sidebar-widget animate" data-anim-type="fadeInUp" data-anim-delay="600">

				<ul class="post-content">',

	) );

register_sidebar( array(

		'name' => esc_html__( 'Footer Widget Area', 'childcare' ),

		'id' => 'footer-widget-area',

		'description' => esc_html__( 'footer widget area', 'childcare' ),

		'before_widget' => '<div class="col-md-3"><div class="colam-footer">',

		'after_widget' => '</div></div>',

		'before_title' => '<h2>',

		'after_title' => '</h2>',

	) );
}   ?>