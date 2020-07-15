<?php
if (!function_exists('childcare_gravatar_class')):
    add_filter('get_avatar', 'childcare_gravatar_class');
    function childcare_gravatar_class($class) {
        $class = str_replace("class='avatar", "class='comment_img", $class);
        return $class;
    }
endif;
if (!function_exists('childcare_archive_title')):
    function childcare_archive_title($before = '<h1 class="pagetitle white" data-anim-type="fadeInLeft">', $after = '</h1>') {
        if (is_archive()) {
            if (is_category()) {
                $title = get_the_archive_title();
            } elseif (is_tag()) {
                $title = get_the_archive_title();
            } elseif (is_author()) {
                $title = get_the_archive_title();
            } elseif (is_year()) {
                $title = get_the_archive_title();
            } elseif (is_month()) {
                $title = get_the_archive_title();
            } elseif (is_day()) {
                $title = get_the_archive_title();
            } elseif (is_post_type_archive()) {
                $title = get_the_archive_title();
            }
        } elseif (is_search()) {
            $title = sprintf(__('Search Results for : %s', 'childcare'), get_search_query());
        } elseif (is_404()) {
            $title = sprintf(__('Error 404  : Page Not Found', 'childcare'));
        } else {
            echo '<h1 class="pagetitle white animate" data-anim-type="fadeInLeft">' . get_the_title() . '</h1>';
        }
        if (!empty($title)) {
            echo '<h1 class="pagetitle white" data-anim-type="fadeInLeft">' . $title . '<h1>';
        }
    }
endif;
function childcare_footer_setting() { ?>

<div class="footer_top section-notch"></div>

<section class="footer">
    
	<div class="container">
	    
		<div class="min-footer animate" data-anim-type="fadeInUp" data-anim-delay="200"> 
		
			<?php
    $childcare_options = childcare_theme_default_data();
    $footer_setting = wp_parse_args(get_option('childcare_option', array()), $childcare_options);
    if (is_active_sidebar('footer-widget-area')) {
        dynamic_sidebar('footer-widget-area');
    } else {
        $footer_widget = array('before_widget' => '<div class="col-md-3"><div class="colam-footer">', 'after_widget' => '</div></div>', 'before_title' => '<h2>', 'after_title' => '</h2>',);
        the_widget('WP_Widget_Calendar', 'title=' . __('Calendar', 'childcare'), $footer_widget);
        the_widget('WP_Widget_Categories', null, $footer_widget);
        the_widget('WP_Widget_Pages', null, $footer_widget);
        the_widget('WP_Widget_Archives', null, $footer_widget);
    } ?>
		</div>

	</div>

	<div class="bottom-footer">

	<div class="container">

	<div class="animate" data-anim-type="fadeInLeft">
	    
		<div class="bottom-footer-inner">

		<?php if (function_exists('the_custom_logo')) {
        the_custom_logo();
    } ?>

			<?php if ($footer_setting['footer_bottom_enabled'] == 1) { ?>
			
			<div class="cinfo">

				<p><?php if ($footer_setting['footer_logo_contact_add_one'] != '') {
            echo esc_html($footer_setting['footer_logo_contact_add_one']);
        } ?>  <span> <?php if ($footer_setting['footer_logo_email_title'] != '') {
            echo esc_html($footer_setting['footer_logo_email_title']);
        } ?></span> <?php if ($footer_setting['footer_logo_email'] != '') {
            echo esc_html($footer_setting['footer_logo_email']);
        } ?> </p>  
        
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($footer_setting['footer_logo_contact_add_two'] != '') {
            echo esc_html($footer_setting['footer_logo_contact_add_two']);
        } ?>  <span> <?php if ($footer_setting['footer_logo_phone_title'] != '') {
            echo esc_html($footer_setting['footer_logo_phone_title']);
        } ?></span> <?php if ($footer_setting['footer_logo_phone'] != '') {
            echo esc_html($footer_setting['footer_logo_phone']);
        } ?> </p> 

			</div>
			
			<?php
    } ?>	

			<?php
    if ($footer_setting['header_social_media_enabled'] == 1) { ?>

			<div class="hi-icon-wrap">

				<?php if ($footer_setting['social_media_linkedin_link'] != '') { ?> 
				
				<a href="<?php echo esc_url($footer_setting['social_media_linkedin_link']); ?>"<?php if ($footer_setting['linkedin_media_enabled'] == 1) {
                echo "target='_blank'";
            } ?>> <i class="link fa fa-linkedin"> </i> </a>

				<?php
        }
        if ($footer_setting['social_media_google_link'] != '') { ?> 

				<a href="<?php echo esc_url($footer_setting['social_media_google_link']); ?>"<?php if ($footer_setting['google_media_enabled'] == 1) {
                echo "target='_blank'";
            } ?>> <i class="google fa fa-google-plus"> </i> </a>

				<?php
        }
        if ($footer_setting['social_media_twitter_link'] != '') { ?>

				<a href="<?php echo esc_url($footer_setting['social_media_twitter_link']); ?>"<?php if ($footer_setting['twitter_media_enabled'] == 1) {
                echo "target='_blank'";
            } ?>> <i class="twitter fa fa-twitter"> </i></a>

	<?php
        }
        if ($footer_setting['social_media_facebook_link'] != '') { ?>

				<a href="<?php echo esc_url($footer_setting['social_media_facebook_link']); ?>"<?php if ($footer_setting['facebook_media_enabled'] == 1) {
                echo "target='_blank'";
            } ?>> <i class="facebook fa fa-facebook"> </i> </a>

				<?php
        } ?>

			</div>

			<?php
    } ?>
    
		</div>	
		
	  </div>
	  
	</div>

</div>

</section>

	<div class="copyright-section">	

	  <div class="container copy-right-inner">

		<p><?php if ($footer_setting['footer_customization_text'] != '') {
        echo esc_html($footer_setting['footer_customization_text']);
    }
    if ($footer_setting['footer_customization_develop'] != '') {
        echo "-" . esc_html($footer_setting['footer_customization_develop']);
    } ?> 

			<a target="_blank" rel="nofollow" href="<?php if ($footer_setting['develop_by_link'] != '') {
        echo esc_url($footer_setting['develop_by_link']);
    } ?>"><?php if ($footer_setting['develop_by_name'] != '') {
        echo $footer_setting['develop_by_name'];
    } ?></a></p>

	  </div>

    </div>

    <a href="#" class="hc_scrollup"><i class="fa fa-chevron-up"></i></a>

</div>

<?php
}
if (!function_exists('childcare_the_custom_logo')):
    function childcare_the_custom_logo() {
        if (function_exists('the_custom_logo')) {
            the_custom_logo();
        }
    }
endif;
?>