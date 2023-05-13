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
        'default' => __('Related Content', 'ippi'),
    ]
);



$this->end_controls_section();
//End Query