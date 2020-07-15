<?php 
/**
 * Template part for displaying Blog Section
 *
 *@package Grand Academy
 */
?>
<?php 
    $blog_section_title    = grand_academy_get_option( 'blog_section_title' );
	$blog_category 		   = grand_academy_get_option( 'blog_category' );
	$blog_number		   = grand_academy_get_option( 'blog_number' );
?> 
    <?php if( !empty($blog_section_title) ):?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($blog_section_title);?></h2>
        </div><!-- .section-header -->
    <?php endif;?>

  	<div class="section-content col-3">
	  	<?php
			$blog_args = array(
				'posts_per_page' =>absint( $blog_number ),				
				'post_type' => 'post',
	            'post_status' => 'publish',
	            'paged' => 1,
				);

			if ( absint( $blog_category ) > 0 ) {
				$blog_args['cat'] = absint( $blog_category );
			}
			
			// Fetch posts.
			$the_query = new WP_Query( $blog_args );
			
		?>

		<?php if ( $the_query->have_posts() ) : 			
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			    <article class="<?php echo has_post_thumbnail() ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>">
			    	<div class="post-item">
				      	<?php if(has_post_thumbnail()):?>
					        <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                                <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                            </div><!-- .featured-image -->
				    	<?php endif?>

				    	<div class="entry-container">
					        <header class="entry-header">
								<h2 class="entry-title">
									<a href="<?php the_permalink();?>"><?php the_title();?></a>
								</h2>
					        </header>

					        <div class="entry-meta">		         
					            <?php grand_academy_posted_on();
								grand_academy_entry_meta(); ?>
					        </div><!-- .entry-meta -->

					        <div class="entry-content">
			 				    <?php
									$excerpt = grand_academy_the_excerpt( 15 );
									echo wp_kses_post( wpautop( $excerpt ) );
								?>
					        </div><!-- .entry-content -->

					        <div class="read-more">
                                <?php $readmore_text = grand_academy_get_option( 'readmore_text' );?>
                                <a href="<?php the_permalink();?>"><?php echo esc_html($readmore_text);?></a>
                            </div><!-- .read-more -->
				        </div><!-- .entry-container -->
				    </div><!-- .post-item -->
			    </article>
		    <?php endwhile;?>
		    <?php wp_reset_postdata(); ?>
	    <?php endif;?>
  	</div><!-- .section-content -->