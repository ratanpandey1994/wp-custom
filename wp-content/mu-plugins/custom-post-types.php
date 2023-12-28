<?php
// wp-content => mu-plugins
function theme_post_types() {
    // Campus Post Type
    register_post_type('campus', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'campuses'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => "Edit Campus",
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus',
            'add_new' => 'Add New Campus'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));
    // Event Post Type
    register_post_type('event', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => "Edit Event",
            'all_items' => 'All Events',
            'singular_name' => 'Event',
            'add_new' => 'Add New Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    // Program Post Type    
    register_post_type('program', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => "Edit Program",
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
            'add_new' => 'Add New Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));

    // Professor Post Type    
    register_post_type('professor', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => "Edit Professor",
            'all_items' => 'All Professors',
            'singular_name' => 'Professor',
            'add_new' => 'Add New Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));
}

add_action('init', 'theme_post_types');