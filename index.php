<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package claudia
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

?>
<div id="primary" class="content-area">

	<main id="main" class="site-main posts-container <?php echo ($wp_query->post_count % 2) ? 'odd':'even';?>">
	<div class="header_list">
		<?php if(get_theme_mod('show_categories_selector','true') === 'true'):?>
		<form  action="<?php esc_url( home_url( '/' ) ); ?>" method="get">
			<?php
			$args_cats = array(
				'show_option_all' => __( 'Select category' ,'claudia'),
				'orderby'          => 'name',
				'id'			   =>'sel_cats',
				'echo'             => 0
			);

			$args_html = array(
				'select' => array(
					'name' => array(),
					'id' => array(),
					'class' => array(),
					'onchange' => array(),
				),
				'option' => array(
					'class' => array(),
					'value' => array(),
				),
			);

			$select = wp_dropdown_categories($args_cats );
			$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
			echo wp_kses($select, $args_html); ?>
			<noscript>
				<input type="submit" value="View" />
			</noscript>
		</form>
		<?php endif; ?>
		<h2 class="list_title">
		<?php
		if(is_archive()):
			echo esc_html(get_the_archive_title());
		elseif ( is_author() ) :
			/* Queue the first post, that way we know
				* what author we're dealing with (if that is the case).
			*/
			the_post();
			/* translators: %s: Author name. */
			printf( esc_html__( 'Author: %s', 'claudia' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . esc_html(get_the_author()) . '</a></span>' );
			/* Since we called the_post() above, we need to
				* rewind the loop back to the beginning that way
				* we can run the loop properly, in full.
				*/
			rewind_posts();
		elseif(is_search()):
			/* translators: %s: Search for. */
			printf(esc_html__('Search for : %s','claudia'),esc_html(get_search_query()));
	
		elseif(is_home()):
			$claudia_blog_title = get_theme_mod('blog_title') ? get_theme_mod('blog_title') : __('Blog','claudia');
			echo esc_html($claudia_blog_title);
		
		elseif ( is_day() ) :
			/* translators: %s: Posts Day. */
			printf( esc_html__( 'Day: %s', 'claudia' ), '<span>' . esc_html(get_the_date()) . '</span>' );

		elseif ( is_month() ) :
			/* translators: %s: Posts Month. */
			printf( esc_html__( 'Month: %s', 'claudia' ), '<span>' . esc_html(get_the_date( 'F Y' )) . '</span>' );

		elseif ( is_year() ) :
			/* translators: %s: Posts Year. */
			printf( esc_html__( 'Year: %s', 'claudia' ), '<span>' . esc_html(get_the_date( 'Y' )) . '</span>' );

		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			esc_html_e( 'Asides', 'claudia' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			esc_html_e( 'Images', 'claudia');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			esc_html_e( 'Videos', 'claudia' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			esc_html_e( 'Quotes', 'claudia' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			esc_html_e( 'Links', 'claudia' );

		else :
			esc_html_e( 'Archives', 'claudia' );

		endif;
		?>
		</h2>
		<?php if( get_theme_mod('show_tags_selector','true') === 'true'):?>
		<form  action="<?php esc_url( home_url( '/' ) ); ?>" method="get">
			<?php
			$args_tags = array(
				'show_option_all' => __(  'Select tags' ,'claudia'),
				'orderby'          => 'name',
				'id'			   =>'sel_tags',
				'name'			   => 'tag',
				'taxonomy'		   => 'post_tag',
				'echo'             => 0,
				'value_field'	   => 'slug',
			);

			$select = wp_dropdown_categories($args_tags);
			$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
			echo wp_kses($select, $args_html);?>
		
		</form>
		<?php endif; ?>
		</div>
		<?php if ( have_posts() ) :
			
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
		<?php the_posts_pagination();?>
	</div><!-- #primary -->

<?php

get_footer();
