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
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Special Project', 'ippi'),
    ]
);

$this->add_control(
    'section_slide_count',
    [
        'label' => esc_html__('Number of slide', 'ippi'),
        'type' => Controls_Manager::NUMBER,
        'default' => '5',
        'min' => -1,
        'max' => 50,
        'step' => 1,
    ]
);

$this->add_control(
    'overview_switcher',
    [
        'label' => esc_html__('Display overview?', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'topics_switcher',
    [
        'label' => esc_html__('Display topics?', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);


// $this->add_control(
//     'manual_selected_issue_area',
//     [
//         'label' => __('Search & Select', 'ippi'),
//         'type' => Query_Module::QUERY_CONTROL_ID,
//         'autocomplete' => [
//             'object' => Query_Module::QUERY_OBJECT_TAX,
//             'display' => 'detailed',
//             'query' => [
//                 'taxonomy' => array('issue_areas'),
//             ],
//         ],
//         'options' => [],
//         'label_block' => true,
//         'multiple' => true,
//         // 'condition' => [
//         //     'section_configuration' => 'yes',
//         // ],
//     ]
// );

$this->add_control('include_issue_are_ids', [
        'label' => __('Tags and Categories', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'options' => [
            '' => __( 'All', 'ippi' ),
        ],
        'label_block' => true,
        'multiple' => true,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_TAX,
            'display' => 'detailed',
            'query' => [
                'taxonomy' => array('issue_areas'),
            ],
        ],
        // 'condition' => [
        //     'section_configuration!' => 'yes',
        // ],
    ]
);

$this->end_controls_section();
//End Query