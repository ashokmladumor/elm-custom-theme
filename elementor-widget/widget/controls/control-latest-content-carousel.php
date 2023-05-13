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
        'default' => __('Latest Content', 'ippi'),
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
    'latest_content_selected_posts',
    [
        'label' => __('Search & Select', 'ippi'),
        'type' => Query_Module::QUERY_CONTROL_ID,
        'autocomplete' => [
            'object' => Query_Module::QUERY_OBJECT_POST,
            'query' => [
                'post_type' => array('backgrounder', 'fellowship', 'projects', 'program', 'in_the_news', 'event', 'dossier', 'video', 'podcast', 'post-report', 'explainer', 'job_and_fellowship'),
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
    'activity_status',
    [
        'label' => esc_html__( 'Activities Status', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'opened' => [
                'title' => esc_html__( 'Open', 'ippi' ),
            ],
            'on-hold' => [
                'title' => esc_html__( 'On-hold', 'ippi' ),
            ],
            'closed' => [
                'title' => esc_html__( 'Close', 'ippi' ),
            ],
        ],
        // 'default' => 'opened',
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

$this->add_control(
    'more_options',
    [
        'label' => esc_html__( 'Specific Content Types', 'ippi' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[0]',
    [
        'label' => esc_html__( 'Events', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'event' => [
                'title' => esc_html__( 'Events', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[1]',
    [
        'label' => esc_html__( 'Backgrounders', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'backgrounder' => [
                'title' => esc_html__( 'Backgrounders', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[2]',
    [
        'label' => esc_html__( 'Reports', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'post-report' => [
                'title' => esc_html__( 'Reports', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[3]',
    [
        'label' => esc_html__( 'Explainers', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'explainer' => [
                'title' => esc_html__( 'Explainers', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[4]',
    [
        'label' => esc_html__( 'Podcast', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'podcast' => [
                'title' => esc_html__( 'Podcast', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[5]',
    [
        'label' => esc_html__( 'Video', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'video' => [
                'title' => esc_html__( 'Video', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[6]',
    [
        'label' => esc_html__( 'Dossier', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'dossier' => [
                'title' => esc_html__( 'Dossier', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'specific_content_type[7]',
    [
        'label' => esc_html__( 'News', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'in_the_news' => [
                'title' => esc_html__( 'News', 'ippi' ),
            ],
        ],
        'condition' => [
            'section_configuration!' => 'yes',
        ],
    ]
);

$this->add_control(
    'hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
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