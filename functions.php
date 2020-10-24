<?php 
function enqueue_styles() {
  wp_register_style('awesomefont_style', get_template_directory_uri() .'/css/font-awesome.css', false, '0.1');
  wp_enqueue_style('awesomefont_style');  
  wp_enqueue_style('fancybox_style', get_template_directory_uri() .'/css/jquery.fancybox.min.css');
  wp_enqueue_style('normalize_style', get_template_directory_uri() .'/css/normalize.css');
  wp_enqueue_style('slick_style', get_template_directory_uri() .'/css/slick.css');
  wp_enqueue_style('slick_theme_style', get_template_directory_uri() .'/css/slick-theme.css');
  wp_enqueue_style('jquery_ui_style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
  
  wp_enqueue_style( 'theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_styles');


add_action( 'wp_enqueue_scripts', 'get_custom' );
function get_custom(){
  global $wp_query;
	wp_enqueue_script('custom', get_template_directory_uri() .'/js/custom.js', array('jquery'), false, true);
	wp_localize_script( 'custom', 'custom', array( 
    'lang_name' => '', 
    'pagename' => get_query_var('pagename'),
    'posts_per_page' => 10,
    'current_page' => 1,
    'query' =>'',
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
  ) );
}

function enqueue_scripts () {
  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js');
  wp_enqueue_script( 'jquery' );
	
  wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), false, true);
  wp_enqueue_script('touch-punch', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', array('jquery'), false, true);	
  wp_enqueue_script('fancybox', get_template_directory_uri() .'/js/jquery.fancybox.min.js', array('jquery'), false, true);
  wp_enqueue_script('slick', get_template_directory_uri() .'/js/slick.min.js', array('jquery'), false, true);      
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

function new_excerpt_length($length) {
  return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_filter('excerpt_more', function($more) {
  return '';
});

function new_more_text( $more_link, $more_link_text ) {
  $new = ''; // вписываем своё
  return str_replace( $more_link_text, $new, $more_link );
}
add_filter( 'the_content_more_link', 'new_more_text', 10, 2 );


function spectrum_setup () {

  load_theme_textdomain('spectrum', get_template_directory() . '/languages');
  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'widgets' );

  add_image_size( 'product_grid', 564, 385, true );
  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'spectrum' ),
    'footer' => __('Footer Menu', 'spectrum')
  ) );

}

add_action( 'after_setup_theme', 'spectrum_setup' );

function pagination($pages = '', $range = 4) {  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         
         if($paged > 15 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         echo "<a href='".get_pagenum_link($paged - 1)."' class=\"pagi-nav\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i></a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current-pagi\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         echo "<a href=\"".get_pagenum_link($paged + 1)."\" class=\"pagi-nav\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         
     }
}


