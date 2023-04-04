<?php
// functions.php

function custom_theme_scripts() {
  wp_enqueue_style( 'custom-theme-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'custom-theme-script', get_template_directory_uri() . '/js/custom-script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );


// index.php

get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
    the_title();
    the_content();
  endwhile;
endif;

get_footer();
