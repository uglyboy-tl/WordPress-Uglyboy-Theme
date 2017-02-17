<?php
/**
 * @package WordPress
 */

get_header(); ?>

	<main class="pure-u-1 pure-u-md-2-3">

		<?php
			if(is_archive()):
				the_archive_title( '<h4 class="divider">', '</h4>' );
			elseif(is_search()):
		?>
			<h2 class="divider"><?php echo sprintf( __( '%s Search Results for ', 'uglyboy' ), $wp_query->found_posts ); echo get_search_query(); ?></h2>
		<?php endif ?>
		<?php if (have_posts()): ?>

			<?php
			// Start the Loop.
			while (have_posts()) : the_post();
				
				get_template_part('content');
			
			// End the loop.
			endwhile;
			
			// Previous/next page navigation.
			get_template_part('pagination');

			// comments
			if( comments_open() || get_comments_number()){
				comments_template();
			}
		?>
		<?php else: ?>

			<!-- article -->
			<article>
				<h2><?php _e( 'Sorry, nothing to display.', 'uglyboy' ); ?></h2>
			</article>
			<!-- /article -->

		<?php endif; ?>
	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
