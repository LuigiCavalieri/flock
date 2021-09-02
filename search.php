<?php
/**
 * Template for displaying search results.
 * *************************************** */

get_header();

if ( have_posts() ):
?>
    <header id="search-header" class="results-header">
        <?php lc_flock_search_results_title(); ?>
        <p id="search-result-count" class="results-description">
            <?php
            printf(
                esc_html(
                    _n(
                        'We found %d result for your search.',
                        'We found %d results for your search.',
                        (int) $wp_query->found_posts,
                        'flock'
                    )
                ),
                (int) $wp_query->found_posts
            );
            ?>
        </p>
    </header>

<?php 
    while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/content' );
    }
    
    lc_flock_navigation_links( 'posts' );
else: 
    get_template_part( 'template-parts/content', 'none' );
endif;

get_footer();
?>