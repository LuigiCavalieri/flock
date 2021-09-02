<?php
/**
 * Template for displaying posts.
 * ************************************* */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        edit_post_link( __( 'Edit Post', 'flock' ) );
        the_title( '<h1 id="post-title">', '</h1>' );
        lc_flock_post_metadata( 'header' );
        lc_flock_post_thumbnail();
        ?>
    </header>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <footer class="post-footer">
        <?php
        lc_flock_post_metadata( 'footer' );
        lc_flock_page_nav_links();
        ?>
    </footer>
</article>