<?php
/**
 * The template for displaying home page.
 * @package Grand Academy
 */

if ( 'posts' != get_option( 'show_on_front' ) ){ 
    get_header(); ?>
    <?php $enabled_sections = grand_academy_get_sections();
    if( is_array( $enabled_sections ) ) {
        foreach( $enabled_sections as $section ) {

            if( ( $section['id'] == 'featured-slider' ) ){ ?>
                <?php $enable_featured_slider = grand_academy_get_option( 'enable_featured_slider' );
                if( true ==$enable_featured_slider): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cloud-up.png' ) ?>" class="cloud-bg">
                    </section>
            <?php endif; ?>

            <?php } elseif( $section['id'] == 'our-services' ) { ?>
                <?php $enable_our_services_section = grand_academy_get_option( 'enable_our_services_section' );
                if( true ==$enable_our_services_section): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" class="page-section">
                        <div class="wrapper">
                            <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cloud-down.png' ) ?>" class="cloud-bg">
                        </div>
                    </section>
            <?php endif; ?>

            <?php } elseif( $section['id'] == 'our-courses' ) { ?>
                <?php $enable_our_courses_section = grand_academy_get_option( 'enable_our_courses_section' );
                if(true ==$enable_our_courses_section): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" class="page-section">  
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cloud-top.png' ) ?>" class="cloud-bg">
                        <div class="wrapper">
                            <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        </div>
                    </section>
            <?php endif; ?>

            <?php } elseif( $section['id'] == 'about-us' ) { ?>
                <?php $enable_about_us_section = grand_academy_get_option( 'enable_about_us_section' );
                if( true ==$enable_about_us_section): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" class="page-section">
                        <div class="wrapper">
                            <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        </div>
                    </section>
            <?php endif; ?>

            <?php } elseif( $section['id'] == 'team' ) { ?>
                <?php $enable_team_section = grand_academy_get_option( 'enable_team_section' );
                if( true ==$enable_team_section): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" class="page-section">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/team-cloud.png' ) ?>" class="cloud-bg">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </section>
            <?php endif; 
            
            }
            elseif( ( $section['id'] == 'blog' ) ){ ?>
                <?php $enable_blog_section = grand_academy_get_option( 'enable_blog_section' );
                if(true ==$enable_blog_section): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" class="blog-posts-wrapper page-section">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cloud-top.png' ) ?>" class="cloud-bg">
                        <div class="wrapper">
                            <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        </div>
                    </section>
                <?php endif;
            }
        }
    }
    if( true == grand_academy_get_option('enable_frontpage_content') ) { ?>
        <div class="wrapper page-section">
            <?php include( get_page_template() ); ?>
        </div>
    <?php }
    get_footer();
} 
elseif ('posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} 