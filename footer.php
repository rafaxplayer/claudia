<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package claudia
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
	
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'claudia' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'claudia' ),__('WordPress','claudia') );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'claudia' ), __('claudia','claudia'), '<a href="https://juanrafaelsimarro.com/">'. __ ( ' JRS ' , 'claudia' ) .'</a>' );
				?>
		</div><!-- .site-info -->
		<a href="#" id="upp-button">
			<?php echo __('UP','claudia'); ?>
		</a><!-- .upp-button -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
