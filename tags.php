<?php

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Media extends \Elementor\Core\DynamicTags\Tag {

    public function get_name(): string {
        return 'media-image';
    }

    public function get_title(): string {
        return esc_html__( 'Image', 'elementor' );
    }

    public function get_group(): array {
        return [ 'media' ];
    }

    public function get_categories(): array {
        return [
            \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
        ];
    }

    protected function register_controls(): void {
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'large',
                'condition' => [
                    'image[url]!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'img{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label' => esc_html__( 'Max Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'img{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'img{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'object-fit',
            [
                'label' => esc_html__( 'Object Fit', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options' => [
                    '' => esc_html__( 'Default', 'elementor' ),
                    'fill' => esc_html__( 'Fill', 'elementor' ),
                    'cover' => esc_html__( 'Cover', 'elementor' ),
                    'contain' => esc_html__( 'Contain', 'elementor' ),
                    'scale-down' => esc_html__( 'Scale Down', 'elementor' ),
                ],
                'default' => '',
                'selectors' => [
                    'img{{WRAPPER}}' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'object-position',
            [
                'label' => esc_html__( 'Object Position', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__( 'Center Center', 'elementor' ),
                    'center left' => esc_html__( 'Center Left', 'elementor' ),
                    'center right' => esc_html__( 'Center Right', 'elementor' ),
                    'top center' => esc_html__( 'Top Center', 'elementor' ),
                    'top left' => esc_html__( 'Top Left', 'elementor' ),
                    'top right' => esc_html__( 'Top Right', 'elementor' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'elementor' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'elementor' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'elementor' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    'img{{WRAPPER}}' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'height[size]!' => '',
                    'object-fit' => [ 'cover', 'contain', 'scale-down' ],
                ],
            ]
        );

        $this->add_control(
            '_css_classes',
            [
                'label' => esc_html__( 'CSS Classes', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'ai' => [
                    'active' => false,
                ],
                'prefix_class' => '',
                'title' => esc_html__( 'Add your custom class WITHOUT the dot. e.g: my-class', 'elementor' ),
                'classes' => 'elementor-control-direction-ltr',
            ]
        );
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        ob_start();

        Group_Control_Image_Size::print_attachment_image_html( $settings );

        $value = ob_get_clean();

        echo str_replace( '<img ', '<img id="elementor-tag-' . esc_attr( $this->get_id() ) . '" class="' . esc_attr( $settings['_css_classes'] ) . '" ', $value );
    }

}