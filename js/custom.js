function resetSliders() {
	$( "#slider-range-price" ).slider({
	  range: true,
	  min: $( "#slider-range-price" ).data('min'),
	  max: $( "#slider-range-price" ).data('max'),
	  values: [$( "#slider-range-price" ).data('min'), $( "#slider-range-price" ).data('max')]
	});

	$( "#slider-range-vznos" ).slider({
	  range: true,
	  min: $( "#slider-range-vznos" ).data('min'),
	  max: $( "#slider-range-vznos" ).data('max'),
	  values: [$( "#slider-range-vznos" ).data('min'), $( "#slider-range-vznos" ).data('max')]
	});
	$( "#slider-range-royalty" ).slider({
	  range: true,
	  min: $( "#slider-range-royalty" ).data('min'),
	  max: $( "#slider-range-royalty" ).data('max'),
	  values: [$( "#slider-range-royalty" ).data('min'), $( "#slider-range-royalty" ).data('max')]
	});
	$( "#slider-range-investments" ).slider({
	  range: true,
	 min: $( "#slider-range-investments" ).data('min'),
	  max: $( "#slider-range-investments" ).data('max'),
	  values: [$( "#slider-range-investments" ).data('min'), $( "#slider-range-investments" ).data('max')]
	});
	$( "#slider-range-income" ).slider({
	  range: true,
	  min: $( "#slider-range-income" ).data('min'),
	  max: $( "#slider-range-income" ).data('max'),
	  values: [$( "#slider-range-income" ).data('min'), $( "#slider-range-income" ).data('max')]
	});
}
function resetModalSliders() {
	$( "#slider-range-price-modal" ).slider({
	  range: true,
	  min: $( "#slider-range-price-modal" ).data('min'),
	  max: $( "#slider-range-price-modal" ).data('max'),
	  values: [$( "#slider-range-price-modal" ).data('min'), $( "#slider-range-price-modal" ).data('max')]
	});

	$( "#slider-range-vznos-modal" ).slider({
	  range: true,
	  min: $( "#slider-range-vznos-modal" ).data('min'),
	  max: $( "#slider-range-vznos-modal" ).data('max'),
	  values: [$( "#slider-range-vznos-modal" ).data('min'), $( "#slider-range-vznos-modal" ).data('max')]
	});
	$( "#slider-range-royalty-modal" ).slider({
	  range: true,
	  min: $( "#slider-range-royalty-modal" ).data('min'),
	  max: $( "#slider-range-royalty-modal" ).data('max'),
	  values: [$( "#slider-range-royalty-modal" ).data('min'), $( "#slider-range-royalty-modal" ).data('max')]
	});
	$( "#slider-range-investments-modal" ).slider({
	  range: true,
	 min: $( "#slider-range-investments-modal" ).data('min'),
	  max: $( "#slider-range-investments-modal" ).data('max'),
	  values: [$( "#slider-range-investments-modal" ).data('min'), $( "#slider-range-investments-modal" ).data('max')]
	});
	$( "#slider-range-income-modal" ).slider({
	  range: true,
	  min: $( "#slider-range-income-modal" ).data('min'),
	  max: $( "#slider-range-income-modal" ).data('max'),
	  values: [$( "#slider-range-income-modal" ).data('min'), $( "#slider-range-income-modal" ).data('max')]
	});
}
function plural_form(number, after) {
	var cases = [2, 0, 1, 1, 1, 2];
	return after[ (number%100>4 && number%100<20)? 2: cases[Math.min(number%10, 5)] ];
}

