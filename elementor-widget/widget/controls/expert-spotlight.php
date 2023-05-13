<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

//Start settings
$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Query', 'ippi'),
    ]
);

$this->add_control(
    'section_carousel_or_grid',
    [
        'label' => esc_html__('Carousel or grid', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Carousel', 'ippi'),
        'label_off' => __('Grid', 'ippi'),
    ]
);


$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Expert Spotlight', 'ippi'),
    ]
);


$this->add_control(
    'section_configuration',
    [
        'label' => esc_html__('Section Configuration (Manual/Bulk)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Manual', 'ippi'),
        'label_off' => __('Bulk', 'ippi'),
    ]
);


$this->add_control(
    'selected_experts',
    [
        'label' => __('Search & Select', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'display' => 'detailed',
            'query' => [
                'post_type' => 'experts',
            ],
        ],
        'options' => [],
        'label_block' => true,
        'multiple' => true,
        'condition' => [
            'section_configuration' => 'yes',
        ],
    ]
);


$this->add_control(
    'more_options',
    [
        'label' => esc_html__( 'Specific Content Types', 'ippi' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[0]',
    [
        'label' => esc_html__( 'Events', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'events' => [
                'title' => esc_html__( 'Events', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[1]',
    [
        'label' => esc_html__( 'Backgrounders', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'backgrounders' => [
                'title' => esc_html__( 'Backgrounders', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->end_controls_section();
//End Query