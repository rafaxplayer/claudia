<?php
/**
 * include files
 *
 * @package claudia
 */

/**
 * Implement the Custom Header feature.
 */
require THEME_PATH . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require THEME_PATH . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require THEME_PATH . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require THEME_PATH . '/inc/customizer/customizer.php';

/**
 * Customizer css styles.
 */
require THEME_PATH . '/inc/customizer/customizer-styles.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require THEME_PATH . '/inc/jetpack.php';
}
