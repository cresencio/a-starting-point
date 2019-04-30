<?php


// add acf-json path
add_filter('acf/settings/save_json', 'asp_theme_acf_json_save_point');

function asp_theme_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/inc/acf-json';

    // return
    return $path;

}

add_filter('acf/settings/load_json', 'asp_theme_json_load_point');

function asp_theme_json_load_point( $paths ) {

    // append path
    $paths[] = get_stylesheet_directory() . '/inc/acf-json';


    // return
    return $paths;

}

function asp_theme_admin_enqueue_scripts() {

	wp_enqueue_script( 'asp-blocks', get_template_directory_uri() . '/js/blocks-min.js', array(), '1.0.0', true );

}

add_action('acf/input/admin_enqueue_scripts', 'asp_theme_admin_enqueue_scripts');

// 4. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// 5. Include ACF

?>
