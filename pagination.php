<!-- pagination -->
<div class="pagination">
	<?php if(is_singular()):?>
	<div class="two bottom attached buttons">
		<?php 
			next_post_link('<span class="nav-next" ><i class="left arrow icon"></i>%link</span>');	
			previous_post_link('<span class="nav-previous" >%link<i class="right arrow icon"></i></span>');	
		?>
	</div>
	<?php else:?>
	<?php
	    global $wp_query;
		$big = 999999999;
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', get_pagenum_link($big)),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages
		));
	 ?>
	 <?php endif; ?>
</div>
<!-- /pagination -->