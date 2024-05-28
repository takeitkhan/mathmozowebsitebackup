<?php

//slider

register_post_type('industry', array(
    'labels' => array(
        'name' => 'Industries',
        'add_new_item' => 'Add New Inndustry',
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

/*
//Remove Custom post type name from link
function industry_remove_slug( $post_link, $post, $leavename ) {

    if ( 'industry' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'industry_remove_slug', 10, 3 );


function industry_parse_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'industry', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'industry_parse_request' );
*/



?>
