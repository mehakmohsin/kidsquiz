 <?php get_header(); 

 childcare_breadcrumbs(); ?>

	<div class="container page-header-inner"> <img src="<?php echo CHILDCARE_TEMPLATE_DIR_URI; ?>/images/callout-shadow.png" class="img-responsive"> </div>

<div class="container ">

	<div class="col-md-8 smart-gep">

		<h2><?php printf( esc_html__( "Search Results for: %s", 'childcare' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

		<?php if(have_posts()) :

					while(have_posts()) :

							the_post(); ?>

							<div class="course-area-blog  animate fadeInUp" data-anim-type="fadeInUp" data-anim-delay="400">

			<div class=" home-gallery-col">

				<div class="home-gallery-img">

					<?php $default_thumb=array('class'=>"img-responsive");

							if(has_post_thumbnail()) { ?>

					<a href="<?php esc_url(the_permalink()); ?>">

								<?php	the_post_thumbnail('',$default_thumb); ?>

								</a>

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

								 <li>  <i class="fa fa-user"> </i> <?php esc_html_e('By - ','childcare');?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php echo get_the_author(); ?> </a></li>

								 <li><i class="fa fa-globe"> </i> <a href="#"> <?php echo get_the_category_list( esc_html__( ', ', 'childcare' ) ); ?></a> </li>

								 <li class="pull-right"><i class="fa fa-heart-o"> </i><a href="#"><?php comments_popup_link( '0', '1', '%', '', '-'); ?></a><li>

						  	</ul>

						</div>

						<?php the_content(); ?>	
						
						<a href="<?php esc_url(the_permalink()); ?>" class="min-btn btn btn-primary"><?php esc_html_e('Read More','childcare');?></a>

				</div>

			</div></div>

			<?php endwhile; else : ?>

				<h2><?php esc_html_e( "Nothing Found", 'childcare' ); ?></h2>

			<div class="">

			<p><?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'childcare' ); ?>

			</p>

			<?php get_search_form(); ?>

			</div>

			<?php endif; ?>

	<div class="clearfix"> </div>

	</div>

	<?php get_sidebar(); ?>

 <div class="clearfix"></div>

</div><?php get_footer(); ?>	