<?php
/**
 * Plugin generic functions file
 *
 * @package SP Blog Designer
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Sanitize Multiple HTML class
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */

if(!function_exists('spbd_get_sanitize_html_classes')){
  function spbd_get_sanitize_html_classes($classes, $sep = " ") {
      $return = "";

      if( !is_array($classes) ) {
          $classes = explode($sep, $classes);
      }

      if( !empty($classes) ) {
          foreach($classes as $class){
              $return .= sanitize_html_class($class) . " ";
          }
          $return = trim( $return );
      }

      return $return;
  }
}

/**
 * Clean variables using sanitize_text_field. 
 * Non-scalar values are ignored.
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
if(!function_exists('spbd_sanitize')){
    function spbd_sanitize( $var ) {
        if ( is_array( $var ) ) {
            return array_map( 'spbd_sanitize', $var );
        }else if( is_object($var) ){
            foreach ($var as &$value) {
                if (is_scalar($value)) {
                    $value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
                    continue;
                }

                $value = spbd_sanitize($value);
            }
            return $var;
        }else {
            $data = sanitize_text_field( $var );
            return wp_unslash($data);
        }
    }
}

if(!function_exists('spbd_sanitize_http')){
  function spbd_sanitize_http($url) {
      $disallowed = array('http://', 'https://');
      foreach($disallowed as $d) {
        if(strpos($url, $d) === 0) {
           return str_replace($d, '', $url);
        }
      }
      return $url;
  }
}
if(!function_exists('spbd_remote_call')){
  function spbd_remote_call($params){   
      $params['shop'] = spbd_sanitize_http(home_url());
      $params['ip'] = $_SERVER['SERVER_ADDR'];
      $response = wp_remote_post(SPBD_STORE_URL,array(
            'method'      => 'POST',
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => array(),
            'body'        => $params
          )
      );
      
      if ( is_wp_error( $response ) ) {
        $result = $response->get_error_message();
      } else {
        $result = $response['body'];
      }
      return $result;
  }
}

if(!function_exists('spdp_enqueue_script')){
  function spdp_enqueue_script() {
      // Check public script is in queue
      // Dequeue Script
      wp_dequeue_script( 'sp-frontend' );

      // Enqueue Script
      wp_enqueue_script( 'sp-frontend' );
  }
}

if(!function_exists('spbd_get_post_featured_image')){
  function spbd_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {

      $size   = !empty($size) ? $size : 'full';

      $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

      if( !empty($image) ) {
          $image = isset($image[0]) ? $image[0] : '';
      }

      return $image;
  }
}
if(!function_exists('spbd_get_post_excerpt')){
  function spbd_get_post_excerpt( $post_id = null, $content = '', $word_length = '50', $more = '...' ) {

      $has_excerpt    = false;
      $word_length    = !empty($word_length) ? $word_length : '55';

      // If post id is passed
      if( !empty($post_id) ) {
          if (has_excerpt($post_id)) {

              $has_excerpt    = true;
              $content        = get_the_excerpt();

          } else {
              $content = !empty($content) ? $content : get_the_content();
          }
      }

      $content = strip_shortcodes( $content ); // Strip shortcodes
      $content = wp_trim_words( $content, $word_length, $more );

      return $content;
  }
}
if(!function_exists('spbd_all_cate')){
  function spbd_all_cate() {  
      $opts = '<option value="">Select</option>';
    
      $cats = get_terms(array('taxonomy'=>'category'));
      if(!empty($cats)){
          foreach ($cats as $key => $value) {
            $opts .= "<option value='".$value->term_id."'>".$value->name."</option>";
          }
      }
      return $opts;
  }
}
if(!function_exists('spbd_post_cate')){
  function spbd_post_cate($arg, $class = '', $current_cate_id = 1) {
      $ret = '';
      if (!$arg['show_category']) {
          return $ret;
      }
      if ($current_cate_id == 1 && is_numeric($arg['category'])) {
          $current_cate_id = (int) $arg['category'];
      }
      $class = 'cate '.$class;
      $categories = get_the_category();
      if($categories){
          foreach($categories as $category) {
            // to make sure has as least 1 cat
            if ($ret == '') {
              $ret = '<a class="'.$class.'" href="'.esc_url(get_category_link( $category->term_id )).'" title="' . esc_attr($category->cat_name) . '">' . 
                  esc_html( $category->cat_name) . 
                  '</a>';
            }
            
            // if has a cat different with box title cat, pick it
            if (((int) $category->term_id) != ((int)$current_cate_id)) {
              $ret = '<a class="'.esc_attr($class).'" href="'.esc_url(get_category_link( $category->term_id )).'" title="' . esc_attr($category->cat_name) . '">' . 
                  esc_html( $category->cat_name ) .
                  '</a>';
              break;
            }
          }
      }
      if (!$ret) {
          $ret = $backup_ret;
      }
      return $ret;
  }
}
if(!function_exists('spbd_post_cates')){
  function spbd_post_cates($arg,$cate_class = 'cate-item') {
    $ret = '';
    if (!isset($arg['number_cates'])) {
      return '';
    }
    if (!$arg['number_cates']) {
      return '';
    }
    if (!is_numeric($arg['number_cates'])) {
      return '';
    }
    $cate_count = (int) $arg['number_cates'];

    $categories = get_the_category();
    if (empty($categories)) {
      return $ret;
    }
    
    $current_cate_ids = $arg['current_cate_ids'];
    if (!is_array($current_cate_ids)) {
      $current_cate_ids = array();
    }
    
    // show categories that not in current cates
    $count = 0;
    for ($i = 0; $i < count($categories) && $count < $cate_count; $i++) {
      $cate = $categories[$i];
      if (!in_array($cate->term_id, $current_cate_ids)) {
        continue;
      }
      $count++;
      if ($ret) {
        $ret .= '<span>, </span>';
      }
      $ret .= '<a href="'.esc_url(get_category_link( $cate->term_id )).'">' . 
          esc_html( $cate->name ) . 
          '</a>';
    }
      
    
    // if not enough, add current cate to
    if ($count < $cate_count) {
      for ($i = 0; $i < count($categories) && $count < $cate_count; $i++) {
        $cate = $categories[$i];
        if (in_array($cate->term_id, $current_cate_ids)) {
          continue;
        }
        $count++;
        if ($ret) {
          $ret .= '<span>, </span>';
        }
        $ret .= '<a href="'.esc_url(get_category_link( $cate->term_id )).'">' . 
            esc_html( $cate->name ) .
            '</a>';
      } 
    }
    
    if ($ret) {
      $ret = '<div class="bg item-labels">'.$ret.'</div>';
    }
    
    return $ret;
  }
}

if(!function_exists('spbd_post_author')){
  function spbd_post_author($arg) { 
    $ret = '';
    
    $id = get_the_author_meta('ID');
    $name = get_the_author_meta( 'display_name' );
    $avatar = get_avatar($id, 16, '', sprintf(esc_attr__("%s 's Author avatar", 'magone'), $name));
    
    if ($arg['show_author'] == 'avatar' && $avatar) {
      $ret .= $avatar;// avatar from database
    } else if ($arg['show_author'] == 'icon') {
      $ret .= '<i class="fa fa-pencil-square-o"></i>';
    }

    $ret .= ' <span>' . esc_html( $name ) . '</span>';

    return ('<a href="'.esc_url(get_author_posts_url($id)).'" target="_blank" class="meta-item meta-item-author">'.$ret.'</a>');
  }
}

if(!function_exists('spbd_post_comments')){
  function spbd_post_comments( $post_id = null) {
    $comment_number = get_comments_number($post_id);    
    
    return '<a class="meta-item meta-item-comment-number" href="'.esc_url(get_comments_link()).'"><i class="fa fa-comment-o"></i> <span>' .$comment_number. '</span></a>';
  }
}

if(!function_exists('spbd_post_pagination')){
  function spbd_post_pagination( $args = array() ) {

    $big        = 999999999; // need an unlikely integer
    $page_links_temp  = array();  
    $pagination_type  = isset( $args['pagination_type'] ) ? $args['pagination_type'] : 'numeric';
    $multi_page     = ! empty( $args['multi_page'] )  ? 1 : 0;

    if(!$multi_page && $pagination_type == "prev-next"){
      add_filter('next_posts_link_attributes', 'spbd_next_link_attributes');
      add_filter('previous_posts_link_attributes', 'spbd_prev_link_attributes'); 

      $page_links = '<div class="wpspw-pagi-btn wpspw-next-btn">'. previous_posts_link( __('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492">
        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
        C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
        c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
        l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
      </svg>', '') ).'</div>
      <div class="next">'.next_posts_link( __('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492">
        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
        C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
        c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
        l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
      </svg>', ''), $args['total'] ).'</div>';
    }else{
      $paging = array(
        'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'  => '?paged=%#%',
        'current'   => max( 1, $args['paged'] ),
        'total'   => $args['total'],
        'prev_next' => true,
        'prev_text' => ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492"><path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path></svg>',
        
        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492">
                <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
              </svg>',
        );

      // If pagination is prev-next and shortcode is placed in single post
      if( $multi_page ) {
        $paging['type']   = ( $pagination_type == 'prev-next' ) ? 'array' : 'plain';
        $paging['base']   = esc_url_raw( add_query_arg( 'sp_blog_page', '%#%', false ) );
        $paging['format'] = '?sp_blog_page=%#%';
      }

      $page_links = paginate_links( $paging );

      // For single post shortcode we just fetch the prev-next link
      if( $pagination_type == 'prev-next' && $page_links && is_array( $page_links ) ) {

        foreach ($page_links as $page_link_key => $page_link) {
          if( strpos( $page_link, 'next page-numbers') !== false || strpos( $page_link, 'prev page-numbers') !== false ) {
            $page_links_temp[ $page_link_key ] = $page_link;
          }
        }
        return join( "\n", $page_links_temp );
      }
    }
    return $page_links;
  }
}

/**
 * Function to get shortcode design
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
if(!function_exists('spbd_designs_type')){
  function spbd_designs_type() {
    $design_arr = array(
      'default' => __('Default', 'sp-blog-designer'),
      'card'  => __('Card', 'sp-blog-designer'),
      'card-date' => __('Date Style', 'sp-blog-designer'),
      'card-news' => __('News Style', 'sp-blog-designer'),
      'card-block'  => __('Block', 'sp-blog-designer'),
      'card-magazine' => __('Magazine', 'sp-blog-designer'),
      'card-magazine-swipe' => __('Magazine Swipe', 'sp-blog-designer'),
      );  
    return $design_arr;
  }
}

if(!function_exists('spbd_designs_type_list')){
  function spbd_designs_type_list() {
    $design_arr = array(
      'design-1'  => __('Design 1', 'sp-blog-designer'),
      'design-2'  => __('Design 2', 'sp-blog-designer'),
      'design-3'  => __('Design 3', 'sp-blog-designer'),
      'design-4'  => __('Design 4', 'sp-blog-designer')
      );  
    return $design_arr;
  }
}

/**
 * Function to create shortcode option design
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
if(!function_exists('spbd_options_create')){
  function spbd_options_create($fields){
    $i = 0;
    foreach ($fields as $key => $value) : ?>
      <div class="spk-slidebar-cllps block_<?php echo __($key);?>">
        <div class="spk-cllps-title <?php echo __($i == 0 ? 'active' : '');?>"> <?php echo $value['title'] ?> <span></span></div>
        <div class="spk-cllps-content" style="display: <?php echo __($i == 0 ? 'block' : 'none');?>;">
        <?php foreach ($value['params'] as $params) : ?>
          <?php 
              $is_premium = false;
              if(isset($params['is_premium'])) $is_premium = 'disabled="disabled"';
          ?>
          <div class="spk-sidebar-block" <?php echo (($key =='appearance' || $key =='slider') && $params['default'] == '' ? 'style="display:none;"' : '');?>>
            <h3><?php echo $params['heading']?><div class="spk-tooltip-ic">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 23.625 23.625"><path d="M11.812,0C5.289,0,0,5.289,0,11.812s5.289,11.813,11.812,11.813s11.813-5.29,11.813-11.813   S18.335,0,11.812,0z M14.271,18.307c-0.608,0.24-1.092,0.422-1.455,0.548c-0.362,0.126-0.783,0.189-1.262,0.189   c-0.736,0-1.309-0.18-1.717-0.539s-0.611-0.814-0.611-1.367c0-0.215,0.015-0.435,0.045-0.659c0.031-0.224,0.08-0.476,0.147-0.759   l0.761-2.688c0.067-0.258,0.125-0.503,0.171-0.731c0.046-0.23,0.068-0.441,0.068-0.633c0-0.342-0.071-0.582-0.212-0.717   c-0.143-0.135-0.412-0.201-0.813-0.201c-0.196,0-0.398,0.029-0.605,0.09c-0.205,0.063-0.383,0.12-0.529,0.176l0.201-0.828   c0.498-0.203,0.975-0.377,1.43-0.521c0.455-0.146,0.885-0.218,1.29-0.218c0.731,0,1.295,0.178,1.692,0.53   c0.395,0.353,0.594,0.812,0.594,1.376c0,0.117-0.014,0.323-0.041,0.617c-0.027,0.295-0.078,0.564-0.152,0.811l-0.757,2.68   c-0.062,0.215-0.117,0.461-0.167,0.736c-0.049,0.275-0.073,0.485-0.073,0.626c0,0.356,0.079,0.599,0.239,0.728   c0.158,0.129,0.435,0.194,0.827,0.194c0.185,0,0.392-0.033,0.626-0.097c0.232-0.064,0.4-0.121,0.506-0.17L14.271,18.307z    M14.137,7.429c-0.353,0.328-0.778,0.492-1.275,0.492c-0.496,0-0.924-0.164-1.28-0.492c-0.354-0.328-0.533-0.727-0.533-1.193   c0-0.465,0.18-0.865,0.533-1.196c0.356-0.332,0.784-0.497,1.28-0.497c0.497,0,0.923,0.165,1.275,0.497   c0.353,0.331,0.53,0.731,0.53,1.196C14.667,6.703,14.49,7.101,14.137,7.429z"/></svg>
                <div class="spk-tooltip-txt"><?php echo $params['desc'];?></div>
              </div>
              <?php if(isset($params['is_premium'])) echo "<a href='".SPBD_PRO_FEATURE_URL."' target='_blank'>(Pro)</a>"; ?>
            </h3>
            <?php switch ($params['type']) {
              case 'select': ?>
                <div class="spk-option-field spk-select-field">
                  <select name="<?php echo $params['name'];?>" data-default='<?php echo (isset($params['default']) ? $params['default'] : '');?>' class="spbdSlider" <?php echo $is_premium;?>>
                  <?php foreach ($params['value'] as $k => $option) {

                    echo "<option value='{$k}' ".(isset($params['default']) && $params['default'] == $k ? 'selected' : '').">{$option}</option>";
                  } ?>
                  </select>
                </div>
                <?php
                break;
              case 'number': ?>
                <div class="spk-option-field spk-select-field">
                  <input type="number" name="<?php echo $params['name'];?>" value="<?php echo $params['value'];?>" data-default='<?php echo (isset($params['default']) ? $params['default'] : '');?>' class="spbdSlider" <?php echo $is_premium;?>>
                </div>
                <?php
                break;

              case 'colorpicker': ?>
                <div class="spk-option-field spk-select-field">
                  <input type="hidden" name="<?php echo $params['name'];?>" value="<?php echo $params['value'];?>" data-default-color='<?php echo (isset($params['default']) ? $params['default'] : '');?>' class="colorPicker <?php echo $params['class']?>" property="<?php echo $params['property'];?>" <?php echo $is_premium;?>>
                </div>
                <?php
                break;

              default: ?>
                <div class="spk-option-field spk-select-field">
                  <input type="text" name="<?php echo $params['name'];?>" value="<?php echo $params['value'];?>" data-default='<?php echo (isset($params['default']) ? $params['default'] : '');?>' <?php echo $is_premium;?>>
                </div>
                <?php
                break;
            } ?>
            
          </div>
        <?php endforeach; ?>
        </div>
      </div>
    <?php $i++; endforeach;
  }
}

/**
 * Function to get registered shortcodes
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
if(!function_exists('spbd_registered_shortcodes')){
  function spbd_registered_shortcodes( $type = 'simplified' ) {

    $shortcodes = array(
            'wpsbd_post'          => __('Post Grid', 'SP-blogs-designer'),
            'wpsbd_post_list'       => __('Post List', 'SP-blogs-designer'),
            'wpsbd_post_carousel'     => __('Post Carousel', 'SP-blogs-designer'),
          );
    $shortcodes = apply_filters('spbd_registered_shortcodes', (array)$shortcodes );
    // For simplified result
    if( $type == 'simplified' && ! empty( $shortcodes ) ) {
      foreach ($shortcodes as $shrt_key => $shrt_val) {
        if( is_array( $shrt_val ) && ! empty( $shrt_val['shortcodes'] ) ) {
          $result = array_merge( $result, $shrt_val['shortcodes'] );
        } else {
          $result[ $shrt_key ] = $shrt_val;
        }
      }
    } else {
      $result = $shortcodes;
    }
    return $shortcodes;
  }
}
/**
 * Function design wise color settings
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
if(!function_exists('spbd_theme_colors')){
  function spbd_theme_colors($shortCode){
    $colorsDefault = array();

      switch ($shortCode) {
          case 'wpsbd_post':
              $colorsDefault = array(
                  'default' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#ffffff',
                    'category_text_colorpicker'=>'#000000',
                    'category_background_color'=>'#F7F7F7',
                    'tag_text_colorpicker'=>'#000000',
                    'tag_background_color'=>'#ffffff',
                    'readmore_text_colorpicker'=>'#000000',
                    'readmore_background_color'=>'#ffffff',
                    'hover_readmore_text_colorpicker'=>'#ffffff',
                    'hover_readmore_background_color'=>'#000000',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  ),
                  'card' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#F7F7F7',
                    'category_text_colorpicker'=>'#000000',
                    'category_background_color'=>'',
                    'tag_text_colorpicker'=>'#000000',
                    'tag_background_color'=>'#ffffff',
                    'readmore_text_colorpicker'=>'#000000',
                    'readmore_background_color'=>'#ffffff',
                    'hover_readmore_text_colorpicker'=>'#ffffff',
                    'hover_readmore_background_color'=>'#000000',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  ),
                  'card-date' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#F7F7F7',
                    'box_background_color'=>'#f1edea',
                    // 'date_text_colorpicker' => '#ffffff',
                    // 'date_background_color' => '#000000',
                    'category_text_colorpicker'=>'#ffffff',
                    'category_background_color'=>'#000000',
                    'tag_text_colorpicker'=>'#000000',
                    'tag_background_color'=>'#ffffff',
                    'readmore_text_colorpicker'=>'#000000',
                    'readmore_background_color'=>'#ffffff',
                    'hover_readmore_text_colorpicker'=>'#ffffff',
                    'hover_readmore_background_color'=>'#000000',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  ),
                  'card-news' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#F7F7F7',
                    'category_text_colorpicker'=>'#000000',
                    'category_background_color'=>'#ffffff',
                    'tag_text_colorpicker'=>'#000000',
                    'readmore_text_colorpicker'=>'#000000',
                    'readmore_background_color'=>'#ffffff',
                    'hover_readmore_text_colorpicker'=>'#ffffff',
                    'hover_readmore_background_color'=>'#000000',
                    'date_text_colorpicker' => '#ffffff',
                    'date_background_color' => '#000000',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  ),
                  'card-block' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#F7F7F7',
                    'box_background_color'=>'#f1edea',
                    'category_text_colorpicker'=>'#000000',
                    'category_background_color'=>'#b9b9b9',
                    'tag_text_colorpicker'=>'#000000',
                    'tag_background_color'=>'#ffffff',
                    'readmore_text_colorpicker'=>'#000000',
                    'readmore_background_color'=>'#ffffff',
                    'hover_readmore_text_colorpicker'=>'#ffffff',
                    'hover_readmore_background_color'=>'#000000',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  ),
                  'card-magazine' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#F7F7F7',
                    'category_text_colorpicker'=>'#ffffff',
                    'category_background_color'=>'#000000',
                    'tag_text_colorpicker'=>'#000000',
                    'tag_background_color'=>'#ffffff',
                    'readmore_text_colorpicker'=>'#000000',
                    'hover_readmore_text_colorpicker'=>'#484848',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  ),
                  'card-magazine-swipe' => array(
                    'text_colorpicker'=>'#000000',
                    'background_color'=>'#F7F7F7',
                    'category_text_colorpicker'=>'#000000',
                    'category_background_color'=>'#ffffff',
                    'tag_text_colorpicker'=>'#000000',
                    'tag_background_color'=>'#ffffff',
                    'readmore_text_colorpicker'=>'#000000',
                    'readmore_background_color'=>'#ffffff',
                    'hover_readmore_text_colorpicker'=>'#ffffff',
                    'hover_readmore_background_color'=>'#000000',
                    'pagination_text_colorpicker'=>'#000000',
                    'pagination_background_color'=>'#ffffff'
                  )
              );
        
          break;

          case 'wpsbd_post_list':
              $colorsDefault = array(
                  'design-1' => array(
                      'title_colorpicker'=>'#000000',
                      'text_colorpicker'=>'#000000',
                      'background_color'=>'#b7d6d1',
                      'box_background_color'=>'#f5ede4',
                      'comments_text_color'=>'#ffffff',
                      'comments_background_color' => '#C0C0C0',
                      'category_text_colorpicker'=>'#111111',
                      'category_background_color'=>'#6b90a8',
                      'readmore_text_colorpicker'=>'#FFFFFF',
                      'readmore_background_color'=>'#000000',
                      'hover_readmore_text_colorpicker'=>'#FFFFFF',
                      'hover_readmore_background_color'=>'#000000',
                      'pagination_text_colorpicker'=>'#000000',
                      'pagination_background_color'=>'#ffffff'
                  ),
                  'design-2' => array(
                      'title_colorpicker'=>'#ffffff',
                      'text_colorpicker'=>'#ffffff',
                      'background_color'=>'#0c3b2e',
                      'category_text_colorpicker'=>'#ffffff',
                      'category_background_color'=>'#ffffff',
                      'readmore_text_colorpicker'=>'#ffffff',
                      'readmore_background_color'=>'#ff9900',
                      'hover_readmore_text_colorpicker'=>'#ff9900',
                      'hover_readmore_background_color'=>'#ffffff',
                      'date_text_colorpicker' => '#0c3b2e',
                      'date_background_color' => '#ffffff',
                      'pagination_text_colorpicker'=>'#000000',
                      'pagination_background_color'=>'#ffffff'
                  ),
                  'design-3' => array(
                      'title_colorpicker'=>'#111111',
                      'text_colorpicker'=>'#111111',
                      'background_color'=>'#FBFAFF',
                      'box_background_color'=>'#deeafa',
                      'category_text_colorpicker'=>'#111111',
                      'category_background_color'=>'#d7bc2e',
                      'readmore_text_colorpicker'=>'#000000',
                      'readmore_background_color'=>'',
                      'hover_readmore_text_colorpicker'=>'#ffffff',
                      'hover_readmore_background_color'=>'#111111',
                      'date_text_colorpicker' => '#111111',
                      'date_background_color' => '#d7bc2e',
                      'pagination_text_colorpicker'=>'#000000',
                      'pagination_background_color'=>'#ffffff'
                  ),
                  'design-4' => array(
                      'title_colorpicker'=>'#111111',
                      'text_colorpicker'=>'#111111',
                      'background_color'=>'#ffffff',
                      'category_text_colorpicker'=>'#111111',
                      'readmore_text_colorpicker'=>'#ffffff',
                      'readmore_background_color'=>'#ff9900',
                      'hover_readmore_text_colorpicker'=>'#ffffff',
                      'hover_readmore_background_color'=>'#111111',
                      'date_text_colorpicker' => '#ffffff',
                      'date_background_color' => '#ff9900',
                      'pagination_text_colorpicker'=>'#000000',
                      'pagination_background_color'=>'#ffffff'
                  )
              );  
          break;

          case 'wpsbd_post_carousel':
              $colorsDefault = array(
                  
                  'design-1' => array(
                      'text_colorpicker'=>'#ffffff',
                      'category_text_colorpicker'=>'#ffffff',
                      'category_background_color'=>'#fb5b21',
                      'readmore_text_colorpicker'=>'#ffffff',
                      'readmore_background_color'=>'transparent',
                      'hover_readmore_text_colorpicker'=>'#000000',
                      'hover_readmore_background_color'=>'#ffffff',
                  )
              );  
          break;
      default:
        # code...
        break;
    }
    return $colorsDefault;
  }
}
if(!function_exists('spbd_slider_options')){
  function spbd_slider_options($design){
      $sliderDefault =array(
          'design-1' => array(
                'arrows'=>'true',
                'fade'=>'true',
                'infinite'=>'true',
                'adaptiveHeight'=>'true',
                'autoplay' => 'true'
              )
      );
      
      return $sliderDefault;
  }
}
if(!function_exists('spbd_Hex2RGB')){
  function spbd_Hex2RGB($hex, $per = ''){
      $split_hex_color = str_split( str_replace('#', '', $hex), 2 );   

      $rgb1 = hexdec( $split_hex_color[0] );  
      $rgb2 = hexdec( $split_hex_color[1] );  
      $rgb3 = hexdec( $split_hex_color[2] );
      $RGB = $rgb1.' '.$rgb2.' '.$rgb3;
      if($per != '') $RGB = $RGB.' / '.$per;
      return 'rgb('.$RGB.')';
  }
}

if(!function_exists('SPBD_preview_shortcode')){
  function SPBD_preview_shortcode(){
    $shortcode_val = spbd_sanitize( $_POST['spbd_shortcode'] );
    echo do_shortcode($shortcode_val);
    wp_die();
  }
}