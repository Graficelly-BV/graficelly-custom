<?php

namespace Graficelly;

use Elementor\Widgets_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function register_graficelly_widgets( Widgets_Manager $widget_manager ) {

    require_once( __DIR__ . '/Widget_Tabs_Old.php' );
    $widget_manager->register( new Widget_Tabs_Old() );

    require_once( __DIR__ . '/Widget_Accordion_Old.php' );
    $widget_manager->register( new Widget_Accordion_Old() );

    if (is_plugin_active('dynamic-shortcodes/dynamic-shortcodes.php')) {
        require_once( __DIR__ . '/Widget_Dynamic_Shortcode.php' );
        $widget_manager->register( new Widget_Dynamic_Shortcode() );
    }

    if (
        is_plugin_active('elementor-pro/elementor-pro.php') &&
        is_plugin_active('dynamic-shortcodes/dynamic-shortcodes.php') &&
        (
            is_plugin_active('advanced-custom-fields-pro/acf.php') ||
            is_plugin_active('advanced-custom-fields/acf.php')
        )
    ) {
        require_once( __DIR__ . '/Widget_Dynamic_Media_Carousel.php' );
        $widget_manager->register( new Widget_Dynamic_Media_Carousel() );
    }
}

add_action( 'elementor/widgets/register', '\Graficelly\register_graficelly_widgets', 0 );