 <?php get_header();

 childcare_breadcrumbs(); ?>

<div class="container page-header-inner"> <img src="<?php echo CHILDCARE_TEMPLATE_DIR_URI; ?>/images/callout-shadow.png" class="img-responsive"> </div>

<div class="clearfix"></div>
<div class=" container ">
	<div class="row">
		<div class="col-md-8">
			<div class="course-area-blog-post  animate" data-anim-type="zoomIn" data-anim-delay="400">
				<?php the_post();  ?>
				<h2><a href="<?php esc_url(the_permalink()); ?>"><?php the_title();?> </a></h2>
					<ul>
						 <li><i class="fa fa-user"></i> <?php esc_html_e('By - ','childcare'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php echo get_the_author(); ?> </a></li>

						 <li><i class="fa fa-globe"> </i> <a href="#"><?php echo get_the_category_list( esc_html__( ', ', 'childcare' ) ); ?></a> </li>

						 <li><i class="fa fa-calendar"></i> <a href="#"><?php the_date(); ?> </a>

						 <li class="pull-right"><i class="fa fa-heart-o"> </i> <a href="#"><?php comments_popup_link( '0', '1', '%', '', '-'); ?></a></li>
					</ul>
					<div class=" home-gallery-col">
						<div class="home-gallery-img">
							<?php $default_img = array('class' => "img-responsive");
								if(has_post_thumbnail()) {
									the_post_thumbnail('',$default_img); 
									 } else { ?>
								<a href="<?php esc_url(the_permalink()); ?>"><?php echo '<img alt="" src="'. esc_url(get_template_directory_uri()) . '/images/default.png' .'">';?></a>
								<?php } ?>
							<div class="gallery-showcase-overlay">
								<div class="gallery-showcase-overlay-inner"></div> 
							</div>
						</div>
					</div>

					<div class="blog-post-title">
						<h4><?php the_title(); ?></h4>				
						<?php the_content(); ?>
						<div class="blog-pagination animate fadeInLeft" data-anim-type="">
						<?php wp_link_pages(); ?>
						</div>
					</div>
					<?php the_post_navigation('nav-below'); ?>
					<div class="row user_detail">
						<div class="colam-user-img">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ),'class="img-responsive"' ); ?>
						</div>
						<div class="colam-user-name">
							<h2><?php echo get_the_author(); ?></h2>
							<h5><i> <?php echo get_the_category_list( esc_html__( ', ', 'childcare' ) ); ?> </i>  </h5>
							<p> <?php echo get_the_author_meta('description'); if(!get_the_author_meta('description')) esc_html_e('No description. Please update your profile.','childcare'); ?> </p>	
						</div>
					</div>
				<div class="clearfix"> </div>
				<?php comments_template( '', true );?>
			</div>
		</div>	
	<?php get_sidebar(); ?>	
	</div>
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
</div>