function dimox_breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home'] = 'Главная'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<div class="breadcrumbs">'; // открывающий тег обертки
  $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep = '/'; // разделитель между "крошками"
  $sep_before = '<span class="sep">'; // тег перед разделителем
  $sep_after = '</span>'; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
  $before = '<span class="current">'; // тег перед текущей "крошкой"
  $after = '</span>'; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_link = home_url('/');
  $link_before = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
  $link_after = '</span>';
  $link_attr = ' itemprop="url"';
  $link_in_before = '<span itemprop="title">';
  $link_in_after = '</span>';
  $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
  $frontpage_id = get_option('page_on_front');
  $parent_id = $post->post_parent;
  $sep = ' ' . $sep_before . $sep . $sep_after . ' ';

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . '<a href="' . $home_link . '">' . $text['home'] . '</a>' . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo sprintf($link, $home_link, $text['home']);

    if ( is_category() ) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if ( get_query_var('paged') ) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif ( is_search() ) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif ( is_day() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ($show_home_link) echo $sep;
      if ( get_post_type() != 'post' ) {
        // var_dump( get_terms(array('taxonomy' => 'service_type')));
        $terms = get_object_taxonomies($post);
        // var_dump($post);
        // var_dump(get_term_link($terms[1]));
        // var_dump(get_post_type_archive_link(get_post_type()));
        // $post_type = get_post_type_object(get_post_type());
        
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
        if ( get_query_var('cpage') ) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

    // custom post type
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      if ( get_query_var('paged') ) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif ( is_attachment() ) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      if ( get_query_var('paged') ) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif ( is_author() ) {
      global $author;
      $author = get_userdata($author);
      if ( get_query_var('paged') ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif ( is_404() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} // end of dimox_breadcrumbs()


add_action('wp_ajax_myfilter', 'custom_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'custom_filter_function');
 
function custom_filter_function(){ 

  $args = array(
	 'orderby'   => 'meta_value_num',
    'meta_key'  => $_POST['orderBy'],
    'order' => $_POST['order']
  );
	if($_POST['orderBy']== 'new'){
		$args['orderby'] = 'meta_value';
	}
    $args['meta_query'][] = array(
      'key' => 'price',
      'value' => array( $_POST['min_price'], $_POST['max_price'] ),
      'type' => 'numeric',
      'compare' => 'between'
    );
    $args['meta_query'][] = array(
      'key' => 'vznos',
      'value' => array( $_POST['min_vznos'], $_POST['max_vznos'] ),
      'type' => 'numeric',
      'compare' => 'between'
    );
    $args['meta_query'][] = array(
      'key' => 'royalty',
      'value' => array( (int)$_POST['min_royalty'], (int)$_POST['max_royalty'] ),
      'type' => 'numeric',
      'compare' => 'between'
    );
    $args['meta_query'][] = array(
      'key' => 'investments',
      'value' => array( $_POST['min_investments'], $_POST['max_investments'] ),
      'type' => 'numeric',
      'compare' => 'between'
    );
    $args['meta_query'][] = array(
      'key' => 'income',
      'value' => array( $_POST['min_income'], $_POST['max_income'] ),
      'type' => 'numeric',
      'compare' => 'between'
    );
 
    $cats = get_terms(array('taxonomy' => 'product_category','hide_empty' => false));
    $terms;
    foreach ($cats as $cat) {
      if(isset( $_POST[$cat->slug] ) && $_POST[$cat->slug] == 'on') {
        $terms[] = $cat->slug;
      }
    }

    if(!empty($terms)){
        $args['tax_query'] = array(
        array(
          'taxonomy' => 'product_category',
          'field' => 'slug',
          'terms' => $terms
        )
      );
    }  			
          
          $args['post_type'] = 'product';
          $args['posts_per_page'] = -1;

            $query = new WP_Query($args);

            /* PageNavi at Top */
            if ( $query->have_posts() ) : 
              $counter = 0;
              ?>
			<?php ob_start();?>
             <?php while ( $query->have_posts() ) : $query->the_post(); 
                $counter ++;
              ?>
              <div class="product d-flex"  id="<?php the_ID()?>">
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
                    <button class="btn subscribe_popup">Получить презентацию</button>
                  </div>
                </div>              
              </div>
              <?php 
                if($_POST['pagename'] == 'katalog' && $counter == 8): ?>
                  <section class="form_wrap catalog">
                    <div class="container d-flex">
                      <div class="form_wrap_left">
                        <div class="section_title">
                          <?php the_field('form_section_title', 193)?>
                        </div>
                        <div class="form">
                          <?php echo do_shortcode('[contact-form-7 id="5" title="Форма на главной"]')?>
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
              <?php wp_reset_postdata();
            endif;
	        $my_html = ob_get_contents();
				ob_end_clean();
	       wp_send_json_success( array('page'=>$my_html, 'query'=> json_encode($query->query_vars), 
          'found_posts' => $query->found_posts
        ));
  die();
}


add_filter('comment_form_default_fields', 'website_remove');

function website_remove($fields)
{
  if(isset($fields['url'])): 
    unset($fields['url']);
  endif;
  return $fields;
}

function comment_field( $fields ) {
 
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );

    $placeholder = "Отзыв";

    $fields['comment'] = '<p class="textarea"><textarea id="comment" name="comment" data-autoresize cols="45" rows="1" maxlength="65525" placeholder="'.$placeholder.'"></textarea></p>';
    return $fields;
 
}
add_filter( 'comment_form_fields', 'comment_field', 10, 1 );

add_action( 'comment_form_logged_in_after', 'modal_comment_form_fields' );
add_action( 'comment_form_after_fields', 'modal_comment_form_fields' );

function modal_comment_form_fields () {
  ?>
  <p class="comments-pluses">
    <span class="pluses-container">
      <textarea id="pluses" name="pluses" cols="45" data-autoresize rows="1" maxlength="65525" placeholder="Плюсы франшизы"></textarea>
    </span>
  </p>
  <p class="comments-minuses">
    <span class="pluses-container">
      <textarea id="minuses" name="minuses" cols="45" data-autoresize rows="1" maxlength="65525" placeholder="Минусы франшизы"></textarea>
    </span>
  </p>
  <?php
}


add_action( 'comment_post', 'comment_form_save_comment_meta' );
function comment_form_save_comment_meta( $comment_id ) {
	if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) ):
		$rating = intval( $_POST['rating'] );	
		add_comment_meta( $comment_id, 'rating', $rating );
	endif;
	if ( ( isset( $_POST['pluses'] ) ) && ( '' !== $_POST['pluses'] ) ):
		add_comment_meta( $comment_id, 'pluses', $_POST['pluses'] );	
	endif;
	if ( ( isset( $_POST['minuses'] ) ) && ( '' !== $_POST['minuses'] ) ):
		add_comment_meta( $comment_id, 'minuses', $_POST['minuses'] );	
	endif;
	update_post_meta( $_POST['post_id'], 'rating', $_POST['rating'] );
} 
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo '<span>'. $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ] . '</span>';
}

