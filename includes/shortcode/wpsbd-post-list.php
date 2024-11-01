<?php
/**
 * 'wpsbd_get_posts_list' Shortcode
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Function to handle the `wpsbd_get_posts_list` shortcode
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
function wpsbd_get_posts_list( $atts, $content = null ) {
	// Taking some globals
	global $post, $multipage, $paged;
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'design' 				=> 'design-1',
		'grid' 					=> 1,
		'show_date' 			=> 'true',
		'show_author' 			=> 'true',
		'show_tags'				=> 'true',
		'show_comments'			=> 'true',
		'show_category' 		=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> 20,
		'show_read_more'        => 'true',
		'media_size' 			=> 'full',
		'limit' 				=> 20,
		'order'					=> 'desc',
		'category' 				=> '',
		'pagination'			=> 'true',
        'title_colorpicker'      => '',
        'text_colorpicker'      => '',
        'background_color'      => '',
        'box_background_color'  =>'',
        'readmore_text_colorpicker' => '',
        'readmore_background_color' => '' ,
        'pagination_text_colorpicker' => '',
        'pagination_background_color' => '',
        'pagination_type' => 'numeric',
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
	$posts_per_page 	= !empty($limit) 						? $limit 						: 20;
	$order 				= ( strtolower( $order ) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$cat 				= (!empty($category))					? explode(',',$category) 		: '';
	$postpagination 	= ( $pagination == 'false' )			? 'false'						: 'true';
	$read_more_text		=  'Read More';
	$link_behaviour		=  'self';
	$pagination_type 	= ( $pagination_type == 'prev-next' )	? 'prev-next' 					: 'numeric';
	
	$multi_page			= ( $multipage || is_single() || is_front_page() ) ? 1 : 0;
    $appreanceObj = spbd_theme_colors('wpsbd_post_list');
  	$themeColors = $appreanceObj[$design];
  	$text_colorpicker   = !empty($text_colorpicker)    ? spbd_sanitize($text_colorpicker) : (isset($themeColors['text_colorpicker']) ? $themeColors['text_colorpicker'] : '');
  	$title_colorpicker   = !empty($title_colorpicker)  ? spbd_sanitize($title_colorpicker) : (isset($themeColors['title_colorpicker']) ? $themeColors['title_colorpicker'] : '');
    $background_color   = !empty($background_color)   ? spbd_sanitize($background_color)  : (isset($themeColors['background_color']) ? $themeColors['background_color'] : '');
    $readmore_text_colorpicker   = !empty($readmore_text_colorpicker)   ? spbd_sanitize($readmore_text_colorpicker)   : (isset($themeColors['readmore_text_colorpicker']) ? $themeColors['readmore_text_colorpicker'] : '');
    $readmore_background_color   = !empty($readmore_background_color)   ? spbd_sanitize($readmore_background_color)   : (isset($themeColors['readmore_background_color']) ? $themeColors['readmore_background_color'] : '');
    $pagination_text_colorpicker = !empty($pagination_text_colorpicker) ? spbd_sanitize($pagination_text_colorpicker) : (isset($themeColors['pagination_text_colorpicker']) ? $themeColors['pagination_text_colorpicker'] : '');
    $pagination_background_color = !empty($pagination_background_color) ? spbd_sanitize($pagination_background_color) : (isset($themeColors['pagination_background_color']) ? $themeColors['pagination_background_color'] : '');
    $hover_readmore_text_colorpicker = (isset($themeColors['hover_readmore_text_colorpicker']) ? $themeColors['hover_readmore_text_colorpicker'] : '');
    $hover_readmore_background_color = (isset($themeColors['hover_readmore_background_color']) ? $themeColors['hover_readmore_background_color'] : '');
    $date_text_colorpicker   = (isset($themeColors['date_text_colorpicker']) ? $themeColors['date_text_colorpicker'] : '');
    $date_background_color   = (isset($themeColors['date_background_color']) ? $themeColors['date_background_color'] : '');
    $category_text_colorpicker   = (isset($themeColors['category_text_colorpicker']) ? $themeColors['category_text_colorpicker'] : '');
    $category_background_color   = (isset($themeColors['category_background_color']) ? $themeColors['category_background_color'] : '');
    $box_background_color   =!empty($box_background_color)  ?  spbd_sanitize($box_background_color):(isset($themeColors['box_background_color']) ? $themeColors['box_background_color'] : '');
    $comments_text_color = (isset($themeColors['comments_text_color']) ? $themeColors['comments_text_color'] : '');
    $comments_background_color = (isset($themeColors['comments_background_color']) ? $themeColors['comments_background_color'] : '');
    $tag_text_colorpicker = (isset($themeColors['category_text_colorpicker']) ? $themeColors['category_text_colorpicker'] : '');
	// Taking some variables
	$count 	= 0;
	if($design == 'design-3') $background_color = spbd_Hex2RGB($background_color,'50%');
    if($design == 'design-1') $comments_background_color = spbd_Hex2RGB($comments_background_color,'30%');
    if($design == 'design-2') $category_background_color = spbd_Hex2RGB($category_background_color,'30%');
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
		'ignore_sticky_posts' 	=> true,
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
	// If post is there
	if ( $query->have_posts() ) { ?>
		<div class="spk-blogposts-list post-list spbd-col-1">
			<div class="spk-blogposts-wrapper">
		<?php while ( $query->have_posts() ) : $query->the_post();
			$count++;
			$css_class 		= '';
			$news_links 	= $tags_links = array();
			$feat_image 	= spbd_get_post_featured_image( $post->ID, $media_size , true );
			$terms 			= get_the_terms( $post->ID, 'category' );
			$posttags       = get_the_tags();
			$comments 		= get_comments_number( $post->ID );
			
			if($terms) {
				foreach ( $terms as $term ) {
					$term_link = get_term_link( $term );
                    if($design == 'design-1'){

                        $news_links[] = '<span><a href="' . esc_url( $term_link ) . '" style="color:'.$category_text_colorpicker.';border-bottom:3px solid '.$category_background_color.';text-decoration:none">'.$term->name.'</a></span>';
                    }else if($design == 'design-4'){
                        $news_links[] = '<span><a href="' . esc_url( $term_link ) . '" style="color:'.$category_text_colorpicker.';text-decoration:none">'.$term->name.'</a></span>';
                    }else{
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '" style="color:'.$category_text_colorpicker.';background-color:'.$category_background_color.';text-decoration:none">'.$term->name.'</a>';
                    }
					
				}
			}
      		$tags_links = array();
			if ($posttags) {
                foreach($posttags as $tag) {
                    $tag_link = get_tag_link( $tag );

                    if($design == 'design-5'){
	                    $tags_links[] = '<span><svg xmlns="http://www.w3.org/2000/svg" style="fill:'.$tag_text_colorpicker.';transform:rotate3d(0, 1, 0, 180deg);" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 436.38 436.38" >
						<path d="M340.38,23.224H206.396c-8.48,0-16.624,3.376-22.624,9.376L9.372,206.968c-12.496,12.496-12.496,32.752,0,45.264
						l133.984,133.984c12.496,12.496,32.752,12.496,45.248,0l174.4-174.368c6-6.016,9.376-14.16,9.376-22.656V55.224
						C372.38,37.544,358.06,23.224,340.38,23.224z M284.38,135.224c-13.248,0-24-10.752-24-24s10.752-24,24-24s24,10.752,24,24
						S297.628,135.224,284.38,135.224z"/>
						<path d="M404.38,55.224l-0.016,148.944c0,7.376-2.928,14.464-8.16,19.68L218.988,401.064l2.72,2.72
						c12.496,12.496,32.752,12.496,45.248,0l160.032-160c6.016-6,9.392-14.144,9.392-22.624V87.224
						C436.38,69.544,422.06,55.224,404.38,55.224z"/></svg><a href="' . esc_url( $tag_link ) . '" style="color:'.$tag_text_colorpicker.';">'.$tag->name.'</a></span>';
					}else{
						$tags_links[] = '<span><a href="' . esc_url( $tag_link ) . '" style="color:'.$tag_text_colorpicker.';">'.$tag->name.'</a></span>';
					}
                }
            }
      		$cate_name = join( " ", $news_links );
      		$tags = join( " ", $tags_links );
			
			// Include shortcode html file
			
			if(file_exists(SPBD_DIR.'/templates/list/'.$design.'.php'))
				include( SPBD_DIR.'/templates/list/'.$design.'.php' );
			endwhile; ?>
			</div>
		</div>
		<?php
		if( $postpagination == "true" && ($query->max_num_pages > 1) ) { ?>
			<div class="spbd-pagination wpspw-<?php echo $pagination_type; ?>">
                <style type="text/css">.spbd-pagination.wpspw-prev-next a:nth-child(3) svg{transform: rotate(180deg);}.spbd-pagination .next svg{transform: rotate(180deg);}.spbd-pagination{display:flex; flex-wrap: wrap; justify-content: center; padding: 0 0 50px;}
					.spbd-pagination a {padding: 8px;margin: 0 7px;display: -webkit-flex;display: flex;align-items: center;justify-content: center;text-decoration: none;color: #000;height: 30px;width: 30px;border-radius: 5px;transition: all 200ms ease-in-out;border: 1px solid #000;}
					.spbd-pagination a:hover{background:#dd3333; color: #fff; border-color:#dd3333;}
					.spbd-pagination .current{font-weight: 600; color: #fff; background: #dd3333;border-color: #dd3333;padding: 8px;margin: 0 7px;display: -webkit-flex;display: flex;align-items: center;justify-content: center;text-decoration: none;height: 30px;width: 30px;border-radius: 5px;transition: all 200ms ease-in-out;}.spbd-pagination a:focus{outline: none;}.spbd-pagination a,.spbd-pagination .next,.spbd-pagination .prev,.spbd-pagination span{color: <?php echo $pagination_text_colorpicker;?>;border-color: <?php echo $pagination_text_colorpicker;?>;fill: <?php echo $pagination_text_colorpicker;?>;background-color: <?php echo $pagination_background_color;?>}
          			.spbd-pagination a:hover,.spbd-pagination span:hover,.spbd-pagination .current,.spbd-pagination a.prev:hover, .spbd-pagination a.next:hover{color: <?php echo $pagination_background_color;?>;border-color: <?php echo $pagination_background_color;?>;fill: <?php echo $pagination_background_color;?>;background-color: <?php echo $pagination_text_colorpicker;?>}</style>
				<?php
					echo spbd_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages, 'pagination_type' => $pagination_type, 'multi_page' => $multi_page ) );
				?>
			</div><!-- end .blog_pagination -->
		<?php }
		$json['post'] = $post_json;
		$json['post_count'] = $post_count;
		
	} // end of have_post()
	wp_reset_postdata(); // Reset WP Query
	$content .= ob_get_clean();
	return $content;
}
// 'wpsbd_get_posts_list' Shortcode
add_shortcode('wpsbd_post_list', 'wpsbd_get_posts_list');