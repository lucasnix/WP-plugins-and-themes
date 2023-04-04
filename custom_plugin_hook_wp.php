<?php
/**
 * Plugin Name: My Hooks Plugin
 * Plugin URI: https://www.example.com/my-hooks-plugin
 * Description: This is a custom WordPress plugin that uses hooks.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://www.example.com/
 */

// Add a custom message to the end of every post
function my_hooks_plugin_add_message_to_post_content( $content ) {
    $message = '<p>Thank you for reading! Please subscribe to our newsletter for more great content.</p>';
    return $content . $message;
}
add_filter( 'the_content', 'my_hooks_plugin_add_message_to_post_content' );
