<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Uglyboy
 */

if ( ! function_exists( 'uglyboy_posted_on' ) ) :
function uglyboy_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        _x( '%s', 'post date', 'uglyboy' ), '<i class="calendar icon"></i>' . $time_string
    );

    $byline = sprintf(
        _x( '%s', 'post author', 'uglyboy' ),
        '<i class="user icon"></i><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
    );

    echo '<span class="ui label">' . $posted_on . '</span><span class="ui label"> ' . $byline . '</span>';
    
    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="ui label"><i class="talk icon"></i> '.get_comments_number().' </span>';
    }
    echo '</br>';
}
endif;

if ( ! function_exists( 'uglyboy_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function uglyboy_entry_footer() {
    // tags
    echo '<div class="ui hidden divider"></div><span class="ui labels tags-links">';
        $post_tags = get_the_tags();
        if ($post_tags) {
            $tag_i   = 0;
            $tag_str = '';
            foreach ((array) $post_tags as $tag) {
                if ($tag_i < 5) {
                    $tag_str .= sprintf(
                        '<a class="ui tag label" id="tag-%2$s" href="%3$s">%1$s</a> ',
                        $tag->name,
                        $tag->term_id,
                        get_tag_link($tag->term_id)
                    );
                    $tag_i++;
                } else {
                    break;
                }
            }
            echo substr($tag_str, 0, -1);
        }
    echo '</span>';
    if (is_singular()){
        edit_post_link('编辑','<div class="ui top right attached label">','</div>');
    }
}
endif;

if ( ! function_exists( 'uglyboy_excerpt_more' ) && ! is_admin() ) :
function uglyboy_excerpt_more( $more ) {
    $link = sprintf( '<div><a href="%1$s" class="readmore">%2$s</a><div>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( __( '继续阅读', 'uglyboy' ) )
        );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'uglyboy_excerpt_more' );
endif;