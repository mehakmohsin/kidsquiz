<?php
/**
 * Childcare sidebar layout options
 *
 * @since Childcare agency  1.0
 *
 */
if (!function_exists('childcare_sidebar_layout_options')) :
    function childcare_sidebar_layout_options() {
        $childcare_sidebar_layout_options = array(
            'default-sidebar' => array(
                'value' => 'default-sidebar',
                'thumbnail' => esc_url(get_template_directory_uri()) . '/images/layout-default/default-sidebar.png'
            ),
            'left-sidebar' => array(
                'value' => 'left-sidebar',
                'thumbnail' => esc_url(get_template_directory_uri()) . '/images/layout-default/left-sidebar.png'
            ),
            'right-sidebar' => array(
                'value' => 'right-sidebar',
                'thumbnail' => esc_url(get_template_directory_uri()) . '/images/layout-default/right-sidebar.png'
            ),
            'no-sidebar' => array(
                'value' => 'no-sidebar',
                'thumbnail' => esc_url(get_template_directory_uri()) . '/images/layout-default/no-sidebar.png'
            )
        );
        return apply_filters('childcare_sidebar_layout_options', $childcare_sidebar_layout_options);
    }
endif;

/**

 * Custom Metabox
 
 **/
if (!function_exists('childcare_add_metabox')):
    function childcare_add_metabox()
    {
        add_meta_box(
            'childcare_sidebar_layout', // $id
            esc_html__('Sidebar Layout', 'childcare'), // $title
            'childcare_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'low'
        ); // $priority

        add_meta_box(
            'childcare_sidebar_layout', // $id
            esc_html__('Sidebar Layout', 'childcare'), // $title
            'childcare_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'low'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'childcare_add_metabox');


/**

 * Callback function for metabox

 **/
if (!function_exists('childcare_sidebar_layout_callback')) :
    function childcare_sidebar_layout_callback()
    {
        global $post;
        $childcare_sidebar_layout_options = childcare_sidebar_layout_options();

        $childcare_options=childcare_theme_default_data(); 
        $customsetting = wp_parse_args(get_option( 'theme_mods_childcare', array(), $childcare_options));
        $childcare_sidebar_layout_c = $customsetting['childcare_option']['childcare_sidebar_layout_option'];
        $childcare_sidebar_meta_layout = get_post_meta( $post->ID, 'childcare_sidebar_layout', true);
        if ( !empty( $childcare_sidebar_meta_layout ) ) {
            $childcare_sidebar_layout = $childcare_sidebar_meta_layout;
        }else{
            $childcare_sidebar_layout = $childcare_sidebar_layout_c;
        }
        wp_nonce_field(basename(__FILE__), 'childcare_sidebar_layout_nonce');
        ?>

        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php esc_html_e('Choose Sidebar Template', 'childcare'); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($childcare_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper qc_radio_button">
                            <input id="<?php echo $field['value']; ?>" type="radio"
                                   name="childcare_sidebar_layout"
                                   value="<?php echo $field['value']; ?>" <?php checked($field['value'], $childcare_sidebar_layout); ?>/>
                            <label class="description" for="<?php echo $field['value']; ?>">
                                <img src="<?php echo esc_url($field['thumbnail']); ?>" alt=""/>
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <em class="f13"><?php esc_html_e('You can set up the sidebar content', 'childcare'); ?>
                        <a href="<?php echo esc_url( admin_url('/widgets.php')); ?>" target="_blank">
                            <?php esc_html_e('here', 'childcare'); ?>
                        </a>
                    </em>
                </td>                
            </tr>
            <tr>
                <td>
                    <em class="f13">
                        <?php esc_html_e('Note: If you wants to set default page layout design then please click', 'childcare'); ?>
                        <a href="<?php echo esc_url( admin_url('/customize.php')); ?>" target="_blank">
                            <?php esc_html_e('here. ', 'childcare'); ?>
                        </a>
                        <?php esc_html_e('Please find there ', 'childcare');?><span class="customSetting"><?php esc_html_e('Theme Options Settings >> Default Sidebar Layout option >> Choose your default option.', 'childcare') ?></span>
                    </em>
                </td>
            </tr>
        </table>

    <?php }
endif;

/**

 * save the custom metabox data
 
 **/
if (!function_exists('childcare_save_sidebar_layout')) :
    function childcare_save_sidebar_layout( $post_id )
    {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset($_POST['childcare_sidebar_layout_nonce']) ||
            !wp_verify_nonce($_POST['childcare_sidebar_layout_nonce'], basename(__FILE__)) || /*Protecting against unwanted requests*/
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || /*Dealing with autosaves*/
            !current_user_can('edit_post', $post_id)/*Verifying access rights*/
        ) {
            return;
        }

        //Execute this saving function
        if ( isset( $_POST['childcare_sidebar_layout'] ) ) {
            $old = get_post_meta( $post_id, 'childcare_sidebar_layout', true);
            $new = sanitize_text_field ($_POST['childcare_sidebar_layout'] );
            if ( $new && $new != $old ) {
                update_post_meta($post_id, 'childcare_sidebar_layout', $new);
            } elseif ( '' == $new && $old ) {
                delete_post_meta( $post_id, 'childcare_sidebar_layout', $old);
            }
        }
    }
endif;
add_action('save_post', 'childcare_save_sidebar_layout');

