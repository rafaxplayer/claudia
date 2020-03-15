<?php
/**
 * include files
 *
 * @package claudia
 */

/**
 * Implement the Custom Header feature.
 */
require CLAUDIA_THEME_PATH . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require CLAUDIA_THEME_PATH . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require CLAUDIA_THEME_PATH . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require CLAUDIA_THEME_PATH . '/inc/customizer/customizer.php';

/**
 * Customizer css styles.
 */
require CLAUDIA_THEME_PATH . '/inc/customizer/customizer-styles.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require CLAUDIA_THEME_PATH . '/inc/jetpack.php';
}
