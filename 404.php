<?php get_header(); ?>

<main class="pure-u-1 pure-u-md-2-3" role="main">
    <!-- section -->
    <section>

        <!-- article -->
        <article id="post-404">

            <h1>
                <?php _e( 'Page not found', 'uglyboy' ); ?>
            </h1>
            <h2>
                <a href="<?php echo home_url(); ?>">
                    <?php _e( 'Return home?', 'uglyboy' ); ?></a>
            </h2>

        </article>
        <!-- /article -->

    </section>
    <!-- /section -->
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>