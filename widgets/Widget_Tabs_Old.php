<?php

namespace Graficelly;

use Elementor\Widget_Tabs;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Widget_Tabs_Old extends Widget_Tabs
{
    public function get_title(): string {
        return esc_html__( 'Tabs', 'elementor' ) . ' Old';
    }

    public function show_in_panel(): bool {
        return true;
    }

    protected function add_deprecation_message( $version, $message, $replacement ): void {
        if ($replacement === 'nested-tabs')
            return;

        parent::add_deprecation_message( $version, $message, $replacement );
    }
}