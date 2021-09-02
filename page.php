<?php
/**
 * Template file for displaying pages.
 * *********************************** */

get_header();

if ( have_posts() ):
    the_post();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <?php lc_flock_page_nav_links(); ?>
    </article>
<?php
    if ( comments_open() || get_comments_number() ):
        comments_template();
    endif;
endif;

get_footer();
?>