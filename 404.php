<?php
get_header();
?>

	<div class="main not_found">
		<div class="container">
			<div class="image">
				<img src="<?php echo get_template_directory_uri(). '/img/404.png' ?>">
			</div>
			<h2 class="not_found_title"><span>Такой страницы не существует или она была удалена</span></h2>
			<a href="<?php echo home_url();?>" class="btn">Перейти на главную</a>
		</div>		
	</div>

<?php get_footer(); ?>