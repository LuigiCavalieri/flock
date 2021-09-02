<?php
/**
 * Template part for displaying posts.
 * ************************************** */

$is_singular          = is_singular();
$is_archive_or_search = ( $is_singular ? false : ( is_archive() || is_search() ) );
$the_permalink        = esc_url( get_the_permalink() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( !$is_singular && is_sticky() ): ?>
        <aside class="sticky-post-tag"><small><?php esc_html_e( 'Featured', 'flock' ); ?></small></aside>
    <?php endif; ?>
    <header class="entry-header">
        <?php
        if ( $is_singular ) {
            the_title( '<h1 id="post-title">', '</h1>' );
            lc_flock_post_thumbnail();
        }
        else {
            if (! $is_archive_or_search ) {
                lc_flock_post_thumbnail();
            }
            
            the_title( '<h2 class="post-title"><a href="' . $the_permalink . '" rel="bookmark">', '</a></h2>' );

            if ( $is_archive_or_search ) {
                lc_flock_post_metadata( 'header' );
            }
        }
        ?>
    </header>
    <?php if ( $is_singular ): ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    <?php else: ?>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
        <?php if (! $is_archive_or_search ): ?>
            <footer class="entry-footer">
                <a href="<?php echo $the_permalink; ?>" class="read-on"><?php esc_html_e( 'Read on', 'flock' ); ?></a>
            </footer>
        <?php endif; ?>
    <?php endif; ?>
</article>