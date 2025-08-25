<?php
/*
Plugin Name: WizeWP Portfolio Romania Map
Plugin URI:  https://wizewp.com
Description: Afișează portofoliul pe hartă interactivă a României cu filtrare AJAX pe județ și categorie.
Version:     1.0.0
Author:      WizeWP
Author URI:  https://wizewp.com
License:     GPL2
Text Domain: wizewp-portfolio-romania-map
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants
define( 'WPRM_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPRM_URL', plugin_dir_url( __FILE__ ) );

// Includes
require_once WPRM_PATH . 'includes/class-cpt.php';
require_once WPRM_PATH . 'includes/class-meta-boxes.php';
require_once WPRM_PATH . 'includes/class-ajax.php';
require_once WPRM_PATH . 'includes/class-shortcode.php';

// Init plugin
function wprm_init_plugin() {
    //new WPRM_CPT();
    new WPRM_Meta_Boxes();
    new WPRM_Ajax();
    new WPRM_Shortcode();
}
add_action( 'plugins_loaded', 'wprm_init_plugin' );
