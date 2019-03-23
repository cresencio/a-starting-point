<?php
/**
 * ASP Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ASP_Theme
 */

if ( ! function_exists( 'asp_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function asp_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ASP Theme, use a find and replace
		 * to change 'asp-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'asp-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'asp-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'asp_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'asp_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function asp_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'asp_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'asp_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function asp_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'asp-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'asp-theme' ),
		'before_widget' => '<section id="%1$s" class="widget asp-theme-acf %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'asp_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function asp_theme_scripts() {
	wp_enqueue_style( 'asp-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'asp-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'asp-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//wp_enqueue_script( 'jquery-slim', get_template_directory_uri() . '/js/jquery.slim.min.js', array(), '3.3.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'asp_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load Advanced Custom Fields
 */
require get_template_directory() . '/inc/advanced-custom-fields.php';

// simple function for dealing with text fields
function clean_acf_text_fields($string) {
  // sanitize the text before anything
  $string = sanitize_text_field( $string );
  //replace any remaining special characters with white space (except for - and _)
  $string = preg_replace('/[^A-Za-z0-9\-_]/', ' ', $string);
  return $string;
}
// Add the custom classes to widgets
add_filter('dynamic_sidebar_params', 'acf_widget_custom_class');
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

// add the BS nav class to all menus

function add_bs_nav_class_to_menus( $args )
{
	$args['menu_class'] .= ' nav';
	return $args;
}

add_filter( 'wp_nav_menu_args', 'add_bs_nav_class_to_menus' );

// add BS nav-item class to all li tags
function add_bs_link_item_class_to_list_items($classes, $item, $args) {
  $classes[] = 'nav-item';
  return $classes;
}
add_filter('nav_menu_css_class', 'add_bs_link_item_class_to_list_items', 1, 3);

// add the BS nav-link class to all menu links
function add_bs_nav_link_class_to_menu_links($atts) {
  $atts['class'] = "nav-link";
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_bs_nav_link_class_to_menu_links');

// add_filter('wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2);

// function my_wp_nav_menu_items( $items, $args ) {
//
// 	echo "<pre>";
//
// 	print_r($args->menu_class);
//
// 	echo "</pre>";
//
// 	// get menu
// 	$menu = wp_get_nav_menu_object($args->menu);
//
// 	// check if field value exists
// 	if( get_field('asp_custom_menu_class', $menu) ) {
//
// 		// vars
// 		$custom_menu_class = get_field('asp_custom_menu_class', $menu);
//
// 		$args->menu->menu_class .= " " . $custom_menu_class;
//
// 		// append html
// 		$items = $custom_menu_class . $items;
//
// 	}
//
// 	// return
// 	return $items;
//
// }
