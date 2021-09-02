<?php
/**
 * @since 1.0
 */
function lc_flock_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'colors', array(
        'title'      => __( 'Color Settings', 'flock' ),
        'priority'   => 1,
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_setting( 'html_bg_color', array(
        'default'           => '#ddeefd',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'html_bg_color', array(
        'label'    => __( 'Background Color', 'flock' ),
        'section'  => 'colors',
        'priority' => 1,
        'settings' => 'html_bg_color',
    )));
    $wp_customize->add_setting( 'base_color', array(
        'default'           => '#0078c3',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'base_color', array(
        'label'    => __( 'Base Color', 'flock' ),
        'section'  => 'colors',
        'priority' => 1,
        'settings' => 'base_color',
    )));
    $wp_customize->add_setting( 'alternate_color', array(
        'default'           => '#e69b00',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alternate_color', array(
        'label'    => __( 'Alternate Color', 'flock' ),
        'section'  => 'colors',
        'priority' => 1,
        'settings' => 'alternate_color',
    )));
}
add_action( 'customize_register', 'lc_flock_customize_register' );

/**
 * @since 1.0
 */
function lc_flock_customizer_styles() {
?>
<style type="text/css" id="lc-flock-customizer-styles">
:root {
    --customizer--html-bg-color: <?php echo esc_attr( get_theme_mod( 'html_bg_color', '#ddeefd' ) ); ?>;
    --customizer--base-color: <?php echo esc_attr( get_theme_mod( 'base_color', '#0078c3' ) ); ?>;
    --customizer--alternate-color: <?php echo esc_attr( get_theme_mod( 'alternate_color', '#e69b00' ) ); ?>;
}
</style>
<?php
}
add_action( 'wp_head', 'lc_flock_customizer_styles' );
?>