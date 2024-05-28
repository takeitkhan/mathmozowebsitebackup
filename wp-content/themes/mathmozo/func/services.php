<?php

//slider

register_post_type('service', array(
    'labels' => array(
        'name' => 'Services',
        'add_new_item' => 'Add New Service',
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Set Featured Image',
        'media_buttons' => true,
    ),
    'public' => true,
    'show_in_menu' => true,
    'menu_position' => 2,
    'has_archive' => false,
    'menu_icon' => 'dashicons-admin-home',
//    'rewrite' => false,
    'rewrite' => array('slug' => '', 'with_front' => false),
    'supports' => array('title' , 'editor', 'thumbnail','excerpt')
));
