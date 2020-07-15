<?php
/**
 * The template for displaying home page.
 *
 * Template Name: Custom Home Page
 *
 * @package Kid Toys Store
 */
get_header(); ?>

<main id="main" role="main">
	<?php do_action( 'kid_toys_store_above_slider' ); ?>
	
	<?php if( get_theme_mod('kid_toys_store_slider_arrows') != ''){ ?>
		<section id="slider">
		  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod( 'kid_toys_store_slider_speed',3000)) ?>"> 
			    <?php $kid_toys_store_slider_pages = array();
			      	for ( $count = 1; $count <= 4; $count++ ) {
				        $mod = intval( get_theme_mod( 'kid_toys_store_slidersettings_page' . $count ));
				        if ( 'page-none-selected' != $mod ) {
				            $kid_toys_store_slider_pages[] = $mod;
				        }
			      	}
			      	if( !empty($kid_toys_store_slider_pages) ) :
			        $args = array(
			          	'post_type' => 'page',
			          	'post__in' => $kid_toys_store_slider_pages,
			          	'orderby' => 'post__in'
			        );
			        $query = new WP_Query( $args );
			        if ( $query->have_posts() ) :
			          $i = 1;
			    ?>     
			    <div class="carousel-inner" role="listbox">
			      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
			        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
			          	<a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail(); ?><span class="screen-reader-text"><?php esc_html_e( 'Slider Images','kid-toys-store' );?></span></a>
			          	<div class="carousel-caption">
				            <div class="inner_carousel">
				            	<?php if( get_theme_mod('kid_toys_store_slider_title',true) != ''){ ?>
				              		<h1><a href="<?php echo esc_url( get_permalink() );?>"><?php esc_html(the_title()); ?><span class="screen-reader-text"><?php esc_html(the_title()); ?></span></a></h1>
				              	<?php }?>
				              	<?php if( get_theme_mod('kid_toys_store_slider_content',true) != ''){ ?>
				                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( kid_toys_store_string_limit_words( $excerpt,esc_attr(get_theme_mod('kid_toys_store_slider_excerpt','15')) ) ); ?></p>
				                <?php }?>
				                <?php if ( get_theme_mod('kid_toys_store_slider_button_text','Read More') != '' && get_theme_mod('kid_toys_store_slider_button',true) != '') {?>
				              		<a class="read-more" href="<?php esc_url(the_permalink()); ?>"><?php echo esc_html( get_theme_mod('kid_toys_store_slider_button_text',__('SHOP NOW', 'kid-toys-store')) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('kid_toys_store_slider_button_text',__('SHOP NOW', 'kid-toys-store')) ); ?></span></a>
				              	<?php }?>
				            </div>
			          	</div>
			        </div>
			      	<?php $i++; endwhile; 
			      	wp_reset_postdata();?>
			    </div>
			    <?php else : ?>
			    <div class="no-postfound"></div>
			      <?php endif;
			    endif;?>
			    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span><span class="screen-reader-text"><?php esc_html_e( 'Previous','kid-toys-store' );?></span>
			    </a>
			    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span><span class="screen-reader-text"><?php esc_html_e( 'Next','kid-toys-store' );?></span>
			    </a>
		  	</div>  
		  	<div class="clearfix"></div>
		</section> 
	<?php }?>

	<?php do_action( 'kid_toys_store_below_slider' ); ?>

	<?php if( get_theme_mod('kid_toys_store_sec1_title') != ''){ ?>
		<section id="our-products">
			<div class="container">
		        <?php if( get_theme_mod('kid_toys_store_sec1_title') != ''){ ?>     
		            <strong><?php echo esc_html(get_theme_mod('kid_toys_store_sec1_title','')); ?></strong>
		            <hr class="titlehr">
		        <?php }?>
				<?php $kid_toys_store_slider_pages = array();
					$mod = intval( get_theme_mod( 'kid_toys_store_servicesettings_page'));
					if ( 'page-none-selected' != $mod ) {
					  $kid_toys_store_slider_pages[] = $mod;
					}
					if( !empty($kid_toys_store_slider_pages) ) :
					  $args = array(
					    'post_type' => 'page',
					    'post__in' => $kid_toys_store_slider_pages,
					    'orderby' => 'post__in'
					  );
					  $query = new WP_Query( $args );
					  if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post(); ?>
						    <div class="box-image">
						        <p><?php the_content(); ?></p>
						        <div class="clearfix"></div>
						    </div>
						<?php  endwhile; ?>
				  	<?php else : ?>
					    <div class="no-postfound"></div>
					<?php endif;
					endif;
				wp_reset_postdata();?>
			    <div class="clearfix"></div>
			</div>
		</section>
	<?php }?>
	<?php do_action( 'kid_toys_store_below_product_section' ); ?>

	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>
	</div>
</main>

<?php get_footer(); ?>