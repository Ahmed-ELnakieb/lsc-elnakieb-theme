<?php
/*
Plugin Name: Elnakieb Plugin
Plugin URI: https://elnakieb.com/
Description: After install the Elnakieb WordPress Theme, you must need to install this "elnakieb-plugin" first to get all functions of Elnakieb WP Theme.
Author: Elnakieb
Author URI: http://elnakieb.com/
Version: 1.0.0
Text Domain: elnakieb-plugin
*/
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define Core Path
 */
define( 'ELNAKIEB_VERSION', '1.0.0' );
define( 'ELNAKIEB_DIR_PATH',plugin_dir_path(__FILE__) );
define( 'ELNAKIEB_DIR_URL',plugin_dir_url(__FILE__) );
define( 'ELNAKIEB_INC_PATH', ELNAKIEB_DIR_PATH . '/inc' );
define( 'ELNAKIEB_PLUGIN_IMG_PATH', ELNAKIEB_DIR_URL . '/assets/img' );

/**
 * Css Framework Load
 */
if ( file_exists(ELNAKIEB_DIR_PATH.'/lib/codestar-framework/codestar-framework.php') ) {
    require_once  ELNAKIEB_DIR_PATH.'/lib/codestar-framework/codestar-framework.php';
}

/**
 *  Elementor - Remove Font Awesome 
 */
add_action( 'elementor/frontend/after_register_styles',function() {
    foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
      wp_deregister_style( 'elementor-icons-fa-' . $style );
    }
  }, 20 );


/**
 * Register Custom Widget
 *
 * @return void
 */
function elnakieb_cw_wisget(){
    register_widget( 'Elnakieb_Recent_Posts' );
}
add_action('widgets_init', 'elnakieb_cw_wisget');


/**
 * Deregister Elementor Animation
 *
 * @return void
 */
function elnakieb_de_reg() {
    wp_deregister_style( 'e-animations' );
}
add_action( 'wp_enqueue_scripts', 'elnakieb_de_reg' );

/**
 * Enqueue Admin Style
 *
 * @return void
 */
function elnakieb_enqueue_admin_customstyle() {
    wp_enqueue_style( 'admin-style', ELNAKIEB_DIR_URL . 'assets/css/admin-style.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'elnakieb_enqueue_admin_customstyle' );

/**
 * Enqueue Admin Style
 *
 * @return void
 */
function elnakieb_enqueue_customstyle() {
    wp_enqueue_script( 'elnakieb-addon-core', ELNAKIEB_DIR_URL . '/assets/js/core.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'elnakieb_enqueue_customstyle' );

/**
 * Dequeue Elemenotr Swiper Slider
 *
 * @return  [type]  [return description]
 */
function dequeue_wpml_styles(){
    wp_dequeue_style( 'swiper' );
    wp_deregister_style( 'swiper' );

    wp_dequeue_script( 'swiper' );
    wp_deregister_script( 'swiper' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_wpml_styles', 20 );


/**
 * Script Remove
 *
 * @return  [type]  [return description]
 */
function remove_jquery_sticky() {
		wp_dequeue_script( 'swiper' );
		wp_deregister_script( 'swiper' );
}
add_action( 'elementor/frontend/after_register_scripts', 'remove_jquery_sticky' );


/**
 * Load files safely with error checking
 */

// Test basic functionality first
add_action('init', function() {
    // Simple test to ensure plugin loads
});

// Load plugin components safely
include_once ELNAKIEB_INC_PATH . "/elnakieb-plugin-helper.php";

// Load other components after helper is loaded
if ( file_exists( ELNAKIEB_INC_PATH . "/custom-widget/recent-post.php" ) ) {
    include_once ELNAKIEB_INC_PATH . "/custom-widget/recent-post.php";
}

if ( file_exists( ELNAKIEB_INC_PATH . "/post-type/template.php" ) ) {
    include_once ELNAKIEB_INC_PATH . "/post-type/template.php";
}

if ( file_exists( ELNAKIEB_INC_PATH . "/helper.php" ) ) {
    include_once ELNAKIEB_INC_PATH . "/helper.php";
}

if ( did_action( 'elementor/loaded' ) && file_exists( ELNAKIEB_DIR_PATH . "/elementor/elementor-init.php" ) ) {
    include_once ELNAKIEB_DIR_PATH . "/elementor/elementor-init.php";
}

if ( class_exists( 'CSF' ) && class_exists( 'Elnakieb_Plugin_Helper' ) ) {
    if ( file_exists( ELNAKIEB_INC_PATH . "/options/theme-metabox.php" ) ) {
        include_once ELNAKIEB_INC_PATH . "/options/theme-metabox.php";
    }
    if ( file_exists( ELNAKIEB_INC_PATH . "/options/theme-option.php" ) ) {
        include_once ELNAKIEB_INC_PATH . "/options/theme-option.php";
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    if ( file_exists( ELNAKIEB_INC_PATH . "/csf-custom-icon.php" ) ) {
        include_once ELNAKIEB_INC_PATH . "/csf-custom-icon.php";
    }
    if ( file_exists( ELNAKIEB_INC_PATH . "/constim-icon.php" ) ) {
        include_once ELNAKIEB_INC_PATH . "/constim-icon.php";
    }
}

/**
 * Contact Form 7 Autop Remove
 */
add_filter('wpcf7_autop_or_not', '__return_false');


