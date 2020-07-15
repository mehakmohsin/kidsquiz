<?php
/**
 * The main template file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aino
 */

get_header(); ?>

<?php
	// Sticky Posts.
	$sticky       = get_option( 'sticky_posts' );
	$args_sticky  = array(
		'post__in' => $sticky,
	);
	$query_sticky = new WP_Query( $args_sticky );
	?>

	<div id="primary" class="content-area">

		<?php if ( is_home() && ! is_front_page() ) : ?>

			<header class="page-header grid-margins">

			<?php if ( get_theme_mod( 'blog_title' ) ) : ?>
				<h1 class="page-title col col7"><?php echo wp_kses_post( get_theme_mod( 'blog_title' ) ); ?></h1>
			<?php else : ?>
				<h1 class="page-title screen-reader-text"><?php esc_html_e( 'Posts', 'aino' ); ?></h1>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'blog_title_description' ) ) : ?>
				<div class="description col col7">
					<p><?php echo wp_kses_post( get_theme_mod( 'blog_title_description' ) ); ?></p>
				</div><!-- .description -->
			<?php endif; ?>

			</header>
		<?php endif; ?>

		<main id="main" class="site-main mobile-margins" role="main">

		<div class="posts-container" id="posts-container">

		<?php
			if ( have_posts() ) :
				?>

				<?php
				// Start the Standard Loop.
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post/content' );
				endwhile;
				?>
		<?php endif; ?>

	</div><!-- .posts-container -->

		<?php
		the_posts_pagination(
			array(
				'next_text'          => aino_get_svg( array( 'icon' => 'baseline-chevron_right-24px' ) ) . '<span class="meta-nav">' . esc_html__( 'Older posts', 'aino' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Older posts', 'aino' ) . '</span> ',
				'prev_text'          => aino_get_svg( array( 'icon' => 'baseline-chevron_left-24px' ) ) . '<span class="meta-nav">' . esc_html__( 'Newer posts', 'aino' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Newer posts', 'aino' ) . '</span> ',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'aino' ) . ' </span>',
			)
		);
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
