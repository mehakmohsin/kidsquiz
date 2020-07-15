<div id="post-<?php the_ID(); ?>" class="swiper-slide">
	<div class="hero__overlay">
		<?php Xtheme_Club\the_post_thumbnail( 'hero' ); ?>
	</div>

	<div class="hero__content">
		<?php Xtheme_Club\post_categories(); ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php Xtheme_Club\post_date(); ?>
		<div class="read-more">
			<a class="btn" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read more', 'jordy' ); ?>
			</a>
		</div>
	</div>
</div>
