<!-- section -->
<section id="post-<?php the_ID(); ?>" class="<?php echo is_singular()?"raised attached":"stacked"; ?> segment">
	<?php if(!is_page()): ?>
	<div class="ui primary ribbon label"><?php echo get_the_category_list( __( ', ', 'uglyboy' ) )?></div>
	<?php endif ?>
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
		<?php the_title( sprintf( '<h1 class="header"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<!-- /post title -->

		<!-- Post Data -->
		<?php if ( 'post' == get_post_type() && !get_theme_mod('meta_index') ) : ?>
		<div class="">
			<?php uglyboy_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<!-- Post Data -->
		
	</div><!-- .entry-header -->
	<!-- post details -->
	<div class="typo">
		<?php is_singular()?the_content():the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'uglyboy' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<!-- /post details -->
	<div class="footer">
		<?php if(is_singular()){uglyboy_entry_footer();} ?>
	</div>
</section>
<!-- /section -->
