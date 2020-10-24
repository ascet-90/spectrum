<?php
get_header();
?>

	<div class="main single_post_page">
		<?php 
			if(have_posts()):
				while(have_posts()):
					the_post(); ?>
					<div class="single_post" id="<?php the_ID()?>">
						<div class="container">
							<div class="single_post_header d-flex">
								<div class="title_wrap d-flex">
									<div class="title_inner">
										<h1 class="title"><?php the_title()?></h1>
										<div class="post_decription">
											<?php the_field('post_description')?>
										</div>
									</div>
									<div class="post_date">
										<?php echo get_the_date('d F Y')?>
									</div>
								</div>
								<div class="thumb_wrap">
									<div class="post_thumb">
										<?php
											if(has_post_thumbnail()) :
												the_post_thumbnail();
											endif;
										?>
									</div>									
								</div>
							</div>
							<div class="post_content">
								<?php the_content();?>
							</div>
							<section class="similar_posts">
								<h2 class="section_title">Похожие статьи</h2>
								<div class="similar_posts_list d-flex">
									<?php 
									$args = array(
										'posts_per_page' => 2,
										'orderby' => 'post_date',
				    					'order' => 'DESC'
									);
									$query = new WP_Query($args);
									if($query->have_posts()):
										$counter = 0;
										while ( $query->have_posts() ) : $query->the_post(); ?>
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
										<?php endwhile;
									endif;
									?>
								</div>
								<div class="similar_posts_slider_wrap">									
									<div class="similar_posts_slider_for">
										<?php 
											$args = array(
												'posts_per_page' => 5,
												'orderby' => 'post_date',
												'order' => 'DESC'
											);
											$query = new WP_Query($args);
											if($query->have_posts()):
												$counter = 0;
												while ( $query->have_posts() ) : $query->the_post(); ?>
													<div class="post d-flex" id="<?php the_ID()?>">
														<div class="thumb">
															<a href="<?php the_permalink()?>">
																<?php if(has_post_thumbnail()):
																	the_post_thumbnail();
																endif;?>
															</a>								
														</div>
													</div>
												<?php endwhile;
											endif;
											?>
									</div>
									<div class="similar_posts_slider_nav">
									  <?php 
											$args = array(
												'posts_per_page' => 5,
												'orderby' => 'post_date',
												'order' => 'DESC'
											);
											$query = new WP_Query($args);
											if($query->have_posts()):
												$counter = 0;
												while ( $query->have_posts() ) : $query->the_post(); ?>
													<div class="post d-flex" id="<?php the_ID()?>">
														<div class="post_content">
															<div class="title">
																<a href="<?php the_permalink()?>"><?php the_title();?></a>
															</div>
															<div class="date">
																<?php echo get_the_date('d F Y')?>
															</div>
														</div>
													</div>
												<?php endwhile;
											endif;
											?>
									</div>
								</div>
								<div class="button_wrap">
									<a href="<?php the_permalink(282)?>" class="btn">Смотреть больше постов<img src="<?php echo get_template_directory_uri() . '/img/posts_more.png'?>"></a>
								</div>
							</section>							
						</div>
						<section class="similar_products">
							<div class="container">
								<h2 class="section_title">
									Интересные предложения
								</h2>
								<?php 					
									$args = array(
									   'post_type'=>'product',
									   'posts_per_page' => -1,
									   'meta_key' => 'price',
									    'orderby' => 'meta_value',
									    'order' => 'DESC'
									); 
									$query = new WP_Query($args);

									if ( $query->have_posts() ) : ?>
									<div class="product_list">
									 <?php while ( $query->have_posts() ) : $query->the_post(); ?>

									 	<div class="product d-flex" id="<?php the_ID()?>">
									 		<div class="title mobile">
								 				<a href="<?php the_permalink()?>"><?php the_title();?></a>
								 			</div>
									 		<div class="thumb">
									 			<a href="<?php the_permalink()?>">
									 				<?php the_post_thumbnail('product_grid')?>
									 				<?php if(is_array(get_post_meta($query->post->ID, 'new', true))):?>
									 					<span class="new">новинка</span>
										 			<?php endif;?>
										 			<?php if(is_array(get_post_meta($query->post->ID, 'hit', true))):?>
														<span class="hit">хит продаж</span>
													<?php endif;?>
										 			<div class="thumb_bottom d-flex">
														<div class="product_rating">
											 				<?php display_product_rating(); ?>
											 			</div>
														<span class="sell_count">Продано <?php echo get_post_meta($query->post->ID, 'sell_count', true)?> раз</span>	
													</div>	
									 			</a>
									 		</div>	
									 		<div class="product_main_wrap d-flex">
									 			<div class="title">
									 				<a href="<?php the_permalink()?>"><?php the_title();?></a>
									 			</div>
									 			<div class="product_main">
									 				<div class="product_fields">
									 					<div class="product_field d-flex">
										        			<span>Вступительный взнос</span> 
										        			<span><?php the_field('vznos');?> &#8381;</span>
										        		</div>
										        		<div class="product_field d-flex">
										        			<span>Роялти</span> 
										        			<span><?php the_field('royalty');?> % от выручки</span>
										        		</div>
										        		<div class="product_field d-flex">
										        			<span>Инвестиции</span> 
										        			<span><?php the_field('investments');?> &#8381;</span>
										        		</div>					        		
										        		<div class="product_field d-flex">
										        			<span>Прибыль</span> 
										        			<span><?php the_field('income');?> &#8381;</span>
										        		</div>
														<div class="product_field d-flex">
										        			<span>Цена</span> 
										        			<span><?php the_field('price');?> &#8381;</span>
										        		</div>
									 				</div>									 				
									 			</div>
									 			<button class="btn subscribe_popup" href="<?php the_field('presentation_file')?>" data-size="<?php echo get_filesize(get_field('presentation_file'))?>">Получить презентацию</button>
									 		</div>	
									 	</div>
										<?php endwhile;?>
										</div> 
										<?php wp_reset_postdata();
									endif;		 
								?>
							</div>
						</section>	
						<section class="form_wrap subscribe_form">
							<div class="container d-flex">
								<div class="form_wrap_left">
									<div class="section_title">
										Узнавайте о новых проектах первым								
									</div>
									<div class="form_subtitle">
										Перед публикацией проектов на сайте мы рассылаем предложения по своей клиентской базе. Подпишитесь на нашу рассылку, чтобы получать выгодные предложения в числе первых										
									</div>
									<div class="form">
										<?php 
											echo do_shortcode('[contact-form-7 id="5" title="Подписаться"]');
										?>
									</div>
								</div>
								<div class="form_image">
									<?php 
									$image = get_field('form_image');
									if(!empty($image)):?>
										<img src="<?php echo $image?>">
									<?php endif;				
									?>
								</div>
							</div>						
						</section>					
					</div>
				<?php endwhile;
			endif;
		?>
	</div>

<?php get_footer(); ?>