<?php
get_header();
?>

	<div class="main single_product_page">
		<?php 
			if(have_posts()):
				while(have_posts()):
					the_post(); ?>
					<div class="product post" id="<?php the_ID()?>">
						<div class="container">
							<div class="product_header d-flex">
								<div class="left">
									<div class="product_title d-flex">
										<span class="title"><?php the_title()?></span>
										<span class="price"><?php the_field('price')?> &#8381;</span>
									</div>									
								</div>
								<div class="right">
									<span class="rating_container">
									<input type="radio" id="rating-t5" name="rating" value="5"><label for="rating-t5"><svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.54593 27.9992L9.25407 18.594L2 11.9242L12.0269 10.5485L16.5 2L20.9733 10.5485L31 11.9242L23.7461 18.594L25.4543 28L16.5 23.5595L7.54593 27.9992Z" stroke="#C7CFD4" stroke-width="1.5"/></svg></label>
									<input type="radio" id="rating-t4" name="rating" value="4"><label for="rating-t4"><svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.54593 27.9992L9.25407 18.594L2 11.9242L12.0269 10.5485L16.5 2L20.9733 10.5485L31 11.9242L23.7461 18.594L25.4543 28L16.5 23.5595L7.54593 27.9992Z" stroke="#C7CFD4" stroke-width="1.5"/></svg></label>
									<input type="radio" id="rating-t3" name="rating" value="3"><label for="rating-t3"><svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.54593 27.9992L9.25407 18.594L2 11.9242L12.0269 10.5485L16.5 2L20.9733 10.5485L31 11.9242L23.7461 18.594L25.4543 28L16.5 23.5595L7.54593 27.9992Z" stroke="#C7CFD4" stroke-width="1.5"/></svg></label>
									<input type="radio" id="rating-t2" name="rating" value="2"><label for="rating-t2"><svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.54593 27.9992L9.25407 18.594L2 11.9242L12.0269 10.5485L16.5 2L20.9733 10.5485L31 11.9242L23.7461 18.594L25.4543 28L16.5 23.5595L7.54593 27.9992Z" stroke="#C7CFD4" stroke-width="1.5"/></svg></label>
									<input type="radio" id="rating-t1" name="rating" value="1"><label for="rating-t1"><svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.54593 27.9992L9.25407 18.594L2 11.9242L12.0269 10.5485L16.5 2L20.9733 10.5485L31 11.9242L23.7461 18.594L25.4543 28L16.5 23.5595L7.54593 27.9992Z" stroke="#C7CFD4" stroke-width="1.5"/></svg></label>
									</span>									
								</div>
							</div>
							<div class="available">Предложение действительно до&nbsp;<?php the_field('available_to')?></div>
							<div class="product_content d-flex">
								<div class="product_main">
									<div class="product_gallery">
										<div class="product_gallery_for">
											<?php 
												if(have_rows('gallery')):
													while(have_rows('gallery')): the_row();?>
														<div class="gallery_slide">
															<div class="thumb">
																<img src="<?php echo get_sub_field('image')['url']?>">
																<?php if(is_array(get_post_meta(get_the_ID(), 'new', true))):?>
																	<span class="new">новинка</span>
																<?php endif;?>
																<?php if(is_array(get_post_meta(get_the_ID(), 'hit', true))):?>
																	<span class="hit">хит продаж</span>
																<?php endif;?>
																<span class="sell_count">Продано&nbsp;<?php echo get_post_meta(get_the_ID(), 'sell_count', true)?> раз</span>
																<div class="product_rating">
																	<?php display_product_rating(); ?>
																</div>
															</div>
															<div class="rating"></div>
														</div>
													<?php endwhile;
												endif;
											?>
										</div>
										<div class="product_gallery_nav">
											<?php 
												if(have_rows('gallery')):
													while(have_rows('gallery')): the_row();?>
														<div class="gallery_slide">
															<div class="thumb">
																<img src="<?php echo get_sub_field('image')['url']?>">
															</div>
														</div>
													<?php endwhile;
												endif;
											?>
										</div>
									</div>
									<div class="product_fields_mobile">
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
												<span>Окупаемость</span> 
												<span><?php the_field('payback');?></span>
											</div>
											<div class="product_field d-flex">
												<span>Прибыль</span> 
												<span><?php the_field('income');?> &#8381;</span>
											</div>
										</div>
										<a href="#" class="btn order_popup">Оставить заявку</a>
										<div class="product_files">
											<div class="top d-flex">
												<div class="items">
													<div class="item">
														<span class="title">Скачать финансовый отчет</span>
														<span class="pdf"><span>PDF</span></span><a href="<?php the_field('financial_file')?>" download><?php echo get_filesize(get_field('financial_file'))?></a>		
													</div>
													<div class="item">
														<span class="title">Скачать бизнес-план</span>
														<span class="pdf"><span>PDF</span></span><a href="<?php the_field('bissness_file')?>" download><?php echo get_filesize(get_field('bissness_file'))?></a>			
													</div>
												</div>										
											</div>
											<div class="bottom d-flex">
												<div class="items">
													<div class="item">
														<span class="title">Скачать презентацию</span>
														<span class="pdf"><span>PDF</span></span><a class="subscribe_popup" href="<?php the_field('presentation_file')?>"><?php echo get_filesize(get_field('presentation_file'))?></a>	
													</div>
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
												</div>												
											</div>
										</div>										
									</div>
									<div class="product_tabs">
										<?php 
											if(have_rows('tabs')): 
												$counter = 0;?>
												<ul>
													<?php while(have_rows('tabs')): the_row();
														$counter++; ?>
														<li><a href="#tabs-<?php echo $counter?>"><?php the_sub_field('tab_title')?></a></li>
													<?php endwhile;?>
												</ul>
												<?php 
													$counter = 0;
													while(have_rows('tabs')): the_row();
														$counter++; ?>
														<div id="tabs-<?php echo $counter?>" class="tab_content">
															<div class="tab_title">
																<?php the_sub_field('tab_text_title')?>
																<?php 
																if($counter == 4):
																	display_product_rating();
																endif;?>
															</div>																										
															<?php the_sub_field('tab_content');
																if($counter == 4):
																	$comments = get_comments(array('post_id' => $post->ID,'status'  => 'approve'));	
																	if(count($comments) > 0):
																	?>
																	<div class="comment_slider">
																		<?php foreach($comments as $comment): ?>
																			<div class="comment_slide">	
																				<div class="comment_header d-flex">
																					<div class="avatar"><?php echo get_avatar($comment->comment_author_email, 100 ); ?></div>
																					<span class="name"><?php echo $comment->comment_author?></span>
																				</div>																	
																				<div class="comment_info d-flex">
																					<div class="comment_pluses"> 
																						<div class="title">Плюсы</div>
																						<?php 
																							$pluses = trim(get_comment_meta($comment->comment_ID, 'pluses', true));
																							$pluses = explode(PHP_EOL, $pluses); ?>
																							<ul>
																							<?php foreach ($pluses as $plus): ?>
																								<li><?php echo $plus; ?></li>
																							<?php endforeach; ?>
																							</ul>
																					</div>
																					<div class="comment_minuses"> 
																						<div class="title">Минусы</div>
																						<?php 
																							$minuses = trim(get_comment_meta($comment->comment_ID, 'minuses', true));
																							$minuses = explode(PHP_EOL, $minuses); ?>
																							<ul>
																							<?php foreach ($minuses as $minus): ?>
																								<li><?php echo $minus; ?></li>
																							<?php endforeach; ?>
																							</ul>
																					</div>
																				</div>		
																				<p class="comment_content"><?php echo $comment->comment_content?></p>				 		
																			</div>
																 		<?php endforeach;
																		?>
																	</div>	
																	<?php endif;?>																
																	<a href="#" class="btn review_popup">Добавить отзыв</a>
																<?php endif;
															?>
														</div>
												<?php endwhile;?>
											<?php endif;
										?>
									</div>
									<div class="product_socials">
										<a class="vk" href="<?php the_field('vk_link')?>"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none"><path d="M34.9261 28.43C34.8945 28.362 34.8651 28.3056 34.8378 28.2604C34.3856 27.4459 33.5214 26.4462 32.2458 25.261L32.2188 25.2339L32.2053 25.2206L32.1917 25.2069H32.178C31.5991 24.655 31.2325 24.284 31.0789 24.094C30.798 23.7321 30.7351 23.3658 30.8886 22.9946C30.9971 22.7141 31.4045 22.1219 32.11 21.217C32.4811 20.7375 32.7749 20.3532 32.992 20.0636C34.5572 17.9827 35.2358 16.6529 35.0277 16.0739L34.9468 15.9385C34.8925 15.8571 34.7523 15.7825 34.5263 15.7146C34.2999 15.6467 34.0105 15.6355 33.6576 15.6807L29.7493 15.7077C29.686 15.6853 29.5956 15.6874 29.4778 15.7146C29.3602 15.7418 29.3014 15.7554 29.3014 15.7554L29.2333 15.7894L29.1793 15.8302C29.1341 15.8572 29.0843 15.9047 29.03 15.9726C28.9759 16.0402 28.9307 16.1196 28.8946 16.21C28.4691 17.3047 27.9853 18.3225 27.4424 19.2634C27.1076 19.8244 26.8002 20.3106 26.5194 20.7222C26.239 21.1338 26.0038 21.437 25.814 21.6313C25.6238 21.8259 25.4523 21.9817 25.2982 22.0995C25.1443 22.2173 25.0268 22.267 24.9455 22.2488C24.864 22.2306 24.7872 22.2125 24.7146 22.1945C24.588 22.113 24.4862 22.0022 24.4094 21.862C24.3323 21.7218 24.2804 21.5453 24.2533 21.3327C24.2263 21.1199 24.2103 20.9369 24.2057 20.7831C24.2015 20.6294 24.2035 20.4121 24.2126 20.1316C24.222 19.851 24.2263 19.6612 24.2263 19.5617C24.2263 19.2178 24.233 18.8447 24.2464 18.4421C24.2601 18.0395 24.2712 17.7205 24.2805 17.4855C24.2897 17.2503 24.294 17.0014 24.294 16.739C24.294 16.4766 24.278 16.2709 24.2464 16.1215C24.2152 15.9724 24.1674 15.8276 24.1043 15.6872C24.0409 15.547 23.948 15.4386 23.8261 15.3616C23.704 15.2846 23.5522 15.2236 23.3715 15.1783C22.892 15.0698 22.2813 15.0111 21.5393 15.0019C19.8567 14.9839 18.7755 15.0925 18.296 15.3278C18.106 15.4271 17.9341 15.5629 17.7803 15.7347C17.6175 15.9338 17.5947 16.0425 17.7123 16.0604C18.2552 16.1417 18.6396 16.3362 18.8658 16.6438L18.9473 16.8068C19.0107 16.9244 19.074 17.1326 19.1374 17.4311C19.2006 17.7296 19.2415 18.0598 19.2594 18.4215C19.3046 19.082 19.3046 19.6475 19.2594 20.1178C19.2141 20.5884 19.1714 20.9547 19.1305 21.2171C19.0897 21.4795 19.0287 21.6921 18.9473 21.8549C18.8658 22.0177 18.8115 22.1172 18.7844 22.1534C18.7572 22.1895 18.7346 22.2123 18.7166 22.2212C18.599 22.2663 18.4767 22.2892 18.3502 22.2892C18.2234 22.2892 18.0697 22.2258 17.8888 22.0991C17.7079 21.9724 17.5202 21.7983 17.3257 21.5766C17.1311 21.3549 16.9117 21.045 16.6673 20.647C16.4232 20.249 16.1698 19.7786 15.9075 19.2357L15.6904 18.8421C15.5547 18.5888 15.3693 18.2201 15.1341 17.7362C14.8987 17.2521 14.6907 16.7838 14.5098 16.3314C14.4375 16.1414 14.3289 15.9968 14.1842 15.8973L14.1162 15.8565C14.0711 15.8203 13.9986 15.782 13.8992 15.7411C13.7996 15.7003 13.6957 15.671 13.587 15.653L9.86868 15.68C9.48872 15.68 9.23091 15.766 9.09516 15.938L9.04083 16.0193C9.01369 16.0646 9 16.1369 9 16.2365C9 16.336 9.02714 16.4582 9.08147 16.6028C9.62428 17.8786 10.2146 19.1089 10.8523 20.2941C11.4901 21.4792 12.0443 22.4339 12.5147 23.1572C12.9851 23.8811 13.4646 24.5643 13.9532 25.2064C14.4417 25.8488 14.7651 26.2605 14.9234 26.4413C15.0818 26.6225 15.2062 26.758 15.2967 26.8484L15.636 27.1741C15.8531 27.3912 16.172 27.6513 16.5927 27.9543C17.0135 28.2576 17.4793 28.556 17.9905 28.8503C18.5017 29.1441 19.0965 29.3839 19.7751 29.5693C20.4536 29.7549 21.114 29.8294 21.7564 29.7934H23.317C23.6336 29.7661 23.8734 29.6666 24.0363 29.4948L24.0903 29.4268C24.1266 29.3728 24.1606 29.2889 24.192 29.176C24.2238 29.0629 24.2395 28.9383 24.2395 28.8028C24.2303 28.4139 24.2599 28.0633 24.3276 27.7512C24.3952 27.4393 24.4723 27.204 24.5585 27.0456C24.6447 26.8873 24.7419 26.7538 24.8502 26.6455C24.9586 26.537 25.0359 26.4712 25.0813 26.4486C25.1263 26.4258 25.1623 26.4104 25.1895 26.4011C25.4066 26.3288 25.6621 26.3988 25.9564 26.6116C26.2505 26.8242 26.5263 27.0868 26.7843 27.3988C27.0422 27.711 27.352 28.0614 27.7138 28.4503C28.0758 28.8394 28.3924 29.1287 28.6637 29.3189L28.935 29.4818C29.1162 29.5904 29.3514 29.69 29.641 29.7804C29.93 29.8708 30.1833 29.8934 30.4008 29.8482L33.8747 29.7941C34.2183 29.7941 34.4857 29.7372 34.6753 29.6243C34.8653 29.5112 34.9782 29.3866 35.0146 29.2511C35.0509 29.1154 35.0529 28.9615 35.0215 28.7895C34.9893 28.6178 34.9576 28.4978 34.9261 28.43Z" fill="#4680C2"></path></svg></a>
										<a class="facebook" href="<?php the_field('facebook_link')?>"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none"><path d="M24.2977 17.5934V15.8373C24.2977 14.9759 24.9029 14.7771 25.3301 14.7771C25.7573 14.7771 27.9644 14.7771 27.9644 14.7771V11H24.2977C20.2395 11 19.3139 13.8163 19.3139 15.6054V17.5934H17V20.244V22H19.3495C19.3495 26.9699 19.3495 33 19.3495 33H24.0841C24.0841 33 24.0841 26.9367 24.0841 22H27.5728L27.7508 20.2771L28 17.5934H24.2977Z" fill="#3B579D"></path></svg></a>
										<a class="telegram"  href="<?php the_field('telegram_link')?>"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none"><path d="M35.1393 11C35.0466 11 34.954 11 34.815 11.0444L8.55021 20.625C7.80905 20.8911 7.80905 21.9113 8.59653 22.1331L14.7111 24.0847L18.3706 31.1371C18.4169 31.2702 18.5558 31.3589 18.7411 31.3589C18.8338 31.3589 18.9264 31.3145 18.9727 31.2702L22.4006 28.4758L18.5558 25.6815L18.8801 29.3629L16.1008 23.8629L30.785 15.3911L18.5558 25.7258L28.0983 32.6452C28.4225 32.8669 28.7931 33 29.1637 33C29.9048 33 30.646 32.5121 30.8313 31.7581L35.9731 12.0202C36.112 11.4879 35.6951 11 35.1393 11Z" fill="#239AD6"></path></svg></a>
										<a class="twitter" href="<?php the_field('twitter_link')?>"><svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M34 15.1017C33.1687 15.4746 32.2334 15.7119 31.2982 15.8136C32.2681 15.2373 33.0301 14.3559 33.3765 13.3051C32.4759 13.8136 31.4714 14.2203 30.3976 14.4237C29.5316 13.5424 28.3193 13 26.9684 13C24.3705 13 22.2575 15.0339 22.2575 17.5424C22.2575 17.9153 22.2922 18.2542 22.3614 18.5932C18.4127 18.3559 14.9488 16.5593 12.628 13.8136C12.2123 14.4915 12.0045 15.2712 12.0045 16.0847C12.0045 17.6441 12.8358 19.0339 14.1175 19.8814C13.3554 19.8475 12.628 19.6441 11.9699 19.3051C11.9699 19.339 11.9699 19.339 11.9699 19.3729C11.9699 19.9492 12.0738 20.5254 12.2816 21.0339C12.8705 22.4576 14.1521 23.5424 15.7455 23.8475C15.3645 23.9492 14.9488 24.0169 14.4985 24.0169C14.1867 24.0169 13.9096 23.983 13.5979 23.9492C14.1867 25.7458 15.9533 27.0678 17.997 27.1017C16.369 28.322 14.3599 29.0339 12.1431 29.0339C11.762 29.0339 11.381 29 11 28.9661C13.0783 30.2542 15.5723 31 18.2395 31C25.6175 31 30.1551 26.0169 31.3328 20.8305C31.5407 19.9153 31.6446 19 31.6446 18.0847C31.6446 17.8814 31.6446 17.678 31.6446 17.5085C32.5798 16.8305 33.3765 16.0169 34 15.1017Z" fill="#41ABE1"/>
										</svg></a>
									</div>
									<?php $post_views_count = do_shortcode('[post-views]'); echo $post_views_count; ?>
								</div>
								<div class="product_sidebar">
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
						        			<span>Окупаемость</span> 
						        			<span><?php the_field('payback');?></span>
						        		</div>
						        		<div class="product_field d-flex">
						        			<span>Прибыль</span> 
						        			<span><?php the_field('income');?> &#8381;</span>
						        		</div>
									</div>
									<a href="#" class="btn order_popup">Оставить заявку</a>
									<div class="product_files">
										<div class="top d-flex">
											<div class="items">
												<div class="item">
													<span class="title">Скачать финансовый отчет</span>
													<span class="pdf"><span>PDF</span></span><a class="download_report_popup" href="<?php the_field('financial_file')?>" download><?php echo get_filesize(get_field('financial_file'))?></a>			
												</div>
												<div class="item">
													<span class="title">Скачать бизнес-план</span>
													<span class="pdf"><span>PDF</span></span><a class="download_plan_popup" href="<?php the_field('bissness_file')?>" download><?php echo get_filesize(get_field('bissness_file'))?></a>			
												</div>
											</div>	
											<div class="top_files_image">
												<img src="<?php echo get_template_directory_uri() . '/img/financial.png'?>">
											</div>										
										</div>
										<div class="bottom d-flex">
											<div class="items">
												<div class="item">
													<span class="title">Скачать презентацию</span>
													<span class="pdf"><span>PDF</span></span><a class="subscribe_popup" data-size="<?php echo get_filesize(get_field('presentation_file'))?>" href="<?php the_field('presentation_file')?>"><?php echo get_filesize(get_field('presentation_file'))?></a>			
												</div>
											</div>	
											<div class="top_files_image">
												<img src="<?php echo get_template_directory_uri() . '/img/presentation.png'?>">
											</div>
										</div>
									</div>
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
							</div>														
						</div>
						<section class="form_wrap more">
							<div class="container d-flex">
								<div class="form_wrap_left">
									<div class="section_title">
										Подробнее о проекте
									</div>
									<div class="form_subtitle">
										Заполните форму ниже и наш куратор свяжется с вами в ближайшее время.									
									</div>
									<div class="form">
										<?php 
											echo do_shortcode('[contact-form-7 id="275" title="Подробнее о проекте"]');							
										?>
									</div>
								</div>
								<div class="form_image">
									<img src="<?php echo get_template_directory_uri() . '/img/single-form.png'?>">
								</div>
							</div>						
						</section>
						<section class="similar_products">
							<div class="container">
								<h2 class="section_title">
									Похожие предложения
								</h2>
								<?php 					
									$investments = get_field('investments');
									$args = array(
									   'post_type'=>'product',
									   'posts_per_page' => -1,
									   'meta_key' => 'price',
									    'orderby' => 'meta_value',
									    'order' => 'DESC',
										'post__not_in' => array(get_the_ID())
									); 
									$args['meta_query'][] = array(
									  'key' => 'investments',
									  'value' => array($investments - $investments *0.5, $investments + $investments *0.5 ),
									  'type' => 'numeric',
									  'compare' => 'between'									  
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