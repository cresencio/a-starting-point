<?php

// 1. customize ACF path
add_filter('acf/settings/path', 'asp_theme_acf_settings_path');

function asp_theme_acf_settings_path( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/inc/advanced-custom-fields/';

    // return
    return $path;

}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'asp_theme_acf_settings_dir');

function asp_theme_acf_settings_dir( $dir ) {

    // update path
    $dir = get_stylesheet_directory_uri() . '/inc/advanced-custom-fields/';

    // return
    return $dir;

}

// 3. add acf-json path
add_filter('acf/settings/save_json', 'asp_theme_acf_json_save_point');

function asp_theme_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/inc/acf-json';


    // return
    return $path;

}

// 4. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// 5. Include ACF
include_once( get_stylesheet_directory() . '/inc/advanced-custom-fields/acf.php' );

?>
