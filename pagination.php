<!-- pagination -->
<div class="card-area">
	<ul class="pagination">
		<?php if(is_singular()):?>
			<li class="page-item page-prev">
				<div class="page-item-title"><?php previous_post_link();?></div>
			</li>
			<li class="page-item page-next">
				<div class="page-item-title"><?php next_post_link();?></div>
			</li>
		<?php else:?>
		<?php
			global $wp_query;
			$big = 999999999;
			echo uglyboy_paginate_links(array(
				'base' => str_replace($big, '%#%', get_pagenum_link($big)),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages
			));
		?>
		<?php endif; ?>
	</ul>
</div>
<!-- /pagination -->