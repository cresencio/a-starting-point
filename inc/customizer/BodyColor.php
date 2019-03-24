<?php

  $wp_customize->add_setting( 'asp_body_color' , array(
      'default'     => '404040',
      'transport'   => 'postMessage',
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_body_color', array(
  	'label'        => 'Main Content Color',
  	'section'    => 'colors',
  	'settings'   => 'asp_body_color',
  )));
