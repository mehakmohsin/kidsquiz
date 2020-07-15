<?php
/**
 * Template Name:Page with Left Sidebar
 */
get_header(); ?>

<?php do_action( 'kid_toys_store_header_page_left' ); ?>

<div class="container">
    <main id="main" role="main" class="middle-align row">       
		<div class="col-lg-4 col-md-4" id="sidebar">
			<?php dynamic_sidebar('sidebar-2'); ?>
		</div>		 
		<div class="col-lg-8 col-md-8" class="content-aa" >
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_post_thumbnail(); ?>
                <h1><?php esc_html(the_title()); ?></h1>
                <div class="entry-content"><?php the_content();?></div>
            <?php endwhile; // end of the loop. ?>
            <?php
                //If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
            <div class="clear"></div> 
        </div>  
    </main>
</div>

<?php do_action( 'kid_toys_store_footer_page_left' ); ?>

<?php get_footer(); ?>