<?php
/**
 * Template part for displaying header image 
 *
 * 
 * @package claudia
 */
?>
<div class="header-image-wrap">
	<?php the_custom_header_markup();?>
	<div class="header-text">
		<h3><?php echo esc_html(get_theme_mod('header_subtitle',__('A theme for WordPress','claudia')));?></h3>
		<h2><?php echo esc_html(get_theme_mod('header_title',__('claudia','claudia')));?></h2>
	</div>
</div>