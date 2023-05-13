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
    'testimonial_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Testimonials', 'ippi'),
    ]
);

// $this->add_control(
//     'section_slide_count',
//     [
//         'label' => esc_html__('Number of slide', 'ippi'),
//         'type' => Controls_Manager::NUMBER,
//         'default' => '5',
//         'min' => -1,
//         'max' => 50,
//         'step' => 1,
//     ]
// );

// $this->add_control(
//     'section_configuration',
//     [
//         'label' => esc_html__('Section Configuration (Manual/Bulk)', 'ippi'),
//         'type' => Controls_Manager::SWITCHER,
//         'default' => 'yes',
//         'label_on' => __('Manual', 'ippi'),
//         'label_off' => __('Bulk', 'ippi'),
//     ]
// );


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

$this->add_control(
    'latest_testimonail_posts',
    [
        'label' => __('Search & Select Testimonails', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'query' => [
                'post_type' => array('testimonials'),
            ],
        ],
        'options' => [],
        'label_block' => true,
        'multiple' => true,
        // 'condition' => [
        //     'section_configuration' => 'yes',
        // ],
    ]
);

$this->end_controls_section();
//End Query