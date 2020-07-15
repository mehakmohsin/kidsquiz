<?php function childcare_curPageURL() { 
    $pageURL = 'http'; if (key_exists("HTTPS", $_SERVER) && ($_SERVER["HTTPS"] == "on")) {
    $pageURL.= "s"; }
    $pageURL.= "://"; 
    if ($_SERVER["SERVER_PORT"] != "80") { $pageURL.= esc_url($_SERVER["SERVER_NAME"]) . ":" . $_SERVER["SERVER_PORT"] . esc_url($_SERVER["REQUEST_URI"]); }
    else { $pageURL.= esc_url($_SERVER["SERVER_NAME"]) . esc_url($_SERVER["REQUEST_URI"]); } return esc_url($pageURL); }
    if (!function_exists('childcare_breadcrumbs')): function childcare_breadcrumbs() { global $post; $homeLink = home_url(); ?> 

 <div class="page-header-top"> 

 <div class="container"> 

 <div class=" col-md-6 page-header-inner animate fadeInRight" data-anim-type=""> 

 <?php echo '<ul id="mytabs">'; 
 if (is_home() || is_front_page()):
    echo '<li><a href="' . esc_url($homeLink) . '">' . __('Home/', 'childcare') . '</a></li>';
    echo '<li class="active"><a href="' . esc_url($homeLink) . '">' . get_bloginfo('name') . '</a></li>';
    else: echo '<li><a href="' . esc_url($homeLink) . '">' . __('Home /', 'childcare') . '</a></li>';
    if (is_category()) { 
    echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . __('Archive category', 'childcare') . ' "' . single_cat_title('', false) . '"</a></li>';
    } elseif (is_day()) { 
    echo '<li class="active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
    echo '<li class="active"><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
    echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . get_the_time('d') . '</a></li>';
    } elseif (is_month()) { 
        echo '<li class="active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
        echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . get_the_time('F') . '</a></li>';
    } elseif (is_year()) { 
    echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . get_the_time('Y') . '</a></li>'; }
    /*elseif ( is_single() && !is_attachment() ) { if ( get_post_type() != 'post' ) { $cat = get_the_category(); $cat = $cat[0]; echo '<li>';
    echo get_category_parents($cat, TRUE, ''); echo '</li>';
    echo '<li class="active"><a href="' . childcare_curPageURL() . '">'. wp_title( '',false ) .'</a></li>'; } } */
    elseif (is_page() && $post->post_parent) {
    $parent_id = $post->post_parent; $breadcrumbs = array(); 
    while ($parent_id) { 
    $page = get_page($parent_id); $breadcrumbs[] = '<li class="active"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
    $parent_id = $page->post_parent; } $breadcrumbs = array_reverse($breadcrumbs); foreach ($breadcrumbs as $crumb) echo esc_url($crumb);
    echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . get_the_title() . '</a></li>'; }
    elseif (is_search()) { 
    echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . get_search_query() . '</a></li>'; }
    elseif (is_404()) { echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . __("404 Error", "childcare") . '</a></li>'; }
    else { echo '<li class="active"><a href="' . childcare_curPageURL() . '">' . get_the_title() . '</a></li>'; } endif; echo '</ul>' ?> 

 </div> 

 <div class="col-md-6 animate fadeInLeft" data-anim-type=""> 

 <?php if (is_home() || is_front_page()): echo '<h1 class="pagetitle white">' . __('Home', 'childcare') . '</h1>'; else: childcare_archive_title(); endif; ?> 

 </div> 

 </div> 

 </div> 

 <div class="page-seperate"></div> 

 <div class="clearfix"></div> 

 <?php } endif ?>