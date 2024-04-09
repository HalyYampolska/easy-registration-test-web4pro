<?php
/*
Plugin Name: CV Shortcode For Web4Pro Test
Description: Custom shortcode code make application easily
Version: 1.0
Author: Halyna Yampolska
*/

function add_cv_form_script() {
    wp_enqueue_script( 'cv-form-script', plugin_dir_url( __FILE__ ) . 'js/cv-form-script.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'cv-form-script', 'ajaxurl', admin_url( 'admin-ajax.php' ) ); // Push admin-ajax.php trougth var ajaxurl
    wp_localize_script( 'cv-form-script', 'home_url', home_url() ); // Push home URL WordPress
}
add_action( 'wp_enqueue_scripts', 'add_cv_form_script' );

// Include file with form handler
require_once( plugin_dir_path( __FILE__ ) . 'include/handle-cv-form-submission.php' );

class CV_Registration_Handler {
    public function __construct() {
        add_shortcode( 'cv_form', array( $this, 'cv_shortcode_web4pro' ) );
    }

    public function cv_shortcode_web4pro() {
        ob_start();
        include( plugin_dir_path( __FILE__ ) . 'template/cv-form-template.php' );
        return ob_get_clean();
    }
}

new CV_Registration_Handler();