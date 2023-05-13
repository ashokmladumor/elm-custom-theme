<?php

use Elementor\Controls_Manager;

$this->start_controls_section(
    'form_section',
    [
        'label' => esc_html__( 'Content', 'ippi' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);


$this->add_control(
    'section_heading',
    [
        'label' => esc_html__('Section Heading', 'ippi'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Apply Here', 'ippi'),
    ]
);

$this->add_control(
    'item_description',
    [
        'label' => esc_html__( 'Description', 'ippi' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'rows' => 5,
        'default' => esc_html__( '', 'ippi' ),
        'placeholder' => esc_html__( 'Type your description here', 'ippi' ),
    ]
);


$this->add_control(
    'section_full_width',
    [
        'label' => esc_html__('Is full Width', 'ippi'),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'label_on' => __('Yes', 'ippi'),
        'label_off' => __('No', 'ippi'),
    ]
);

$this->add_control(
    'section_background',
    [
        'label' => esc_html__( 'Background color', 'ippi' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .form-content' => 'background-color: {{VALUE}}',
        ],
    ]
);

// $this->add_control(
//     'form_type',
//     [
//         'label' => esc_html__( 'Select form type', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::SELECT,
//         'default' => '',
//         'options' => [
//             ''  => esc_html__( 'Select form type', 'ippi' ),
//             'fellowship' => esc_html__( 'Fellowship', 'ippi' ),
//             'genral_form' => esc_html__( 'Genral form', 'ippi' ),            
//         ],
//     ]
// );

// $this->add_control(
//     'submission_closed_date',
//     [
//         'label' => esc_html__( 'Submission closed date', 'ippi' ),
//         'type' => \Elementor\Controls_Manager::DATE_TIME,
//         'condition' => [
//             'form_type' => 'fellowship',
//         ],
//     ]
// );

if ( class_exists( 'GFFormsModel' ) ) {
    $gravity_choices = [];

    $gravity_choices[ '' ] = 'Select form';
    foreach ( \GFFormsModel::get_forms() as $form ) {
        $gravity_choices[ $form->id ] = $form->title;
    }    
}

$this->add_control(
    'gravity_form_select',
    [
        'label' => esc_html__( 'Select form', 'ippi' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '',
        'options' => $gravity_choices,
    ]
);

$this->end_controls_section();


//End Query