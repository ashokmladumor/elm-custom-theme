<?php

// use Elementor\Controls_Manager;
// use ElementorPro\Modules\QueryControl\Module;
// use ElementorPro\Modules\QueryControl\Module as Query_Module;
// use ElementorPro\Modules\QueryControl\Module as QueryModule;


$this->start_controls_section(
    'section_image',
    [
        'label' => __('WP Tips Image Box', 'elementor-test-extension'),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'image',
    [
        'label' => __('Choose Image', 'elementor-test-extension'),
        'type' => Controls_Manager::MEDIA,
        'dynamic' => [
            'active' => true,
        ],
        'default' => [
            'url' => Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_group_control(
    Group_Control_Image_Size::get_type(),
    [
        'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
        'default' => 'full',
        'separator' => 'none',
    ]
);

$this->add_control(
    'title_text',
    [
        'label' => __('Title, Subtitle & Description', 'elementor-test-extension'),
        'type' => Controls_Manager::TEXT,
        'dynamic' => [
            'active' => true,
        ],
        'default' => __('This is the heading', 'elementor-test-extension'),
        'placeholder' => __('Enter your title', 'elementor-test-extension'),
        'label_block' => true,
    ]
); 

$this->add_control(
    'description_text',
    [
        'label' => __('Content', 'elementor-test-extension'),
        'type' => Controls_Manager::TEXTAREA,
        'dynamic' => [
            'active' => true,
        ],
        'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-test-extension'),
        'placeholder' => __('Enter your description', 'elementor-test-extension'),
        'separator' => 'none',
        'rows' => 10,
        'show_label' => false,
    ]
);

$this->add_control(
    'link',
    [
        'label' => __('Link', 'elementor-test-extension'),
        'type' => Controls_Manager::URL,
        'dynamic' => [
            'active' => true,
        ],
        'placeholder' => __('https://your-link.com', 'elementor-test-extension'),
        'separator' => 'before',
    ]
);

$this->add_control(
    'position',
    [
        'label' => __('Image Position', 'elementor-test-extension'),
        'type' => Controls_Manager::CHOOSE,
        'default' => 'top',
        'options' => [
            'left' => [
                'title' => __('Left', 'elementor-test-extension'),
                'icon' => 'eicon-h-align-left',
            ],
            'top' => [
                'title' => __('Top', 'elementor-test-extension'),
                'icon' => 'eicon-v-align-top',
            ],
            'right' => [
                'title' => __('Right', 'elementor-test-extension'),
                'icon' => 'eicon-h-align-right',
            ],
        ],
        'prefix_class' => 'elementor-position-',
        'toggle' => false,
    ]
);

$this->add_control(
    'title_size',
    [
        'label' => __('Title HTML Tag', 'elementor-test-extension'),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
            'div' => 'div',
            'span' => 'span',
            'p' => 'p',
        ],
        'default' => 'h3',
    ]
);

$this->add_control(
    'view',
    [
        'label' => __('View', 'elementor-test-extension'),
        'type' => Controls_Manager::HIDDEN,
        'default' => 'traditional',
    ]
);

$this->end_controls_section();

$this->start_controls_section(
    'section_style_image',
    [
        'label' => __('Image', 'elementor-test-extension'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_responsive_control(
    'image_space',
    [
        'label' => __('Spacing', 'elementor-test-extension'),
        'type' => Controls_Manager::SLIDER,
        'default' => [
            'size' => 15,
        ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}}.elementor-position-right .elementor-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}}.elementor-position-left .elementor-image-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}}.elementor-position-top .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            '(mobile){{WRAPPER}} .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'image_size',
    [
        'label' => __('Width', 'elementor-test-extension') . ' (%)',
        'type' => Controls_Manager::SLIDER,
        'default' => [
            'size' => 30,
            'unit' => '%',
        ],
        'tablet_default' => [
            'unit' => '%',
        ],
        'mobile_default' => [
            'unit' => '%',
        ],
        'size_units' => ['%'],
        'range' => [
            '%' => [
                'min' => 5,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'hover_animation',
    [
        'label' => __('Hover Animation', 'elementor-test-extension'),
        'type' => Controls_Manager::HOVER_ANIMATION,
    ]
);

$this->start_controls_tabs('image_effects');

$this->start_controls_tab('normal',
    [
        'label' => __('Normal', 'elementor-test-extension'),
    ]
);

$this->add_group_control(
    Group_Control_Css_Filter::get_type(),
    [
        'name' => 'css_filters',
        'selector' => '{{WRAPPER}} .elementor-image-box-img img',
    ]
);

$this->add_control(
    'image_opacity',
    [
        'label' => __('Opacity', 'elementor-test-extension'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'max' => 1,
                'min' => 0.10,
                'step' => 0.01,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-img img' => 'opacity: {{SIZE}};',
        ],
    ]
);

$this->add_control(
    'background_hover_transition',
    [
        'label' => __('Transition Duration', 'elementor-test-extension'),
        'type' => Controls_Manager::SLIDER,
        'default' => [
            'size' => 0.3,
        ],
        'range' => [
            'px' => [
                'max' => 3,
                'step' => 0.1,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-img img' => 'transition-duration: {{SIZE}}s',
        ],
    ]
);

$this->end_controls_tab();

$this->start_controls_tab('hover',
    [
        'label' => __('Hover', 'elementor-test-extension'),
    ]
);

$this->add_group_control(
    Group_Control_Css_Filter::get_type(),
    [
        'name' => 'css_filters_hover',
        'selector' => '{{WRAPPER}}:hover .elementor-image-box-img img',
    ]
);

$this->add_control(
    'image_opacity_hover',
    [
        'label' => __('Opacity', 'elementor-test-extension'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'max' => 1,
                'min' => 0.10,
                'step' => 0.01,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}}:hover .elementor-image-box-img img' => 'opacity: {{SIZE}};',
        ],
    ]
);

$this->end_controls_tab();

$this->end_controls_tabs();

$this->end_controls_section();

$this->start_controls_section(
    'section_style_content',
    [
        'label' => __('Content', 'elementor-test-extension'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_responsive_control(
    'text_align',
    [
        'label' => __('Alignment', 'elementor-test-extension'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', 'elementor-test-extension'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __('Center', 'elementor-test-extension'),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __('Right', 'elementor-test-extension'),
                'icon' => 'eicon-text-align-right',
            ],
            'justify' => [
                'title' => __('Justified', 'elementor-test-extension'),
                'icon' => 'eicon-text-align-justify',
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-wrapper' => 'text-align: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'content_vertical_alignment',
    [
        'label' => __('Vertical Alignment', 'elementor-test-extension'),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'top' => __('Top', 'elementor-test-extension'),
            'middle' => __('Middle', 'elementor-test-extension'),
            'bottom' => __('Bottom', 'elementor-test-extension'),
        ],
        'default' => 'top',
        'prefix_class' => 'elementor-vertical-align-',
    ]
);

$this->add_control(
    'heading_title',
    [
        'label' => __('Title', 'elementor-test-extension'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_responsive_control(
    'title_bottom_space',
    [
        'label' => __('Spacing', 'elementor-test-extension'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'title_color',
    [
        'label' => __('Color', 'elementor-test-extension'),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-title' => 'color: {{VALUE}};',
        ],
        'scheme' => [
            'type' => Schemes\Color::get_type(),
            'value' => Schemes\Color::COLOR_1,
        ],
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'title_typography',
        'selector' => '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-title',
        'scheme' => Schemes\Typography::TYPOGRAPHY_1,
    ]
);

$this->add_control(
    'heading_description',
    [
        'label' => __('Description', 'elementor-test-extension'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'description_color',
    [
        'label' => __('Color', 'elementor-test-extension'),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
            '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-description' => 'color: {{VALUE}};',
        ],
        'scheme' => [
            'type' => Schemes\Color::get_type(),
            'value' => Schemes\Color::COLOR_3,
        ],
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'description_typography',
        'selector' => '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-description',
        'scheme' => Schemes\Typography::TYPOGRAPHY_3,
    ]
);

$this->end_controls_section();


//End Query