<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="header">
        <!-- post thumbnail -->
        <div>
        <?php if ( !is_singular() && has_post_thumbnail()) : // Check if Thumbnail exists ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail(array(120,120),array('class' => 'right floated rounded image'));// Fullsize image for the single post ?>
            </a>
        <?php endif; ?>
        </div>
        <!-- /post thumbnail -->

        <!-- post title -->
        <h2>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?></a>
        </h2>
        <!-- /post title -->

        <!-- post details -->
        <span class="date">
            <?php the_time('F j, Y'); ?>
            <?php the_time('g:i a'); ?></span>
        <span class="author">
            <?php _e( 'Published by', 'uglyboy' ); ?>
            <?php the_author_posts_link(); ?></span>
        <span class="comments">
            <?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'uglyboy' ), __( '1 Comment', 'uglyboy' ), __( '% Comments', 'uglyboy' )); ?></span>
        <!-- /post details -->
	</div><!-- .entry-header -->
    <div class="typo typo-selection">
        <?php the_excerpt();?>
    </div>

    <?php edit_post_link(); ?>

</article>
<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

<!-- article -->
<article>
    <h2>
        <?php _e( 'Sorry, nothing to display.', 'uglyboy' ); ?>
    </h2>
</article>
<!-- /article -->

<?php endif; ?>