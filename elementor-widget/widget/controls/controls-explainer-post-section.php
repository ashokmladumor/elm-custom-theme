<?php

use Elementor\Controls_Manager;

//Start settings
$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Query', 'ippi'),
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('', 'ippi'),
        'type' => Controls_Manager::HEADING,
    ]
);

$this->end_controls_section();
//End Query