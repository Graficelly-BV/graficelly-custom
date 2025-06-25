<?php

namespace Graficelly;

use DynamicContentForElementor\Helper;
use Elementor\Controls_Manager;
use ElementorPro\Modules\Carousel\Widgets\Media_Carousel;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Widget_Dynamic_Media_Carousel extends Media_Carousel
{
    public function get_name() {
        return 'dynamic-media-carousel';
    }

    public function get_title() {
        return 'Dynamic ' . esc_html__( 'Media Carousel', 'elementor-pro' );
    }

    protected function is_dynamic_content(): bool
    {
        return true;
    }

    public function get_script_depends(): array {
        $parent_scripts = parent::get_script_depends();
        $parent_scripts[] = 'graficelly-dynamic-media-carousel-handler';
        return $parent_scripts;
    }

    public function get_settings_for_display($setting_key = null)
    {
        $settings = parent::get_settings_for_display($setting_key);

        $id = Helper::get_acf_source_id($settings['acf_gallery_from'], $settings['other_post_source'] ?? false);

        $acf_gallery = get_field($settings['acf_field_list'], $id, false);
        if (!$acf_gallery) {
            $acf_gallery = get_sub_field($settings['acf_field_list'], false);
        }
        if (empty($acf_gallery)) {
            $settings['slides'] = $this->get_repeater_defaults();

            return $settings;
        }

        $settings['slides'] = array_map(function($slideId) {
            return [
                'image' => [
                    'id' => $slideId,
                    'image_link_to_type' => '',
                    'type' => 'image'
                ]
            ];
        }, $acf_gallery);

        return $settings;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_slides_graficelly',
            [
                'label' => esc_html__( 'Slides', 'elementor-pro' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'acf_field_list',
            [
                'label' => esc_html__('ACF Gallery Field', 'dynamic-content-for-elementor'),
                'type' => 'ooo_query',
                'placeholder' => esc_html__('Select the field...', 'dynamic-content-for-elementor'),
                'label_block' => true,
                'query_type' => 'acf',
                'object_type' => 'gallery'
            ]
        );
        $this->add_control(
            'acf_gallery_from',
            [
                'label' => esc_html__('Retrieve the field from', 'dynamic-content-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'current_post',
                'options' => [
                    'current_post' => esc_html__('Current Post', 'dynamic-content-for-elementor'),
                    'current_user' => esc_html__('Current User', 'dynamic-content-for-elementor'),
                    'current_author' => esc_html__('Current Author', 'dynamic-content-for-elementor'),
                    'current_term' => esc_html__('Current Term', 'dynamic-content-for-elementor'),
                    'options_page' => esc_html__('Options Page', 'dynamic-content-for-elementor')
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_source',
            [
                'label' => esc_html__('Source', 'dynamic-content-for-elementor'),
                'condition' => [
                    'acf_gallery_from' => 'current_post'
                ]
            ]
        );

        $this->add_control(
            'data_source',
            [
                'label' => esc_html__('Source', 'dynamic-content-for-elementor'),
                'description' => esc_html__('Select the data source', 'dynamic-content-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Same', 'dynamic-content-for-elementor'),
                'label_off' => esc_html__('Other', 'dynamic-content-for-elementor')
            ]
        );
        $this->add_control(
            'other_post_source',
            [
                'label' => esc_html__('Select from other source post', 'dynamic-content-for-elementor'),
                'type' => 'ooo_query',
                'placeholder' => esc_html__('Post Title', 'dynamic-content-for-elementor'),
                'label_block' => true,
                'query_type' => 'posts',
                'condition' =>
                    [
                        'data_source' => ''
                    ]
            ]
        );

        $this->end_controls_section();

        parent::register_controls();

        $this->remove_control('slides');
    }
}