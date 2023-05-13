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
        'default' => __('Partners', 'ippi'),
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
    'selected_partners',
    [
        'label' => __('Search & Select', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'display' => 'detailed',
            'query' => [
                'post_type' => 'partner',
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

// $this->add_control('include_term_ids', [
//         'label' => __('Term', 'ippi'),
//         'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'ippi'),
//         'type' => Query_Module::QUERY_CONTROL_ID,
//         'options' => [],
//         'label_block' => true,
//         'multiple' => true,
//         'autocomplete' => [
//             'object' => Query_Module::QUERY_OBJECT_TAX,
//             'display' => 'detailed',
//             'query' => [
//                 'post_type' => 'any',
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

//$this->add_control(
//    'specific_content_type',
//    [
//        'label' => esc_html__( 'Specific Content Type', 'ippi' ),
//        'type' => \Elementor\Controls_Manager::CHOOSE,
//        'options' => [
//            'events' => [
//                'title' => esc_html__( 'Events', 'ippi' ),
//            ],
//            'backgrounders' => [
//                'title' => esc_html__( 'Backgrounders', 'ippi' ),
//            ],
//            'reports' => [
//                'title' => esc_html__( 'Reports', 'ippi' ),
//            ],
//            'explainers' => [
//                'title' => esc_html__( 'Explainers', 'ippi' ),
//            ],
//            'podcast' => [
//                'title' => esc_html__( 'Podcast', 'ippi' ),
//            ],
//            'video' => [
//                'title' => esc_html__( 'Video', 'ippi' ),
//            ],
//            'dossier' => [
//                'title' => esc_html__( 'Dossier', 'ippi' ),
//            ],
//            'news' => [
//                'title' => esc_html__( 'News', 'ippi' ),
//            ],
//        ],
//    ]
//);

// $this->add_control(
//     'more_options',
//     [
//         'label' => esc_html__( 'Specific Content Types', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::HEADING,
//         'separator' => 'before',
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[0]',
//     [
//         'label' => esc_html__( 'Events', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'events' => [
//                 'title' => esc_html__( 'Events', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[1]',
//     [
//         'label' => esc_html__( 'Backgrounders', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'backgrounders' => [
//                 'title' => esc_html__( 'Backgrounders', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[2]',
//     [
//         'label' => esc_html__( 'Reports', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'reports' => [
//                 'title' => esc_html__( 'Reports', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[3]',
//     [
//         'label' => esc_html__( 'Explainers', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'explainers' => [
//                 'title' => esc_html__( 'Explainers', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[4]',
//     [
//         'label' => esc_html__( 'Podcast', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'podcast' => [
//                 'title' => esc_html__( 'Podcast', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[5]',
//     [
//         'label' => esc_html__( 'Video', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'video' => [
//                 'title' => esc_html__( 'Video', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[6]',
//     [
//         'label' => esc_html__( 'Dossier', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'dossier' => [
//                 'title' => esc_html__( 'Dossier', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'specific_content_type[7]',
//     [
//         'label' => esc_html__( 'News', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::CHOOSE,
//         'options' => [
//             'news' => [
//                 'title' => esc_html__( 'News', 'ippi' ),
//             ],
//         ],
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

// $this->add_control(
//     'hr',
//     [
//         'type' => \Elementor\Controls_Manager::DIVIDER,
//         'condition' => [
//             'section_configuration!' => 'yes',
//         ],
//     ]
// );

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



$this->end_controls_section();
//End Query