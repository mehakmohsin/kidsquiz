<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Kid Toys Store
 */
get_header(); ?>

<?php do_action( 'kid_toys_store_header_page' ); ?>

<div class="container">
    <div class="middle-align">       
        <main id="main" role="main" class="content-aa">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_post_thumbnail();  ?>
                <h1><?php esc_html(the_title()); ?></h1>
                <?php the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'kid-toys-store' ),
                    'after'  => '</div>',
                ) );
                
                //If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
            <?php endwhile; // end of the loop. ?>
        </main>
        <div class="clearfix"></div>              
    </div>
</div>

<?php do_action( 'kid_toys_store_footer_page' ); ?>

<?php get_footer(); ?>