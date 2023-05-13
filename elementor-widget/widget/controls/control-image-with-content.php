<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'fields' => 'ids',
);

$query = new WP_Query($args);

$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Query', 'ippi'),
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Images', 'ippi'),
    ]
);

$this->add_control(
    'section_image',
    [
        'label' => esc_html__( 'Choose Image', 'ippi' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'section_content',
    [
        'label' => esc_html__( 'Section Content', 'ippi' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'placeholder' => esc_html__( 'Type your content here', 'ippi' ),
    ]
);

$this->add_control(
    'hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$this->add_control(
    'image_and_content_type',
    [
        'label' => esc_html__( 'Specific Content Types', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'full_width' => [
                'title' => esc_html__( 'Full Width', 'ippi' ),
            ],
            'left_side_image' => [
                'title' => esc_html__( '1/2 Width - Left Side Image', 'ippi' ),
            ],
            'right_side_image' => [
                'title' => esc_html__( '1/2 Width - Right Side Image', 'ippi' ),
            ],
            'stretched' => [
                'title' => esc_html__( 'Stretched', 'ippi' ),
            ],
            'stretched_with_text' => [
                'title' => esc_html__( 'Stretched + Text', 'ippi' ),
            ],
        ],
    ]
);


//$this->add_control(
//    'hr_1',
//    [
//        'type' => \Elementor\Controls_Manager::DIVIDER,
//    ]
//);

$this->add_control(
    'image_credit',
    [
        'label' => esc_html__( 'Image Credit', 'ippi' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( 'Type your image credit here', 'ippi' ),
    ]
);



$this->add_control(
    'image_credit_link',
    [
        'label' => esc_html__( 'Image Credit Link', 'ippi' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( 'Type your image credit link here', 'ippi' ),
    ]
);

$this->add_control(
    'image_description',
    [
        'label' => esc_html__( 'Image Description', 'ippi' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 10,
        'placeholder' => esc_html__( 'Type your description here', 'ippi' ),
    ]
);

$this->add_control(
    'image_popup_description',
    [
        'label' => esc_html__( 'Image Popup Description', 'ippi' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 10,
        'placeholder' => esc_html__( 'Type your description here', 'ippi' ),
    ]
);

$this->end_controls_section();
//End Query