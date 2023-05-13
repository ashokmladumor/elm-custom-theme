<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;


$this->start_controls_section(
    'agenda_section',
    [
        'label' => esc_html__('Content', 'ippi'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);


$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        //'default' =>  _e('Agenda', 'ippi'),
    ]
);

$repeater = new \Elementor\Repeater();


$repeater->add_control(
    'hour_start',
    [
        'label' => esc_html__('Hour Start', 'ippi'),
        'type' => \Elementor\Controls_Manager::DATE_TIME,
        'picker_options' => [
            'enableTime' => true,
            'noCalendar' => true,
            'dateFormat' => "H:i"
        ],
    ]
);

$repeater->add_control(
    'hour_end',
    [
        'label' => esc_html__('Hour End', 'ippi'),
        'type' => \Elementor\Controls_Manager::DATE_TIME,
        'picker_options' => [
            'enableTime' => true,
            'noCalendar' => true,
            'dateFormat' => "H:i"
        ],
    ]
);

$repeater->add_control(
    'list_title',
    [
        'label' => esc_html__('Title', 'ippi'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('List Title', 'ippi'),
        'label_block' => true,
    ]
);

$repeater->add_control(
    'list_content',
    [
        'label' => esc_html__('Description (optional)', 'ippi'),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => esc_html__('List Content', 'ippi'),
        'show_label' => true,
    ],
    
);
$repeater->add_control(
    'read_more_toggle',
    [
        'label' => esc_html__('Read More (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'list',
    [
        'label' => esc_html__('Repeater List', 'ippi'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
            [
                'list_title' => esc_html__('Title #1', 'ippi'),
                'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'ippi'),
            ],
            [
                'list_title' => esc_html__('Title #2', 'ippi'),
                'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'ippi'),
            ],
        ],
        'title_field' => '{{{ list_title }}}',
    ]
);


$this->add_control(
    'pdf_title',
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