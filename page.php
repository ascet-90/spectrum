<?php
get_header();
?>

	<div class="main single_page">
		<?php 
			if(have_posts()):
				while(have_posts()):
					the_post(); ?>
					<div class="page" id="<?php the_ID()?>">
						<div class="container">
							<h1 class="single_page_title">
								<?php single_post_title();?>
							</h1>
							<div class="page_content">
								<?php the_content();?>
							</div>
						</div>
					</div>
				<?php endwhile;
			endif;
		?>
	</div>

<?php get_footer(); ?>