function ajaxRequest(order, orderBy, modal) {
	var filter = $('#filter');
	if(modal && modal == true) {
		filter = $('#filter_modal');
	}		
	$('.product_list').css({'opacity': '0.5'});
	filter.find('input[type=text]').each(function(ind, el){
		$(el).val($(el).val().replace(/\s/g, ''));
	});
	$.ajax({
		url:filter.attr('action'),
		data:filter.serialize() + '&order='+order+'&orderBy='+orderBy+'&pagename='+custom.pagename, // form data
		type:filter.attr('method'),
		beforeSend:function(xhr){				
		},
		success:function(data){	
			var found_posts = data.data.found_posts;
			var html = data.data.page;
			$('.products_count > .number').text(found_posts);
			$('.wp-pagenavi').hide();
			$('.products_count > span:last-child').text(plural_form(found_posts, ['проект','проекта','проектов']));
			$('.product_list').html(html);		
			$('.product_list').css({'opacity': '1'});		
			$('.subscribe_popup').click(function(e){
				e.preventDefault();
				$('.modal').addClass('open');
				$('.modal .form_wrap').hide();
				$('.modal .form_wrap.subscribe').show();	
			    $('body').css('overflow-y','hidden');
			});		
		}
	});
	filter.find('input[type=text]').each(function(ind, el){
		$(el).val(numberWithSpaces($(el).val()));
	});
	return false;
}
$('.load_more_wrap').click(function(){
	custom.offset_count++;
	var order_by = $('.sort_group .sort.active').data('order');
	var order = null;
	if($('.sort_group .sort.active').hasClass('desc')){
		order = 'desc';
	} else if($('.sort_group .sort.active').hasClass('asc')) {
		order = 'asc';
	}
	ajaxRequest(order, order_by);

});

function numberWithSpaces(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    return parts.join(".");
}

