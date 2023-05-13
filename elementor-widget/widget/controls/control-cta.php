<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;


$this->start_controls_section(
    'main_image_section',
    [
        'label' => esc_html__('Image', 'ippi-elementor-child'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'position_layout',
    [
        'label' => esc_html__( 'Position', 'ippi-elementor-child' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'full_width' => [
                'title' => esc_html__( 'Full Width', 'ippi-elementor-child' ),
                'icon' => 'eicon-layout-settings',
            ],
            'left' => [
                'title' => esc_html__( 'Align To Left', 'ippi-elementor-child' ),
                'icon' => 'eicon-h-align-left',
            ],
            'right' => [
                'title' => esc_html__( 'Aligh To Right', 'ippi-elementor-child' ),
                'icon' => 'eicon-h-align-right',
            ],
        ],
        //'prefix_class' => 'elementor-cta-%s-layout-image-',
        // 'condition' => [
        //     'skin!' => 'cover',
        // ],
    ]
);

$this->add_control(
    'layout',
    [
        'label' => esc_html__( 'Background', 'ippi-elementor-child' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'color' => [
                'title' => esc_html__( 'color', 'ippi-elementor-child' ),
                 'icon' => 'eicon-paint-brush',
            ],
            'background_image' => [
                'image' => esc_html__( 'Image', 'ippi-elementor-child' ),
                'icon' => 'eicon-image',
            ],
        ],
       
    ]
);


$this->add_control(
    'bg_color',
    [
        'label' => esc_html__( 'Background Color', 'ippi-elementor-child' ),
        'type' => \Elementor\Controls_Manager::COLOR,
         'condition' => [
            'layout' => 'color',
        ],
    ]
);

$this->add_control(
    'bg_image',
    [
        'label' => esc_html__( 'Choose Image', 'ippi-elementor-child' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'condition' => [
            'layout' => 'background_image',
        ],
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'main_item',
    [
        'label' => esc_html__('Items', 'ippi-elementor-child'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'title',
    [
        'label' => esc_html__( 'Title', 'ippi-elementor-child' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        
    ]
);

$this->add_control(
    'content',
    [
        'label' => esc_html__( 'Content', 'elementor-addon' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
    ]
);

$this->add_control(
    'button_title',
    [
        'label' => esc_html__('Button Title', 'ippi-elementor-child'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__('Apply Now', 'ippi-elementor-child'),
    ]
);

$this->add_control(
    'button_link',
    [
        'label' => esc_html__('Button Link', 'ippi-elementor-child'),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'ippi-elementor-child'),
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