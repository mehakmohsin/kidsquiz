<div class="col-md-4">
	<div class="sm-right-sidebar">
		<?php if ( is_active_sidebar( 'sidebar-data' ) )
				{ dynamic_sidebar( 'sidebar-data' );	} else { $args = array(
		'name' => __( 'Sidebar Data', 'childcare' ),
		'id' => 'sidebar-data',
		'description' => __( 'The primary widget area', 'childcare' ),
		'before_widget' => '',
		'after_widget' => '</ul></div>',
		'before_title' => '<div class="sm-widget-title animate fadeInleft" data-anim-type="fadeInLeft"><h3>',
		'after_title' => '</h3></div><div class="sm-sidebar-widget animate" data-anim-type="fadeInUp" data-anim-delay="600">
				<ul class="post-content">',
	); the_widget('WP_Widget_Search', 'title=Search', $args);
	the_widget('WP_Widget_Recent_Posts', null, $args);
	the_widget('WP_Widget_Categories', null, $args);
	the_widget('WP_Widget_Archives', null, $args);
	the_widget('WP_Widget_Tag_Cloud', null, $args);
	} ?>
	</div>
</div>