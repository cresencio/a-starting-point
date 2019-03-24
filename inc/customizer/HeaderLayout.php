<?php

// settings go into controls, so set this up before the control

$wp_customize->add_setting( 'header_layout' , array(
	'default'     				=> 'layout-one',
	'transport'   				=> 'refresh',
	'type'			  				=> 'theme_mod',
	'sanitize_callback'		=> 'asp_sanitize_header_layout'
));

function asp_sanitize_header_layout( $input, $setting ){

		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);

		//get the list of possible select options
		$choices = $setting->manager->get_control( $setting->id )->choices;

		//return input if valid or return default option
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

// create the control

$wp_customize->add_control(
	'header_layout',
		array(
			'label'       => 'Header Layout',
			'section'     => 'asp_layout',
			'settings'    => 'header_layout',
			'type'        => 'radio',
			'description' => __( 'Modifies the layout of the website\'s header content. (branding, widgets, and navigation)', 'asp' ),
			'choices' => array(
					'layout-one' => esc_html__('Layout 1','asp'),
					'layout-two' => esc_html__('Layout 2','asp'),
					'layout-three' => esc_html__('Layout 3','asp')
			)
		)
);
