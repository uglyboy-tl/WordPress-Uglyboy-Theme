<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
    <!-- .header -->
    <div class="card-header">
        <span class="date">
            <?php echo uglyboy_get_icon( array('icon' => 'calendar' ))?>
            <?php the_time('Y.m.d G:i'); ?>
        </span>
        <span class="category">
            <?php echo uglyboy_get_icon( array('icon' => 'archive' ))?>
            <?php the_category(__(',','uglyboy')); ?>
        </span>
    </div>
    <!-- .header -->
    
    <!-- post thumbnail -->
    <div class="card-image">
        <?php if ( !is_singular() && has_post_thumbnail()) : // Check if Thumbnail exists ?>
        <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
            <?php the_post_thumbnail(array(120,120),array('class' => 'pure-image'));// Fullsize image for the single post ?>
        </a>
        <?php endif; ?>
    </div>
    <!-- /post thumbnail -->
    
    <div class="card-body typo typo-selection">
        
        <!-- post title -->
        <h2 class="card-title">
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>" class="card-title">
                <?php the_title(); ?></a>
        </h2>
        <!-- /post title -->
        
    <?php if (is_singular()):
        the_content();
    else:
        the_excerpt();
    endif ?>
    </div>
    <div class="card-footer">
        <!-- post details -->
        <span class="author">
            <?php echo uglyboy_get_icon( array('icon' => 'user' ))?>
            <?php the_author_posts_link(); ?>
        </span>
        <span class="views">
            <?php echo uglyboy_get_icon( array('icon' => 'eye' ))?>
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
                <?php echo get_post_views(); ?>
            </a>
        </span>
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
</article>
<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

<!-- article -->
<article class="bg-title">
    <h2>
        <?php _e( 'Sorry, nothing to display.', 'uglyboy' ); ?>
    </h2>
</article>
<!-- /article -->

<?php endif; ?>