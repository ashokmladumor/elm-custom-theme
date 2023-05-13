
<?php

// Image Style Settings
$this->start_controls_section(
    'image_style_section',
    [
        'label' => __( 'Image', 'my-elementor-widget' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

    // Width
    $this->add_responsive_control(
        'image_width',
        [
            'label' => __( 'Image Width', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    //Min Width
    $this->add_responsive_control(
        'image_min_width',
        [
            'label' => __( 'Image Min Width', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    //Max Width
    $this->add_responsive_control(
        'image_max_width',
        [
            'label' => __( 'Image Max Width', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );


    $this->add_control(
        'hr',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER,
        ]
    );

    // Height
    $this->add_responsive_control(
        'image_height',
        [
            'label' => __( 'Image Height', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    //Min Height
    $this->add_responsive_control(
        'image_min_height',
        [
            'label' => __( 'Image Min Height', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    //Max Height
    $this->add_responsive_control(
        'image_max_height',
        [
            'label' => __( 'Image Max Height', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'max-height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    // Image radius
    $this->add_responsive_control(
        'image_radius',
        [
            'label' => __( 'Image Radius', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img img' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    // Padding
    $this->add_responsive_control(
        'image_padding',
        [
            'label' => __( 'Padding', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'default' => [
                'top' => 0,
                'right' => 0,
                'bottom' => 0,
                'left' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    // Border Type
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'image_border',
            'label' => __( 'Border', 'bfs-testimonials' ),
            'selector' => '{{WRAPPER}} .slider .card .img',
        ]
    );

     // Box Shadow
     $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'image_box_shadow',
            'label' => __( 'Box Shadow', 'plugin-domain' ),
            'selector' => '{{WRAPPER}} .slider .card .img',
        ]
    );

$this->end_controls_section();
//end imgae controls

//Quote Image Style Settings
$this->start_controls_section(
    'quote_image_style_section',
    [
        'label' => __( 'Quote Image', 'my-elementor-widget' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);
    //Quote image Width
    $this->add_responsive_control(
        'quote_image_width',
        [
            'label' => __( 'Quote Image Width', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .quote_image img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

     //Quote image Height
     $this->add_responsive_control(
        'quote_image_hight',
        [
            'label' => __( 'Quote Image Height', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 100%',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .quote_image img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    // Padding
    $this->add_responsive_control(
        'quote_image_padding',
        [
            'label' => __( 'Padding', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'default' => [
                'top' => 0,
                'right' => 0,
                'bottom' => 0,
                'left' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .quote_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

$this->end_controls_section();



/**
 * Content Style Settings
 */

$this->start_controls_section(
    'content_style_section',
    [
        'label' => __( 'Content', 'bfs-testimonials' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

      // Padding
      $this->add_responsive_control(
        'content_padding',
        [
            'label' => __( 'Padding', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'default' => [
                'top' => 10,
                'right' => 20,
                'bottom' => 10,
                'left' => 20,
            ],
            'selectors' => [
                '{{WRAPPER}} .slider .card .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ]
        ]
    );

    // Title heading
    $this->add_responsive_control(
        'content_title_heading',
        [
            'label' => __( 'Title', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    // Title Bottom Spacing
    $this->add_responsive_control(
        'title_bottom_spacing',
        [
            'label' => __( 'Bottom Spacing', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 0 px',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .card .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    // Title Bottom Spacing
    $this->add_responsive_control(
        'designation_bottom_spacing',
        [
            'label' => __( 'Designation Bottom Spacing', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 0 px',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .card .content .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    // Title Color
    $this->add_control(
        'content_title_color',
        [
            'label' => __( 'Title Color', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .card .content .title' => 'color: {{VALUE}}',
            ],
            'default' => '#404040',
        ]
    );

    // Title Typography
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'content_title_typography',
            'label' => __( 'Typography', 'bfs-testimonials' ),
            'selector' => '{{WRAPPER}} .card .content .title',
        ]
    );


    // Description Settings
    $this->add_control(
        'content_description_heading',
        [
            'label' => __( 'Description', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    // Description Bottom Spacing
    $this->add_responsive_control(
        'description_bottom_spacing',
        [
            'label' => __( 'Description Bottom Spacing', 'bfs-testimonials' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'description' => 'Default: 0 px',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .card .content .cotent_text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    // Description Color
    $this->add_control(
        'content_description_color',
        [
            'label' => __( 'Description Color', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .card .content .cotent_text' => 'color: {{VALUE}}',
            ],
            'default' => '#404040',
        ]
    );

    // Description Typography
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'content_description_typography',
            'label' => __( 'Typography', 'bfs-testimonials' ),
            'selector' => '{{WRAPPER}} .card .content .cotent_text',
        ]
    );



$this->end_controls_section();

/**
 * End Content Style Settings
 */