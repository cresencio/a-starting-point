<?php

  $wp_customize->add_setting( 'asp_main_content_background_color' , array(
      'default'     => 'FFFFFF',
      'transport'   => 'refresh',
  ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'asp_main_content_background_color', array(
  	'label'        => 'Main Content Background Color',
  	'section'    => 'colors',
  	'settings'   => 'asp_main_content_background_color',
  )));
