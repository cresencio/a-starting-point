<?php

  $wp_customize->add_setting( 'asp_headings_color' , array(
      'default'     => '404040',
      'transport'   => 'postMessage',
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_headings_color', array(
  	'label'        => 'Headings Color',
  	'section'    => 'colors',
  	'settings'   => 'asp_headings_color',
  )));
