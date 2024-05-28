<?php

//slider 
	register_post_type('slider', array(
	 'labels' => array(
	    'name' => 'Sliders',
		'add_new_item' => 'Add New Slider',
		'featured_image' => 'Upload or Update Slider Image',
		'set_featured_image' => 'Set Slider Image',
		'media_buttons' => false,
	 ),
	 'public' => true,
	 'show_in_menu' => true,
	 'menu_position' => 2,
	 'has_archive' => false,
	 'menu_icon' => 'dashicons-image-flip-horizontal',
	 'supports' => array('title' , 'editor', 'thumbnail')
	));



/**
 * Removes media buttons from post types.
 */
add_filter( 'wp_editor_settings', function( $settings ) {
    $current_screen = get_current_screen();

    // Post types for which the media buttons should be removed.
    $post_types = array( 'slider' );

    // Bail out if media buttons should not be removed for the current post type.
    if ( ! $current_screen || ! in_array( $current_screen->post_type, $post_types, true ) ) {
        return $settings;
    }

    $settings['media_buttons'] = false;

    return $settings;
} );

?>