$(document).ready(function() {
	var views_count = parseInt($('.post-views .post-views-count').text());
	$('.post-views .post-views-label').text(plural_form(views_count, ['просмотр','просмотра','просмотров']));
	
	document.querySelectorAll('[data-autoresize]').forEach(function (element) {
		var offset = element.offsetHeight - element.clientHeight;
		document.addEventListener('input', function (event) {
		  event.target.style.height = 'auto';
		  event.target.style.height = event.target.scrollHeight + offset + 'px';
		});
		element.removeAttribute('data-autoresize');
	});

    $('.mob_toggle').click(function(){
    	$('.header').toggleClass('open');
    	$('.header .bottom_menu_wrap').slideToggle();
    	$('.top_menu_wrap').toggleClass('open');    	
    });
    if($(window).scrollTop() >= 50) {
      $('.header').addClass('fixed');
    }
    else {
      $('.header').removeClass('fixed');
    }

    $('.main_slider').slick({
		accessibility: false,
		autoplay: true,
		autoplaySpeed: 6000,
		speed: 1000,
		focusOnSelect: false,
        dots: false,
		arrows: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        lazyload: 'ondemand',
        infinite: true,
        asNavFor: '.main_slider_nav',
        responsive: [
        	{
        		breakpoint: 769,
        		settings: {
        			centerMode: true,
        			centerPadding: '20px'
        		}        		
        	}
        ]
      });      

    $('.top_section_left_slider').slick({
    	accessibility: false,
        dots: false,
		arrows: false,
        speed: 300,
        initialSlide: 1,
        slidesToShow: 3,
        slidesToScroll:1,
        lazyload: 'ondemand',
        infinite: true,
        swipe: false
      });  
    $('.main_slider_nav').slick({
		accessibility: false,
		focusOnSelect: false,
        dots: false,
		arrows: true,
        speed: 300,
        slidesToShow: 1,
        lazyload: 'ondemand',
        slidesToScroll:1,
        infinite: true,
        asNavFor: '.main_slider',
        responsive: [
        	{
        		breakpoint: 541,
        		settings: {
        			dots: true,
        			arrows: false
        		}        		
        	}
        ]
      });  
    $('.main_slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
	  $('.top_section_left_slider').slick('slickGoTo', nextSlide +1);
	});
	$('.consult_slider').slick({
        dots: false,
		arrows: true,
		fade: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        infinite: true,
		prevArrow: '<button type="button" class="slick-prev"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51807 1.07446L1.43855 9.15397L9.51807 17.2335" stroke="white"/></svg></button>',
		nextArrow: '<button type="button" class="slick-next"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.431641 17.0056L8.51115 8.9261L0.431642 0.846589" stroke="white"/></svg></button>',
      });

	
	$('.latest_posts_list_wrap .latest_posts_list.for').slick({
        dots: false,
		arrows: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        infinite: true,
        centerMode: true,
    	centerPadding: '20px',
        asNavFor: $('.latest_posts_list_wrap .latest_posts_list.nav')
    });
    $('.latest_posts_list_wrap .latest_posts_list.nav').slick({
        dots: true,
		arrows: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        infinite: true,
        asNavFor: $('.latest_posts_list_wrap .latest_posts_list.for')
    });
	
	resetSliders();
	resetModalSliders();
	
	$('.sidebar .slider-range').each(function(ind, el){		
		$(el).draggable();	
		var value1 = $(el).slider("values", 0);				
		$(el).prev('.filter_inputs').find('span:first-child input').val(numberWithSpaces(value1));
		var value2 = $(el).slider("values", 1);	
		$(el).prev('.filter_inputs').find('span:last-child input').val(numberWithSpaces(value2));
		if($(el).closest('.filter').hasClass('royalty')) {
			$(el).prev('.filter_inputs').find('span:first-child input').val(value1+'%');
			$(el).prev('.filter_inputs').find('span:last-child input').val(value2+'%');
		}
		$(el).on( "slide", function( event, ui ) {
			$(el).prev('.filter_inputs').find('span:first-child input').val(numberWithSpaces(ui.values[0]));
			$(el).prev('.filter_inputs').find('span:last-child input').val(numberWithSpaces(ui.values[1]));
			if($(el).closest('.filter').hasClass('royalty')) {
				$(el).prev('.filter_inputs').find('span:first-child input').val(ui.values[0]+'%');
				$(el).prev('.filter_inputs').find('span:last-child input').val(ui.values[1]+'%');
			}
		} );
		$(el ).on( "slidestop", function( event, ui ) {
			var order_by = $('.sort_group .sort.active').data('order');
			var order = null;
			if($('.sort_group .sort.active').hasClass('desc')){
				order = 'desc';
			} else if($('.sort_group .sort.active').hasClass('asc')) {
				order = 'asc';
			}
			ajaxRequest(order, order_by);
			} );
	});
	$('.modal .slider-range').each(function(ind, el){		
		$(el).draggable();	
		var value1 = $(el).slider("values", 0);				
		$(el).prev('.filter_inputs').find('span:first-child input').val(numberWithSpaces(value1));
		var value2 = $(el).slider("values", 1);	
		$(el).prev('.filter_inputs').find('span:last-child input').val(numberWithSpaces(value2));
		if($(el).closest('.filter').hasClass('royalty')) {
			$(el).prev('.filter_inputs').find('span:first-child input').val(value1+'%');
			$(el).prev('.filter_inputs').find('span:last-child input').val(value2+'%');
		}
		$(el).on( "slide", function( event, ui ) {
			$(el).prev('.filter_inputs').find('span:first-child input').val(numberWithSpaces(ui.values[0]));
			$(el).prev('.filter_inputs').find('span:last-child input').val(numberWithSpaces(ui.values[1]));
			if($(el).closest('.filter').hasClass('royalty')) {
				$(el).prev('.filter_inputs').find('span:first-child input').val(ui.values[0]+'%');
				$(el).prev('.filter_inputs').find('span:last-child input').val(ui.values[1]+'%');
			}
		} );
		$(el ).on( "slidestop", function( event, ui ) {
			var order_by = $('.modal .sort_group .sort.active').data('order');
			var order = null;
			if($('.modal .sort_group .sort.active').hasClass('desc')){
				order = 'desc';
			} else if($('.modal .sort_group .sort.active').hasClass('asc')) {
				order = 'asc';
			}
			ajaxRequest(order, order_by, true);
			} );
	});
	$('.filter').each(function(ind, el){
		var min = $(el).find('span:first-child input');
		var max = $(el).find('span:last-child input');
		var filter = $(el);
		min.change(function(){
			var currentInput = $(this).val();
			var fixedInput = null;
			if(!filter.hasClass('royalty')) {
				fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
			}
			else {
				fixedInput = currentInput.replace(/[A-Za-z!@#$^&*()]/g, '');
			}
			var maxInput = $(this).parent().next().find('input').val();
			maxInput = maxInput.replace(/\s/g, '');
			$(this).val(fixedInput);
			currentInput = $(this).val();
			currentInput = currentInput.replace(/\s/g, '');
			var sliderRange = $(this).closest('.filter').find('.slider-range');		
			if(currentInput > sliderRange.slider("values", 1)) {
				currentInput = sliderRange.slider("values", 1);
			}
			currentInput = currentInput < sliderRange.slider( "option", "min" ) ? sliderRange.slider( "option", "min" ) : currentInput;
			if(filter.hasClass('royalty')) {
				currentInput = parseInt(currentInput) + '%';
				maxInput = parseInt(maxInput);
				$(this).val(currentInput);
			} else {
				$(this).val(numberWithSpaces(currentInput));
			}			
			if(filter.hasClass('royalty')) {
				$(this).closest('.filter').find('.slider-range').slider( "option", "values", [ parseInt(currentInput), maxInput ] );
			}
			else {
				$(this).closest('.filter').find('.slider-range').slider( "option", "values", [ parseInt(currentInput), maxInput ] );
			}
			
		});
		max.change(function(){
			var currentInput = $(this).val();
			var fixedInput = null;
			if(!filter.hasClass('royalty')) {
				fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
			}
			else {
				fixedInput = currentInput.replace(/[A-Za-z!@#$^&*()]/g, '');
			}
			var minInput = $(this).parent().prev().find('input').val();
			minInput = minInput.replace(/\s/g, '');
			$(this).val(fixedInput);
			currentInput = $(this).val();
			currentInput = currentInput.replace(/\s/g, '');
			var sliderRange = $(this).closest('.filter').find('.slider-range');			
			if(currentInput < sliderRange.slider("values", 0)) {
				currentInput = sliderRange.slider("values", 0);
			}
			currentInput = currentInput > sliderRange.slider( "option", "max" ) ? sliderRange.slider( "option", "max" ) : currentInput;
			if(filter.hasClass('royalty')) {
				currentInput = parseInt(currentInput) + '%';
				minInput = parseInt(minInput);
				$(this).val(currentInput);
			}
			else {
				$(this).val(numberWithSpaces(currentInput));
			}						
			if(filter.hasClass('royalty')) {
				$(this).closest('.filter').find('.slider-range').slider( "option", "values", [ minInput, parseInt(currentInput) ] );
			}
			else {
				$(this).closest('.filter').find('.slider-range').slider( "option", "values", [ minInput, parseInt(currentInput) ] );
			}			
		});
	});
	
	$('#filter input[type=text], #filter input[type=checkbox]').change(function(){
		var order_by = $('.sort_group .sort.active').data('order');
		var order = null;
		if($('.sort_group .sort.active').hasClass('desc')){
			order = 'desc';
		} else if($('.sort_group .sort.active').hasClass('asc')) {
			order = 'asc';
		}
		ajaxRequest(order, order_by);
	});
	$('#filter_modal input[type=text], #filter_modal input[type=checkbox]').change(function(){
		var order_by = $('.modal .sort_group .sort.active').data('order');
		var order = null;
		if($('.modal .sort_group .sort.active').hasClass('desc')){
			order = 'desc';
		} else if($('.modal .sort_group .sort.active').hasClass('asc')) {
			order = 'asc';
		}
		ajaxRequest(order, order_by, true);
	});
	
	
	$('.content .sort_group .sort').click(function(){
		$('.content .sort_group .sort').each(function(ind, el){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		if($(this).hasClass('desc')){
			$(this).removeClass('desc');
			$(this).addClass('asc');
			ajaxRequest('ASC', $(this).data('order'));
		}
		else if($(this).hasClass('asc')){
			$(this).removeClass('asc');
			$(this).addClass('desc');
			ajaxRequest('DESC', $(this).data('order'));
		}
		else {
			$('.sort_group .sort').each(function(ind, el){
				$(this).removeClass('desc');
				$(this).removeClass('asc');
			});
			$(this).addClass('desc');
			ajaxRequest('DESC', $(this).data('order'));
		}		
	});

	$('.modal .form_wrap.sort .sort').click(function(){
		$('.modal .form_wrap.sort .sort').each(function(ind, el){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		if($(this).hasClass('desc')){
			$(this).removeClass('desc');
			$(this).addClass('asc');
		}
		else if($(this).hasClass('asc')){
			$(this).removeClass('asc');
			$(this).addClass('desc');
		}
		else {
			$('.modal .form_wrap.sort .sort').each(function(ind, el){
				$(this).removeClass('desc');
				$(this).removeClass('asc');
			});
			$(this).addClass('desc');
		}		
	});
	
	$('#filter').on('reset', function(e){
		resetSliders();
    	setTimeout(function() {
			var order_by = $('.sort_group .sort.active').data('order');
			var order = null;
			if($('.sort_group .sort.active').hasClass('desc')){
				order = 'desc';
			} else if($('.sort_group .sort.active').hasClass('asc')) {
				order = 'asc';
			}
			ajaxRequest(order, order_by);
		}, 1000);
	});

	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.filters .form.second').hide();
	
	var filter_pos = null;	
	if($('.mobile_filters_wrap').offset()) {
		filter_pos = $('.mobile_filters_wrap').offset().top;				
	}
	var consult_pos = null;
	if($('.single_product_page .consult_popup_wrap').offset()) {
		consult_pos = $('.single_product_page .consult_popup_wrap').offset().top;
	}
	var consult_desktop_pos = null;
	$count = 0;
	$(window).scroll(function(){
		if($count == 0){
			if($('.sidebar .consult_wrap').offset()) {
				consult_desktop_pos = $('.sidebar .consult_wrap').offset().top;
			}
			if($('.single_product_page .consult_popup_wrap').offset()) {
				consult_pos = $('.single_product_page .consult_popup_wrap').offset().top;
			}
			if($('.mobile_filters_wrap').offset()) {
				filter_pos = $('.mobile_filters_wrap').offset().top;				
			}
			$count++;
		}		
	    if(filter_pos < ($(window).scrollTop() + $('.header').height())) {
	    	$('.mobile_filters_wrap').addClass('fixed');
	    	$('.content .consult_popup_wrap').addClass('fixed');
	    }
	    if($(window).scrollTop() + $('.header').height() < filter_pos) {
	    	$('.mobile_filters_wrap').removeClass('fixed');
	    	$('.content .consult_popup_wrap').removeClass('fixed');
	    }
		if(consult_pos < $(window).scrollTop() + $('.header').height()) {
	    	$('.single_product_page .consult_popup_wrap').addClass('fixed');
	    }
		if($(window).scrollTop() + $('.header').height() < consult_pos) {
	    	$('.single_product_page .consult_popup_wrap').removeClass('fixed');
	    }
		if(consult_desktop_pos < $(window).scrollTop() + $('.header').height()) {
			var width = $('.sidebar .consult_wrap').width();	    		
	    	if($('.sidebar').innerHeight() - $('.sidebar .consult_wrap').outerHeight(true) - $('.sidebar form').height() >= $('.sidebar .consult_wrap').outerHeight(true)/4) {
	    		$('.sidebar .consult_wrap').addClass('fixed');
	    		$('.sidebar .consult_wrap').width(width);
	    	}				
	    }

		if($(window).scrollTop() + $('.header').height() < consult_desktop_pos ) {
	    	$('.sidebar .consult_wrap').removeClass('fixed');
			$('.sidebar .consult_wrap').width('100%');
	    }
	    if($('.sidebar .consult_wrap').offset()) {
	    	if($('.sidebar .consult_wrap').offset().top + $('.sidebar .consult_wrap').height() > $('.content_wrap').offset().top + $('.content_wrap').innerHeight()) {	
		    	$('.sidebar .consult_wrap').removeClass('fixed');
		    	$('.sidebar').css('justify-content', 'space-between');
		    }
		    if($(window).scrollTop() < $('.sidebar .consult_wrap').offset().top) {
		    	$('.sidebar').css('justify-content', 'stretch');
		    }
	    }    
	   
	});

	$('.product_gallery_for').slick({
        dots: false,
		arrows: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        infinite: true,        
        responsive: [
        	{
        		breakpoint: 541,
        		settings: {
        			arrows: false,
        			dots: true,
        			centerMode: true,        			
        			centerPadding: '20px'
        		}        		
        	}
        ],
		asNavFor: '.product_gallery_nav',
      });
	$('.product_gallery_nav').slick({
		focusOnSelect: true,
        dots: false,
		arrows: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll:5,
        infinite: true,
        centerMode: true,
        centerPadding: 0,
        asNavFor: '.product_gallery_for'
      });

	$().fancybox({
	  selector : '.post_gallery_for .slick-slide:not(.slick-cloned) a[data-fancybox]',
	  backFocus : false,
	  afterShow : function( instance, current ) {
	    current.opts.$orig.closest(".post_gallery_for.slick-initialized").slick('slickGoTo', parseInt(current.index), true);
	  }
	});
	
	$('.post_gallery_for').slick({
		accessibility: false,
        dots: false,
		arrows: true,
        speed: 300,
        slidesToShow: 1,
        infinite: true,
        slidesToScroll:1,
		asNavFor: '.post_gallery_nav',
        responsive: [
        	{
        		breakpoint: 541,
        		settings: {
        			arrows: false,
        			dots: true,
        			centerMode: true,        			
        			centerPadding: '20px'
        		}        		
        	}
        ]
      });
	$('.post_gallery_nav').slick({
		focusOnSelect: true,
		accessibility: false,
        dots: false,
		arrows: false,
		infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll:1,
        centerMode: true,
        centerPadding: 0,
        asNavFor: '.post_gallery_for'
      });
	
	$('.similar_posts_slider_for').slick({
        dots: true,
		arrows: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        infinite: true,
        asNavFor: '.similar_posts_slider_nav'
      });
	$('.similar_posts_slider_nav').slick({
        dots: false,
		arrows: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        infinite: true,
        asNavFor: '.similar_posts_slider_for'
      });
	
	$('.product_tabs').tabs();

	$('.single_product_page .comment_slider').on('init', function (event, slick, direction) {
	    // check to see if there are one or less slides
	    if (($('.single_product_page .comment_slider .comment_slide').length <= 1)) {
	        // remove arrows
	        $('.single_product_page .comment_slider .slick-dots').hide();
	    }
	});
	
	$('.single_product_page .comment_slider').slick({
	    dots: true,
		arrows: true,
	    speed: 300,
	    slidesToShow: 1,
	    slidesToScroll:1,
	    infinite: true,
	    responsive: [
        	{
        		breakpoint: 769,
        		settings: {
        			arrows: false
        		}        		
        	}
        ]
	 });

	$('.single_product_page .product_list').slick({
	    dots: true,
		arrows: true,
	    speed: 300,
	    slidesToShow: 3,
	    slidesToScroll:3,
	    infinite: true,
		responsive: [
        	{
        		breakpoint: 1025,
        		settings: {
        			slidesToShow: 2,
					slidesToScroll:2
        		}        		
        	},
			{
        		breakpoint: 541,
        		settings: {
					arrows: false,
        			slidesToShow: 1,
					slidesToScroll:1,
					centerMode: true,
					centerPadding: '20px'
        		}        		
        	}
        ]
	 });

	$('.single_post_page .product_list').slick({
	    dots: true,
		arrows: true,
	    speed: 300,
	    slidesToShow: 3,
	    slidesToScroll:3,
	    infinite: true,
		responsive: [
        	{
        		breakpoint: 1025,
        		settings: {
        			slidesToShow: 2,
					slidesToScroll:2
        		}        		
        	},
			{
        		breakpoint: 541,
        		settings: {
					arrows: false,
        			slidesToShow: 1,
					slidesToScroll:1,
					centerMode: true,
					centerPadding: '20px'
        		}        		
        	}
        ]
	 });
	$('.product_tabs ul li:last-child a').click(function(e) {
		e.preventDefault();
	  	var href = $(this).attr('href');
	  	$(this).closest('.product_tabs').find(href).find('.comment_slider').slick('setPosition');
		$(this).closest('.product_tabs').find(href).find('.comment_slider').slick('slickGoTo', 0); 
		$(this).closest('.product_tabs').find(href).find('.comment_slider').resize();
	});	

	
	$('.form_wrap.order .wpcf7, .form_wrap.leave_order .wpcf7, .form_wrap.consult .wpcf7,.form_wrap.more .wpcf7, .form_wrap.download .wpcf7,.form_wrap.download_report .wpcf7,.form_wrap.download_plan .wpcf7,.form_wrap.subscribe .wpcf7').each(function(ind, el){
		el.addEventListener( 'wpcf7submit', function( event ) {
		  	var name = $(el).find('input[type=text]').val();
			var email = $(el).find('input[type=email]').val();
			var tel = $(el).find('input[type=tel]').val();
			var data = {
				action: 'action_ammo',
				name: name,
				email: email,
				tel: tel
			}
			$.get('/wp-admin/admin-ajax.php', data, function(response) {
                var data = jQuery.parseJSON(response);
                console.log(data);
            }).done(function () {
            });
		}, false );
	});

});

$(window).scroll(function(){
  if($(window).scrollTop() >= 50) {
      $('.header').addClass('fixed');
    }
    else {
      $('.header').removeClass('fixed');
    }
});

$('.form_wrap.subscribe_mailing .wpcf7,.form_wrap.subscribe_form .wpcf7').each(function(ind, el){
	el.addEventListener( 'wpcf7mailsent', function( event ) {
			var email = $(el).find('input[type=email]').val();
			$.post('http://api.unisender.com/ru/api/subscribe?format=json&api_key=5rzms38bjo4iw8atnhjwz5ud16cripunuwyom4xa&list_ids=19473609&fields[email]=' + email+'&double_optin=0&overwrite=0', function(response) {
                console.log(response);
            });
	    $('.modal').addClass('open');
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks').show();
	    $('body').css('overflow-y','hidden');
	}, false );
});

$('.modal .modal_sandbox, .modal .form .close').click(function(){
	$('.modal').removeClass('open');
	$('.modal .form_wrap.filters .form.second').hide('slow');
	$('.modal .form_wrap.filters .form.first').show('slow');
    $('body').css('overflow-y','auto');
});

$('.download_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.download').show();	
    $('body').css('overflow-y','hidden');
});

$('.order_call').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.order').show();
    $('body').css('overflow-y','hidden');
});
if($('.modal .form_wrap.order .wpcf7')[0]) {
	$('.modal .form_wrap.order .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}
if($('.modal .form_wrap.leave_order .wpcf7')[0]) {
	$('.modal .form_wrap.leave_order .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}
if($('.modal .form_wrap.consult .wpcf7')[0]) {
	$('.modal .form_wrap.consult .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}
if($('.modal .form_wrap.download .wpcf7')[0]) {
	$('.modal .form_wrap.download .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {		
		$('.modal .form_wrap.download .download_hidden').get(0).click();
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}
if($('.modal .form_wrap.subscribe .wpcf7')[0]) {
	$('.modal .form_wrap.subscribe .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {		
		$('.modal .form_wrap.subscribe .download_hidden').get(0).click();
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}
if($('.modal .form_wrap.download_report .wpcf7')[0]) {
	$('.modal .form_wrap.download_report .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {		
		$('.modal .form_wrap.download_report .download_hidden').get(0).click();
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}
if($('.modal .form_wrap.download_plan .wpcf7')[0]) {
	$('.modal .form_wrap.download_plan .wpcf7')[0].addEventListener( 'wpcf7mailsent', function( event ) {		
		$('.modal .form_wrap.download_plan .download_hidden').get(0).click();
	    $('.modal .form_wrap').hide();
	    $('.modal .form_wrap.thanks_order').show();
	}, false );
}

$('.subscribe_popup').click(function(e){
	e.preventDefault();
	var filePath = $(e.target).attr('href');	
	var fileSize = $(e.target).data('size');
	$('.modal .form_wrap.subscribe').find('.pdf').text('PDF ' + fileSize);
	$('.modal .form_wrap.subscribe').find('.download_hidden').prop('href', filePath);
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.subscribe').show();	
    $('body').css('overflow-y','hidden');
});
$('.download_report_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.download_report').show();	
    $('body').css('overflow-y','hidden');
});
$('.download_plan_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.download_plan').show();	
    $('body').css('overflow-y','hidden');
});

$('.currency_switch a').click(function(){
	$('.currency_switch a').removeClass('active');
	$(this).addClass('active');
	return false;
});

$('.consult_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.consult').show();
	$('.modal .form_wrap.consult .consult_slider').slick('setPosition');
	$('.modal .form_wrap.consult .consult_slider').slick('slickGoTo', 0);
    $('body').css('overflow-y','hidden');
});
$('.filters_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.filters').show();	
	$('.modal .form_wrap.filters .form.first').show();	
	$('.modal .slider-range').each(function(ind, el){		
		$(el).draggable();	
		var value1 = $(el).slider("values", 0);				
		$(el).prev('.filter_inputs').find('span:first-child input').val(numberWithSpaces(value1));
		var value2 = $(el).slider("values", 1);	
		$(el).prev('.filter_inputs').find('span:last-child input').val(numberWithSpaces(value2));
		if($(el).closest('.filter').hasClass('royalty')) {
			$(el).prev('.filter_inputs').find('span:first-child input').val(value1+'%');
			$(el).prev('.filter_inputs').find('span:last-child input').val(value2+'%');
		}
		$(el).on( "slide", function( event, ui ) {
			$(el).prev('.filter_inputs').find('span:first-child input').val(numberWithSpaces(ui.values[0]));
			$(el).prev('.filter_inputs').find('span:last-child input').val(numberWithSpaces(ui.values[1]));
			if($(el).closest('.filter').hasClass('royalty')) {
				$(el).prev('.filter_inputs').find('span:first-child input').val(ui.values[0]+'%');
				$(el).prev('.filter_inputs').find('span:last-child input').val(ui.values[1]+'%');
			}
		} );
		$(el ).on( "slidestop", function( event, ui ) {
			var order_by = $('.modal .sort_group .sort.active').data('order');
			var order = null;
			if($('.modal .sort_group .sort.active').hasClass('desc')){
				order = 'desc';
			} else if($('.modal .sort_group .sort.active').hasClass('asc')) {
				order = 'asc';
			}
			// ajaxRequest(order, order_by, true);
			} );
	});
    $('body').css('overflow-y','hidden');
});

$('.modal .form_wrap.filters .hide_filter').click(function(){
	$('.modal .form_wrap.filters .form.second').hide('slow');
	$('.modal .form_wrap.filters .form.first').show('slow');
	$('.modal').removeClass('open');
    $('body').css('overflow-y','auto');
});

$('.modal .form_wrap.filters .form.second .close').click(function(){
	console.log('here');
	$('.modal .form_wrap.filters .form.second').hide();
	$('.modal .form_wrap.filters .form.first').show();
});

$('.modal .form_wrap.filters form').submit(function(e){
	e.preventDefault();
	$('.modal .form_wrap.filters .form.second').hide('slow');
	$('.modal .form_wrap.filters .form.first').show('slow');
	$('.modal').removeClass('open');
    $('body').css('overflow-y','auto');
});


$('#filter_modal').on('reset', function(e){
	resetModalSliders();
});

$('.category_popup').click(function(){
	$('.modal .form_wrap.filters .form.first').hide();
	$('.modal .form_wrap.filters .form.second').show();
});

$('.category_close').click(function(){
	$('.modal .form_wrap.filters .form.second').hide();
	$('.modal .form_wrap.filters .form.first').show();
});

$('.sort_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.sort').show();
    $('body').css('overflow-y','hidden');
});
$('.order_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.leave_order').show();
    $('body').css('overflow-y','hidden');
});

