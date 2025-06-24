<?php

namespace Graficelly;

use Elementor\Widget_Accordion;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Widget_Accordion_Old extends Widget_Accordion
{
    public function get_title(): string {
        return parent::get_title() . ' Old';
    }

    public function show_in_panel(): bool {
        return true;
    }

    protected function add_deprecation_message( $version, $message, $replacement ): void {
        if ($replacement === 'nested-accordion')
            return;

        parent::add_deprecation_message( $version, $message, $replacement );
    }
}