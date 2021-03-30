<?php

//add new custom post types to wp
//code file in \wp-content\mu-plugins\ forces wp to always load plugin
function wpdev_post_types(){
    register_post_type('event', array(
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array(
        'slug' => 'events',
        ), //change slug for posts listing
        'has_archive' => true, //create post listings page
        'public'=> true,
        'menu_icon' => 'dashicons-calendar-alt', //dashboad icon in wp-dmin
        'labels'=> array(
            'name' => 'Events', //dashboard name
            'add_new_item' => 'Add New Event', //title when adding post type
            'edit_item' => 'Edit Event', //title when editing post type
            'all_items' => 'All Events', //drop-down title in dashboard
            'singular_name' => 'Event',
        ),
    ));
};

add_action('init', 'wpdev_post_types');

?>