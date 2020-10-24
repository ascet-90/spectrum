<!-- search -->
<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
	<div class="search_group">
		<input class="search-input" type="search" name="s" placeholder="<?php _e( 'поиск', 'html5blank' ); ?>">
		<button class="search-submit" type="submit" role="button"><img src="<?php echo get_template_directory_uri().'/img/search-icon.png'?>" alt=""></button>
	</div>	
</form>
<!-- /search -->
