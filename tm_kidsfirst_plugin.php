<?php
/*
Plugin Name: TM KidsFirst Plugin
Description: KidsFirstRugby.com Plugin by Martin Croker
*/

/* Start Adding Functions Below this Line */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if (!function_exists('tm_kidsfirst_load_plugin')):
  function tm_kidsfirst_load_plugin() {

    // Classes
    require_once('TMSessionPlan.php');

    add_action( 'wp_enqueue_scripts', 'tm_club_load_plugin_css' );
  }
  add_action('tm_plugin_load_children', 'tm_kidsfirst_load_plugin');
endif;

// CSS
if (!function_exists('tm_club_load_plugin_css')):
  function tm_club_load_plugin_css() {
      $plugin_url = plugin_dir_url( __FILE__ );
      wp_enqueue_style( 'style', $plugin_url . '/style.css' );
  }
endif;



/* Stop Adding Functions Below this Line */
?>
