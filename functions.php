<?php
/**
 * claudia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package claudia
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
$claudia_theme = wp_get_theme();
define('CLAUDIA_THEME_PATH',get_template_directory());
define('CLAUDIA_THEME_PATH_URI',get_template_directory_uri());
define('CLAUDIA_THEME_VERSION',$claudia_theme->get('Version'));

if ( ! function_exists( 'claudia_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function claudia_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on claudia, use a find and replace
		 * to change 'claudia' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'claudia', CLAUDIA_THEME_PATH . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'claudia' ),
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
		add_theme_support( 'custom-background', apply_filters( 'claudia_custom_background_args', array(
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
add_action( 'after_setup_theme', 'claudia_setup' );

if ( ! isset( $content_width ) ) $content_width = 900;

/**
 * Enable support for custom editor styles if using the classic editor.
 *
 * @link  https://developer.wordpress.org/reference/functions/add_editor_style/
 * @since 1.0.0
 */
function claudia_classic_editor_styles() {

	// Return if the block editor is not found.
	if ( ! function_exists( 'register_block_type' ) ) {

		return;

	}

	// Add editor styles for the classic editor.
	if ( ! get_current_screen()->is_block_editor() ) {

		add_editor_style( 'editor-style.css' );

	}

}
add_action( 'admin_print_styles', 'claudia_classic_editor_styles', 10, 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function claudia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'claudia' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'claudia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'claudia_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function claudia_scripts() {

	wp_enqueue_style( 'normalize-css',CLAUDIA_THEME_PATH_URI . '/assets/css/normalize.min.css' ,array(),'8.0.1');
	
	wp_enqueue_style( 'claudia-style', get_stylesheet_uri(), array('normalize-css'), 'CLAUDIA_THEME_VERSION' );
	wp_style_add_data ('claudia-style', 'rtl', 'replace');
	
	wp_enqueue_style( 'claudia-font-quicksand', 'https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap', array() );

	wp_enqueue_style( 'claudia-font-oxigen', 'https://fonts.googleapis.com/css?family=Oxygen:300,400,700|Quicksand:300,400,500,600,700&display=swap', array() );
	
	wp_enqueue_style( 'claudia-font-fira-sans', 'https://fonts.googleapis.com/css?family=Fira+Sans:300,300i,400,400i,500,600|Quicksand:300,400,500,600,700&display=swap', array() );
	
	wp_enqueue_script( 'claudia-globals', CLAUDIA_THEME_PATH_URI . '/js/global.js', array('jquery'), '20151215', true );

	wp_localize_script( 'claudia-globals', 'claudia_data', array('theme_path' => CLAUDIA_THEME_PATH_URI) );
	
	wp_enqueue_script( 'claudia-skip-link-focus-fix', CLAUDIA_THEME_PATH_URI . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'claudia_scripts' );

/**
 * includes.
 */
require CLAUDIA_THEME_PATH . '/inc/includes.php';
