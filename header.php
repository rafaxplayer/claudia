<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package claudia
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'claudia' ); ?></a>
	<div id="claudia-search-panel">
		<?php get_search_form(); ?>
	</div>
	<header id="masthead" class="site-header">
		<div class="header-wrap">
			<div class="header-left">
				<a id="search-open" class="claudia-button-search" href="#" >
					<img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/search.png');?>" alt="<?php esc_attr_e('search button', 'claudia'); ?>"/>
				</a>
			</div> 
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" ><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" ><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$claudia_description = get_bloginfo( 'description', 'display' );
				if ( $claudia_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo esc_html($claudia_description); ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<a id="menu-toggle" href="#">
				<div class="menu-toggle" >
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
			</a>
			
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
			
		</div>
		<?php do_action('claudia_social_network'); 
			
			if( is_page() && get_header_image() != '' && get_theme_mod('show_header_on_pages') === 'true'):
				
				get_template_part('template-parts/header-image');

			

			elseif( is_single() && get_header_image() != '' && get_theme_mod('show_header_on_posts') === 'true'):
				
				get_template_part('template-parts/header-image');

			

			elseif( is_archive() && get_header_image() != '' && get_theme_mod('show_header_on_categories') === 'true'):
				
				get_template_part('template-parts/header-image');

			
			elseif ( get_header_image() != ''  && ( is_front_page() || is_home() ) ): 
									
				get_template_part('template-parts/header-image');

			endif;?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	
