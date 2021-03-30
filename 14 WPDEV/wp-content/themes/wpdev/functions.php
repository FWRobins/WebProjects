<?php 

//add style and scripts to header
function wpdev_files(){
    wp_enqueue_script('wpdev_main_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL , '1.0' , true);
    wp_enqueue_style('custom_google_fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('wpdev_main_styles', get_stylesheet_uri());
};

add_action('wp_enqueue_scripts', 'wpdev_files');


//add title to tab and nav menu locations
function wpdev_features(){
    add_theme_support('title-tag');
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocation1', 'footer Menu Location1');
    register_nav_menu('footerMenuLocation2', 'footer Menu Location2');
};

add_action('after_setup_theme', 'wpdev_features');

////add new custom post types to wp
//function wpdev_post_types(){
//    register_post_type('event', array(
//        'public'=> True,
//        'menu_icon' => 'dashicons-calendar-alt',
//        'labels'=> array(
//            'name' => 'Events'
//        ),
//    ));
//};
//
//add_action('init', 'wpdev_post_types');

function wpdev_adjust_queries($query){
    $today = date('Ymd');
    if(!is_admin() and is_post_type_archive('event') and $query->is_main_query()){
       $query->set('meta_key', 'event_date'); 
       $query->set('orderby' , 'meta_value_num'); 
       $query->set('order' , 'ASC'); 
       $query->set('meta_query' , array(
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    )
                )); 
    }
    
};

add_action('pre_get_posts', 'wpdev_adjust_queries');

?>