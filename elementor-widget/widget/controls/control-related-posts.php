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
        'label' => __('Related Posts Links', 'ippi'),
    ]
);


$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Related Programs', 'ippi'),
    ]
);

$this->add_control(
    'selected_related_posts',
    [
        'label' => esc_html__( 'Show Elements', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => [
            'related_programs'  => esc_html__( 'Related Programs', 'ippi' ),
            'related_projects' => esc_html__( 'Related Projects', 'ippi' ),
            'related_experts' => esc_html__( 'Related Experts', 'ippi' ),
            'related_content' => esc_html__( 'Related Content', 'ippi' ),
        ],
        'default' =>'related_programs',
    ]
);


$this->end_controls_section();
//End Query