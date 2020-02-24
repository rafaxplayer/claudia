<?php
/**
 * Template part for displaying single posts 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package claudia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>

	<?php  claudia_post_thumbnail(); ?>

	<header class="entry-header">
	
		<?php
		
		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				claudia_posted_on();
				claudia_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'claudia' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'claudia' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
		<?php 
			claudia_post_categories(); 
		?>
	</footer><!-- .entry-footer -->
		
</article><!-- #post-<?php the_ID(); ?> -->
