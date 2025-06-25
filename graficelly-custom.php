<?php
/**
 * Plugin Name:       Graficelly custom
 * Plugin URI:        https://graficelly.nl
 * Version:           1.3.3
 * Author:            Graficelly
 * Author URI:        https://graficelly.nl
 * Text Domain:       graficelly-custom
 * GitHub Plugin URI: https://github.com/Graficelly-BV/graficelly-custom
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.29.2
 * Elementor Pro tested up to: 3.29.2
 */

use Elementor\Modules\ElementManager\Options as ElementManagerOptions;

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

function enqueue_graficelly_frontend_scripts() {
    $disabled_elements = ElementManagerOptions::get_disabled_elements();

    if (
        !in_array( 'dynamic-media-carousel', $disabled_elements) &&
        is_plugin_active('elementor-pro/elementor-pro.php') &&
        is_plugin_active('dynamic-content-for-elementor/dynamic-content-for-elementor.php') &&
        (
            is_plugin_active('advanced-custom-fields-pro/acf.php') ||
            is_plugin_active('advanced-custom-fields/acf.php')
        )
    ) {
        wp_enqueue_script('graficelly-dynamic-media-carousel-handler');
    }
}
add_action( 'elementor/frontend/before_enqueue_scripts', 'enqueue_graficelly_frontend_scripts', 11 );