<?php
/**
 * Template for Blog Designer - Post and Widget Design 1
 *
 * @package SP Blog Designer
 * @version 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
} 
global $post;
?>
<div class="spk-blogposts-item post-grid-block spbd-box-bg spbd-col-2">
    <div class="spk-blogposts-bx main-box-background" style="background-color: <?php echo  $box_background_color;?>">
      <a href="<?php the_permalink(); ?>" class="spk-blogposts-img">
        <img src="<?php echo $feat_image; ?>">
      </a>
      <div class="spk-blogposts-text box-background" style="background-color: <?php echo  $background_color;?>">
        <?php if($show_category == 'true') { ?>
            <div class="spk-blogpost-tags categoryBlog">
                <?php if(!empty($show_category) && $show_category == 'true'  && $cate_name != '') { ?>
                    <?php echo str_replace(',', ' ', $cate_name);  ?><?php } ?>
            </div>
            <?php } ?>
        <h2 class="spk-blogpost-title" style="color: <?php echo  $text_colorpicker;?>"><a href="<?php the_permalink(); ?>" target="_self" class="sp-text-color"><?php echo get_the_title(); ?></a></h2>
        <div class="spk-blogpost-i1nfo">
            <?php if($show_author == 'true') { ?>
           <span class="sp-text-color" style="color: <?php echo  $text_colorpicker;?>;fill:<?php echo  $text_colorpicker;?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 512 512"><path d="M437.02,330.98c-27.883-27.882-61.071-48.523-97.281-61.018C378.521,243.251,404,198.548,404,148    C404,66.393,337.607,0,256,0S108,66.393,108,148c0,50.548,25.479,95.251,64.262,121.962    c-36.21,12.495-69.398,33.136-97.281,61.018C26.629,379.333,0,443.62,0,512h40c0-119.103,96.897-216,216-216s216,96.897,216,216    h40C512,443.62,485.371,379.333,437.02,330.98z M256,256c-59.551,0-108-48.448-108-108S196.449,40,256,40    c59.551,0,108,48.448,108,108S315.551,256,256,256z"></path></svg><a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>" ><?php the_author(); ?></a></span>
            <?php } ?>
            <?php if($show_date == "true") { ?>
            <span class="sp-text-color" style="color: <?php echo  $text_colorpicker;?>;fill:<?php echo  $text_colorpicker;?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 443.294 443.294"><path d="m221.647 0c-122.214 0-221.647 99.433-221.647 221.647s99.433 221.647 221.647 221.647 221.647-99.433 221.647-221.647-99.433-221.647-221.647-221.647zm0 415.588c-106.941 0-193.941-87-193.941-193.941s87-193.941 193.941-193.941 193.941 87 193.941 193.941-87 193.941-193.941 193.941z"></path><path d="m235.5 83.118h-27.706v144.265l87.176 87.176 19.589-19.589-79.059-79.059z"></path></svg> <?php echo get_the_date(); ?></span>
            <?php } ?>
          </div>
        <?php if($show_content == "true") { ?>
                <?php if($words_limit > 0 ) { ?>
                   <div class="spk-blogpost-rte sp-text-color" style="color: <?php echo  $text_colorpicker;?>"><?php echo spbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></div>
                  
                  <?php if($show_read_more == 'true'){ ?>
                   <a href="<?php the_permalink(); ?>" class="spk-blogpost-btn" onMouseOver="this.style.background='<?php echo $hover_readmore_background_color;?>';this.style.color='<?php echo $hover_readmore_text_colorpicker;?>';this.style.borderColor='<?php echo $hover_readmore_text_colorpicker;?>'" onMouseOut="this.style.background='<?php echo $readmore_background_color;?>';this.style.color='<?php echo $readmore_text_colorpicker;?>';this.style.borderColor='<?php echo $readmore_text_colorpicker;?>'" style="color: <?php echo  $readmore_text_colorpicker ?>;background-color: <?php echo  $readmore_background_color; ?>"><?php _e($read_more_text, 'sp-blog-designer'); }?></a>
                <?php } else {
                    the_content();
                } ?>
          <?php } ?>
          <?php if($show_tags == 'true') { ?>
            <div class="spk-blogpost-tags tagBlog">
                <?php if(!empty($tags) && $show_tags == 'true') { ?>
                    <?php echo $tags;  ?><?php } ?>
            </div>
            <?php } ?>
      </div>
    </div>
</div>
