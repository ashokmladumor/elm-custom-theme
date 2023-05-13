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
        'default' => __('Events', 'ippi'),
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
    'selected_posts',
    [
        'label' => esc_html__('Show Posts', 'ippi'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'select_post' => esc_html('Select Post', 'ippi'),
            'post'  => esc_html__('Publications', 'ippi'),
            'in_the_news' => esc_html__('In The News', 'ippi'),
            'dossier' => esc_html__('Dossier', 'ippi'),
        ],
        'default' => 'post',
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

$this->add_control(
    'loadmore_toggle',
    [
        'label' => esc_html__('Show Load More (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);


$this->end_controls_section();


//End Query