//Get the average rating of a post.
function comment_rating_get_average_ratings( $id ) {
  $comments = get_approved_comments( $id );

  if ( $comments ) {
    $i = 0;
    $total = 0;
    foreach( $comments as $comment ){
      $rate = get_comment_meta( $comment->comment_ID, 'rating', true );
      if( isset( $rate ) && '' !== $rate ) {
        $i++;
        $total += $rate;
      }
    }

    if ( 0 === $i ) {
      return false;
    } else {
      return round( $total / $i, 0 );
    }
  } else {
    return false;
  }
}


function comment_rating_display_average_rating() {
  
  global $post;    
  
  $stars   = '';
  $average = comment_rating_get_average_ratings( $post->ID );

  if($average != false) {
    for ( $i = 1; $i <= $average; $i++ ) {
      $stars .= '<span class="rating_star filled"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="1" d="M11 0L13.9222 6.97787L21.4616 7.60081L15.7283 12.5363L17.4656 19.8992L11 15.9716L4.53436 19.8992L6.2717 12.5363L0.538379 7.60081L8.07775 6.97787L11 0Z" fill="#FCB810"/></svg></span>';
    }
    for ( $i = $average; $i < 5; $i++ ) {
      $stars .= '<span class="rating_star empty"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M11 0L13.9222 6.97787L21.4616 7.60081L15.7283 12.5363L17.4656 19.8992L11 15.9716L4.53436 19.8992L6.2717 12.5363L0.538379 7.60081L8.07775 6.97787L11 0Z" fill="#969696"/></svg></span>';
    }
  } 
  
  $custom_content  = '<span class="average_rating">' . $stars .'</span>';
  echo $custom_content;
}
function display_product_rating() {

  global $post;

  $rating = get_field('rating');
  
  $stars   = '';

  if($rating == 0) {
    for ( $i = 0; $i < 5; $i++ ) {
      $stars .= '<span class="rating_star empty"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M11 0L13.9222 6.97787L21.4616 7.60081L15.7283 12.5363L17.4656 19.8992L11 15.9716L4.53436 19.8992L6.2717 12.5363L0.538379 7.60081L8.07775 6.97787L11 0Z" fill="#969696"/></svg></span>';
    }
  }

  if($rating > 0) {
    for ( $i = 1; $i <= $rating; $i++ ) {
      $stars .= '<span class="rating_star filled"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="1" d="M11 0L13.9222 6.97787L21.4616 7.60081L15.7283 12.5363L17.4656 19.8992L11 15.9716L4.53436 19.8992L6.2717 12.5363L0.538379 7.60081L8.07775 6.97787L11 0Z" fill="#FCB810"/></svg></span>';
    }
    for ( $i = $rating; $i < 5; $i++ ) {
      $stars .= '<span class="rating_star empty"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M11 0L13.9222 6.97787L21.4616 7.60081L15.7283 12.5363L17.4656 19.8992L11 15.9716L4.53436 19.8992L6.2717 12.5363L0.538379 7.60081L8.07775 6.97787L11 0Z" fill="#969696"/></svg></span>';
    }
  } 
  
  $custom_content  = '<span class="average_rating">' . $stars .'</span>';
  echo $custom_content;
}

