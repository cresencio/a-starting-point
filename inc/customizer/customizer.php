<?php
/**
 * ASP Theme Theme Customizer
 *
 * @package ASP_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function asp_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'asp_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'asp_theme_customize_partial_blogdescription',
		) );
	}

	include 'SidebarPosition.php';
	//include 'HeaderLayout.php';
	// include 'BackgroundColor.php';
	// include 'HeadingsColor.php';
	// include 'BodyColor.php';
	// include 'LinkColors.php';

}
add_action( 'customize_register', 'asp_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function asp_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function asp_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function asp_theme_customize_preview_js() {
	wp_enqueue_script( 'asp-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'asp_theme_customize_preview_js' );

// hook the styles onto the head

add_action( 'wp_head', 'asp_customizer_css');

function asp_customizer_css(){
		?>
				 <style type="text/css">
						 .site             { background: <?php echo get_theme_mod('asp_main_content_background_color', 'FFFFFF'); ?>; }
						 h1,h2,h3,h4,h5,h6 { color: #<?php echo get_theme_mod('asp_headings_color', '404040'); ?>; --headings-color: <?php echo get_theme_mod('asp_headings_color', '404040'); ?>; }
						 body              { color: #<?php echo get_theme_mod('asp_body_color', '404040'); ?>; --body-text-color: #<?php echo get_theme_mod('asp_body_color', '404040'); ?>; }
						 a                 { color: #<?php echo get_theme_mod('asp_link_color', '4169E1'); ?>; }
						 a:visited         { color: #<?php echo get_theme_mod('asp_link_colors_visited', '551A8B'); ?>;}
						 a:hover,
						 a:active,
						 a:focus           { color: #<?php echo get_theme_mod('asp_link_haf_color', '191970'); ?>;}
				 </style>


		<?php
}
