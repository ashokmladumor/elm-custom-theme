<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;


$this->start_controls_section(
    'content_section',
    [
        'label' => esc_html__( 'Content', 'ippi' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Our Experts', 'ippi'),
    ]
);

$this->add_control(
    'section_heading_toggle',
    [
        'label' => esc_html__('Section Heading (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'experts_tab_toggle',
    [
        'label' => esc_html__('Event Tab (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control('experts_tab', [
    'label' => __('Experts Tab', 'ippi'),
    'description' => '',
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [],
    'label_block' => true,
    'multiple' => true,
    'autocomplete' => [
        'object' => Query_Module::QUERY_OBJECT_TAX,
        'display' => 'detailed',
        'query' => [
            'taxonomy' => 'expert-type',
        ],
    ],
    'condition' => [
        'experts_tab_toggle' => 'yes',
    ],
]
);

$this->add_control('show_elements', [
    'label' => __('Show Element', 'ippi'),
    'description' => '',
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [],
    'label_block' => true,
    'multiple' => false,
    'autocomplete' => [
        'object' => Query_Module::QUERY_OBJECT_TAX,
        'display' => 'detailed',
        'query' => [
            'taxonomy' => 'expert-type',
        ],
    ],
    'condition' => [
        'experts_tab_toggle' => '',
    ],
]
);


$this->end_controls_section();
//Start settings
$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Query', 'ippi'),
    ]
);

$this->add_control(
    'col_count',
    [
        'label' => esc_html__( 'Columns', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => __('3', 'ippi'),
        'options' => [
            '1'  => esc_html__('1', 'ippi' ),
            '2' => esc_html__( '2', 'ippi' ),
            '3' => esc_html__( '3', 'ippi' ),
            '4' => esc_html__( '4', 'ippi' ),
            '5' => esc_html__( '5', 'ippi' ),
            '6' => esc_html__( '6', 'ippi' ),
        ],
    ]
);

$this->add_control(
    'post_per_page',
    [
        'label' => esc_html__('Post Per Page', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('6', 'ippi'),
    ]
);

$this->add_control(
    'experts_loadmore_toggle',
    [
        'label' => esc_html__('Show Load More (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control('include_term_ids', [
    'label' => __('Expertise', 'ippi'),
    'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'ippi'),
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [],
    'label_block' => true,
    'multiple' => true,
    'autocomplete' => [
        'object' => Query_Module::QUERY_OBJECT_TAX,
        //'display' => 'detailed',
        'query' => [
            'taxonomy' => 'expert-type',
        ],
    ],
    
]
);

$this->end_controls_section();
//End Query