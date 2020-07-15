<?php

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/post/content', 'single' );

	do_action( 'xtheme/h/single/bottom' );

	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile;
