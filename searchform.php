<?php
/**
 * Template for displaying search forms in claudia theme
 *
 * @package claudia
*/
?>
	<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'claudia' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
	</form>