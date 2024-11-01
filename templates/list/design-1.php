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
<div class="spk-blogposts-item spk-list-i1 post-list-design-1">
	<div class="spk-blogposts-bx main-box-background" style="background-color: <?php echo  $box_background_color;?>">
        <?php if($show_comments == "true"){?>
		<ul class="spk-share-link">
			
			<li class="comments comments-background" style="background-color: <?php echo  $comments_background_color;?>;color: <?php echo  $comments_text_color;?>;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.99 35.991" class="comments" style="fill: <?php echo  $comments_text_color;?>"><path d="M35.49,17.416c0,3.613-1.594,6.91-4.217,9.453v6.248l-6.248-2.39c-2.152,0.789-4.527,1.232-7.03,1.232
                C8.333,31.959,0.5,25.448,0.5,17.417c0-8.031,7.833-14.543,17.495-14.543S35.49,9.385,35.49,17.416z"></path><path d="M31.273,33.617c-0.061,0-0.121-0.011-0.179-0.033l-6.074-2.323c-2.234,0.796-4.597,1.199-7.025,1.199
                C8.073,32.459,0,25.711,0,17.417S8.073,2.374,17.995,2.374c9.923,0,17.995,6.748,17.995,15.042c0,3.531-1.496,6.954-4.217,9.663
                v6.038c0,0.165-0.081,0.318-0.217,0.412C31.473,33.586,31.373,33.617,31.273,33.617z M25.025,30.227
                c0.061,0,0.121,0.011,0.179,0.033l5.569,2.13v-5.521c0-0.136,0.055-0.265,0.152-0.359c2.621-2.541,4.064-5.771,4.064-9.094
                c0-7.743-7.624-14.042-16.995-14.042S1,9.673,1,17.417s7.624,14.043,16.995,14.043c2.375,0,4.683-0.404,6.858-1.202
                C24.909,30.237,24.967,30.227,25.025,30.227z"></path></svg><span><?php echo $comments;?></span></li>
		</ul>
    <?php } ?>
		
		<a href="<?php the_permalink(); ?>" class="spk-blogposts-img">
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title_attribute(); ?>">
		</a>
		<div class="spk-blogposts-text" >
			<h2 class="spk-blogpost-title"><a href="<?php the_permalink(); ?>" target="_self" class="sp-title-color" style="color: <?php echo  $title_colorpicker;?>"><?php echo get_the_title(); ?></a></h2>
			<div class="spk-blogposts-t2xt box-background" style="background-color: <?php echo  $background_color;?>">
				
				<?php if($show_category == 'true') { ?>
	            <div class="spk-ctg-tag categoryBlog">
	                <?php if(!empty($show_category) && $show_category == 'true'  && $cate_name != '') { ?>
	                    <?php echo str_replace(',', ' ', $cate_name);  ?><?php } ?>
	            </div>
	            <?php } ?>
			
				<?php if($show_content == "true") { ?>
				<div class="spk-blogpost-rte sp-text-color" style="color: <?php echo  $text_colorpicker;?>">
					<?php if($words_limit > 0 ) { ?>
						<?php echo spbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?>
					<?php } else {
						the_content();
					} ?>
				</div>
				<?php } ?>
				
                <?php if($show_date == "true" || $show_author == "true" ) { ?>
				<div class="spk-blogpost-i1nfo">
					<ul>
                        <?php if($show_author == "true") { ?>
						  <li class="auther"><span><a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>" class="sp-text-color" style="color: <?php echo  $text_colorpicker;?>"><?php the_author(); ?></a></span></li>
                        <?php } ?>
						<?php if($show_date == "true") { ?><li class="blog-date"><span style="color: <?php echo  $text_colorpicker;?>" class="sp-text-color"><?php echo get_the_date(); ?></span></li><?php } ?>
					</ul>					
				</div>
                <?php } ?>
				<?php if($show_content == "true" && $show_read_more == 'true'){ ?>
					<a href="<?php the_permalink(); ?>" class="spk-blogpost-btn" onMouseOver="this.style.background='<?php echo $hover_readmore_background_color;?>';this.style.color='<?php echo $hover_readmore_text_colorpicker;?>';this.style.borderColor='<?php echo $hover_readmore_text_colorpicker;?>'" onMouseOut="this.style.background='<?php echo $readmore_background_color;?>';this.style.color='<?php echo $readmore_text_colorpicker;?>';this.style.borderColor='<?php echo $readmore_text_colorpicker;?>'" style="color: <?php echo  $readmore_text_colorpicker ?>;background-color: <?php echo  $readmore_background_color; ?>"><?php _e($read_more_text, 'sp-blog-designer'); ?></a>
                <?php } ?>

			</div>
		</div>
	</div>
</div>