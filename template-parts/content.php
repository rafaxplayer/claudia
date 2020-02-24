<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package claudia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list'); ?>>

	<header class="entry-header">
	
		<?php

		claudia_post_tags();
		
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
	

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
	
	
	<footer class="entry-footer">
		<?php claudia_post_categories(); ?>
	</footer><!-- .entry-footer -->
		
</article><!-- #post-<?php the_ID(); ?> -->
