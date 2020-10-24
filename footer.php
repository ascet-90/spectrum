			
		</div>
	</div>
	<div class="footer">
		<div class="top_menu_wrap d-flex">
			<div class="left d-flex">
				<div class="logo">
					<?php 
						if(!is_front_page()): ?>
							<a href="<?php echo get_home_url(); ?>"><img src="<?php $logo = get_field('logo','options'); echo $logo['url'] ?>" alt=""></a>
						<?php else: ?>
							<img src="<?php $logo = get_field('logo','options'); echo $logo['url'] ?>" alt="">
						<?php endif;
					?>					
				</div>
				<div class="title"><?php the_field('site_description', 'options')?></div>
			</div>		
			<div class="right d-flex">
				<div class="phone">
					<span class="tel"><?php the_field('tel', 'options')?></span>
					<a href="#" class="order_call btn"><?php the_field('call_text', 'options')?></a>
				</div>
			</div>													
		</div>
		<div class="bottom_menu_wrap">
			<div class="bottom_menu_main d-flex">
				<?php wp_nav_menu(['theme_location' => 'footer','container'=>false]); ?>
				<div class="bottom_menu_social">
					<div class="top d-flex">
						<div class="item">
							<div><?php the_field('messenger_text', 'options');?></div>
							<div class="social-icons d-flex">
								<?php 
									$link = get_field('whatsapp_link', 'options');?>
									<a class="whatsapp" href="<?php echo $link;?>"><?php $icon = get_field('whatsapp_icon', 'options'); echo file_get_contents($icon['url'])?></a>
									<?php $link = get_field('viber_link', 'options');?>
									<a class="viber" href="<?php echo $link;?>"><?php $icon = get_field('viber_icon', 'options'); echo file_get_contents($icon['url'])?></a>
									<?php $link = get_field('telegram_link', 'options');?>
									<a class="telegram" href="<?php echo $link;?>"><?php $icon = get_field('telegram_icon', 'options'); echo file_get_contents($icon['url'])?></a>
							</div>
							<a href="#" class="subscribe">Подписка на рассылку</a>
						</div>
						<div class="item">
							<div><?php the_field('follow_text', 'options');?></div>
							<div class="social-icons d-flex">
								<?php 
									$link = get_field('vk_link', 'options');?>
									<a class="vk" href="<?php echo $link;?>"><?php $icon = get_field('vk_icon', 'options'); echo file_get_contents($icon['url'])?></a>
									<?php $link = get_field('facebook_link', 'options');?>
									<a class="facebook" href="<?php echo $link;?>"><?php $icon = get_field('facebook_icon', 'options'); echo file_get_contents($icon['url'])?></a>
									<?php $link = get_field('instagram_link', 'options');?>
									<a class="instagram" href="<?php echo $link;?>"><?php $icon = get_field('instagram_icon', 'options'); echo file_get_contents($icon['url'])?></a>
							</div>
							<!-- <a href="#" class="subscribe subscribe_rss">Подписка через RSS</a> -->
						</div>
					</div>
				</div>	
			</div>											
			<div class="bottom_menu_footer d-flex">
				<a href="<?php the_field('politika_link', 'options')?>"><?php the_field('politika_text', 'options')?></a>
				<span><?php the_field('copyright', 'options')?></span>
				<a href="<?php the_field('studio_link', 'options')?>"><?php the_field('studio_text', 'options')?></a>
			</div>
		</div>

		<div id="modal" class="modal">
			<div class="modal_sandbox">				
			</div>
			<div class="form_wrap thanks">
				<div class="form">
					<div class="title">
						Спасибо за подписку!						
					</div>
					<div class="text">
						Мы уже отправили вам первое письмо — пожалуйста, проверьте почту и подвердите рассылку				
					</div>
					<img src="<?php echo get_template_directory_uri().'/img/form-thanks.png'?>">
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap thanks_order">
				<div class="form">
					<div class="title">
						Спасибо за заявку!
					</div>
					<div class="text">
						Наш специалист перезвонит ближайшее время, чтобы ответить на все интересующие вопросы!			
					</div>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap download">
				<div class="form">
					<?php 
						echo do_shortcode('[contact-form-7 id="169" title="Скачивание каталога"]');
					?>
					<span class="pdf">PDF <?php echo get_filesize(get_field('pdf_file'))?></span>
					<a href="<?php the_field('pdf_file')?>" class="download_hidden" download></a>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap order">
				<div class="form">
					<?php 
						echo do_shortcode('[contact-form-7 id="170" title="Заказ звонка"]');
					?>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap subscribe">
				<div class="form">
					<?php 
						echo do_shortcode('[contact-form-7 id="172" title="Получение презентации"]');
					?>
					<span class="pdf">PDF <?php echo get_filesize(get_field('pdf_file'))?></span>
					<a href="<?php the_field('pdf_file')?>" class="download_hidden" download></a>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap download_report">
				<div class="form">
					<?php 
						echo do_shortcode('[contact-form-7 id="459" title="Скачать финансовый отчет"]');
					?>
					<span class="pdf">PDF <?php echo get_filesize(get_field('financial_file'))?></span>
					<a href="<?php the_field('financial_file')?>" class="download_hidden" download></a>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap download_plan">
				<div class="form">
					<?php 
						echo do_shortcode('[contact-form-7 id="460" title="Скачать бизнес-план"]');
					?>
					<span class="pdf">PDF <?php echo get_filesize(get_field('bissness_file'))?></span>
					<a href="<?php the_field('bissness_file')?>" class="download_hidden" download></a>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap subscribe_mailing">
				<div class="form">
					<div class="title">
						Узнавайте о новых проектах первым
					</div>
					<div class="text">
						Перед публикацией проектов на сайте мы рассылаем предложения по своей клиентской базе. Подпишитесь на нашу рассылку, чтобы получать выгодные предложения в числе первых					
					</div>
					<?php  
						echo do_shortcode('[contact-form-7 id="424" title="Подписаться на рассылку"]');	
					?>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap leave_order">
				<div class="form">
					<?php 
						echo do_shortcode('[contact-form-7 id="422" title="Оставить заявку"]');
					?>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap consult">
				<div class="form">
					<div class="title">
						Заказ консультации				
					</div>
					<div class="text">
						Выберите специалиста и он перезвонит ближайшее время, чтобы ответить на все интересующие вопросы				
					</div>
					<div class="consult_slider">
							<?php 
								if(have_rows('consult_list', 'options')):
									while(have_rows('consult_list', 'options')): the_row();?>
										<div class="consultor d-flex">
											<div class="photo">
												<img src="<?php echo get_sub_field('photo')['url']?>">
											</div>
											<div class="right">
												<div class="name">
													<?php the_sub_field('name')?>
												</div>
												<div class="position">
													<?php the_sub_field('position')?>
												</div>
											</div>											
										</div>
									<?php endwhile;
							endif;
							?>
						</div>
						<a href="#" class="btn order_call"><img src="<?php echo get_field('button_bg', 'options')?>">Заказать консультацию</a>
					<div class="consult_footer d-flex">
						<img src="<?php echo get_field('appstore_banner', 'options')['url']?>">
						<img src="<?php echo get_field('google_banner', 'options')['url']?>">
					</div>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>
				</div>				
			</div>
			<div class="form_wrap filters">
				<form id="filter_modal" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" novalidate>
					<div class="form first">
						<div class="title">Сервис по выбору проверенных франшиз</div>
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
									<div class="slider-range" id="slider-range-price-modal" data-min="<?php echo $min_price?>" data-max="<?php echo $max_price?>"></div>
								</div>
								<div class="filter vznos">
									<div class="filter_title d-flex"><span>Вступительный взнос</span>
									</div>								
									<div class="filter_inputs d-flex">
										<span><input type="text" name="min_vznos" value="<?php echo $min_vznos?>"></span>
										<span><input type="text" name="max_vznos" value="<?php echo $max_vznos?>"></span>								
									</div>										 
									<div class="slider-range" id="slider-range-vznos-modal" data-min="<?php echo $min_vznos?>" data-max="<?php echo $max_vznos?>"></div>
								</div>
								<div class="filter royalty">
									<div class="filter_title d-flex"><span>Роялти</span>
									</div>								
									<div class="filter_inputs d-flex">
										<span><input type="text" name="min_royalty" value="<?php echo $min_royalty?>%"></span>
										<span><input type="text" name="max_royalty" value="<?php echo $max_royalty?>%"></span>								
									</div>										 
									<div class="slider-range" id="slider-range-royalty-modal" data-min="<?php echo $min_royalty?>" data-max="<?php echo $max_royalty?>"></div>
								</div>
								<div class="filter investments">
									<div class="filter_title d-flex"><span>Инвестиции</span>
									</div>								
									<div class="filter_inputs d-flex">
										<span><input type="text" name="min_investments" value="<?php echo $min_investments?>"></span>
										<span><input type="text" name="max_investments" value="<?php echo $max_investments?>"></span>								
									</div>										 
									<div class="slider-range" id="slider-range-investments-modal" data-min="<?php echo $min_investments?>" data-max="<?php echo $max_investments?>"></div>
								</div>
								<div class="filter income">
									<div class="filter_title d-flex"><span>Прибыль</span>
									</div>								
									<div class="filter_inputs d-flex">
										<span><input type="text" name="min_income" value="<?php echo $min_income?>"></span>
										<span><input type="text" name="max_income" value="<?php echo $max_income?>"></span>								
									</div>										 
									<div class="slider-range" id="slider-range-income-modal" data-min="<?php echo $min_income?>" data-max="<?php echo $max_income?>"></div>
								</div>
								<div class="filter">
									<div class="filter_title"><span>Сфера бизнеса</span>
									</div>	
								</div>	
								<button type="button" class="btn category_popup">Выбрать</button>
							</div>
							<button type="submit" class="btn products_count">Показать&nbsp;<span class="number"><?php echo wp_count_posts('product')->publish;?></span> <span>объектов</span></button>
							<button type="button" class="hide_filter">Скрыть фильтр</button>
							<input type="reset" name="reset" value="Очистить фильтр">
							<input type="hidden" name="action" value="myfilter">				
					</div>	
					<div class="form second">
						<div class="title">
							Сфера бизнеса
						</div>
						<div class="filter product_category_filter">
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
						<button type="button" class="btn category_close">Вернуться к фильтру</button>
						<div class="close">
							<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
						</div>
					</div>	
				</form>		
			</div>
			<div class="form_wrap sort">
				<div class="form">
					<div class="title">Сервис по выбору проверенных франшиз</div>
					<div class="sort_group">
						<p><span class="sort_title">Сортировать по:</span></p>
						<p><span class="sort sort_price desc active" data-order="price">ценe</span></p>
						<p><span class="sort sort_rating" data-order="rating">рейтингу</span></p>
						<p><span class="sort sort_new" data-order="new">новизне</span></p>
						<p><span class="sort sort_income" data-order="payback">окупаемости</span></p>
					</div>	
					<button type="button" class="btn apply">Применить</button>
					<button type="button" class="hide_sort">Скрыть</button>			
				</div>
			</div>
			<div class="form_wrap add_review">
				<div class="form">
					<div class="title">Отзыв на сайт</div>
					<div class="text">
						Напишите свой отзыв о бизнесе по франшизе, и после проверки модератором он появится на сайте						
					</div>	
					<?php 
					ob_start(); ?>
					<span class="rating_container">
						<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
							<input type="radio" id="rating-<?php echo esc_attr( $i ); ?>" name="rating" value="<?php echo esc_attr( $i ); ?>" /><label for="rating-<?php echo esc_attr( $i ); ?>"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M11 0L13.9222 6.97787L21.4616 7.60081L15.7283 12.5363L17.4656 19.8992L11 15.9716L4.53436 19.8992L6.2717 12.5363L0.538379 7.60081L8.07775 6.97787L11 0Z" fill="white"/></svg></label>
						<?php endfor; ?>
						<input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0"></label>
					</span>					
					<?php 
						$html_rating = ob_get_contents();
						ob_end_clean();
						global $post;
						$args = array(
						    'fields' => apply_filters(
						        'comment_form_default_fields', array(
						            'author' =>'<p class="comment-form-author">' . '<input id="author" placeholder="Ваше имя" name="author" type="text" value="" size="30" </p>',
						            'email'  => '<p class="comment-form-email">' . '<input id="email" placeholder="E-mail" name="email" type="text" value="" size="30"</p>'
						        )
						    ),
						    'comment_notes_after' => '',
						    'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn" value="Оставить отзыв" />',
						    'submit_field'  => '<p class="form-submit">%1$s %2$s <p class="rating_wrap d-flex">'.$html_rating . '<span class="rating_text">Оцените работу с бизнес-франшизой по пятибалльной шкале</span></p> <span class="wpcf7-acceptance"><label><input type="checkbox" name="acceptance-9" value="1" aria-invalid="false" checked="checked"><span class="wpcf7-list-item-label">Я принимаю <a href="' . get_permalink(335) . '">условия передачи информации</a></span></label></span><input type="hidden" name="post_id" value="' . $post->ID .'"></p>');
					comment_form($args);?>
					<div class="close">
						<img src="<?php echo get_template_directory_uri().'/img/close.png'?>">
					</div>		
				</div>
			</div>
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>