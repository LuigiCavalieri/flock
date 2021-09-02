<?php
/**
 * Template for displaying archive pages.
 * ************************************** */

get_header();

if ( have_posts() ):
    $description = get_the_archive_description();
?>
    <header id="archive-header" class="results-header">
        <?php 
        the_archive_title( '<h1 id="archive-title" class="page-title results-title">', '</h1>' );
        
        if ( $description ):
        ?>
            <div id="archive-description" class="results-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
        <?php 
        endif;

        lc_flock_archive_posts_count();
        ?>
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