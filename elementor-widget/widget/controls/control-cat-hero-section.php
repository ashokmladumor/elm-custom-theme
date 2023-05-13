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
    'show_post_type_tax',
    [
        'label' => esc_html__('Post name (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'date_reading',
    [
        'label' => esc_html__('Date & Reading time (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'share_icon',
    [
        'label' => esc_html__('Social Icon (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
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