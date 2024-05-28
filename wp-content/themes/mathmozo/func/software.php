<?php

//slider

register_post_type('software', array(
    'labels' => array(
        'name' => 'Softwares',
        'add_new_item' => 'Add New Software',
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Set Featured Image',
        'media_buttons' => true,
    ),
    'public' => true,
    'show_in_menu' => true,
    'menu_position' => 2,
    'has_archive' => false,
    'menu_icon' => 'dashicons-screenoptions',
    'rewrite' => array('slug' => '', 'with_front' => false),
    'supports' => array('title' , 'editor', 'thumbnail','excerpt')
));

/*
//Remove Custom post type name from link
function cpt_remove_slug( $post_link, $post, $leavename ) {

    if ( 'software' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'cpt_remove_slug', 10, 3 );


function cpt_parse_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'software', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'cpt_parse_request' );
*/
?>
