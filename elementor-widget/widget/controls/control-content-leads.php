<?php

use Elementor\Controls_Manager;

$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Content Leads Settings', 'ippi'),
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Content Leads', 'ippi'),
    ]
);

$this->add_control(
    'lead_left_content',
    [
        'label' => esc_html__('Left content', 'ippi'),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __('The program sets out to establish a stable international platform for ongoing exchange and networking among digital governance experts from the academic,','ippi'),
    ]
);

$this->add_control(
    'lead_right_content',
    [
        'label' => esc_html__('Right Content', 'ippi'),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __('We seek to reflect on the latest developments in the tech field and their impact on our societies, and to develop new ideas on how to shape and navigate technological disruption.','ippi'),
    ]
);

$this->add_control(
    'image_and_content_type',
    [
        'label' => esc_html__('Specific Content Types', 'ippi'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'full_width' => [
                'title' => esc_html__('Full Width', 'ippi'),
            ],
            'left_side_description' => [
                'title' => esc_html__('1/2 Width - Left Side Description', 'ippi'),
            ],
            'right_side_description' => [
                'title' => esc_html__('1/2 Width - Right Side Description', 'ippi'),
            ],
        ],
    ]
);

$this->add_control(
    'author_name',
    [
        'label' => esc_html__('Author Name', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('~ By Natalie Oralio','ippi'),
    ]
);



$this->end_controls_section();
//End Query