<!-- pagination -->
<div class="<?php echo is_singular()?'two bottom attached buttons':'' ?> navigation">
	<?php
	if(is_singular()){
		next_post_link('<span class="nav-next" ><i class="left arrow icon"></i>%link</span>');	
	}
	else{
		previous_posts_link('<button class="pure-button-primary pure-button nav-previous" ><i class="left arrow icon"></i>查看新文章</button>', 0);
	}
	if(is_singular()){
		previous_post_link('<span class="nav-previous" >%link<i class="right arrow icon"></i></span>');	
	}
	else{
		next_posts_link('<button class="pure-button-primary pure-button nav-next" >查看旧文章<i class="right arrow icon"></i></button>', 0);
	}
	?>
</div>
<!-- /pagination -->
