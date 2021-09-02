<?php
/**
 * Template for displaying a message that posts cannot be found.
 * ************************************************************* */

$is_search = is_search();

if ( $is_search ):
?>
    <header class="results-header">
        <?php lc_flock_search_results_title(); ?>
    </header>
<?php else: ?>
    <h2 class="page-title"><?php esc_html_e( 'Nothing Here', 'flock' ); ?></h2>
<?php endif; ?>

<div class="entry-content center-text">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ): ?>
    <p><?php
        printf(
            esc_html__( 'Ready to publish your first post? %1$sGet started here!%2$s', 'flock' ),
            '<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">',
            '</a>'
        );
    ?></p>
        
    <?php elseif ( $is_search ): ?>
        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some other keyword.', 'flock' ); ?></p>
    <?php else: ?>
        <p class="shrink-text"><?php esc_html_e( 'It seems we cannot find what you are looking for.', 'flock' ); ?></p>
        <p class="shrink-text"><?php esc_html_e( 'Perhaps you may try searching the site using the form in the upper right corner of the page.', 'flock' ); ?></p>
    <?php endif; ?>
</div>