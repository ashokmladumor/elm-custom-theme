<?php

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module;
use ElementorPro\Modules\QueryControl\Module as Query_Module;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

$this->start_controls_section(
    'content_section',
    [
        'label' => esc_html__( 'Overview Content', 'ippi' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Overview', 'ippi'),
    ]
);

$this->add_control(
    'overview_content',
    [
        'label' => esc_html__( 'Content', 'ippi' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'placeholder' => esc_html__( 'Type your content here', 'ippi' ),
    ]
);

$this->add_control(
    'word_count',
    [
        'label' => esc_html__( 'Number Of Words', 'ippi' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( 'Enter numbers of word to show', 'ippi' ),
    ]
);

$this->add_control(
    'enable_show_more_btn',
    [
        'label' => esc_html__('Show More button (Show/Hide)', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'yes',
        'label_on' => __('Show', 'ippi'),
        'label_off' => __('Hide', 'ippi'),
    ]
);

$this->end_controls_section();
//End Query