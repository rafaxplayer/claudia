<?php
/**
 * claudia Theme Customizer styles
 *
 * @package claudia
 */

if(! function_exists('claudia_custom_css')):

    function claudia_custom_css(){
    ?>
        <style id="claudia_custom_css">
           
            .header-text h2, .header-text h3{ 
                color:#<?php esc_attr(get_theme_mod('header_text_color','#fbf6e5')); ?>
            }

        </style>
    <?php }

endif;

add_action( 'wp_head', 'claudia_custom_css');