<?php
/**
 * Plugin Name:       Graficelly custom
 * Plugin URI:        https://graficelly.nl
 * Version:           1.3.1
 * Author:            Graficelly
 * Author URI:        https://graficelly.nl
 * Text Domain:       graficelly-custom
 * GitHub Plugin URI: https://github.com/Graficelly-BV/graficelly-custom
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.29.2
 * Elementor Pro tested up to: 3.29.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once( __DIR__ . '/widgets/_register.php' );
require_once( __DIR__ . '/tags/_register.php' );

function register_graficelly_frontend_scripts() {
    wp_register_script(
        'graficelly-dynamic-media-carousel-handler',
        plugins_url( 'assets/js/dynamic-media-carousel-handler.js', __FILE__ ),
        [ 'pro-elements-handlers' ],
        false,
        true
    );
}
add_action( 'elementor/frontend/before_register_scripts', 'register_graficelly_frontend_scripts', 11 );