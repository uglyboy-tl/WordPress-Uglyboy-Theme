<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- .header -->
    <div class="header">
        <!-- post thumbnail -->
        <div>
            <?php if ( !is_singular() && has_post_thumbnail()) : // Check if Thumbnail exists ?>
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
                <?php the_post_thumbnail(array(120,120),array('class' => 'pure-image'));// Fullsize image for the single post ?>
            </a>
            <?php endif; ?>
        </div>
        <!-- /post thumbnail -->

        <!-- post title -->
        <h2>
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
                <?php the_title(); ?></a>
        </h2>
        <!-- /post title -->

        <!-- post details -->
        <span class="date">
            <?php echo uglyboy_get_icon( array('icon' => 'calendar' ))?>
            <?php the_time('Y F j'); ?>
            <?php the_time('a g:i'); ?></span>
        <span class="category">
            <?php echo uglyboy_get_icon( array('icon' => 'archive' ))?>
            <?php the_category(__(',','uglyboy')); ?></span>
        <span class="author">
            <?php echo uglyboy_get_icon( array('icon' => 'user' ))?>
            <?php the_author_posts_link(); ?></span>
        <br>
        <span class="views">
            <?php echo uglyboy_get_icon( array('icon' => 'eye' ))?>
            <?php echo get_post_views(); ?></span>
        <span class="comments">
            <?php
                if(comments_open(get_the_ID())){
                    echo uglyboy_get_icon( array('icon' => 'comments' )).' ';
                    comments_popup_link( __( 'Leave your thoughts', 'uglyboy' ), __( '1 Comment', 'uglyboy' ), __( '% Comments', 'uglyboy' ));
                }
            ?>
        </span>
        <!-- /post details -->

    </div>
    <!-- .header -->

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