<?php
get_header();
?>

	<div class="main">
		<?php 
			while(have_posts()){
				if(have_posts())
				{
					the_post();
					the_content();
				}
			}
		?>
	</div>

<?php get_footer(); ?>