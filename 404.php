<?php
/**
 * Template file for 404 pages.
 * **************************** */

get_header();
?>  
    <h1 class="page-title"><?php esc_html_e( 'Sorry, Nothing Here.', 'flock' ); ?></h1>
    <div class="entry-content">
        <p><?php esc_html_e( "The page you were looking for doesn't exist anymore or has been moved. Maybe, you may try searching the site using the form in the upper right corner of the page!", 'flock' ); ?></p>
        <p><?php
            printf(
                esc_html__( 'Below there is a list of the %1$slatest published posts%2$s.', 'flock' ),
                '<strong>',
                '</strong>'
            );
            ?></p>
        <ul class="two-colums-list">
            <?php
            wp_get_archives(
                array(
                'type'  => 'postbypost',
                'limit' => 10
                )
            );
            ?>
        </ul>
    </div>
<?php
get_footer();
?>