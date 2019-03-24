<?php

  // default link color

  $wp_customize->add_setting( 'asp_link_color' , array(
      'default'     => '4169E1',
      'transport'   => 'postMessage',
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_link_color', array(
  	'label'        => 'Link Color',
  	'section'    => 'colors',
  	'settings'   => 'asp_link_color',
    'description' => 'default',
  )));

  // visited color

  $wp_customize->add_setting( 'asp_link_colors_visited' , array(
      'default'     => '551A8B',
      'transport'   => 'postMessage',
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_link_colors_visited', array(
  	'label'        => 'Link Visited Color',
  	'section'    => 'colors',
  	'settings'   => 'asp_link_colors_visited',
    'description' => 'visited links',
  )));

  // hover color

  $wp_customize->add_setting( 'asp_link_haf_color' , array(
      'default'     => '191970',
      'transport'   => 'postMessage',
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_link_haf_color', array(
  	'label'        => 'Link Hover Color',
  	'section'    => 'colors',
  	'settings'   => 'asp_link_haf_color',
    'description' => 'color on hover, active, and focus',
  )));
