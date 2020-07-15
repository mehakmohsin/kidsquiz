<?php

if ( have_posts() ) :
	echo '<div class="news__items">';
	$i = 1;
	while ( have_posts() ) :
		$i++;
		the_post();

		if ( $i === 2 ) {
			add_filter( 'xtheme/f/post/thumbnail', function() {
				return 'single';
			} );
			get_template_part( 'template-parts/post/content', get_post_format() );
		} else {
			get_template_part( 'template-parts/post/content', get_post_format() );
		}

	endwhile;

	do_action( 'xtheme/h/general/bottom' );

	echo '</div>';
else :
	get_template_part( 'template-parts/post/content', 'none' );
endif;
