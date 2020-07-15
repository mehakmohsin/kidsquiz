<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>
	<div class="page-content" <?php printf( 'data-first_letter="%s"', esc_attr( Xtheme_Club\first_content_character() ) ); ?>>
		<?php
		the_content();

		wp_link_pages( [
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'jordy' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'jordy' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		] );
		?>
	</div>
</article>
