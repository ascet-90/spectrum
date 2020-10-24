<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="keywords" content="<?php bloginfo('keywords'); ?>"/>
		<meta name="description" content="<?php bloginfo('description'); ?>"/>
		<meta name="copyright" content="<?php bloginfo('copyright'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="">
		<meta name="robots" content="noindex, nofollow" />
		<title><?php bloginfo('name'); ?> - <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="page">
			<div class="wrapper">
				<?php 
					$class = '';
					if(is_singular('product') || is_single() || (is_page() && !is_front_page())) {
						$class = 'light';
					}
				?>
				<header id="header" class="header <?php echo $class?>">
					<div class="top_menu_wrap d-flex">
						<div class="left d-flex">							
							<div class="logo">
								<?php if(!is_front_page()):?>
									<a href="<?php echo get_home_url(); ?>"><img src="<?php $logo = get_field('logo','options'); echo $logo['url'] ?>" alt=""></a>
								<?php 
									else: ?>
									<img src="<?php $logo = get_field('logo','options'); echo $logo['url'] ?>" alt="">
								<?php endif;?>								
							</div>
							<div class="logo dark">
								<?php if(!is_front_page()):?>
									<a href="<?php echo get_home_url(); ?>"><img src="<?php $logo = get_field('logo_dark','options'); echo $logo['url'] ?>" alt=""></a>
								<?php 
									else: ?>
									<img src="<?php $logo = get_field('logo_dark','options'); echo $logo['url'] ?>" alt="">
								<?php endif;?>	
							</div>
							<div class="title"><?php the_field('site_description', 'options')?></div>
							<div class="mob_toggle">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>		
						<div class="right d-flex">
							<div class="social-icons d-flex">
								<?php 
									$link = get_field('whatsapp_link', 'options');?>
									<a class="whatsapp" href="<?php echo $link;?>"><?php $icon = get_field('whatsapp_icon', 'options'); echo file_get_contents($icon['url'])?></a>
									<?php $link = get_field('viber_link', 'options');?>
									<a class="viber" href="<?php echo $link;?>"><?php $icon = get_field('viber_icon', 'options'); echo file_get_contents($icon['url'])?></a>
									<?php $link = get_field('telegram_link', 'options');?>
									<a class="telegram" href="<?php echo $link;?>"><?php $icon = get_field('telegram_icon', 'options'); echo file_get_contents($icon['url'])?></a>
							</div>
							<div class="phone">
								<span class="hotline"><?php the_field('hotline_text', 'options')?></span>
								<span class="tel"><?php the_field('tel', 'options')?></span>								
								<a href="#" class="order_call"><?php the_field('call_text', 'options')?></a>
							</div>
							<div class="tel_icon">
								<?php the_field('tel', 'options')?>
								<img src="<?php echo get_field('tel_icon', 'options')['url']?>">
							</div>	
						</div>													
					</div>
					<div class="bottom_menu_wrap">
						<div class="bottom_menu_main d-flex">
							<?php wp_nav_menu(['theme_location' => 'primary','container'=>false]); ?>
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
								<div class="bottom">
									<button class="btn order_call">Заказать звонок</button>
									<span class="tel"><?php the_field('tel', 'options')?></span>
								</div>
							</div>	
						</div>											
						<div class="bottom_menu_footer d-flex">
							<a href="<?php the_field('politika_link', 'options')?>"><?php the_field('politika_text', 'options')?></a>
							<span class="copyright"><?php the_field('copyright', 'options')?></span>
							<a href="<?php the_field('studio_link', 'options')?>"><?php the_field('studio_text', 'options')?></a>
						</div>
					</div>
				</header>