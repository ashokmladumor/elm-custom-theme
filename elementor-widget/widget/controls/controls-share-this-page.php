<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

$query = new WP_Query($args);

$this->start_controls_section(
    'query_settings',
    [
        'label' =>__('Share This Page Settings', 'ippi'),
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Share This Page:', 'ippi'),
    ]
);

// $this->add_control(
//     'section_icon',
//     [
//         'label' => esc_html__('Icon', 'elementor'),
//         'type' => Controls_Manager::ICONS,
//         'fa4compatibility' => 'icon',
//         'default' => [
//             'value' => 'fas fa-star',
//             'library' => 'fa-solid',
//         ],
//         'icon' => [
//             'icon' => 'eicon-star',
//         ],
//     ]
// );

$this->add_control(
    'share_icons',
    [
        'label' => esc_html__( 'Share_icons', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'default'  => esc_html__( 'Default', 'ippi' ),
            'lite' => esc_html__( 'Lite', 'ippi' ),
        ],
        'default' => 'default',
        
    ]
);
