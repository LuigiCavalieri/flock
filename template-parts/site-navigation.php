<?php
/**
 * Displays the site navigation.
 * ******************************** */
?>
<nav id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'flock' ); ?>">
    <button id="mobile-nav-toggle">
        <svg viewBox="0 0 70 50" width="25" height="25">
            <rect width="70" height="10"></rect>
            <rect y="20" width="70" height="10"></rect>
            <rect y="40" width="70" height="10"></rect>
        </svg>
    </button>
    <?php
    wp_nav_menu(
        array(
            'theme_location'  => 'primary',
            'menu_class'      => 'menu-items',
            'container_id'    => 'site-nav-container',
            'container_class' => 'hide-resp-nav',
            'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
            'fallback_cb'     => false
        )
    );
    ?>
</nav>