<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

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
        'default' => __('Recent Reports', 'ippi'),
    ]
);

$this->add_control(
    'section_heading_toggle',
    [
        'label' => esc_html__('Section Heading (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'section_heading_toggle',
    [
        'label' => esc_html__('Section Heading (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
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
                'taxonomy' => array('issue_areas','topics','regions','countries'),
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
            'related_programs' => esc_html__( 'Programs', 'ippi' ),
            'related_projects' => esc_html__( 'Projects', 'ippi' ),
            'fellowship' => esc_html__( 'Fellowship', 'ippi' ),
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'related_experts',
    [
        'label' => esc_html__( 'Related Partners and Experts', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => true,
        'options' => [
            'partners' => esc_html__( 'Partners', 'ippi' ),
            'related_experts' => esc_html__( 'Experts', 'ippi' ),
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);



// $this->add_control(
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
    'recent_reports_selected_posts',
    [
        'label' => __('Search & Select', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'query' => [
                'post_type' => array( 'post-report' ),
            ],
        ],
        'options' => [],
        'label_block' => true,
        'multiple' => true,
        'condition' => [
            'report_loadmore_toggle' => '',
        ],
    ]
);

$this->add_control(
    'report_loadmore_toggle',
    [
        'label' => esc_html__('Show Load More (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => '',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'report_per_page',
    [
        'label' => esc_html__( 'Posts per page', 'ippi' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 1,
        'max' => 100,
        'step' => 1,
        'default' => 4,
        'condition' => [
            'report_loadmore_toggle' => 'yes',
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
    'recent_reports_selected_posts',
    [
        'label' => __('Search & Select', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'query' => [
                'post_type' => array( 'post-report' ),
            ],
        ],
        'options' => [],
        'label_block' => true,
        'multiple' => true,
        'condition' => [
            'report_loadmore_toggle' => '',
        ],
    ]
);

$this->end_controls_section();
//End Query