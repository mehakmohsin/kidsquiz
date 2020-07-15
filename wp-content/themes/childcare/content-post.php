<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<div class="course-area-blog animate" data-anim-type="fadeInUp" data-anim-delay="600">
	    
		<div class=" home-gallery-col">
		    
			<div class="home-gallery-img">

				<?php $default_thumb=array('class'=>"img-responsive");

						if(has_post_thumbnail()) { ?>

				<a href="<?php esc_url(the_permalink()); ?>">

							<?php	the_post_thumbnail('',$default_thumb); ?>

							</a>

							<?php } else { ?>
							
							<a href="<?php esc_url(the_permalink()); ?>"><?php echo '<img alt="" src="'. esc_url(get_template_directory_uri()) . '/images/default.png' .'">';?></a>

							<?php } ?>

				<div class="gallery-showcase-overlay">

					<div class="gallery-showcase-overlay-inner">

						<div class="gallery-showcase-icons">

							<a href="<?php esc_url(the_permalink()); ?>" class="hover_thumb"><i class="fa fa-link"></i></a>

						</div>

					</div> 

				</div>

			</div>

		</div>

		<a href="#"> <span class="date-post"> <?php echo get_the_date('j'); ?> <span><?php echo get_the_date('M'); ?></span> </span></a>

		<span class="lick-post"><i class="fa fa-heart-o"> </i> <?php comments_popup_link( '0', '1', '%', '', '-'); ?> </span>	

		<div class="post-blog">

			<div class="post-heading-blog">

				<h2><a href="<?php esc_url(the_permalink()); ?>"><?php  the_title(); ?></a></h2>

					<div class="blog-post-detail">

						<ul>

							 <li> <i class="fa fa-user"> </i> <?php esc_html_e('By - ','childcare'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php echo get_the_author(); ?> </a></li>

							 <li> <a href="#"> <i class="fa fa-tags"> </i><?php the_tags('', ', '); ?></a> </li>

							 <li class="pull-right"><a href="#"><i class="fa fa-heart-o"> </i><?php comments_popup_link( '0', '1', '%', '', '-'); ?></a><li>

						</ul>

					</div>				

			<?php the_excerpt(esc_html__( 'More' , 'childcare' )); ?>

			<div class="blog-pagination animate fadeInLeft" data-anim-type="">

				<?php wp_link_pages(); ?>

				</div>

			<a href="<?php esc_url(the_permalink()); ?>" class="min-btn btn btn-primary"><?php esc_html_e('Read More','childcare');?></a>

			</div>

		</div>

	</div>

</article>		