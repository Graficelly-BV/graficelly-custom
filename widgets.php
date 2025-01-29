<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Old_Widget_Tabs extends \Elementor\Widget_Tabs {
    public function get_title(): string {
        return esc_html__( 'Tabs', 'elementor' ) . ' Old';
    }
    
    public function show_in_panel(): bool {
        return true;
    }
    
    protected function add_deprecation_message( $version, $message, $replacement ): void {
        if ($version === '3.8.0' && $replacement === 'nested-tabs')
            return;
        
        parent::add_deprecation_message( $version, $message, $replacement );
    }
}

class Old_Widget_Accordion extends \Elementor\Widget_Accordion {
    public function get_title(): string {
        return esc_html__( 'Accordion', 'elementor' ) . ' Old';
    }

    public function show_in_panel(): bool {
        return true;
    }

    protected function add_deprecation_message( $version, $message, $replacement ): void {
        if ($version === '3.15.0' && $replacement === 'nested-accordion')
            return;

        parent::add_deprecation_message( $version, $message, $replacement );
    }
}