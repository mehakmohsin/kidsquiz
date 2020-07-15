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
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="postbox mdallpostimage">
    <?php
      if ( ! is_single() ) {
        // If not a single post, highlight the gallery.
        if ( get_post_gallery() ) {
          echo '<div class="entry-gallery">';
          echo get_post_gallery();
          echo '</div>';
        };

      };
    ?>
    <div class="new-text">
      <div class="box-content">
        <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html(the_title()); ?><span class="screen-reader-text"><?php esc_html(the_title()); ?></span></a></h2>
        <?php if( get_theme_mod( 'kid_toys_store_date_hide',true) != '' || get_theme_mod( 'kid_toys_store_comment_hide',true) != '' || get_theme_mod( 'kid_toys_store_author_hide',true) != '') { ?>
          <div class="metabox">
            <?php if( get_theme_mod( 'kid_toys_store_date_hide',true) != '') { ?>
              <span class="entry-date"><i class="far fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
            <?php } ?>

            <?php if( get_theme_mod( 'kid_toys_store_author_hide',true) != '') { ?>
              <span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php esc_html(the_author()); ?><span class="screen-reader-text"><?php esc_html(the_author()); ?></span></a></span>
            <?php } ?>

            <?php if( get_theme_mod( 'kid_toys_store_comment_hide',true) != '') { ?>
              <span class="entry-comments"><i class="fa fa-comments" aria-hidden="true"></i><?php comments_number( __('0 Comment', 'kid-toys-store'), __('0 Comments', 'kid-toys-store'), __('% Comments', 'kid-toys-store') ); ?> </span>
            <?php } ?>
          </div>
        <?php } ?>
        <?php if(get_theme_mod('kid_toys_store_post_content') == 'Full Content'){ ?>
          <?php the_content(); ?>
        <?php }
        if(get_theme_mod('kid_toys_store_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?>
          <?php if(get_the_excerpt()) { ?>
            <p><?php $excerpt = get_the_excerpt(); echo esc_html( kid_toys_store_string_limit_words( $excerpt, esc_attr(get_theme_mod('kid_toys_store_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('kid_toys_store_button_excerpt_suffix','[...]') ); ?></p>
          <?php }?>
        <?php }?>
        <?php if ( get_theme_mod('kid_toys_store_post_button_text','Read Full') != '' ) {?>
          <a href="<?php esc_url(the_permalink()); ?>" class="blogbutton-mdall hvr-sweep-to-right"><?php echo esc_html( get_theme_mod('kid_toys_store_post_button_text',__( 'Read Full','kid-toys-store' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('kid_toys_store_post_button_text',__( 'Read Full','kid-toys-store' )) ); ?></span></a>
        <?php }?>
      </div>
    </div>
    <div class="clearfix"></div> 
  </div> 
</article>