<?php
/*
Plugin Name: Lucas Dev Social Proof Plugin
Plugin URI: https://github.com/lucasnix
Description: Adds social proof notifications to your WordPress site
Version: 1.0
Author: Lucas Dev
Author URI: https://bit.ly/lucasdev
*/

// Enqueue necessary scripts and styles for the social proof functionality
function enqueue_social_proof_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'social-proof-script', plugin_dir_url( __FILE__ ) . 'social-proof.js', array( 'jquery' ) );
    wp_enqueue_style( 'social-proof-style', plugin_dir_url( __FILE__ ) . 'social-proof.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_social_proof_scripts' );

// Create the HTML structure for the social proof notifications
function display_social_proof() {
    $social_proof_html = '<div id="social-proof-wrapper"></div>';
    return $social_proof_html;
}
add_shortcode( 'social_proof', 'display_social_proof' );

// Initialize the social proof functionality with JavaScript code
function init_social_proof_script() {
    echo '<script>';
    echo 'var socialProofWrapper = document.getElementById("social-proof-wrapper");';
    echo 'var socialProofTimeout;';
    echo 'function showSocialProof(message) {';
    echo 'var socialProofElement = document.createElement("div");';
    echo 'socialProofElement.classList.add("social-proof-element");';
    echo 'socialProofElement.innerHTML = message;';
    echo 'socialProofWrapper.appendChild(socialProofElement);';
    echo 'socialProofTimeout = setTimeout(function() {';
    echo 'socialProofWrapper.removeChild(socialProofElement);';
    echo '}, 5000);';
    echo '}';
    echo '</script>';
}
add_action( 'wp_footer', 'init_social_proof_script' );

// Add the functionality to display social proof notifications based on user actions
function social_proof_notification() {
    $message = $_POST['message'];
    // Add code to determine which user action triggered the social proof notification
    // and customize the $message accordingly
    echo '<script>';
    echo 'showSocialProof("'.$message.'");';
    echo '</script>';
    wp_die();
}
add_action( 'wp_ajax_social_proof_notification', 'social_proof_notification' );
add_action( 'wp_ajax_nopriv_social_proof_notification', 'social_proof_notification' );
