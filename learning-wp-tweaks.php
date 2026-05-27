<?php
/**
 * Plugin Name: Learning WP Tweaks
 * Description: My first custom plugin for learning Wordpress development.
 * Version: 2.0.0
 * Author: Elyron Clark
 */

// Safety: don't allow this file to be accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LWP_Tweaks {
    /**
     * Constructor - runs when the object is created
     * This is where we wire up all our hooks
     */
    public function __construct() {
        add_filter( 'the_content', array( $this, 'add_thanks_message' ) );
        add_action( 'init', array( $this, 'register_property_cpt' ) );
    }

    /** 
     * Append a thank-you message to single posts.
     */
    public function add_thanks_message( $content ) {
        if ( is_single() ) {
            $content .= '<p><strong>Thanks for reading!</strong></p>';
        }
        return $content;
    }

    /**
     * Register the property custom post type
     */
    public function register_property_cpt() {
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
            'supports'      => array( 'title', 'editor', 'thumbnail'),
            'show_in_rest'  => true,
            'rewrite'       => array( 'slug' => 'properties'),
        );
        register_post_type( 'lwp_property', $args );
    }

    /**
     * Runs on plugin activation: register the CPT, then flush rewrite rules.
     */
    public function activate() {
        $this->register_property_cpt();
        flush_rewrite_rules();
    }
}

//Create the object - this fires the constructor and wires up all hooks.
$lwp_tweaks = new LWP_Tweaks();

//Activation hook still lives outside the class, but points at the objects method.
register_activation_hook( __FILE__, array( $lwp_tweaks, 'activate' ) );