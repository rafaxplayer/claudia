<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package claudia
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'claudia_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function claudia_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'claudia' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';

	}
endif;

if ( ! function_exists( 'claudia_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function claudia_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'claudia' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; 

	}
endif;


if ( ! function_exists( 'claudia_post_tags' ) ) :

function claudia_post_tags(){

	if ( 'post' === get_post_type() ) {

		$tags_list = get_the_tag_list( '', ' - ');
		
		if ( $tags_list ) {
			
			echo '<span class="tags-links">' . wp_kses_post( $tags_list ) . '</span>';
		}
	}
	
}
endif;

if ( ! function_exists( 'claudia_post_categories' ) ) :
	
	function claudia_post_categories(){

		if ( 'post' === get_post_type() ) {
			
			$categories_list = get_the_category_list( '<span class="cats-line"> | </span>' );
			
			if ( $categories_list ) {
				
				echo '<span class="cat-links">' . wp_kses_post( $categories_list) . '</span>' ; 
			}
		}
	}
	endif;

if ( ! function_exists( 'claudia_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function claudia_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail <?php if( (get_theme_mod('show_header_on_posts') === 'true' && is_single()) || (get_theme_mod('show_header_on_pages') === 'true' && is_page())): echo 'thumb-padding'; endif;?>">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;
