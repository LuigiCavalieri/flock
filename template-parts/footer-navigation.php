<?php
/**
 * Displays the footer navigation.
 * ********************************** */
?>
    <nav id="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer menu', 'flock' ); ?>">
        <?php
        if ( has_nav_menu( 'footer' ) ) {
            wp_nav_menu(
                array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'menu-items',
                    'container'      => '',
                    'items_wrap'     => '<ul id="footer-menu-list" class="%2$s">%3$s</ul>',
                    'fallback_cb'    => false
                )
            );
        }
        ?>
        <div id="scroll-top-container"><a href="#" id="scroll-top"><?php _e( 'UP', 'flock' ); ?></a></div>
    </nav>