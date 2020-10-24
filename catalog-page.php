<?php 
	/*
	Template Name: Catalog Page
	*/
?>

<?php
get_header();
?>

	<div class="main default_page">
		<section class="catalog_top_section">
			<div class="container d-flex">
				<h1 class="page_title"><?php the_field('page_title')?></h1>
				<div class="download_wrap d-flex">
					<a class="btn download_popup" href="#">Скачать каталог
						<?php $image = get_field('top_button_image');
							if(!empty($image)):?>
								<img src="<?php echo $image['url']?>">
							<?php endif;
						?>
					</a>					
					<span class="pdf">PDF <?php echo get_filesize(get_field('pdf_file'))?></span>
				</div>				
			</div>			
		</section>
		<div class="content_wrap">
			<div class="mobile_filters_wrap d-flex">
				<button type="button" class="filters_popup"><img src="<?php echo get_template_directory_uri().'/img/filter-icon.png'?>">Фильтр</button>
				<button type="button" class="sort_popup"><img src="<?php echo  get_template_directory_uri().'/img/sort-icon.png'?>">Сортировка</button>
			</div>
			<div class="container d-flex">
				<div class="sidebar">
				<?php 
					$args = array(
					   'post_type'=>'product',
					   'posts_per_page' => -1
					);
					$query = new WP_Query($args);
					$min_income = $min_investments = $min_royalty = $min_vznos = $min_price = 999999999999999;
					$max_income = $max_investments = $max_royalty = $max_vznos = $max_price = 0;

					if ( $query->have_posts() ) :
					 while ( $query->have_posts() ) : $query->the_post(); 
					 	$min_p = get_post_meta($query->post->ID, 'price', true);
					 	$max_p = get_post_meta($query->post->ID, 'price', true);
					 	$min_price = $min_p < $min_price ? $min_p : $min_price;
					 	$max_price = $max_p > $max_price ? $max_p : $max_price;
					 	$min_v = get_post_meta($query->post->ID, 'vznos', true);
					 	$max_v = get_post_meta($query->post->ID, 'vznos', true);
					 	$min_vznos = $min_v < $min_vznos ? $min_v : $min_vznos;
					 	$max_vznos = $max_v > $max_vznos ? $max_v : $max_vznos;
					 	$min_r = get_post_meta($query->post->ID, 'royalty', true);
					 	$max_r = get_post_meta($query->post->ID, 'royalty', true);
					 	$min_royalty = $min_r < $min_royalty ? $min_r : $min_royalty;
					 	$max_royalty = $max_r > $max_royalty ? $max_r : $max_royalty;
					 	$min_i = get_post_meta($query->post->ID, 'investments', true);
					 	$max_i = get_post_meta($query->post->ID, 'investments', true);
					 	$min_investments = $min_i < $min_investments ? $min_i : $min_investments;
					 	$max_investments = $max_i > $max_investments ? $max_i : $max_investments;
					 	$min_in = get_post_meta($query->post->ID, 'income', true);
					 	$max_in = get_post_meta($query->post->ID, 'income', true);
					 	$min_income = $min_in < $min_income ? $min_in : $min_income;
					 	$max_income = $max_in > $max_income ? $max_in : $max_income;

						endwhile; 
						wp_reset_postdata();
					endif;
				?>
				<form id="filter" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST">
					<div class="filter_block">						
						<div class="filter price">
							<div class="filter_title d-flex"><span>Цена</span>
								<div class="currency_switch clearfix">
									<a href="#" class="active">&#8381;</a>
									<a href="#">&#36;</a>
									<a href="#">&#8364;</a>
								</div>
							</div>								
							<div class="filter_inputs d-flex">
								<span><input type="text" name="min_price" value="<?php echo $min_price?>"></span>
								<span><input type="text" name="max_price" value="<?php echo $max_price?>"></span>								
							</div>										 
							<div class="slider-range" id="slider-range-price" data-min="<?php echo $min_price?>" data-max="<?php echo $max_price?>"></div>
						</div>
						<div class="filter vznos">
							<div class="filter_title d-flex"><span>Вступительный взнос</span>
							</div>								
							<div class="filter_inputs d-flex">
								<span><input type="text" name="min_vznos" value="<?php echo $min_vznos?>"></span>
								<span><input type="text" name="max_vznos" value="<?php echo $max_vznos?>"></span>								
							</div>										 
							<div class="slider-range" id="slider-range-vznos" data-min="<?php echo $min_vznos?>" data-max="<?php echo $max_vznos?>"></div>
						</div>
						<div class="filter royalty">
							<div class="filter_title d-flex"><span>Роялти</span>
							</div>								
							<div class="filter_inputs d-flex">
								<span><input type="text" name="min_royalty" value="<?php echo $min_royalty?>%"></span>
								<span><input type="text" name="max_royalty" value="<?php echo $max_royalty?>%"></span>								
							</div>										 
							<div class="slider-range" id="slider-range-royalty" data-min="<?php echo $min_royalty?>" data-max="<?php echo $max_royalty?>"></div>
						</div>
						<div class="filter investments">
							<div class="filter_title d-flex"><span>Инвестиции</span>
							</div>								
							<div class="filter_inputs d-flex">
								<span><input type="text" name="min_investments" value="<?php echo $min_investments?>"></span>
								<span><input type="text" name="max_investments" value="<?php echo $max_investments?>"></span>								
							</div>										 
							<div class="slider-range" id="slider-range-investments" data-min="<?php echo $min_investments?>" data-max="<?php echo $max_investments?>"></div>
						</div>
						<div class="filter income">
							<div class="filter_title d-flex"><span>Прибыль</span>
							</div>								
							<div class="filter_inputs d-flex">
								<span><input type="text" name="min_income" value="<?php echo $min_income?>"></span>
								<span><input type="text" name="max_income" value="<?php echo $max_income?>"></span>								
							</div>										 
							<div class="slider-range" id="slider-range-income" data-min="<?php echo $min_income?>" data-max="<?php echo $max_income?>"></div>
						</div>
					</div>
					<div class="filter product_category_filter">
						<div class="filter_title">Сфера бизнеса</div>
						<?php 
							$cats = get_terms(array('taxonomy' => 'product_category','hide_empty' => false));
							foreach ($cats as $cat) { ?>
								<div class="custom_checkbox">
									<label>
										<input type="checkbox" name="<?php echo $cat->slug?>">
										<span><?php echo $cat->name;?></span>
									</label>
								</div>
							<?php }
						?>
					</div>
					<input type="reset" name="reset" value="очистить фильтр">
					<input type="hidden" name="action" value="myfilter">
					<input type="hidden" name="paged" value="<?php echo home_url()?>">
				</form>
				<div class="consult_wrap">
					<?php
						$bg = get_field('consult_bg', 'options');
						$style = '';
						if(!empty($bg)){
							$style = 'background-image:url('. $bg . ');';
						}
					?>
					<div class="consult_main" style="<?php echo $style;?>">
						<div class="consult_slider">
							<?php 
								if(have_rows('consult_list', 'options')):
									while(have_rows('consult_list', 'options')): the_row();?>
										<div class="consultor">
											<div class="photo">
												<img src="<?php echo get_sub_field('photo')['url']?>">
											</div>
											<div class="name">
												<?php the_sub_field('name')?>
											</div>
											<div class="position">
												<?php the_sub_field('position')?>
											</div>
										</div>
									<?php endwhile;
							endif;
							?>
						</div>
						<a href="#" class="btn order_call"><img src="<?php echo get_field('button_bg', 'options')?>">Заказать консультацию</a>
					</div>
					<div class="consult_footer d-flex">
						<img src="<?php echo get_field('appstore_banner', 'options')['url']?>">
						<img src="<?php echo get_field('google_banner', 'options')['url']?>">
					</div>
				</div>
			</div>
			<div class="content">
				<div class="content_top">
					<div class="search_wrap d-flex">
						<?php echo do_shortcode('[wpdreams_ajaxsearchlite]')?>
						<span class="products_count">Найдено
							<span class="number">
								<?php 
									$count = wp_count_posts('product')->publish;
									echo $count;
								?>								
							</span> 
							<?php							
								plural_form(
									$count,
									/* варианты написания для количества 1, 2 и 5 */
									array( 'проект','проекта','проектов')
								);
							?>  
						</span>
					</div>						
					<div class="sort_group">
						<form id="sort">
							<span class="sort_title">сортировать по:</span>
							<span class="sort sort_price desc active" data-order="price">ценe</span>
							<span class="sort sort_rating" data-order="rating">рейтингу</span>
							<span class="sort sort_new" data-order="new">новизне</span>
							<span class="sort sort_income" data-order="payback">окупаемости</span>						
						</form>
					</div>				
				</div>
				<div class="content_main">
					<div class="consult_popup_wrap">
						<a href="#" class="consult_popup">
							<?php 
								if(have_rows('consult_list', 'options')):
									$counter = 0;
									while(have_rows('consult_list', 'options')): the_row();
										if($counter === 0):?>
											<img src="<?php echo get_sub_field('photo')['url']?>">
										<?php endif;
										$counter++;
									?>										
									<?php endwhile;
							endif;
							?>
						</a>
					</div>
					<?php 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;						
						$args = array(
						   'post_type'=>'product',
						   'posts_per_page' => 10,
						   'paged'=>$paged,
						   'meta_key' => 'price',
						    'orderby' => 'meta_value',
						    'order' => 'DESC'
						);
						$query = new WP_Query($args);

						/* PageNavi at Top */
						if ( $query->have_posts() ) : 
							$counter = 0;
						?>
						<div class="product_list">
						 <?php while ( $query->have_posts() ) : $query->the_post(); 
						 		$counter++;
						 	?>
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
							 			<span class="sell_count">Продано <?php echo get_post_meta($query->post->ID, 'sell_count', true)?> раз</span>
										<div class="product_rating">
							 				<?php display_product_rating(); ?>
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
						 				<button class="btn subscribe_popup" href="<?php the_field('presentation_file')?>" data-size="<?php echo get_filesize(get_field('presentation_file'))?>">Получить презентацию</button>
						 			</div>
						 		</div>	
						 	</div>
						 	<?php 
						 		if($counter == 8): ?>
						 			<section class="form_wrap catalog subscribe_form">
										<div class="container d-flex">
											<div class="form_wrap_left">
												<div class="section_title">
													<?php the_field('form_section_title', 193)?>
												</div>
												<div class="form">
													<?php  
														echo do_shortcode('[contact-form-7 id="5" title="Подписаться"]');							
													?>
												</div>
											</div>
											<div class="form_image">
												<?php 
												$image = get_field('form_image', 193);
												if(!empty($image)):?>
													<img src="<?php echo $image['url']?>">
												<?php endif;				
												?>
											</div>
										</div>						
									</section>
						 		<?php endif;
						 	?>
							<?php endwhile;?>
							</div> 
							<?php wp_reset_postdata();
						endif;
						if (function_exists('wp_pagenavi') && $query->max_num_pages > 1){wp_pagenavi(array( 'query' => $query ));}		 
					?>
				</div>
			</div>
			</div>			
		</div>	
	</div>


<?php get_footer(); ?>