<?php 
	/*
	Template Name: Blog Page
	*/
?>

<?php
get_header();
?>

	<div class="main default_page">
		<section class="blog">
			<div class="container">
				<h1 class="blog_title"><?php the_field('page_title')?></h1>
				<div class="latest_posts_wrap">
					<?php 
						$args = array(
							'posts_per_page' => 6,
							'orderby' => 'post_date',
	    					'order' => 'DESC'
						);
						$query = new WP_Query($args);
						$query_args = json_encode($query->query_vars);	?>				
						<script>
							var query_vars = '<?php echo $query_args?>';
							var current_page = 1;
							var max_num_pages = '<?php echo $query->max_num_pages?>';
						</script>
						<?php if($query->have_posts()):
							$counter = 0;
							$posts_count = $query->post_count;
							while ( $query->have_posts() ) : $query->the_post(); 
								if($counter%3 == 0):?>
									<div class="latest_posts_list d-flex">
										<div class="post_big post" id="<?php the_ID()?>">
											<div class="thumb">
												<a href="<?php the_permalink()?>">
													<?php if(has_post_thumbnail()):
														the_post_thumbnail();
													endif;?>
												</a>								
											</div>
											<div class="post_content">
												<div class="title">
													<a href="<?php the_permalink()?>"><?php the_title();?></a>
												</div>
												<div class="date">
													<?php echo get_the_date('d F Y')?>
												</div>
											</div>
										</div>
										<?php if($posts_count == 1||($counter == 3 && $posts_count == 4)): ?>
											</div>
										<?php endif;?>
								<?php endif;?>
								<?php if($counter%3 == 1):?>
									<div class="posts_right d-flex">
										<div class="post d-flex" id="<?php the_ID()?>">
											<div class="thumb">
												<a href="<?php the_permalink()?>">
													<?php if(has_post_thumbnail()):
														the_post_thumbnail();
													endif;?>
												</a>								
											</div>
											<div class="post_content">
												<div class="title">
													<a href="<?php the_permalink()?>"><?php the_title();?></a>
												</div>
												<div class="date">
													<?php echo get_the_date('d F Y')?>
												</div>
											</div>
										</div>
										<?php if($posts_count == 2 || ($counter==4 && $posts_count==5)){?> </div></div><?php }?>
									<?php endif;
								?>
								<?php if($counter%3 == 2):?>
										<div class="post d-flex" id="<?php the_ID()?>">
											<div class="thumb">
												<a href="<?php the_permalink()?>">
													<?php if(has_post_thumbnail()):
														the_post_thumbnail();
													endif;?>
												</a>								
											</div>
											<div class="post_content">
												<div class="title">
													<a href="<?php the_permalink()?>"><?php the_title();?></a>
												</div>
												<div class="date">
													<?php echo get_the_date('d F Y')?>
												</div>
											</div>
										</div>
									</div><!-- posts_right -->
								</div> <!-- latest_posts_list -->
									<?php endif;
								?>
								
								<?php $counter++;
							endwhile;
							endif; 
						?>				
						<?php if($query->max_num_pages > 1): ?>
							<div class="button_wrap">						
								<a href="#" class="btn load_more_posts"><span>Смотреть больше постов</span><img src="<?php echo get_template_directory_uri() . '/img/posts_more.png'?>"></a>
							</div>	
							<?php endif;							
						wp_reset_postdata();?>										
				</div>
			</div>			
		</section>
	</div>


<?php get_footer(); ?>