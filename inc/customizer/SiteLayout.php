<?php 


	// add a section, this will not show in the panel until a control is added to it.

	$wp_customize->add_section( 'asp_layout' , array(
		'title'      => 'Site Layout',
		'priority'   => 30
	));

	// settings go into controls, so set this up before the control

	$wp_customize->add_setting( 'layout_width' , array(
    'default'     				=> 'container',
    'transport'   				=> 'refresh',
		'type'			  				=> 'theme_mod',
		'sanitize_callback'		=> 'asp_sanitize_layout_width'
	));

	function asp_sanitize_layout_width( $input, $setting ){

			//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
			$input = sanitize_key($input);

			//get the list of possible select options
			$choices = $setting->manager->get_control( $setting->id )->choices;

			//return input if valid or return default option
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

	// create the control

	$wp_customize->add_control(
		'layout_width',
			array(
				'label'       => 'Layout Width',
				'section'     => 'asp_layout',
				'settings'    => 'layout_width',
				'type'        => 'select',
				'description' => __( 'Modifies the width of the website\'s body.', 'asp' ),
				'choices' => array(
						'container' => esc_html__('Fixed width','asp'),
						'container-fluid' => esc_html__('Full width with padding','asp'),
						'full-width' => esc_html__('Full width with no padding','asp')
				)
			)
	);
