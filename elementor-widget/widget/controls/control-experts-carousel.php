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
            'display' => __('detailed', 'ippi'),
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
$this->add_control('include_term_ids', [
    'label' => __('Term', 'ippi'),
    'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'ippi'),
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [],
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

$this->add_control(
    'related_activity',
    [
        'label' => esc_html__( 'Related Activities', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => true,
        'options' => [
            'program' => esc_html__( 'Programs', 'ippi' ),
            'projects' => esc_html__( 'Projects', 'ippi' ),
            'fellowship' => esc_html__( 'Fellowship', 'ippi' ),
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

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

$this->add_control(
    'recency_and_popularity',
    [
        'label' => esc_html__( 'Recency or popularity', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'recency' => [
                'title' => esc_html__( 'Recency', 'ippi' ),
            ],
            'popularity' => [
                'title' => esc_html__( 'Popularity', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);
$this->add_control(
    'title',
    [
        'label' => esc_html__('Title', 'ippi'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__('Type your title here', 'ippi'),
    ]
);

$this->add_control(
    'link',
    [
        'label' => esc_html__('Link', 'ippi'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'ippi'),
        'options' => ['url', 'is_external', 'nofollow'],
        'default' => [
            'url' => '',
            'is_external' => true,
            'nofollow' => true,
        ],
        'label_block' => true,
    ]
);


$this->end_controls_section();
//End Query