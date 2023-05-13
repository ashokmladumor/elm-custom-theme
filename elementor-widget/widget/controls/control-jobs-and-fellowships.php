<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Settings', 'ippi'),
    ]
);

$this->add_control(
    'enable_filters',
    [
        'label' => esc_html__('Section Tabs (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control('job_fellowhips_categories_ids', [
    'label' => __('Select categories', 'ippi'),
    'description' => esc_html__( '', 'ippi' ),
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [
        //'' => __( 'All', 'ippi' ),
    ],
    'label_block' => true,
    'multiple' => true,
    'autocomplete' => [
        'object' => Query_Module::QUERY_OBJECT_TAX,
        'display' => 'detailed',
        'query' => [
            'taxonomy' => array('issue_areas', 'regions'),
        ],
    ],
]
);

$this->add_control('job_fellowhips_tag_ids', [
    'label' => __('Select Tags', 'ippi'),
    'description' => esc_html__( '', 'ippi' ),
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [
        //'' => __( 'All', 'ippi' ),
    ],
    'label_block' => true,
    'multiple' => true,
    'autocomplete' => [
        'object' => Query_Module::QUERY_OBJECT_TAX,
        'display' => 'detailed',
        'query' => [
            'taxonomy' => array('topics', 'countries'),
        ],
    ],
]
);

$this->end_controls_section();


//End Query