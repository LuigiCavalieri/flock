<?php
/**
 * Displays header site branding.
 * ********************************* */

$home_url    = esc_url( home_url( '/' ) );
$blog_name   = get_bloginfo( 'name', 'display' );
$description = get_bloginfo( 'description', 'display' );
$has_logo    = has_custom_logo();
?>

<div id="site-branding">
    <?php if ( $has_logo ): ?>
        <div id="site-logo"><?php
            $custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
            $logo_width  = floor( $custom_logo[1]/2 );

            printf( '<a href="%1$s" class="custom-logo-link" rel="home"><img src="%2$s" class="custom-logo" width="%3$s" alt="%4$s" /></a>', $home_url, esc_url( $custom_logo[0] ), esc_attr( $logo_width ), esc_attr( $blog_name ) );
        ?></div>
    <?php endif; ?>

    <?php if ( $blog_name && ( get_theme_mod( 'header_text' ) !== 0 ) ): ?>
        <div id="site-title-container" <?php if (! $has_logo ) { echo 'class="resp-center-text"'; } ?>>
            <?php if ( is_front_page() && is_home() ): ?>
                <h1 id="site-title"><a href="<?php echo $home_url; ?>" rel="home"><?php echo $blog_name; ?></a></h1>
            <?php else: ?>
                <p id="site-title"><a href="<?php echo $home_url; ?>" rel="home"><?php echo $blog_name; ?></a></p>
            <?php endif; ?>

            <?php if ( $description ): ?>
                <p id="site-description"><a href="<?php echo $home_url; ?>" rel="home"><?php echo $description; ?></a></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>