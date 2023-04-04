<?php
/*
Plugin Name: Lucas Dev Plugin
Plugin URI: https://github.com/lucasnix
Description: A simple plugin that adds a custom shortcode
Version: 1.0
Author: Lucas Dev
Author URI: https://bit.ly/lucasdev
*/

function example_shortcode() {
  return date("F j, Y");
}
add_shortcode('example_shortcode', 'example_shortcode');
?>