add_shortcode( 'quotes', 'quotes_func' );
function quotes_func( $atts, $content ){
  // белый список параметров и значения по умолчанию
  $atts = shortcode_atts( array(
    'name' => '',
    'position' => '',
    'photo' => ''
  ), $atts );

 
  $html = '<div class="quotes">
    <div class="photo">      
        <img src=" '. esc_url($atts['photo']). '">
    </div>
    <div class="quotes_content">
      <div class="text">' .$content. ' </div>
      <div class="info">
        <span>' .$atts['name'] . '</span>
        <span>, '.$atts['position'] .'</span>
      </div>
    </div>
  </div>';

  return $html;
}

add_shortcode( 'post-gallery', 'gallery_func' );
function gallery_func( $atts, $content ){

  $atts = shortcode_atts( array(
  ), $atts );

  ob_start();
  ?>
  <div class="post_gallery">
    <div class="post_gallery_for">
      <?php 
        if(have_rows('gallery')):
          while(have_rows('gallery')): the_row();?>
            <div class="gallery_slide">
              <div class="thumb">
                <a href="<?php echo get_sub_field('image')?>" data-fancybox="gallery">
                  <img src="<?php echo get_sub_field('image')?>">
                </a>                
              </div>
            </div>
          <?php endwhile;
        endif;
      ?>
    </div>
    <div class="post_gallery_nav">
      <?php 
        if(have_rows('gallery')):
          while(have_rows('gallery')): the_row();?>
            <div class="gallery_slide">
              <div class="thumb">
                <img src="<?php echo get_sub_field('image')?>">
              </div>
            </div>
          <?php endwhile;
        endif;
      ?>
    </div>
  </div>  
  <?php 
  $html = ob_get_contents();
  ob_clean();
  return $html;
}
function blog_loadmore_ajax_handler(){
 
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 		$counter = 0;
		$posts_count = $wp_query->post_count;		
		while( have_posts() ): the_post();
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
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'blog_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'blog_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


 // add_action( 'wpcf7_mail_sent', 'wpcf7_get_unisender' );
 //    function wpcf7_get_unisender( $contact_form ) {
 //        $title = $contact_form->title;
 //        if ( 'Подписаться' == $title || 'Подписаться на рассылку'== $title) { // сравниваем название формы с нужной
       
 //            $submission = WPCF7_Submission::get_instance(); 
 //            $posted_data = & $submission->get_posted_data();
 //                //далее мы перехватывает те поля из формы, которые хотим отправить в унисендер
 //            $email = $posted_data['email-307']; //перехватываем поле [your-name]
 //            file_get_contents('http://api.unisender.com/ru/api/subscribe?format=json&api_key=5rzms38bjo4iw8atnhjwz5ud16cripunuwyom4xa&list_ids=19473609&fields[email]='.$email.'&double_optin=0&overwrite=0');
 //        }
 //    }


// add_action('init', function() {
//   if ( function_exists( 'pll_register_string' ) ) {
//     pll_register_string('catalog_download', 'Скачать каталог');
//     pll_register_string('available_to', 'Предложение действительно до');
//     pll_register_string('vznos', 'Вступительный взнос');
//     pll_register_string('royalty', 'Роялти');
//     pll_register_string('from_income', 'от выручки');
//     pll_register_string('investments', 'Инвестиции');
//     pll_register_string('income', 'Прибыль');
//     pll_register_string('price', 'Цена');
//     pll_register_string('filter', 'Фильтр');
//     pll_register_string('sorting', 'Сортировка');
//     pll_register_string('business_sphere', 'Сфера бизнеса');
//     pll_register_string('consult_order', 'Заказать консультацию');
//     pll_register_string('found', 'Найдено');
//     pll_register_string('project1_name', 'проект');
//     pll_register_string('project2_name', 'проекта');
//     pll_register_string('project3_name', 'проектов');
//     pll_register_string('view1_name', 'просмотр');
//     pll_register_string('view2_name', 'просмотра');
//     pll_register_string('view3_name', 'просмотров');
//     pll_register_string('sort_by', 'сортировать по:');
//     pll_register_string('sort_by_price', 'ценe');
//     pll_register_string('sort_by_rating', 'рейтингу');
//     pll_register_string('sort_by_new', 'новизне');
//     pll_register_string('sort_by_payback', 'окупаемости');
//     pll_register_string('new', 'новинка');
//     pll_register_string('hit', 'хит продаж');
//     pll_register_string('sold', 'Продано');
//     pll_register_string('times', 'раз');
//     pll_register_string('get_presentation', 'Получить презентацию');
//     pll_register_string('show_more', 'Показать еще');
//     pll_register_string('latest_from_blog', 'Последнее из блога');
//     pll_register_string('see_more_posts', 'Смотреть больше постов');
//     pll_register_string('clear_filter', 'очистить фильтр');
//     pll_register_string('rss_subscribe', 'Подписка через RSS');
//     pll_register_string('order_call', 'Заказать звонок');
//     pll_register_string('mailing_subcribe', 'Подписка на рассылку');
//     pll_register_string('thank_for_subscribe', 'Спасибо за подписку!');
//     pll_register_string('we_sent_mail', 'Мы уже отправили вам первое письмо — пожалуйста, проверьте почту и подвердите рассылку');
//     pll_register_string('thank_for_order', 'Спасибо за заявку!');
//     pll_register_string('our_spec', 'Наш специалист перезвонит ближайшее время, чтобы ответить на все интересующие вопросы!');
//     pll_register_string('consult_to_order', 'Заказ консультации');
//     pll_register_string('choose_spec', 'Выберите специалиста и он перезвонит ближайшее время, чтобы ответить на все интересующие вопросы');
//     pll_register_string('franchise_service', 'Сервис по выбору проверенных франшиз');
//     pll_register_string('choose', 'Выбрать');
//     pll_register_string('show', 'Показать');
//     pll_register_string('hide_filter', 'Скрыть фильтр');
//     pll_register_string('back_to_filter', 'Вернуться к фильтру');
//     pll_register_string('apply', 'Применить');
//     pll_register_string('hide', 'Скрыть');
//     pll_register_string('review_on_site', 'Отзыв на сайт');
//     pll_register_string('write_your_review', 'Напишите свой отзыв о бизнесе по франшизе, и после проверки модератором он появится на сайте');
//     pll_register_string('similar_posts', 'Похожие статьи');
//     pll_register_string('interesting_offers', 'Интересные предложения');
//     pll_register_string('know_new', 'Узнавайте о новых проектах первым');
//     pll_register_string('before_publication', 'Перед публикацией проектов на сайте мы рассылаем предложения по своей клиентской базе. Подпишитесь на нашу рассылку, чтобы получать выгодные предложения в числе первых');
//     pll_register_string('download_financial', 'Скачать финансовый отчет');
//     pll_register_string('download_bus_plan', 'Скачать бизнес-план');
//     pll_register_string('pluses', 'Плюсы');
//     pll_register_string('misuses', 'Минусы');
//     pll_register_string('add_review', 'Добавить отзыв');
//     pll_register_string('leave_order', 'Оставить заявку');
//     pll_register_string('more_about_project', 'Подробнее о проекте');
//     pll_register_string('fill_the_form', 'Заполните форму ниже и наш куратор свяжется с вами в ближайшее время.');
//     pll_register_string('similar_offers', 'Похожие предложения');
//     pll_register_string('loading', 'Загрузка...');   

//   }
// });

function myfeed_request($qv) {
    if (isset($qv['feed']))
        $qv['post_type'] = get_post_types();
    return $qv;
}
add_filter('request', 'myfeed_request');

/*Ammo crm */

add_action('wp_ajax_action_ammo','action_ammo');
add_action('wp_ajax_nopriv_action_ammo','action_ammo');

function action_ammo(){
  $responsible_user_id = 215309; //id ответственного по сделке, контакту, компании
  $lead_name = 'Заявка с сайта'; //Название добавляемой сделки
  $lead_status_id = '7087609'; //id этапа продаж, куда помещать сделку
  $contact_name = $_GET['name'];//Название добавляемого контакта
  $contact_email = '';
  if(isset($_GET['email'])) {
    $contact_email = $_GET['email'];//Email контакта
  } 
  $contact_phone = $_GET['tel']; //Телефон контакта
  //АВТОРИЗАЦИЯ
  $user=array(
    'USER_LOGIN'=>'info@spectrum-biz.com', #Your login (email)
    'USER_HASH'=>'3a68d12b8efaa53678ded65a87e42cb192d88b19' #Hash for API access (see user profile)
  );
  $subdomain='infospectrumbizcom'; #Our account is a subdomain
  #Form a link to request
  $link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';
  $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
  #Устанавливаем необходимые опции для сеанса cURL
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
  curl_setopt($curl,CURLOPT_URL,$link);
  curl_setopt($curl,CURLOPT_POST,true);
  curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($user));
  curl_setopt($curl,CURLOPT_HEADER,false);
  curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
  $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
  $code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
  curl_close($curl);  #Завершаем сеанс cURL
  $Response=json_decode($out,true);
  //echo '<b>Авторизация:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';
  //ПОЛУЧАЕМ ДАННЫЕ АККАУНТА
  $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/accounts/current'; #$subdomain уже объявляли выше
  $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
  #Устанавливаем необходимые опции для сеанса cURL
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
  curl_setopt($curl,CURLOPT_URL,$link);
  curl_setopt($curl,CURLOPT_HEADER,false);
  curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
  $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
  $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
  curl_close($curl);
  $Response=json_decode($out,true);
  $account=$Response['response']['account'];
  //echo '<b>Данные аккаунта:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';
  //ПОЛУЧАЕМ СУЩЕСТВУЮЩИЕ ПОЛЯ
  $amoAllFields = $account['custom_fields']; //Все поля
  $amoConactsFields = $account['custom_fields']['contacts']; //Поля контактов
  //echo '<b>Поля из амо:</b>'; echo '<pre>'; print_r($amoConactsFields); echo '</pre>';
  //ФОРМИРУЕМ МАССИВ С ЗАПОЛНЕННЫМИ ПОЛЯМИ КОНТАКТА
  //Стандартные поля амо:
  $sFields = array_flip(array(
      'PHONE', //Телефон. Варианты: WORK, WORKDD, MOB, FAX, HOME, OTHER
      'EMAIL' //Email. Варианты: WORK, PRIV, OTHER
    )
  );
  //Проставляем id этих полей из базы амо
  foreach($amoConactsFields as $afield) {
    if(isset($sFields[$afield['code']])) {
      $sFields[$afield['code']] = $afield['id'];
    }
  }
  //ДОБАВЛЯЕМ СДЕЛКУ
  $leads['request']['leads']['add']=array(
    array(
      'name' => $lead_name,
      'status_id' => $lead_status_id, //id статуса
      'responsible_user_id' => $responsible_user_id, //id ответственного по сделке
      //'date_create'=>1298904164, //optional
      //'price'=>300000,
      //'tags' => 'Important, USA', #Теги
      //'custom_fields'=>array()
    )
  );
  $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/set';
  $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
  #Устанавливаем необходимые опции для сеанса cURL
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
  curl_setopt($curl,CURLOPT_URL,$link);
  curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
  curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($leads));
  curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
  curl_setopt($curl,CURLOPT_HEADER,false);
  curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
  $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
  $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
  $Response=json_decode($out,true);
  //echo '<b>Новая сделка:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';
  if(is_array($Response['response']['leads']['add']))
    foreach($Response['response']['leads']['add'] as $lead) {
      $lead_id = $lead["id"]; //id новой сделки
    };
  //ДОБАВЛЯЕМ СДЕЛКУ - КОНЕЦ
  //ДОБАВЛЕНИЕ КОНТАКТА
  $contact = array(
    'name' => $contact_name,
    'linked_leads_id' => array($lead_id), //id сделки
    'responsible_user_id' => $responsible_user_id, //id ответственного
    'custom_fields'=>array(
      array(
        'id' => $sFields['PHONE'],
        'values' => array(
          array(
            'value' => $contact_phone,
            'enum' => 'MOB'
          )
        )
      ),
      array(
        'id' => $sFields['EMAIL'],
        'values' => array(
          array(
            'value' => $contact_email,
            'enum' => 'WORK'
          )
        )
      )
    )
  );
  $set['request']['contacts']['add'][]=$contact;
  #Формируем ссылку для запроса
  $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
  $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
  #Устанавливаем необходимые опции для сеанса cURL
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
  curl_setopt($curl,CURLOPT_URL,$link);
  curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
  curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($set));
  curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
  curl_setopt($curl,CURLOPT_HEADER,false);
  curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
  $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
  $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);  
  $Response=json_decode($out,true);
  $code=(int)$code;

    $errors=array(
        301=>'Moved permanently',
        400=>'Bad request',
        401=>'Unauthorized',
        403=>'Forbidden',
        404=>'Not found',
        500=>'Internal server error',
        502=>'Bad gateway',
        503=>'Service unavailable'
    );

    try
    {
        #If the response code is not 200 or 204, we return an error message
        if($code!=200 && $code!=204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
        }
    }
    catch(Exception $E)
    {
        die('Error: '.$E->getMessage().PHP_EOL.'Error code: '.$E->getCode());
    }
    print_r($code);
    die;
