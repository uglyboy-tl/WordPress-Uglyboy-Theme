<?php get_header(); ?>

<main class="pure-u-1 pure-u-md-2-3" role="main">
    <!-- section -->
    <section>

        <?php
            if(is_archive()):
                the_archive_title( '<h2 class="divider">', '</h2>' );
            elseif(is_search()):
        ?>
            <h2 class="divider"><?php echo sprintf( __( '%s Search Results for ', 'uglyboy' ), $wp_query->found_posts ); echo get_search_query(); ?></h2>
        <?php endif ?>

        <?php

        get_template_part('loop');

        // Previous/next page navigation.
        get_template_part('pagination');

        // comments
        if( comments_open() || get_comments_number()){
            comments_template();
        }
        ?>

    </section>
    <!-- /section -->
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>