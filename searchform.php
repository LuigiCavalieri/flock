<?php
/**
 * This template file is used any time get_search_form() is called.
 * **************************************************************** */

$unique_id = wp_unique_id( 'searchform-' );
?>

<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="<?php echo $unique_id; ?>" class="searchform" role="search">
    <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'flock' ); ?></label>
    <input type="text" id="s" name="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'flock' ); ?>" value="<?php echo get_search_query(); ?>" class="searchform-field">
    <button type="submit" class="searchform-btn"><svg width="14" height="14" viewBox="0 0 14 14"><title><?php esc_html_e( 'Search', 'flock' ) ?></title><path d="m4.8495 7.8226c0.82666 0 1.5262-0.29146 2.0985-0.87438 0.57232-0.58292 0.86378-1.2877 0.87438-2.1144 0.010599-0.82666-0.28086-1.5262-0.87438-2.0985-0.59352-0.57232-1.293-0.86378-2.0985-0.87438-0.8055-0.010599-1.5103 0.28086-2.1144 0.87438-0.60414 0.59352-0.8956 1.293-0.87438 2.0985 0.021197 0.8055 0.31266 1.5103 0.87438 2.1144 0.56172 0.60414 1.2665 0.8956 2.1144 0.87438zm4.4695 0.2115 3.681 3.6819-1.259 1.284-3.6817-3.7 0.0019784-0.69479-0.090043-0.098846c-0.87973 0.76087-1.92 1.1413-3.1207 1.1413-1.3553 0-2.5025-0.46363-3.4417-1.3909s-1.4088-2.0686-1.4088-3.4239c0-1.3553 0.4696-2.4966 1.4088-3.4239 0.9392-0.92727 2.0864-1.3969 3.4417-1.4088 1.3553-0.011889 2.4906 0.45771 3.406 1.4088 0.9154 0.95107 1.379 2.0924 1.3909 3.4239 0 1.2126-0.38043 2.2588-1.1413 3.1385l0.098834 0.090049z"></path></svg></button>
</form>