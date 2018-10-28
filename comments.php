<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="pure-u-1">

    <?php
	// You can start editing here -- including this comment!
    if ( have_comments() ) : 
    ?>

    <h2 class="comments-title">
        <?php
        $comments_number = get_comments_number();
        if ( '1' === $comments_number ) {
            /* translators: %s: post title */
            printf( __('One Reply to &ldquo;%s&rdquo;', 'uglyboy'), get_the_title());
        } else {
            printf(
                /* translators: 1: number of comments, 2: post title */
                _n(
                    '%1$s Reply to &ldquo;%2$s&rdquo;',
                    '%1$s Replies to &ldquo;%2$s&rdquo;',
                    $comments_number,
                    'uglyboy'
                ),
                number_format_i18n( $comments_number ),
                get_the_title()
            );
        }
        ?>
    </h2>

    <ol class="comment-list">
        <?php
            wp_list_comments(
                array(
                    'avatar_size' => 100,
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'reply_text'  => uglyboy_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'uglyboy' ),
                )
            );
        ?>
    </ol>

    <?php
    the_comments_pagination(
        array(
            'prev_text' => uglyboy_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'uglyboy' ) . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'uglyboy' ) . '</span>' . uglyboy_get_svg( array( 'icon' => 'arrow-right' ) ),
        )
    );
	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : 
    ?>
    <p class="no-comments">
        <?php _e( 'Comments are closed here.', 'uglyboy' ); ?>
    </p>
    <?php
	endif;

    
	// custem comment form
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields   =  array(
		'author'  => '<div class="pure-u-1 pure-u-md-1-3">'.
					 '<input id="author" name="author" type="text" placeholder="'. __( 'Name' ) . ( $req ? '*' : '' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '" class="pure-input-1"' . $html_req . ' /></div>',
		'email'   => '<div class="pure-u-1 pure-u-md-2-3">'.
					 '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="'. __( 'Email' ) . ( $req ? '*' : '' ) .'" value="' . esc_attr( $commenter['comment_author_email'] ) . '" class="pure-input-1"' . $html_req . ' /></div>',
	);

	$comments_args = array(
		'fields' =>  $fields,
		'class_form'        => 'pure-form pure-form-stacked pure-g',
		'class_submit'      => 'pure-button pure-button-primary',
		'comment_notes_before' => '',
		'comment_field'        => '<div class="pure-u-1"><textarea id="comment" name="comment" required="required" class="pure-input-1" placeholder="'. _x( 'Comment', 'uglyboy' ) .'"></textarea></div>',
	);

	comment_form($comments_args);
	?>

</div><!-- #comments -->