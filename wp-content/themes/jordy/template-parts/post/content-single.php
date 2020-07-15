<?php

use function Xtheme_Club\entry_footer;
use function Xtheme_Club\post_categories;
use function Xtheme_Club\post_date;
use function Xtheme_Club\the_post_thumbnail;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		the_post_thumbnail( 'single' );
		post_categories();
		the_title( '<h1 class="entry-title">', '</h1>' );
		post_date();
		?>
	</header>

	<div class="entry-content" <?php printf( 'data-first_letter="%s"', esc_attr( Xtheme_Club\first_content_character() ) ); ?>>
		<?php
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jordy' ),
			'after'  => '</div>',
		] );
		?>
	</div>
	<footer class="entry-footer">
		<?php entry_footer(); ?>
	</footer>
</article>
