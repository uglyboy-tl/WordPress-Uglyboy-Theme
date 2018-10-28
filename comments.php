<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="pure-u-1">

    <?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
    <h2 class="comments-title">
        <?php
				 printf(esc_html(__('One thought on &ldquo;%2$s&rdquo;','uglyboy'), __('%1$s thoughts on &ldquo;%2$s&rdquo;','uglyboy'), get_comments_number(), 'comments title', 'uglyboy'), 
				 number_format_i18n( get_comments_number()), 
				 '<span>' . get_the_title() . '</span>');
			?>
    </h2>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text">
            <?php _e( 'Comment navigation', 'uglyboy' ); ?>
        </h2>
        <div class="nav-links">

            <div class="nav-previous">
                <?php previous_comments_link( __( 'Older Comments', 'uglyboy' ) ); ?>
            </div>
            <div class="nav-next">
                <?php next_comments_link( __( 'Newer Comments', 'uglyboy' ) ); ?>
            </div>

        </div><!-- .nav-links -->
    </nav><!-- #comment-nav-above -->

    <?php endif; // Check for comment navigation. ?>

    <ol class="comment-list">
        <?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text">
            <?php _e( 'Comment navigation', 'uglyboy' ); ?>
        </h2>
        <div class="nav-links">

            <div class="nav-previous">
                <?php previous_comments_link( __( 'Older Comments', 'uglyboy' ) ); ?>
            </div>
            <div class="nav-next">
                <?php next_comments_link( __( 'Newer Comments', 'uglyboy' ) ); ?>
            </div>

        </div><!-- .nav-links -->
    </nav><!-- #comment-nav-below -->
    <?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

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
		'comment_field'        => '<div class="pure-u-1"><textarea id="comment" name="comment" required="required" class="pure-input-1" placeholder="'. _x( 'Comment', 'noun' ) .'"></textarea></div>',
	);

	comment_form($comments_args);
	?>

</div><!-- #comments -->