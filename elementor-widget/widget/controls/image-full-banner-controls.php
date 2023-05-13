<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'fields' => 'ids',
);

$query = new WP_Query($args);

$this->start_controls_section(
    'query_settings',
    [
        'label' => __('Settings', 'ippi'),
    ]
);

$this->add_control(
    'content_type',
    [
        'label' => esc_html__( 'Specific Content Types', 'ippi' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'default' => [
                'title' => esc_html__( 'Default', 'ippi' ),
            ],
            'dossier' => [
                'title' => esc_html__( 'Dossier', 'ippi' ),
            ],
            'program' => [
                'title' => esc_html__( 'Program', 'ippi' ),
            ],
        ],
        'default' => 'default',
    ]
);

$this->add_control(
    'hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);

$this->add_control(
    'section_content',
    [
        'label' => esc_html__( 'Section Content', 'ippi' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'placeholder' => esc_html__( 'Type your content here', 'ippi' ),
    ]
);




//$this->add_control(
//    'hr_1',
//    [
//        'type' => \Elementor\Controls_Manager::DIVIDER,
//    ]
//);

$this->add_control(
    'image_credit',
    [
        'label' => esc_html__( 'Image Credit', 'ippi' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'placeholder' => esc_html__( 'Type your image credit here', 'ippi' ),
    ]
);

$this->add_control(
    'image_credit_link',
    [
        'label' => esc_html__( 'Image Credit Link', 'ippi' ),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__( 'Type your image credit link here', 'ippi' ),
    ]
);

$this->add_control(
    'image_description',
    [
        'label' => esc_html__( 'Image Description', 'ippi' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'rows' => 10,
        'placeholder' => esc_html__( 'Type your description here', 'ippi' ),
    ]
);

$this->add_control(
    'post_full_banner',
    [
        'label' => esc_html__('Post Banner (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'show_post_type_tax',
    [
        'label' => esc_html__('Post name (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'image_credit_remove',
    [
        'label' => esc_html__('Image Credit Remove (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'date_reading',
    [
        'label' => esc_html__('Date & Reading time (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'share_icon',
    [
        'label' => esc_html__('Social Icon (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'no',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->add_control(
    'image_popup_description',
    [
        'label' => esc_html__( 'Image Popup Description', 'ippi' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'rows' => 10,
        'placeholder' => esc_html__( 'Type your description here', 'ippi' ),
    ]
);
$this->end_controls_section();
//End Query