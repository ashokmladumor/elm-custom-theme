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
//echo '<pre>';
//print_r($query->posts);
//echo '</pre>';

// $query = new WP_Query( array( 's' => 'keyword' ) );


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
        'default' => __('Explainers', 'ippi'),
    ]
);

$this->add_control(
    'section_slide_count',
    [
        'label' => esc_html__('Number of slide', 'ippi'),
        'type' => Controls_Manager::NUMBER,
        'default' => __('5', 'ippi'),
        'min' => 1,
        'max' => 5,
        'step' => 1,
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
    'spacial_project_selected_posts',
    [
        'label' => __('Search & Select', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'query' => [
                'post_type' => array( 'explainer' ),
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

$this->add_control('include_term_ids', [
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
                'taxonomy' => array('issue_areas','topics','regions', 'countries'),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

// $this->add_control(
//     'spacial_project_related_activity',
//     [
//         'label' => esc_html__( 'Related Activities', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::SELECT2,
//         'multiple' => true,
//         'options' => [
//             'related_programs' => esc_html__( 'Programs', 'ippi' ),
//             'related_projects' => esc_html__( 'Projects', 'ippi' ),
//             'fellowship' => esc_html__( 'Fellowship', 'ippi' ),
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );


// $this->add_control(
//     'spacial_project_status',
//     [
//         'label' => esc_html__( 'Activities Status', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'opened' => [
//                 'title' => esc_html__( 'Open', 'ippi' ),
//             ],
//             'on-hold' => [
//                 'title' => esc_html__( 'On-hold', 'ippi' ),
//             ],
//             'closed' => [
//                 'title' => esc_html__( 'Close', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'related_experts',
//     [
//         'label' => esc_html__( 'Related Partners and Experts', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::SELECT2,
//         'multiple' => true,
//         'options' => [
//             'partners' => esc_html__( 'Partners', 'ippi' ),
//             'related_experts' => esc_html__( 'Experts', 'ippi' ),
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'recency_and_popularity',
//     [
//         'label' => esc_html__( 'Recency or popularity', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'recency' => [
//                 'title' => esc_html__( 'Recency', 'ippi' ),
//             ],
//             'popularity' => [
//                 'title' => esc_html__( 'Popularity', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

$this->end_controls_section();
//End Query