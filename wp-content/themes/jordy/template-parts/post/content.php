<?php

use function Xtheme_Club\post_categories;
use function Xtheme_Club\post_date;
use function Xtheme_Club\the_post_thumbnail;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail( apply_filters( 'xtheme/f/post/thumbnail', 'blog' ) ); ?>
	<?php post_categories(); ?>
	<header class="news__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</header>
	<?php post_date(); ?>
	<main class="news__text">
		<?php the_excerpt(); ?>
	</main>
	<footer class="news__footer">
		<div class="read-more">
			<a class="btn btn--outline" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read more', 'jordy' ); ?>
			</a>
		</div>
	</footer>
</article>
