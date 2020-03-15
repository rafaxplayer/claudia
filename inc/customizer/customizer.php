<?php
/**
 * claudia Theme Customizer
 *
 * @package claudia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function claudia_customize_register( $wp_customize ) {

	global $claudia_yes_no_choices;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default 	= '#fbf6e5';
	$wp_customize->get_control( 'header_textcolor' )->label 	= __('Site title & Description text color','claudia');
	$wp_customize->get_section( 'header_image' )->panel 		= 'claudia_theme_panel';
	$wp_customize->get_section( 'colors' )->panel 				= 'claudia_theme_panel';

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'claudia_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'claudia_customize_partial_blogdescription',
		) );

		$wp_customize->selective_refresh->add_partial( 'header_title', array(
			'selector'        => '.header-text h2',
			'render_callback' => 'claudia_customize_partial_header_title',
		) );
		$wp_customize->selective_refresh->add_partial( 'header_subtitle', array(
			'selector'        => '.header-text h3',
			'render_callback' => 'claudia_customize_partial_header_subtitle',
		) );

		
	}

	$wp_customize->add_panel('claudia_theme_panel', array(
		'title'     => __('Theme Options','claudia'),
		'priority'       => 10,
		
	));

	/* custom colors*/
	$wp_customize->add_setting('header_text_color',array(
		'default' => '#fbf6e5',
		'transport'=> 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
		
	));
			
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'header_text_color',array(
			'label' => __('Color header text','claudia'),
			'description' => __('Set header texts colors, requires having set a header image or video','claudia'),		
			'section' => 'colors',
			'settings' => 'header_text_color'
		))
	);	


	/* Header Settings */
	$wp_customize->add_section( 'header_section' , array(
		'title'     => __('Header Options','claudia'),
		'panel'		=> 'claudia_theme_panel'
	));

	// header title and subtitle
	$wp_customize->add_setting('header_title',array(
		'default' => '',
		'transport'=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('header_title',array(
		'label'	=> __('Header title','claudia'),
		'description' => __('Set header title, requires having set a header image or video','claudia'),
		'section'	=> 'header_section'
	));	

	$wp_customize->add_setting('header_subtitle',array(
		'default' => '',
		'transport'=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('header_subtitle',array(
		'label'	=> __('Header subttile','claudia'),
		'description' => __('Set header subtitle, requires having set a header image or video','claudia'),
		'section'	=> 'header_section'
	));
	// show or hide header
	$wp_customize->add_setting( 'show_header_on_pages', array(
        'default'        => 'default',
        'sanitize_callback' => 'claudia_sanitize_yes_no',
    ));
    $wp_customize->add_control( 'show_header_on_pages', array(
        'label'   => __('Show Header on Pages', 'claudia'),
        'section' => 'header_section',
        'type'    => 'select',
		'choices' => $claudia_yes_no_choices,
	));	
	
	$wp_customize->add_setting( 'show_header_on_posts', array(
        'default'        => 'default',
        'sanitize_callback' => 'claudia_sanitize_yes_no',
    ));
    $wp_customize->add_control( 'show_header_on_posts', array(
        'label'   => __('Show Header on Posts', 'claudia'),
        'section' => 'header_section',
        'type'    => 'select',
		'choices' => $claudia_yes_no_choices,
	));
	
	$wp_customize->add_setting( 'show_header_on_categories', array(
        'default'        => 'default',
        'sanitize_callback' => 'claudia_sanitize_yes_no',
    ));
    $wp_customize->add_control( 'show_header_on_categories', array(
        'label'   => __('Show Header on Categories page', 'claudia'),
        'section' => 'header_section',
        'type'    => 'select',
		'choices' => $claudia_yes_no_choices,
	));
	
	/* Blog settings */
	$wp_customize->add_section( 'blog_settings' , array(
		'title'     => __('Blog options','claudia'),
		'panel'		=> 'claudia_theme_panel'
	));

	$wp_customize->add_setting('blog_title',array(
		'default' => __('Blog','claudia'),
		'transport'=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('blog_title',array(
		'label'	=> __('Blog title','claudia'),
		'description' => __('Set title for blog page','claudia'),
		'section'	=> 'blog_settings'
	));	

	// show or hide slectors
	$wp_customize->add_setting( 'show_categories_selector' , array(
		'default'           => 'true',
		'sanitize_callback' => 'claudia_sanitize_yes_no',
		
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_categories_selector', array(
		'label'   => __('Show Categories selector', 'claudia'),
        'section' => 'blog_settings',
        'type'    => 'select',
		'choices' => $claudia_yes_no_choices,
	)));

	$wp_customize->add_setting( 'show_tags_selector' , array(
		'default'           => 'true',
		'sanitize_callback' => 'claudia_sanitize_yes_no',
		
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_tags_selector', array(
		'label'   => __('Show tags selector', 'claudia'),
        'section' => 'blog_settings',
        'type'    => 'select',
		'choices' => $claudia_yes_no_choices,
	)));
	
	/* Social links */
	$wp_customize->add_section( 'social_network' , array(
		'title'     => __('Social Network','claudia'),
		'panel'		=> 'claudia_theme_panel'
	));

	// facebook
	$wp_customize->add_setting( 'social_facebook' , array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_facebook_control', array(
		'label'      => __( 'Url for facebook link ', 'claudia' ),
		'section'    => 'social_network',
		'settings'   => 'social_facebook',
	)));

	// twitter
	$wp_customize->add_setting( 'social_twitter' , array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_twitter_control', array(
		'label'      => __( 'Url for twitter link ', 'claudia' ),
		'section'    => 'social_network',
		'settings'   => 'social_twitter',
	)));

	// instagram
	$wp_customize->add_setting( 'social_instagram' , array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_instagram_control', array(
		'label'      => __( 'Url for instagram link', 'claudia' ),
		'section'    => 'social_network',
		'settings'   => 'social_instagram',
	)));



	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_youtube_control', array(
		'label'      => __( 'Url for youtube link', 'claudia' ),
		'section'    => 'social_network',
		'settings'   => 'social_youtube',
	)));

	// linkedin
	$wp_customize->add_setting( 'social_linkedin' , array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_linkedin_control', array(
		'label'      => __( 'Url for linkedin link', 'claudia' ),
		'section'    => 'social_network',
		'settings'   => 'social_linkedin',
	)));

	// pinterest
	$wp_customize->add_setting( 'social_pinterest' , array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_pinterest_control', array(
		'label'      => __( 'Url for pinterest link', 'claudia' ),
		'section'    => 'social_network',
		'settings'   => 'social_pinterest',
	)));

}
add_action( 'customize_register', 'claudia_customize_register' );

$claudia_yes_no_choices = array( 'default' => __('Select an Option', 'claudia'), 'true' => __('Yes', 'claudia'), 'false' => __('No', 'claudia') );

function claudia_sanitize_yes_no( $value ) {
	global $claudia_yes_no_choices;
    if ( ! array_key_exists( $value, $claudia_yes_no_choices ) ){
        $value = 'default';
	}
    return $value;	
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function claudia_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function claudia_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site header title for the selective refresh partial.
 *
 * @return void
 */
function claudia_customize_partial_header_title() {
	return esc_html(get_theme_mod('header_title'));
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function claudia_customize_partial_header_subtitle() {
	return esc_html(get_theme_mod('header_subtitle'));
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function claudia_customize_preview_js() {
	wp_enqueue_script( 'claudia-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'claudia_customize_preview_js' );
