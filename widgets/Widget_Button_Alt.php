<?php

namespace Graficelly;

use Elementor\Widget_Button;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Widget_Button_Alt extends Widget_Button
{
    public function get_name(): string
    {
        return parent::get_name() . '-alt';
    }

    public function get_title(): string
    {
        return parent::get_title() . ' Alt';
    }
}