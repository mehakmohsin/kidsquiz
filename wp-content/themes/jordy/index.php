<?php

if ( have_posts() ) :
	if ( is_home() && ! is_front_page() ) :
		echo '<h1 class="page-title">';
		single_post_title();
		echo '</h1>';
	endif;

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile;

	do_action( 'xtheme/h/index/bottom' );
else :
	get_template_part( 'template-parts/post/content', 'none' );
endif;

