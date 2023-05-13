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
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Topics', 'ippi'),
    ]
);

$this->add_control(
    'selected_taxonomy',
    [
        'label' => esc_html__('Show Taxonomy', 'ippi'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'topics'  => esc_html__('Topics', 'ippi'),
            'expertise' => esc_html__('Expertise', 'ippi'),
        ],
        'default' => 'topics',
    ]
);


$this->end_controls_section();
//End Query