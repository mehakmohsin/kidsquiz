<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Kid Toys Store
 */
?>
<footer role="contentinfo">
    <?php //Set widget areas classes based on user choice
        $kid_toys_store_widget_areas = get_theme_mod('kid_toys_store_footer_widget_layout', '4');
        if ($kid_toys_store_widget_areas == '3') {
            $cols = 'col-lg-4 col-md-4';
        } elseif ($kid_toys_store_widget_areas == '4') {
            $cols = 'col-lg-3 col-md-3';
        } elseif ($kid_toys_store_widget_areas == '2') {
            $cols = 'col-lg-6 col-md-6';
        } else {
            $cols = 'col-lg-12 col-md-12';
        }
    ?>
    <div class="footertown">
        <div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                  <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
                    <?php dynamic_sidebar( 'footer-1'); ?>
                  </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                  <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
                    <?php dynamic_sidebar( 'footer-2'); ?>
                  </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                  <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
                    <?php dynamic_sidebar( 'footer-3'); ?>
                  </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                  <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
                    <?php dynamic_sidebar( 'footer-4'); ?>
                  </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="footer" class="copyright-wrapper">
        <div class="container">
            <div class="copyright">
                <p><?php kid_toys_store_credit_link(); ?> <?php echo esc_html(get_theme_mod('kid_toys_store_footer_copy',__('By ThemesCaliber','kid-toys-store'))); ?></p>
            </div>
            <div class="clear"></div>  
        </div>
    </div>

    <?php if( get_theme_mod( 'kid_toys_store_show_back_to_top',true) != '') { ?>
        <?php $scroll_lay = get_theme_mod( 'kid_toys_store_back_to_top_alignment','Right');
            if($scroll_lay == 'Left'){ ?>
               <a href="#" class="scrollup left"><span><?php esc_html_e('Back to Top', 'kid-toys-store'); ?><i class="fas fa-arrow-right"></i></span><span class="screen-reader-text"><?php esc_html_e('Back to Top', 'kid-toys-store'); ?></span></a>
            <?php }else if($scroll_lay == 'Center'){ ?>
              <a href="#" class="scrollup center"><span><?php esc_html_e('Back to Top', 'kid-toys-store'); ?><i class="fas fa-arrow-right"></i></span><span class="screen-reader-text"><?php esc_html_e('Back to Top', 'kid-toys-store'); ?></span></a>
            <?php }else{ ?>
              <a href="#" class="scrollup right"><span><?php esc_html_e('Back to Top', 'kid-toys-store'); ?><i class="fas fa-arrow-right"></i></span><span class="screen-reader-text"><?php esc_html_e('Back to Top', 'kid-toys-store'); ?></span></a>
        <?php }?>
    <?php }?>
    <?php wp_footer(); ?>
</footer>
</body>
</html>