<?php
$template_dir = get_template_directory();

include( $template_dir . '/includes/template-tags.php' );
include( $template_dir . '/includes/customizer.php' );

// This is a theme feature.
if (! isset( $content_width ) ) {
    $content_width = 800;
}

if (! function_exists( 'lc_flock_setup_theme' ) ) {
    /**
     * @since 1.0
     */
    function lc_flock_setup_theme() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array( 'comment-form', 'gallery', 'caption' ) );
        add_theme_support( 'custom-logo', array(
            'height'               => 160,
            'width'                => 200,
            'flex-height'          => false,
            'flex-width'           => false,
            'header-text'          => array( 'site-title', 'site-description' ),
            'unlink-homepage-logo' => false 
        ));

        add_editor_style( array( lc_flock_get_theme_fonts_url(), 'css/gutenberg-style.css' ) );

        register_nav_menus(
            array(
                'primary' => __( 'Primary menu', 'flock' ),
                'footer'  => __( 'Secondary menu', 'flock' ),
            )
        );
    }
}
add_action( 'after_setup_theme', 'lc_flock_setup_theme' );

/**
 * @since 1.0
 */
function lc_flock_widgets_init() {
    $name        = __( 'Footer Widget Area %d', 'flock' );
    $description = __( 'Widgets in this area will be displayed in the footer.', 'flock' );

    for ( $i = 1; $i < 4; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( $name, $i ),
            'id'            => "footer_widgets_{$i}",
            'description'   => $description,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action( 'widgets_init', 'lc_flock_widgets_init' );

/**
 * @since 1.0
 */
function lc_flock_enqueue_styles_scripts() {
    $theme_url = get_template_directory_uri();

    wp_enqueue_style( 'lc-flock-google-fonts', lc_flock_get_theme_fonts_url(), array(), null ); 
    wp_enqueue_style( 'lc-flock-style', "{$theme_url}/style.css" );

    // Enqueues global script in the footer.
    wp_enqueue_script( 'lc-flock-global', "{$theme_url}/js/global.js", array(), wp_get_theme()->get( 'Version' ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lc_flock_enqueue_styles_scripts' );

/**
 * @since 1.0
 */
function lc_flock_archive_title( $title ) {
    if ( is_author() ) {
        $title = sprintf(
            esc_html__( 'All posts by %s', 'flock' ),
            '<span>' . get_the_author() . '</span>'
        );
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'lc_flock_archive_title' );


// ----- Ultility Functions -----

if (! function_exists( 'lc_flock_get_theme_fonts_url' ) ) {
    /**
     * Returns the URL of the Google Fonts used by the theme.
     * 
     * @since 1.0
     * @return string
     */
    function lc_flock_get_theme_fonts_url() {
        return 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700%7CUbuntu:400,500,700%7CUbuntu+Mono:400,700display=swap';
    }
}


// ----- Callback Functions -----

if (! function_exists( 'lc_flock_render_comment' ) ) {
    /**
     * Displays a comment.
     * Callback of wp_list_comments() called in comments.php
     * 
     * @since 1.0
     * @param object $comment
     * @param array $args
     * @param int $depth
     */
    function lc_flock_render_comment( $comment, $args, $depth ) {
        $avatar_size        = 50;
        $comment_id         = (int) get_comment_ID();
        $comment_author     = esc_html( get_comment_author( $comment ) );
        $comment_author_url = esc_url( get_comment_author_url( $comment ) );
        $avatar_alt_text    = sprintf( esc_attr__( "%s's avatar.", 'flock' ), $comment_author );
        $edit_link_url      = get_edit_comment_link( $comment );
        $edit_link          = '';

        if ( $edit_link_url ) {
            $edit_link = ' &mdash; <a href="' . esc_url( $edit_link_url ) 
                       . '" class="edit-comment-link">' . esc_html__( 'Edit Comment', 'flock' ) . '</a>';
        }

        echo '<li id="comment-', $comment_id, '" ';

        comment_class();

        echo '><article><footer class="comment-info self-clear"><a href="',
             esc_url( get_comment_link() ), '" class="comment-permalink" title="', esc_attr__( 'Comment permalink', 'flock' ), 
             '">#', $comment_id, '</a>', get_avatar( $comment, $avatar_size, '', $avatar_alt_text );
        
        if ( $comment_author_url && ( $comment_author_url != home_url() ) ) {
            echo '<a href="', $comment_author_url, 
                 '" class="comment-author-link" rel="external nofollow ugc">', $comment_author, '</a>';
        }
        else {
            echo '<span class="comment-author">', $comment_author, '</span>';
        }

        if ( '0' == $comment->comment_approved ) {
            echo '<p class="moderation-notice"><span class="moderation-notice-text">', esc_html__( 'Your comment is awaiting moderation.', 'flock' ), '</span>', $edit_link, '</p>';
        }
        else {
            echo '<div class="comment-date"><time datetime="', esc_attr( get_comment_date( DATE_W3C, $comment ) ), 
                 '">', esc_html( get_comment_date( '', $comment ) ), '</time>', $edit_link, '</div>';
        }
        
        echo '</footer><div class="entry-content">';

        comment_text();

        echo '</div>';

        $args['depth']      = $depth;
        $args['reply_text'] = esc_html__( 'Reply &darr;', 'flock' );
        
        $reply_link = get_comment_reply_link( $args, $comment, null );

        if ( $reply_link ) {
            echo '<div class="comment-reply"><small>', $reply_link, '</small></div>';
        }

        echo '</article>';
    }
}

if (! function_exists( 'lc_flock_render_comment_end' ) ) {
    /**
     * Displays the closing markup of a comment.
     * Callback of wp_list_comments() called in comments.php
     * 
     * @since 1.0
     */
    function lc_flock_render_comment_end() {
        echo "</li>\n";
    }
}
?>