<?php

namespace Graficelly;

use Elementor\Core\DynamicTags\Manager as Tag_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function register_graficelly_tags( Tag_Manager $dynamic_tags_manager ) {

    require_once( __DIR__ . '/Tag_Media_Image.php' );
    $dynamic_tags_manager->register( new Tag_Media_Image() );

}
add_action( 'elementor/dynamic_tags/register', '\Graficelly\register_graficelly_tags', 0 );