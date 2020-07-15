<?php
$hero_query = new WP_Query( [
	'tag'            => get_theme_mod( 'hero_tag', 'featured' ),
	'posts_per_page' => 4,
] );

if ( $hero_query->have_posts() ) :
	echo '<div class="hero"><div class="swiper-container"><div class="swiper-wrapper">';
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();
		get_template_part( 'template-parts/post/content', 'hero' );
	endwhile;
	echo '</div><div class="swiper-button-prev"></div> <div class="swiper-button-next"></div>';
	echo '</div></div>';
else :
	Xtheme_Club\Live_Preview::hero();
endif;

wp_reset_postdata();