$('.modal .form_wrap.sort .hide_sort').click(function(){
	$('.modal').removeClass('open');
    $('body').css('overflow-y','auto');
});

$('.modal .form_wrap.sort .apply').click(function(){
	var orderby = 'price';
	var order = 'desc';
	$('.modal .form_wrap.sort .sort').each(function(ind, el){
		if($(el).hasClass('active')){
			orderby = $(el).data('order');
			if($(el).hasClass('asc')){
				order = 'asc';
			}
		}
	});
	ajaxRequest(order, orderby, true);
	$('.modal').removeClass('open');
    $('body').css('overflow-y','auto');
});

$('.review_popup').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.add_review').show();
    $('body').css('overflow-y','hidden');
});

$('.modal .form_wrap.add_review .wpcf7-acceptance input').change(function(){
	if(!$(this).is(':checked')) {
		$('.modal .form_wrap.add_review input[type=submit]').addClass('disabled').prop('disabled', true);
	}
	else {
		$('.modal .form_wrap.add_review input[type=submit]').removeClass('disabled').prop('disabled', false);
	}
});

$('.load_more_posts').click(function(e){
	e.preventDefault();
	var button = $(this),
	    data = {
		'action': 'loadmore',
		'query': query_vars, // that's how we get params from wp_localize_script() function
		'page' : current_page
	};
	$.ajax({ 
		url : custom.ajaxurl, // AJAX handler
		data : data,
		type : 'POST',
		beforeSend : function ( xhr ) {
			button.find('span').text('Загрузка...'); 
		},
		success : function( data ){
			if( data ) { 
				$(data).insertBefore(button.parent());
				button.find('span').text('Смотреть больше постов');
				current_page++;

				if (current_page == max_num_pages ) 
					button.remove(); // if last page, remove the button

				// you can also fire the "post-load" event here if you use a plugin that requires it
				// $( document.body ).trigger( 'post-load' );
			} else {
				button.remove(); // if no data, remove the button as well
			}
		}
	});
});

$('a.subscribe').click(function(e){
	e.preventDefault();
	$('.modal').addClass('open');
	$('.modal .form_wrap').hide();
	$('.modal .form_wrap.subscribe_mailing').show();
    $('body').css('overflow-y','hidden');
});

