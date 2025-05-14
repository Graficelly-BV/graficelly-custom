<?php
/**
 * Plugin Name:       Graficelly custom
 * Plugin URI:        https://graficelly.nl
 * Version:           1.2
 * Author:            Graficelly
 * Author URI:        https://graficelly.nl
 * Text Domain:       graficelly-custom
 * GitHub Plugin URI: https://github.com/Graficelly-BV/graficelly-custom
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.26.0
 * Elementor Pro tested up to: 3.26.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once( __DIR__ . '/widgets/_register.php' );
require_once( __DIR__ . '/tags/_register.php' );

function register_graficelly_frontend_scripts() {
    wp_register_script(
        'graficelly-elements-handlers',
        plugins_url( 'assets/js/elements-handlers.js', __FILE__ ),
        [ 'pro-elements-handlers' ],
        false,
        true
    );
}
add_action( 'elementor/frontend/before_register_scripts', 'register_graficelly_frontend_scripts', 11 );

function enqueue_graficelly_frontend_scripts() {
    wp_enqueue_script('graficelly-elements-handlers');
}
add_action( 'elementor/frontend/before_enqueue_scripts', 'enqueue_graficelly_frontend_scripts', 11 );