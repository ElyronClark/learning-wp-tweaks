<?php
/**
 * Plugin Name: Learning WP Tweaks
 * Description: My first custom plugin for learning Wordpress development.
 * Version: 1.0.0
 * Author: Elyron Clark
 */

function lwp_thanks_after_post( $content ) {
    if ( is_single() ) {
        $content .= '<p><strong>Thanks for reading!</strong></p>';
    }
    return $content;
}
add_filter( 'the_content', 'lwp_thanks_after_post');

function lwp_register_property_cpt() {
    $args = array(
        'labels' => array(
            'name'          => 'Properties',
            'singular_name' => 'Property',
            'add_new_item'  => 'Add New Property',
            'edit_item'     => 'Edit Property',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-admin-home',
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'  => true,
        'rewrite'       => array( 'slug' => 'properties' ),
    );
    
    register_post_type( 'lwp_property', $args );
}
add_action( 'init', 'lwp_register_property_cpt' );

// function lwp_show_property_fields( $content ) {
//     // Only a single Property, and only on the main content (not excerpts, feeds, etc.)
//     if (is_singular( 'lwp_property' ) && in_the_loop() && is_main_query() ) {

//     $price      = get_field( 'price' );
//     $bedrooms   = get_field( 'bedrooms' );

//     $details    = '<div class="property-detail">';
//     $details    .= '<p><strong>Price:</strong> $' . esc_html( number_format( $price ) ) . '</p>';
//     $details    .= '<p><strong>Bedrooms:</strong> ' . esc_html( $bedrooms ) . '</p>';
//     $details    .= '</div>';

//     //Put our details ABOVE the body content
//     $content = $details . $content;
//     } 

//     return $content;
// }
// add_filter( 'the_content', 'lwp_show_property_fields' );