<?php
/**
 * The template part for displaying single-post
 *
 * @package Kid Toys Store
 * @subpackage kid_toys_store
 * @since Kid Toys Store 1.0
 */
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<div class="col-lg-4 col-md-4">
  <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="postbox mdallpostimage">
      <?php the_post_thumbnail(); ?>
      <div class="new-text">
          <div class="box-content">
            <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html(the_title()); ?><span class="screen-reader-text"><?php esc_html(the_title()); ?></span></a></h2>
            <?php if(get_the_excerpt()) { ?>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( kid_toys_store_string_limit_words( $excerpt, esc_attr(get_theme_mod('kid_toys_store_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('kid_toys_store_button_excerpt_suffix','[...]') ); ?></p>
            <?php }?>
            <?php if ( get_theme_mod('kid_toys_store_post_button_text','Read Full') != '' ) {?>
              <a href="<?php esc_url(the_permalink()); ?>" class="blogbutton-mdall hvr-sweep-to-right"><?php echo esc_html( get_theme_mod('kid_toys_store_post_button_text',__( 'Read Full','kid-toys-store' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('kid_toys_store_post_button_text',__( 'Read Full','kid-toys-store' )) ); ?></span></a>
            <?php }?>
          </div>
      </div>
      <div class="clearfix"></div> 
    </div> 
  </article>
</div>