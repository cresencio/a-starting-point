<?php
function asp_theme_guten_enqueue() {
    wp_enqueue_script(
        'blocks',
        get_template_directory_uri() . '/js/blocks-min.js',
        array( 'wp-blocks')
    );
}
add_action( 'enqueue_block_editor_assets', 'asp_theme_guten_enqueue' );