//ДОБАВЛЕНИЕ КОНТАКТА - КОНЕЦ
}

function get_remote_file_info($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
    $data = curl_exec($ch);
    $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [
        'fileExists' => (int) $httpResponseCode == 200,
        'fileSize' => (int) $fileSize
    ];
}

function get_filesize($file)
{
    if(!get_remote_file_info($file)['fileExists']) return "Файл  не найден";

  $filesize = get_remote_file_info($file)['fileSize'];

if($filesize > 1024){
$filesize = ($filesize/1024);
    if($filesize > 1024){
    $filesize = ($filesize/1024);
        if($filesize > 1024) {
        $filesize = ($filesize/1024);
        $filesize = round($filesize, 1);
        return $filesize." ГБ";       
        } else {
        $filesize = round($filesize, 1);
        return $filesize." MБ";   
        }       
    } else {
    $filesize = round($filesize, 1);
    return $filesize." Кб";   
    }  
    } else {
    $filesize = round($filesize, 1);
    return $filesize." байт";   
    }
}

// Add an edit option to comment editing screen  

add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
    add_meta_box( 'title', 'Плюсы и Минусы', 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}

function extend_comment_meta_box ( $comment ) {
    $pluses = get_comment_meta( $comment->comment_ID, 'pluses', true );
    $minuses = get_comment_meta( $comment->comment_ID, 'minuses', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
    <p>
        <label for="pluses">Плюсы</label>
        <textarea name="pluses" rows=5 class="widefat"><?php echo esc_html( $pluses ); ?></textarea>
    </p>
    <p>
        <label for="minuses">Минусы</label>
        <textarea name="minuses" rows=5 class="widefat"><?php echo esc_html( $minuses ); ?></textarea>
    </p>
    <?php
}

// Update comment meta data from comment editing screen 

add_action( 'edit_comment', 'extend_comment_edit_metafields' );

function extend_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;

  if ( ( isset( $_POST['pluses'] ) ) && ( $_POST['pluses'] != ’) ) :
  $pluses = wp_filter_nohtml_kses($_POST['pluses']);
  update_comment_meta( $comment_id, 'pluses', $pluses );
  else :
  delete_comment_meta( $comment_id, 'pluses');
  endif;

  if ( ( isset( $_POST['minuses'] ) ) && ( $_POST['minuses'] != ’) ):
  $minuses = wp_filter_nohtml_kses($_POST['minuses']);
  update_comment_meta( $comment_id, 'minuses', $minuses );
  else :
  delete_comment_meta( $comment_id, 'minuses');
  endif;

}

?>