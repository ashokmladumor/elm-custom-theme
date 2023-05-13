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
        'default' => __('Projects', 'ippi'),
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
    'project_tab_toggle',
    [
        'label' => esc_html__('Project Tab (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);
$this->add_control(
    'project_tab',
    [
        'label' => esc_html__( 'Project Tab', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'multiple' => true,
        'options' => [
            'all-projects'  => esc_html__( 'All Projects', 'ippi' ),
            'current-projects' => esc_html__( 'Current Projects', 'ippi' ),
            'past-projects' => esc_html__( 'Past Projects', 'ippi' ),
        ],
        'default' => [ 'all' ],
        'condition' => [
            'project_tab_toggle' => '',
        ],
    ]
);


$this->add_control(
    'show_elements',
    [
        'label' => esc_html__( 'Show Elements', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => true,
        'options' => [
            'all-projects'  => esc_html__( 'all-proejcts', 'ippi' ),
            'current-projects' => esc_html__( 'current-projects', 'ippi' ),
            'past-projects' => esc_html__( 'past-projects', 'ippi' ),
        ],
        'default' => [ 'all' ],
        'condition' => [
            'project_tab_toggle' => 'yes',
        ],
    ]
);

$this->add_control('include_project_term_ids', [
    'label' => __('Select issue areas and regions', 'ippi'),
    'description' => esc_html__( 'This is run only when an element is in the single post type.', 'ippi' ),
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
            'taxonomy' => array('issue_areas', 'regions'),
        ],
    ],
]
);

$this->add_control('include_project_tag_ids', [
    'label' => __('Select topics and countries', 'ippi'),
    'description' => esc_html__( 'This is run only when an element is in the single post type.', 'ippi' ),
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
            'taxonomy' => array('topics', 'countries'),
        ],
    ],
]
);

$this->add_control(
    'project_related_activity',
    [
        'label' => esc_html__( 'Related Activities', 'ippi' ),
        'description' => esc_html__( 'This is run only when an element is in the single post type.', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => true,
        'options' => [
            'related_programs' => esc_html__( 'Programs', 'ippi' ),
            'related_projects' => esc_html__( 'Projects', 'ippi' ),
            'fellowship' => esc_html__( 'Fellowship', 'ippi' ),
            'event' => esc_html__( 'event', 'ippi' ),
        ],
    ]
);

$this->add_control(
    'project_related_partners',
    [
        'label' => esc_html__( 'Related Partners', 'ippi' ),
        'description' => esc_html__( 'This is run only when an element is in the single post type.', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => true,
        'options' => [
            'partners' => esc_html__( 'Partners', 'ippi' ),
            //'related_projects' => esc_html__( 'Projects', 'ippi' ),
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
        'default' => '3',
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
        'default' => '6',
    ]
);

// $this->add_control(
//     'project_loadmore_toggle',
//     [
//         'label' => esc_html__('Show Load More (Show/Hide)', 'ippi'),
//         'type' => Controls_Manager::SWITCHER,
//         'default' => 'yes',
//         'label_on' => __('Show', 'ippi'),
//         'label_off' => __('Hide', 'ippi'),
//     ]
// );

// $this->add_control('include_term_ids', [
//     'label' => __('Event Types', 'elementor-pro'),
//     'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'elementor-pro'),
//     'type' => Query_Module::QUERY_CONTROL_ID,
//     'options' => [],
//     'label_block' => true,
//     'multiple' => true,
//     'autocomplete' => [
//         'object' => Query_Module::QUERY_OBJECT_TAX,
//         //'display' => 'detailed',
//         'query' => [
//             'taxonomy' => 'event_types',
//         ],
//     ],
    
// ]
// );



$this->end_controls_section();


//End Query