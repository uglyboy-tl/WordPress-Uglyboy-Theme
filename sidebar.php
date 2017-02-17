<?php
/**
 * @package WordPress
 */
?>

<!-- sidebar -->
<?php if ( is_active_sidebar( 'sidebar' )  ) : ?>
	<aside class="pure-u-1 pure-u-md-1-3">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside>
<?php endif; ?>
<!-- /sidebar -->