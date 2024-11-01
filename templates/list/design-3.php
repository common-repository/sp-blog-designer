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
<div class="spk-blogposts-item spk-list-i3 post-list-design-3">
	<div class="spk-blogposts-bx main-box-background" style="background-color: <?php echo  $box_background_color;?>">
        <?php if($show_date == "true"){?>
    		<div class="spk-short-time">
    			<?php $dt = strtotime(get_the_date()); ?>
                <span class='date-color' style="background-color: <?php echo  $date_background_color;?>;color: <?php echo  $date_text_colorpicker;?>"><?php echo date('d',$dt); ?></span>
                <span class='text-color' style="color: <?php echo  $date_text_colorpicker;?>"><?php echo date('M',$dt); ?><br><?php echo date('Y',$dt); ?></span>
    		</div>
        <?php } ?>
		<a href="<?php the_permalink(); ?>" class="spk-blogposts-img">
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title_attribute(); ?>">
		</a>
		<div class="spk-blogposts-text box-background" style="background-color: <?php echo  $background_color?>">
			 <?php if($show_category == 'true') { ?>
            <div class="spk-ctg-tag categoryBlog">
                <?php if(!empty($show_category) && $show_category == 'true'  && $cate_name != '') { ?>
                    <?php echo str_replace(',', ' ', $cate_name);  ?><?php } ?>
            </div>
            <?php } ?>
			<h2 class="spk-blogpost-title"  style="color: <?php echo  $title_colorpicker;?>"><a href="<?php the_permalink(); ?>" target="_self" class="sp-title-color" style="color: <?php echo  $title_colorpicker;?>"><?php echo get_the_title(); ?></a></h2>										
			<?php if($show_content == "true") { ?>
					<div class="spk-blogpost-rte sp-text-color" style="color: <?php echo  $text_colorpicker;?>">
					<?php if($words_limit > 0 ) { ?>
						<?php echo spbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?>
					<?php } else {
						the_content();
					} ?>
					</div>
				<?php } ?>
				<?php if($show_comments == "true" || $show_author == 'true') { ?>
			<div class="spk-blogpost-i1nfo">
				<?php if($show_author == 'true') { ?>
				<span class="sp-text-color" style="color: <?php echo  $text_colorpicker;?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 512 512"><path d="M437.02,330.98c-27.883-27.882-61.071-48.523-97.281-61.018C378.521,243.251,404,198.548,404,148    C404,66.393,337.607,0,256,0S108,66.393,108,148c0,50.548,25.479,95.251,64.262,121.962    c-36.21,12.495-69.398,33.136-97.281,61.018C26.629,379.333,0,443.62,0,512h40c0-119.103,96.897-216,216-216s216,96.897,216,216    h40C512,443.62,485.371,379.333,437.02,330.98z M256,256c-59.551,0-108-48.448-108-108S196.449,40,256,40    c59.551,0,108,48.448,108,108S315.551,256,256,256z"></path></svg> <?php the_author(); ?></span>
			<?php } ?>
                <?php if($show_comments == 'true') { ?>
				<span class="sp-text-color" style="color: <?php echo  $text_colorpicker;?>"><svg id="Capa_1" enable-background="new 0 0 511.072 511.072" height="14" viewBox="0 0 511.072 511.072" width="14" xmlns="http://www.w3.org/2000/svg" style="transform: rotate3d(0, 1, 0, 180deg);"><g id="Speech_Bubble_48_"><g><path d="m74.39 480.536h-36.213l25.607-25.607c13.807-13.807 22.429-31.765 24.747-51.246-36.029-23.644-62.375-54.751-76.478-90.425-14.093-35.647-15.864-74.888-5.121-113.482 12.89-46.309 43.123-88.518 85.128-118.853 45.646-32.963 102.47-50.387 164.33-50.387 77.927 0 143.611 22.389 189.948 64.745 41.744 38.159 64.734 89.63 64.734 144.933 0 26.868-5.471 53.011-16.26 77.703-11.165 25.551-27.514 48.302-48.593 67.619-46.399 42.523-112.042 65-189.83 65-28.877 0-59.01-3.855-85.913-10.929-25.465 26.123-59.972 40.929-96.086 40.929zm182-420c-124.039 0-200.15 73.973-220.557 147.285-19.284 69.28 9.143 134.743 76.043 175.115l7.475 4.511-.23 8.727c-.456 17.274-4.574 33.912-11.945 48.952 17.949-6.073 34.236-17.083 46.99-32.151l6.342-7.493 9.405 2.813c26.393 7.894 57.104 12.241 86.477 12.241 154.372 0 224.682-93.473 224.682-180.322 0-46.776-19.524-90.384-54.976-122.79-40.713-37.216-99.397-56.888-169.706-56.888z"/></g></g></svg> <?php echo $comments;?></span>
            <?php } ?>
			</div>
		<?php } ?>
			<?php if($show_content == "true" && $show_read_more == 'true'){ ?>
					<a href="<?php the_permalink(); ?>" class="spk-blogpost-btn" onMouseOver="this.style.background='<?php echo $hover_readmore_background_color;?>';this.style.color='<?php echo $hover_readmore_text_colorpicker;?>';this.style.borderColor='<?php echo $hover_readmore_text_colorpicker;?>'" onMouseOut="this.style.background='<?php echo $readmore_background_color;?>';this.style.color='<?php echo $readmore_text_colorpicker;?>';this.style.borderColor='<?php echo $readmore_text_colorpicker;?>'" style="color: <?php echo  $readmore_text_colorpicker ?>;background-color: <?php echo  $readmore_background_color; ?>"><?php _e($read_more_text, 'sp-blog-designer'); ?></a>
			<?php } ?>
		</div>
	</div>
</div>