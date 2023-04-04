<?php
/*
Plugin Name: Lucas Dev Map Plugin
Plugin URI: https://github.com/lucasnix
Description: A simple plugin that adds a custom shortcode
Version: 1.0
Author: Lucas Dev
Author URI: https://bit.ly/lucasdev
*/

// Register the custom post type for the map
function create_map_post_type() {
    register_post_type( 'map',
        array(
            'labels' => array(
                'name' => __( 'Maps' ),
                'singular_name' => __( 'Map' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'map'),
            'supports' => array('title', 'editor')
        )
    );
}
add_action( 'init', 'create_map_post_type' );

// Register the taxonomy for the markers
function create_marker_taxonomy() {
    register_taxonomy(
        'marker',
        'map',
        array(
            'label' => __( 'Markers' ),
            'rewrite' => array( 'slug' => 'marker' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'create_marker_taxonomy' );

// Enqueue necessary scripts and styles for the map functionality
function enqueue_map_scripts() {
    wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY' );
    wp_enqueue_script( 'map-script', plugin_dir_url( __FILE__ ) . 'map.js', array( 'google-maps-api' ) );
    wp_enqueue_style( 'map-style', plugin_dir_url( __FILE__ ) . 'map.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_map_scripts' );

// Create the HTML structure for the map
function display_map() {
    $args = array(
        'post_type' => 'map',
        'posts_per_page' => 1
    );
    $map_query = new WP_Query( $args );
    if ( $map_query->have_posts() ) {
        while ( $map_query->have_posts() ) {
            $map_query->the_post();
            $map_id = get_the_ID();
            $map_title = get_the_title();
            $map_content = get_the_content();
            echo '<div class="map-wrapper">';
            echo '<h2>' . $map_title . '</h2>';
            echo '<div id="map"></div>';
            echo '</div>';
        }
    }
    wp_reset_postdata();
}
add_shortcode( 'interactive_map', 'display_map' );

// Initialize the map with JavaScript code
function init_map_script() {
    $args = array(
        'post_type' => 'map',
        'posts_per_page' => 1
    );
    $map_query = new WP_Query( $args );
    if ( $map_query->have_posts() ) {
        while ( $map_query->have_posts() ) {
            $map_query->the_post();
            $map_id = get_the_ID();
            $map_content = get_the_content();
            echo '<script>';
            echo 'var map;';
            echo 'function initMap() {';
            echo 'map = new google.maps.Map(document.getElementById("map"), {';
            echo
