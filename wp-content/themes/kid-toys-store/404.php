<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Kid Toys Store
 */
get_header(); ?>

<main id="main" role="main" class="content-aa">
	<div class="container">
        <div class="page-content">
			<?php if(get_theme_mod('kid_toys_store_404_title','404 Not Found')){ ?>	
				<h1><?php echo esc_html( get_theme_mod('kid_toys_store_404_title',__('404 Not Found', 'kid-toys-store' )) ); ?></h1>
			<?php }?>
			<?php if(get_theme_mod('kid_toys_store_404_text','Looks like you have taken a wrong turn. Dont worry it happens to the best of us.')){ ?>
				<p class="text-404"><?php echo esc_html( get_theme_mod('kid_toys_store_404_text',__('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.', 'kid-toys-store' )) ); ?></p>
			<?php }?>
			<?php if(get_theme_mod('kid_toys_store_404_button_text','Back to Home Page')){ ?>
				<div class="read-moresec">
	           		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right"><?php echo esc_html( get_theme_mod('kid_toys_store_404_button_text',__('Back to Home Page', 'kid-toys-store' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('kid_toys_store_404_button_text',__('Back to Home Page', 'kid-toys-store' )) ); ?></span></a>
				</div>
				<div class="clearfix"></div>
			<?php }?>
        </div>
	</div>
</main>

<?php get_footer(); ?>