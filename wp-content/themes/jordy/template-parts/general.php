<?php

if ( have_posts() ) :
	echo '<div class="news__items">';

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile;

	do_action( 'xtheme/h/general/bottom' );

	echo '</div>';
else :
	get_template_part( 'template-parts/post/content', 'none' );
endif;
