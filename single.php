<?php
/**
 * The template for displaying single posts.
 * ***************************************** */

get_header();

if ( have_posts() ) {
    the_post();

    get_template_part( 'template-parts/content', 'single' );

    the_post_navigation();

    if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) {
        comments_template();
    }
}

get_footer();
?>