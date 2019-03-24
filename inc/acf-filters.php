<?php

// simple function for dealing with text fields
// removes special characters for html attributes
function clean_acf_text_fields($string) {
  // sanitize the text before anything
  $string = sanitize_text_field( $string );
  //replace any remaining special characters with white space (except for - and _)
  $string = preg_replace('/[^A-Za-z0-9\-_]/', ' ', $string);
  return $string;
}

// Add the custom classes to widgets
function acf_widget_custom_class( $params ) {
	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id = $params[0]['widget_id'];
	// get acf value
	$custom_css_class_value = clean_acf_text_fields(get_field('asp_custom_widget_class', 'widget_' . $widget_id));
	if( $custom_css_class_value ) {
		$params[0]['before_widget'] = str_replace( 'asp-theme-acf', esc_html( $custom_css_class_value ), $params[0]['before_widget'] );
	}
	// return
	return $params;
}
add_filter('dynamic_sidebar_params', 'acf_widget_custom_class');

// add custom field value to menu class if it exists

function my_wp_nav_menu_objects( $items, $args ) {

	$menu = $args->menu;

	$custom_menu_class = get_field('asp_custom_menu_class', $menu);

	if($custom_menu_class){
			$args->menu_class .= ' '. clean_acf_text_fields($custom_menu_class);
	}

	return $items;
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
