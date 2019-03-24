<?php


	// add a section, this will not show in the panel until a control is added to it.

	$wp_customize->add_section( 'asp_sidebar_position' , array(
		'title'      => 'Sidebar Position',
		'priority'   => 30
	));

	// settings go into controls, so set this up before the control

	$wp_customize->add_setting( 'sidebar_position' , array(
    'default'     				=> 'sidebar-right',
    'transport'   				=> 'refresh',
		'type'			  				=> 'theme_mod',
		'sanitize_callback'		=> 'asp_sanitize_sidebar_position'
	));

	function asp_sanitize_sidebar_position( $input, $setting ){

			//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
			$input = sanitize_key($input);

			//get the list of possible select options
			$choices = $setting->manager->get_control( $setting->id )->choices;

			//return input if valid or return default option
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

	// create the control

	$wp_customize->add_control(
		'sidebar_position',
			array(
				'label'       => 'Sidebar Position',
				'section'     => 'asp_sidebar_position',
				'settings'    => 'sidebar_position',
				'type'        => 'select',
				'description' => __( 'Modifies the position of the sidebar widget area.', 'asp-theme' ),
				'choices' => array(
						'sidebar-right' => esc_html__('Sidebar Right','asp-theme'),
						'sidebar-left' => esc_html__('Sidebar Left','asp-theme')
				)
			)
	);
