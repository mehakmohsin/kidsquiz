<?php get_header();
childcare_breadcrumbs(); ?>	

<div class="container page-header-inner"> <img src="<?php echo CHILDCARE_TEMPLATE_DIR_URI; ?>/images/callout-shadow.png" class="img-responsive"> </div>

<div class="clearfix"></div>

<div class="page-not-found"> 

	<div class="container">

		<div class="page-not-found-inner"> 

			<ul>

				<li class="animate" data-anim-type="fadeInLeft"> <div class="rotted-not-found animate" data-anim-type="fadeInLeft"><?php esc_html_e('4', 'childcare'); ?> </div></li>

				<li class="animate" data-anim-type="fadeInUp" data-anim-delay="600"><div class="img0-not-found"><img src="<?php echo CHILDCARE_TEMPLATE_DIR_URI; ?>/images/404shape.png" class="img-responsive"></div></li>

				<li class="animate" data-anim-type="fadeInRight"> <div class="rotted-not-found animate" data-anim-type="fadeInRight"><?php esc_html_e('4', 'childcare'); ?></div></li>

			</ul>

				<h2><?php esc_html_e('OOPS PAGE NOT-FOUND!', 'childcare'); ?> </h2>

				<h3><?php esc_html_e('THE LINK MIGHT BE CORRUPTED', 'childcare'); ?></h3>

				<p><?php esc_html_e('Your can search what your interested in:', 'childcare'); ?></p>

				<div class="col-md-4 form-not-found input-group animate" data-anim-type="fadeInLeft">

				<?php get_search_form(); ?>

				</div>

				<h5><?php esc_html_e('or', 'childcare'); ?> </h5>

				<a href="<?php echo esc_url(home_url()); ?>" class="min-btn btn btn-primary"><?php esc_html_e('GO TO HOMEPAGE', 'childcare'); ?></a>

		</div>

	</div>	

</div>

 <div class="clearfix"></div>

<?php get_footer(); ?>

</div>		