<?php
/**
 * Main template file.
 * ******************* */

get_header();

if ( have_posts() ) {
    $is_posts_list = !is_singular();

    if ( $is_posts_list ) {
        echo '<div id="posts">';
    }

    while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/content' );
    }

    if ( $is_posts_list ) {
        echo '</div>';
    }

    lc_flock_navigation_links( 'posts' );
}
else {
    get_template_part( 'template-parts/content', 'none' );
}

get_footer();
?>