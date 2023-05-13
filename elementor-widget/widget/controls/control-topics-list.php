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
        'default' => __('Topics','ippi'),
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
    'topic_tab_toggle',
    [
        'label' => esc_html__('Topic Tab (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);
$this->add_control(
    'topic_tab',
    [
        'label' => esc_html__( 'Topic Tab', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'multiple' => true,
        'options' => [
            'all'  => esc_html__( 'All', 'ippi' ),
            'technology' => esc_html__( 'Technology', 'ippi' ),
            'environment' => esc_html__( 'Environment', 'ippi' ),
        ],
        'default' => [ 'all' ],
        'condition' => [
            'topic_tab_toggle' => '',
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
            'all'  => esc_html__( 'All', 'ippi' ),
            'technology' => esc_html__( 'Technology', 'ippi' ),
            'environment' => esc_html__( 'Environment', 'ippi' ),
        ],
        'default' => [ 'all' ],
        'condition' => [
            'topic_tab_toggle' => 'yes',
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
//Start settings
$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Query','ippi'),
    ]
);



$this->add_control(
    'col_count',
    [
        'label' => esc_html__( 'Columns', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => __('6','ippi'),
        'options' => [
            '1'  => esc_html__('1', 'textdomain' ),
            '2' => esc_html__( '2', 'textdomain' ),
            '3' => esc_html__( '3', 'textdomain' ),
            '4' => esc_html__( '4', 'textdomain' ),
            '5' => esc_html__( '5', 'textdomain' ),
            '6' => esc_html__( '6', 'textdomain' ),
        ],
    ]
);

$this->add_control(
    'post_per_page',
    [
        'label' => esc_html__('Post Per Page', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('4', 'ippi'),
    ]
);

$this->add_control(
    'topic_loadmore_toggle',
    [
        'label' => esc_html__('Show Load More (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control('include_term_ids', [
    'label' => __('Topics Types', 'ippi'),
    'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'elementor-pro'),
    'type' => Query_Module::QUERY_CONTROL_ID,
    'options' => [],
    'label_block' => true,
    'multiple' => true,
    'autocomplete' => [
        'object' => Query_Module::QUERY_OBJECT_TAX,
        //'display' => 'detailed',
        'query' => [
            'taxonomy' => 'event_types',
        ],
    ],
    
]
);



$this->end_controls_section();


//End Query