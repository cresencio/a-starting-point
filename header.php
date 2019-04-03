<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ASP_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>

<?php $sidebar_position = get_theme_mod('sidebar_position', 'sidebar-right'); ?>

<body <?php body_class($sidebar_position); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'asp-theme' ); ?></a>

	<header id="masthead" class="site-header">

		<?php get_sidebar('header'); ?>

		<div class="container-fluid">
			<div class="row">
				<!-- <div class="col"> -->
					<div class="site-branding">
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$asp_theme_description = get_bloginfo( 'description', 'display' );
						if ( $asp_theme_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $asp_theme_description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'asp-theme' ); ?></button>
						<?php

						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );

						?>

					</nav><!-- #site-navigation -->

				<!-- </div> -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container-fluid">
			<div class="row">
