<?php
/**
 * Plugin Name:       Graficelly custom
 * Plugin URI:        https://graficelly.nl
 * Version:           1.0
 * Author:            Graficelly
 * Author URI:        https://graficelly.nl
 * Text Domain:       graficelly-custom
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.26.0
 * Elementor Pro tested up to: 3.26.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

include_once( __DIR__ . '/updater.php' );

if (is_admin()) {
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => dirname( plugin_basename( __FILE__ ) ), // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/Graficelly-BV/graficelly-custom', // the GitHub API url of your GitHub repo
        'raw_url' => 'https://raw.github.com/Graficelly-BV/graficelly-custom/master', // the GitHub raw url of your GitHub repo
        'github_url' => 'https://github.com/Graficelly-BV/graficelly-custom', // the GitHub url of your GitHub repo
        'zip_url' => 'https://github.com/Graficelly-BV/graficelly-custom/zipball/master', // the zip url of the GitHub repo
        'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '5.0', // which version of WordPress does your plugin require?
        'tested' => '6.7.1', // which version of WordPress is your plugin tested up to?
        'readme' => 'graficelly-custom', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Plugins > GitHub Updates when this example plugin is installed
    );
    new WP_GitHub_Updater($config);
}

function register_graficelly_widgets( $widget_manager ) {

    require_once( __DIR__ . '/widgets.php' );

    $widget_manager->register( new \Old_Widget_Tabs() );
    $widget_manager->register( new \Old_Widget_Accordion() );

}
add_action( 'elementor/widgets/register', 'register_graficelly_widgets', 0 );

function register_graficelly_tags(\Elementor\Core\DynamicTags\Manager $dynamic_tags_manager ) {

    require_once( __DIR__ . '/tags.php' );

    $dynamic_tags_manager->register( new \Elementor_Dynamic_Tag_Media() );

}
add_action( 'elementor/dynamic_tags/register', 'register_graficelly_tags', 0 );
