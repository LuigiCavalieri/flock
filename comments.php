<?php
/**
 * Template for displaying comments.
 * ********************************* */

$commenter     = wp_get_current_commenter();
$comment_field = '<textarea id="comment-area" name="comment" class="comment-field" placeholder="' 
               . esc_attr__( 'Your Comment', 'flock' ) . '*" required></textarea>';
$name_field    = '<div id="comment-form-commenter-info"><input type="text" id="commenter-name-field" name="author" '
               . 'class="comment-field" placeholder="' . esc_attr__( 'Name', 'flock' ) . '*" value="'
               . esc_attr( $commenter['comment_author'] )
               . '" maxlength="50" required>';
$email_field   = '<input type="email" id="commenter-email-field" name="email" '
               . 'class="comment-field" placeholder="' . esc_attr__( 'Email Address', 'flock' ) . '*" value="' 
               . esc_attr( $commenter['comment_author_email'] ) 
               . '" maxlength="50" required>';
$url_field     = '<input type="url" id="commenter-url-field" name="url" '
               . 'class="comment-field" placeholder="' . esc_attr__( 'Website URL', 'flock' ) . '" value="'
               . esc_attr( $commenter['comment_author_url'] )
               . '" maxlength="150"></div>';
$submit_button = '<input type="submit" id="comment-post-button" name="submit" value="' . esc_attr__( 'Post', 'flock' ) . '">';

$comment_form_args = array(
    'title_reply'          => esc_html__( 'Leave a Comment', 'flock' ),
    'title_reply_before'   => '<h2 id="comment-form-title">',
    'title_reply_after'    => '</h2>',
    'logged_in_as'         => null,
    'cancel_reply_before'  => '',
    'cancel_reply_after'   => '',
    'class_form'           => 'self-clear',
    'comment_field'        => $comment_field,
    'submit_field'         => '%1$s %2$s',
    'submit_button'        => $submit_button,
    'fields'               => array(
        'author'  => $name_field,
        'email'   => $email_field,
        'url'     => $url_field
    ),
);
?>

<div id="comments">
    <?php if ( have_comments() ): ?>
        <h2 id="comments-title"><?php 
            comments_number( '', esc_html__( 'There is one comment:', 'flock' ),  esc_html__( 'There are % comments:', 'flock' ) );
        ?></h2>
        <ol id="comments-list">
            <?php
            wp_list_comments(
                array(
                    'style'        => 'ol',
                    'type'         => 'comment',
                    'callback'     => 'lc_flock_render_comment',
                    'end-callback' => 'lc_flock_render_comment_end'
                )
            );
            ?>
        </ol>
        <?php
        lc_flock_navigation_links( 'comments' );
        
        if (! comments_open() ):
        ?>
            <p id="comments-closed">&mdash; <small><?php esc_html_e( 'Comments are closed', 'flock' ); ?></small> &mdash;</p>
        <?php endif; ?>
    <?php endif; ?>
    <?php comment_form( $comment_form_args ); ?>
</div>