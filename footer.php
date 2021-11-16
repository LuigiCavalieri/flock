<?php 
$is_sidebar_1_active = is_active_sidebar( 'footer_widgets_1' );
$is_sidebar_2_active = is_active_sidebar( 'footer_widgets_2' );
$is_sidebar_3_active = is_active_sidebar( 'footer_widgets_3' );
?>

</main>
    <footer id="site-footer" <?php if ( has_nav_menu( 'footer' ) ) { echo 'class="footer-has-nav"'; } ?>>
        <?php
        if ( $is_sidebar_1_active || $is_sidebar_2_active || $is_sidebar_3_active ): ?> 
            <div id="footer-widgets" class="entry-content">
                <?php if ( $is_sidebar_1_active ): ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar( 'footer_widgets_1' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $is_sidebar_2_active ): ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar( 'footer_widgets_2' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $is_sidebar_3_active ): ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar( 'footer_widgets_3' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div id="footer-nav-container">
            <?php get_template_part( 'template-parts/footer-navigation' ); ?>
            <p id="copyrights">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <span id="credits"><?php printf( esc_html__( 'Powered by %s.', 'flock' ), '<a href="https://wordpress.org/">WordPress</a>' ); ?></span>
            </p>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>