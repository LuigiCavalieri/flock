<?php

if (! function_exists( 'lc_flock_post_thumbnail' ) ) {
    /**
     * Displays the post thumbnail.
     * 
     * @since 1.0
     * @return bool
     */
    function lc_flock_post_thumbnail() {
        if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
            return false;
        }

        if ( is_singular() ):
        ?>
            <figure id="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </figure>
        <?php else: ?>
            <figure class="post-thumbnail">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?></a>
            </figure>
        <?php endif;

        return true;
    }
}

if (! function_exists( 'lc_flock_navigation_links' ) ) {
    /**
     * Print the next and previous posts or comments navigation.
     *
     * @since 1.0
     * @param string $context
     * @return bool
     */
    function lc_flock_navigation_links( $context ) {
        $prev_string = '<svg class="svg-icon" width="24" height="24" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20 13v-2H8l4-4-1-2-7 7 7 7 1-2-4-4z" fill="currentColor"></path></svg> <span class="nav-prev-text">%s</span>';
        $next_string = '<span class="nav-next-text">%s</span> <svg class="svg-icon" width="24" height="24" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="m4 13v-2h12l-4-4 1-2 7 7-7 7-1-2 4-4z" fill="currentColor"></path></svg>';

        switch ( $context ) {
            case 'posts':
                the_posts_pagination(
                    array(
                        'prev_text' => sprintf( $prev_string, esc_html__( 'Newer Posts', 'flock' ) ),
                        'next_text' => sprintf( $next_string, esc_html__( 'Older Posts', 'flock' ) )
                    )
                );
                break;

            case 'comments':
                the_comments_navigation(
                    array(
                        'prev_text' => sprintf( $prev_string, esc_html__( 'Older Comments', 'flock' ) ),
                        'next_text' => sprintf( $next_string, esc_html__( 'Newer Comments', 'flock' ) )
                    )
                );
                break;

            default:
                return false;
        }
        
        return true;
    }
}

if (! function_exists( 'lc_flock_post_metadata' ) ) {
    /**
     * Prints meta information about the current post.
     *
     * @since 1.0
     * 
     * @param string $context Valid values: header, footer.
     * @return bool
     */
    function lc_flock_post_metadata( $context ) {
        if ( ( $context !== 'header' ) && ( get_post_type() !== 'post' ) ) {
            return false;
        }

        switch ( $context ) {
            case 'header':
                $author_link = '';
                $time_string = '<time class="post-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) 
                             . '">' . esc_html( get_the_date() ) . '</time>';
                
                if (! is_author() ) {
                    $author_link = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) 
                             . '" rel="author">' . esc_html( get_the_author() ) . '</a> <span class="meta-separator">·</span> ';
                }

                echo '<div class="post-meta">', $author_link, $time_string, 
                     ' <span class="meta-separator">·</span> <a href="', esc_url( get_the_permalink() ), '#comments">';

                comments_number( __( 'No Comments', 'flock' ), __( '1 Comment', 'flock' ), __( '% Comments', 'flock' ) );

                echo '</a></div>';
                break;

            case 'footer':
                $categories = get_the_category();

                if ( $categories ) {
                    if ( 
                        ( 1 === count( $categories ) ) && 
                        ( ( 1 == $categories[0]->cat_ID ) || ( 1 == $categories[0]->category_parent ) )
                    ) {
                        return lc_flock_post_tags_list();
                    }

                    $categories_list = get_the_category_list( ', ' );
                    
                    if ( $categories_list ) {
                        echo '<p class="post-meta">';

                        printf( __( 'Posted in %s', 'flock' ), $categories_list );
                        
                        echo '</p>';
                    }
                }
                elseif ( has_tag() ) {
                    lc_flock_post_tags_list();
                }
                break;

            default:
                return false;
        }

        return true;
    }
}

if (! function_exists( 'lc_flock_post_tags_list' ) ) {
    /**
     * Prints the list of tags for the current post.
     *
     * @since 1.0
     * @return bool
     */
    function lc_flock_post_tags_list() {
        $tags_list = get_the_tag_list( '', ', ' );

        if ( $tags_list ) {
            echo '<p class="post-meta">';

            printf( __( 'Tagged as %s', 'flock' ), $tags_list );
            
            echo '</p>';

            return true;
        }

        return false;
    }
}

if (! function_exists( 'lc_flock_archive_posts_count' ) ) {
    /**
     * Prints a one-liner summary of the number of posts contained
     * in the current archive page.
     *
     * @since 1.0
     */
    function lc_flock_archive_posts_count() {
        global $wp_query;

        $posts_count = (int) $wp_query->found_posts;

        echo '<p id="archive-posts-count">';

        if ( is_author() ) {
            printf( esc_html__( '%s has published %d posts to date.', 'flock' ), get_the_author(), $posts_count );
        }
        else {
            $taxonomy_labels = get_taxonomy_labels( get_taxonomy( get_queried_object()->taxonomy ) );
            $taxonomy_name   = strtolower( $taxonomy_labels->singular_name );

            printf( esc_html__( '%d posts have been filed under this %s.', 'flock' ), $posts_count, $taxonomy_name );
        }

        echo '</p>';
    }
}

if (! function_exists( 'lc_flock_search_results_title' ) ) {
    /**
     * Prints the title of search results pages.
     *
     * @since 1.0
     */
    function lc_flock_search_results_title() {
        echo '<h1 id="search-title" class="page-title results-title">';

        printf(
            esc_html__( 'Results for %s', 'flock' ),
            '<span id="search-term">"' . esc_html( get_search_query() ) . '"</span>'
        );
        
        echo '</h1>';
    }
}

if (! function_exists( 'lc_flock_page_nav_links' ) ) {
    /**
     * Prints the navigation menu for paginated posts and pages.
     *
     * @since 1.0
     */
    function lc_flock_page_nav_links() {
        wp_link_pages(
            array(
                'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'flock' ) . '">',
                'after'    => '</nav>',
                'pagelink' => esc_html__( 'Page %', 'flock' ),
            )
        );
    }
}
?>