<?php
/**
 * 'wpsbd_post' Shortcode
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
if ( !defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
/**
 * Function to handle the `wpsbd_post` shortcode
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
function wpsbd_get_posts( $atts, $content = null ) {
    // Taking some globals
    global $post, $multipage, $paged;
    // Shortcode Parameters
    extract(shortcode_atts(array(
        'design'        => 'default',
        'grid'          => 3,
        'show_date'       => 'true',
        'show_author'       => 'true',
        'show_tags'       => 'false',
        'show_comments'     => 'false',
        'show_category'     => 'true',
        'show_content'      => 'true',
        'content_words_limit'   => 20,
        'show_read_more'        => 'true',
        'media_size'      => 'full',
        'limit'         => 20,
        'order'         => 'desc',
        'category'        => '',
        'pagination'      => 'true',
        'text_colorpicker'      => '',
        'background_color'      => '',
        'box_background_color'  =>'',
        'readmore_text_colorpicker' => '',
        'readmore_background_color' => '' ,
        'pagination_text_colorpicker' => '',
        'pagination_background_color' => ''
    ), $atts, 'wpsbd_post'));

    $design       = !empty($design)             ? $design             : 'default';
    $gridcol      = !empty($grid)             ? $grid             : 3;
    $show_date      = ( $show_date == 'true' )        ? 'true'            : 'false';

    $show_author    = ( $show_author == 'true' )      ? 'true'            : 'false';
    $show_tags      = ( $show_tags == 'true' )        ? 'true'            : 'false';
    $show_comments    = ( $show_comments == 'true' )      ? 'true'            : 'false';
    $show_category    = ( $show_category == 'true' )   ? 'true'            : 'false';
    $show_content     = ( $show_content == 'true' )       ? 'true'            : 'false';
    $words_limit    = !empty( $content_words_limit )    ? $content_words_limit      : 0;
    $show_read_more   = ( $show_read_more == 'true' )     ? 'true'            : 'false';
    $media_size     = !empty( $media_size )         ? $media_size         : 'full';
    $posts_per_page   = !empty($limit)            ? $limit            : 20;
    
    $order        = ( strtolower( $order ) == 'asc' )   ? 'ASC'             : 'DESC';
    $cat        = (!empty($category))         ? explode(',',$category)    : '';
    $postpagination   = ( $pagination == 'false' )      ? 'false'           : 'true';
    $read_more_text   = 'Read More';
    $link_behaviour   = 'self';
    $pagination_type  = 'numeric';
    
    $multi_page     = ( $multipage || is_single() || is_front_page() ) ? 1 : 0;
    $appreanceObj = spbd_theme_colors('wpsbd_post');
    $themeColors = $appreanceObj[$design];
    $text_colorpicker   = !empty($text_colorpicker) ? spbd_sanitize($text_colorpicker) : (isset($themeColors['text_colorpicker']) ? $themeColors['text_colorpicker'] : '');
    $box_background_color   = !empty($box_background_color) ?  spbd_sanitize($box_background_color)  : (isset($themeColors['box_background_color']) ? $themeColors['box_background_color'] : '');
    $background_color   = !empty($background_color) ? spbd_sanitize($background_color) : (isset($themeColors['background_color']) ? $themeColors['background_color'] : '');
    $readmore_text_colorpicker   = !empty($readmore_text_colorpicker) ? spbd_sanitize($readmore_text_colorpicker) : (isset($themeColors['readmore_text_colorpicker']) ? $themeColors['readmore_text_colorpicker'] : '');
    $readmore_background_color   = !empty($readmore_background_color) ? spbd_sanitize($readmore_background_color) : (isset($themeColors['readmore_background_color']) ? $themeColors['readmore_background_color'] : '');
    $pagination_text_colorpicker = !empty($pagination_text_colorpicker) ? spbd_sanitize($pagination_text_colorpicker) : (isset($themeColors['pagination_text_colorpicker']) ? $themeColors['pagination_text_colorpicker'] : '');
    $pagination_background_color = !empty($pagination_background_color) ? spbd_sanitize($pagination_background_color) : (isset($themeColors['pagination_background_color']) ? $themeColors['pagination_background_color'] : '');
    $hover_readmore_text_colorpicker = (isset($themeColors['hover_readmore_text_colorpicker']) ? $themeColors['hover_readmore_text_colorpicker'] : '');
    $hover_readmore_background_color = (isset($themeColors['hover_readmore_background_color']) ? $themeColors['hover_readmore_background_color'] : '');
    $date_text_colorpicker   = (isset($themeColors['date_text_colorpicker']) ? $themeColors['date_text_colorpicker'] : '');
    $date_background_color   =  (isset($themeColors['date_background_color']) ? $themeColors['date_background_color'] : '');
    $category_text_colorpicker =  (isset($themeColors['category_text_colorpicker']) ? $themeColors['category_text_colorpicker'] : '');
    $category_background_color   =  (isset($themeColors['category_background_color']) ? $themeColors['category_background_color'] : '');
    $tag_text_colorpicker   =  (isset($themeColors['tag_text_colorpicker']) ? $themeColors['tag_text_colorpicker'] : '');
    $tag_background_color   =  (isset($themeColors['tag_background_color']) ? $themeColors['tag_background_color'] : '');
    // Taking some variables
    $count  = 0;
    
    // Pagination parameter
    $paged = 1;
    if( $multi_page ) {
        $paged = isset( $_GET['sp_blog_page'] ) ? spbd_sanitize($_GET['sp_blog_page']) : 1;
    } else if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } else if ( get_query_var('page') ) {
        $paged = get_query_var('page');
    }
      // WP Query Parameters
    $args = array ( 
        'post_type'       => 'post',
        'post_status'       => array('publish'),
        'order'         => $order,
        'orderby'       => 'date',
        'ignore_sticky_posts'   => true,
        'posts_per_page'    => $posts_per_page,
        'paged'         => ( $postpagination ) ? spbd_sanitize($paged) : 1,
    );
      // Category Parameter
    if($cat != "") {
        $args['tax_query'] = array(
            array( 
              'taxonomy'      => SPBD_CATE,
              'field'       => 'term_id',
              'terms'       => $cat,
          ));
    }
      // WP Query
    $query    = new WP_Query($args);
    $post_count = $query->post_count;
    ob_start();
    $json = $post_json = array();
      // If post is there
    if ( $query->have_posts() ) { ?>
        <div class="spk-blogposts-list post-grid post-grid-view spbd-col-<?php echo $grid;?>">
            <div class="spk-blogposts-wrapper">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $count++;
                $css_class    = '';
                $news_links   = $tags_links = array();
                $feat_image   = spbd_get_post_featured_image( $post->ID, $media_size , true );
                $terms      = get_the_terms( $post->ID, 'category' );
                $posttags       = get_the_tags();
                $comments     = get_comments_number( $post->ID );
                $reply      = ($comments <= 1)  ? 'Reply' : 'Replies';

                if($terms) {
                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<span><a href="' . esc_url( $term_link ) . '" >'.$term->name.'</a></span>';
                    }
                }
                if ($posttags) {
                    foreach($posttags as $tag) {
                        $tag_link = get_tag_link( $tag );
                        $tags_links[] = '<span><a href="' . esc_url( $tag_link ) . '">'.$tag->name.'</a></span>';
                    }
                }
                $cate_name = join( " ", $news_links );
                $tags = join( " ", $tags_links );

                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }
                // Include shortcode html file
                
                if(file_exists(SPBD_DIR.'/templates/grid/'.$design.'.php'))
                    include( SPBD_DIR.'/templates/grid/'.$design.'.php' );
            endwhile; ?>
            </div>
        </div>
        <?php
        if( $postpagination == "true" && ($query->max_num_pages > 1) ) { ?>
            <div class="spbd-pagination wpspw-<?php echo $pagination_type; ?>" style="">
                <style type="text/css">.spbd-pagination.wpspw-prev-next a:nth-child(3) svg{transform: rotate(180deg);}.spbd-pagination .next svg{transform: rotate(180deg);}.spbd-pagination{display:flex; flex-wrap: wrap; justify-content: center; padding: 0 0 50px;}
                    .spbd-pagination a {padding: 8px;margin: 0 7px;display: -webkit-flex;display: flex;align-items: center;justify-content: center;text-decoration: none;color: #000;height: 30px;width: 30px;border-radius: 5px;transition: all 200ms ease-in-out;border: 1px solid #000;}
                    .spbd-pagination a:hover{background:#dd3333; color: #fff; border-color:#dd3333;}
                    .spbd-pagination .current{font-weight: 600; color: #fff; background: #dd3333;border-color: #dd3333;padding: 8px;margin: 0 7px;display: -webkit-flex;display: flex;align-items: center;justify-content: center;text-decoration: none;height: 30px;width: 30px;border-radius: 5px;transition: all 200ms ease-in-out;}.spbd-pagination a:focus{outline: none;}.spbd-pagination a,.spbd-pagination .next,.spbd-pagination .prev,.spbd-pagination span{color: <?php echo $pagination_text_colorpicker;?>;border-color: <?php echo $pagination_text_colorpicker;?>;fill: <?php echo $pagination_text_colorpicker;?>;background-color: <?php echo $pagination_background_color;?>}
                    .spbd-pagination a:hover,.spbd-pagination span:hover,.spbd-pagination .current,.spbd-pagination a.prev:hover, .spbd-pagination a.next:hover{color: <?php echo $pagination_background_color;?>;border-color: <?php echo $pagination_background_color;?>;fill: <?php echo $pagination_background_color;?>;background-color: <?php echo $pagination_text_colorpicker;?>}
                </style>
                <?php
                echo spbd_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages, 'pagination_type' => $pagination_type, 'multi_page' => $multi_page ) );
                ?>
            </div><!-- end .blog_pagination -->
        <?php }
    } // end of have_post()
    wp_reset_postdata(); // Reset WP Query
    $content .= ob_get_clean();
    return $content;
}
// 'wpsbd_post' Shortcode
add_shortcode('wpsbd_post', 'wpsbd_get_posts');