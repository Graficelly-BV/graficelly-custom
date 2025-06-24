<?php

namespace Graficelly;

use DynamicShortcodes\Plugin;
use Elementor\Widget_Html;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Widget_Dynamic_Shortcode extends Widget_Html
{
    public function get_name(): string {
        return 'dynamic-shortcode';
    }

    public function get_title(): string {
        return esc_html__( 'HTML', 'elementor' ) . ' Dynamic Shortcode';
    }

    public function get_icon() {
        return 'eicon-shortcode';
    }

    protected function is_dynamic_content(): bool
    {
        return true;
    }

    protected function render() {
        $content = $this->get_settings_for_display( 'html' );
        $content = Plugin::instance()->shortcodes_manager->expand_shortcodes( $content );
        echo $content;
    }

    protected function content_template() {}
}