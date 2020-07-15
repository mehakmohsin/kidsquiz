 <?php get_header(); 
 childcare_breadcrumbs(); ?> 

<div class="container page-header-inner"> <img src="<?php echo CHILDCARE_TEMPLATE_DIR_URI; ?>/images/callout-shadow.png" class="img-responsive"> </div> 

<div class="container "> 

    <div class="col-md-8 smart-gep"> 

         <?php if (have_posts()): while (have_posts()): the_post(); ?> 
        
         <?php get_template_part('content', 'post'); ?> 
        
         <?php endwhile; endif; ?> 
        
         <div class="clearfix"> </div> 
        
         <div class="blog-pagination pull-left animate fadeInLeft" data-anim-type=""> 
        
         <?php echo paginate_links(array('show_all' => true, 'prev_text' => '<<', 'next_text' => '>>',)); ?> 
        
         </div> 

    </div> 

 <?php get_sidebar(); ?> 

 <div class="clearfix"></div> 

</div><?php get_footer(); ?>