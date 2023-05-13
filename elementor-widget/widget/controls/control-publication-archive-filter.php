<?php
use Elementor\Controls_Manager;

$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Publication Archive Filter Settings', 'ippi'),
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Resource Library', 'ippi'),
    ]
);

$this->add_control(
    'section_description',
    [
        'label' => esc_html__('Section Description', 'ippi'),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __('The program sets out to establish a stable international platform for ongoing exchange and networking among digital governance experts from the academic,', 'ippi'),
    ]
);



$this->end_controls_section();
//End Query