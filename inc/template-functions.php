<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package claudia
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function claudia_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'claudia_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function claudia_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'claudia_pingback_header' );

if( !function_exists('claudia_social_links') ):

    function claudia_social_links(){
        ?>
            <div class="social-links">
			
                <?php 
                $facebook = get_theme_mod('social_facebook');
                $twitter = get_theme_mod('social_twitter');
                $instagram = get_theme_mod('social_instagram');
                $linkedin = get_theme_mod('social_linkedin');
				$pinterest = get_theme_mod('social_pinterest');
				
                if(!empty($facebook)):?>
                    <a href="<?php echo esc_url($facebook); ?>"><?php _e('Facebook','claudia'); ?></a>
                <?php endif;
                if(!empty($twitter)):?>
                    <a href="<?php echo esc_url($twitter); ?>"><?php _e('Twitter','claudia'); ?></a>
                <?php endif;
                if(!empty($instagram)):?>
                    <a href="<?php echo esc_url($instagram); ?>"><?php _e('Instagam','claudia'); ?></a>
                <?php endif;
                if(!empty($linkedin)):?>
                    <a href="<?php echo esc_url($linkedin); ?>"><?php _e('Linkedin','claudia'); ?></a>
                <?php endif;
                if(!empty($pinterest)):?>
                <a href="<?php echo esc_url($pinterest); ?>"><?php _e('Pinterest','claudia'); ?></a>
                <?php endif;?>
				
            </div>
        <?php

    }

endif;

add_action('claudia_social_network','claudia_social_links');

if( !function_exists('claudia_posts_navigation') ):

function claudia_posts_navigation(){ 

	if( !is_singular() ){
		return;
	}
      	
	?>
	<div class="posts-navigation">
		<div class="nav-links">

			<?php $prevPost = get_previous_post();
				if($prevPost) { ?>
					<div class="nav-previous" style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url($prevPost->ID,'large')); ?>)">
						<h4><a href="<?php echo esc_html($prevPost->guid); ?>"><?php echo esc_html($prevPost->post_title); ?></a></h4>
					</div>
				<?php }// end if
					
				$nextPost = get_next_post();
				if($nextPost) {?>
					<div class="nav-next" style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url($nextPost->ID,'large')); ?>)">
						<h4><a href="<?php echo esc_html($nextPost->guid); ?>"><span><?php echo esc_html($nextPost->post_title); ?></span></a></h4>
					</div>
					
				<?php } // end if 
			?> 
		</div>
	</div>
<?php 
}
endif;

if( !function_exists('claudia_comment') ):
	function claudia_comment($comment, $args, $depth) {?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-header">
				<?php echo get_avatar($comment,$size='48',$default= esc_url(THEME_PATH.'/images/avatar.png') ); ?>
				<div class="comment-info-wrap">
					<div class="author">
						<?php printf('<cite class="fn">%1$s</cite> <span class="says">%2$s</span>', get_comment_author_link(),esc_html__('says:','claudia')) ?>
					</div>
					<div class="comment-meta">
						<a class="comment-date" href="<?php echo esc_html(htmlspecialchars( get_comment_link( $comment->comment_ID ) )) ?>">
						<?php 
						/* translators: %1$s: comment date, %2$s: comment time. */
						printf(esc_html__('%1$s at %2$s','claudia'), esc_html(get_comment_date()),  esc_html(get_comment_time())) ?>
						</a>
						<?php edit_comment_link() ?>
					</div>
				</div>
				
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html__e('Your comment is awaiting moderation.','claudia') ?></em>
				<br />
			<?php endif; ?>
	
			<?php comment_text() ?>
	
			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	<?php
	}
endif;