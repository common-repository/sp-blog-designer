<?php
/**
 * 'wpsbd_get_posts_carousel' Shortcode
 * 
 * @package SP Blog Designer
 * @since 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `wpsbd_get_posts_carousel` shortcode
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
function wpsbd_get_posts_carousel( $atts, $content = null ) {

	// Taking some globals
	global $post, $multipage, $paged;

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'design' 				=> 'design-1',
		'grid' 					=> 1,
		'show_date' 			=> 'true',
		'show_author' 			=> 'true',
		'show_tags'				=> 'false',
		'show_comments'			=> 'true',
		'show_category' 		=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> 20,
		'show_read_more'        => 'true',
		'media_size' 			=> 'full',
		'limit' 				=> 5,
		'order'					=> 'desc',
		'category' 				=> '',
		'pagination'			=> 'true',
        'text_colorpicker'      => '',
        'readmore_text_colorpicker' => '',
        'slide_show' => '',
        'slide_scroll' => '',
        'dots' => '',
        'arrows' => '',
        'autoplay' => '',
        'autoplayspeed' => '',
        'speed' => '',
        'infinite' => '',
        'fade' => '',
        'adaptiveheight' => '',
        'centermode' => '',
        'centerpadding' => '',
	), $atts, 'wpsbd_post'));

	$design 			= !empty($design) 						? $design 						: 'design-1';
	$show_date 			= ( $show_date == 'true' ) 				? 'true'						: 'false';
	$show_author 		= ( $show_author == 'true' )			? 'true'						: 'false';
	$show_tags 			= ( $show_tags == 'true' ) 				? 'true'						: 'false';
	$show_comments 		= ( $show_comments == 'true' ) 			? 'true'						: 'false';
	$show_category 		= ( $show_category == 'true' ) 	        ? 'true' 						: 'false';
	$show_content 		= ( $show_content == 'true' ) 			? 'true' 						: 'false';
	$words_limit 		= !empty( $content_words_limit ) 		? $content_words_limit 			: 0;
	$show_read_more 	= ( $show_read_more == 'true' )			? 'true' 						: 'false';
	$media_size			= !empty( $media_size )					? $media_size					: 'full';
	$posts_per_page 	= !empty($limit) 						? $limit 						: 5;
	$order 				= ( strtolower( $order ) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$cat 				= (!empty($category))					? explode(',',$category) 		: '';
	$postpagination 	= ( $pagination == 'false' )			? 'false'						: 'true';
	$read_more_text		= 'Read More';
	$link_behaviour		= 'self';
	$pagination_type 	= 'numeric';
	$multi_page			= ( $multipage || is_single() || is_front_page() ) ? 1 : 0;
    $appreanceObj = spbd_theme_colors('wpsbd_post_carousel');
    $themeColors = $appreanceObj[$design];
    $text_colorpicker   = !empty($text_colorpicker) ? spbd_sanitize($text_colorpicker) : (isset($themeColors['text_colorpicker']) ? $themeColors['text_colorpicker'] : '');
    $background_color   = !empty($background_color) ? spbd_sanitize($background_color) : (isset($themeColors['background_color']) ? $themeColors['background_color'] : '');
    $readmore_text_colorpicker   = !empty($readmore_text_colorpicker)   ? spbd_sanitize($readmore_text_colorpicker)   : (isset($themeColors['readmore_text_colorpicker']) ? $themeColors['readmore_text_colorpicker'] : '');
    $readmore_background_color   = (isset($themeColors['readmore_background_color']) ? $themeColors['readmore_background_color'] : '');
    $hover_readmore_text_colorpicker =  (isset($themeColors['hover_readmore_text_colorpicker']) ? $themeColors['hover_readmore_text_colorpicker'] : '');
    $hover_readmore_background_color = (isset($themeColors['hover_readmore_background_color']) ? $themeColors['hover_readmore_background_color'] : '');
    $category_text_colorpicker   =  (isset($themeColors['category_text_colorpicker']) ? $themeColors['category_text_colorpicker'] : '');
    $category_background_color   =  (isset($themeColors['category_background_color']) ? $themeColors['category_background_color'] : '');
   
    // Enqueue required script
    wp_enqueue_script( 'sp-slick-carousel' );

	// Taking some variables
	$count 	= 0;
	// Pagination parameter
	$paged = 1;
	if( $multi_page ) {
		$paged = isset( $_GET['sp_blog_page'] ) ? spbd_sanitize($_GET['sp_blog_page']) : 1;
	} else if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	// WP Query Parameters
	$args = array ( 
		'post_type' 			=> 'post',
		'post_status' 			=> array('publish'),
		'order'					=> $order,
		'orderby'       		=> 'date',
		'posts_per_page' 		=> $posts_per_page,
		'paged'					=> ( $postpagination ) ? spbd_sanitize($paged) : 1,
	);

	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
								array( 
									'taxonomy' 			=> SPBD_CATE,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
								));
	}

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;
	ob_start();
	$json = $post_json = array();

	$themeSlider = spbd_slider_options($design);
    $themeSlider = $themeSlider[$design];
    $configData = array();
    $configData['slidesToShow'] = 1;
    $configData['slidesToScroll'] = 1;
    foreach ($themeSlider as $key => $value) {
    	$varKey = strtolower($key);
    	if(isset($$varKey)){
    		
    		$setVal = ($$varKey != '' && $$varKey != null ? $$varKey : $value);
    		if(is_int($setVal)) $setVal = (int)$setVal;
    		if($setVal === 'true') $setVal = true;
    		if($setVal === 'false') $setVal = false;
    		$configData[$key] = $setVal;
    	}
    }
    
	// If post is there
	if ( $query->have_posts() ) {
		$input = $design;
		$result = explode('-',$input);
	?>

	<div class="spk-blogposts-list spbd-col-1 post-carousel spk-slider-box spbd-slidev<?php echo __($result[1])?>" id="spbd-carouse-<?php echo rand() .time();?>">
		<div class="carouselConfig" style="display: none;visibility: hidden;"><?php echo json_encode($configData);?></div>
		<div class="spk-blogposts-wrapper">
			<div class="spk-blog-slide post-carousel-<?php echo __($design);?>">
		<?php while ( $query->have_posts() ) : $query->the_post();
			$count++;
			$css_class 		= '';
			$news_links 	= array();
			$feat_image 	= spbd_get_post_featured_image( $post->ID, $media_size , true );
			$terms 			= get_the_terms( $post->ID, 'category' );
			$comments 		= get_comments_number( $post->ID );
			
			if($terms) {
				foreach ( $terms as $term ) {
					$term_link = get_term_link( $term );
                    if($design == 'design-4'){
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '" style="color:'.$category_text_colorpicker.';border-bottom: 1px solid'.$category_background_color.'">'.$term->name.'</a>';
                    }else{
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '" style="color:'.$category_text_colorpicker.';background-color:'.$category_background_color.'">'.$term->name.'</a>';
                    }
					
				}
			}
      		$cate_name = join( " ", $news_links );
			// Include shortcode html file
			
			if(file_exists(SPBD_DIR.'/templates/carousel/'.$design.'.php'))
				include( SPBD_DIR.'/templates/carousel/'.$design.'.php' );

			endwhile; ?>
			</div>
			</div>
		</div>
		<?php
		
		$json['post'] = $post_json;
		$json['post_count'] = $post_count;
		
	} // end of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'wpsbd_post' Shortcode
add_shortcode('wpsbd_post_carousel', 'wpsbd_get_posts_carousel');