<?php
/**
 * Shortcode Fields for Shortcode Preview 
 *
 * @package SP Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Generate 'wpsbd_post' shortcode fields
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
function wpsbd_post_shortcode_fields( $shortcode = '' ) {
    $fields = array(
            // General Settings
            'general' => array(
                    'title'     => __('General Parameters', 'sp-blog-designer'),
                    'params'    =>  array(
                                        array(
                                            'type'      => 'select',
                                            'heading'   => __( 'Design', 'sp-blog-designer' ),
                                            'name'      => 'design',
                                            'value'     => spbd_designs_type(),
                                            'default'   => 'default',
                                            'desc'      => __( 'Choose Design Type.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Grid', 'sp-blog-designer' ),
                                            'name'          => 'grid',
                                            'value'         => array(
                                                                    '1'  => __( 'Grid 1', 'sp-blog-designer' ),
                                                                    '2'  => __( 'Grid 2', 'sp-blog-designer' ),
                                                                    '3'  => __( 'Grid 3', 'sp-blog-designer' ),
                                                                    '4'  => __( 'Grid 4', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => '3',
                                            'desc'          => __( 'Choose Number Of Column To Be Displayed.', 'sp-blog-designer' ),
                                        ),
                                       
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Date', 'sp-blog-designer' ),
                                            'name'          => 'show_date',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Date.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Author', 'sp-blog-designer' ),
                                            'name'          => 'show_author',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Author.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Tags', 'sp-blog-designer' ),
                                            'name'          => 'show_tags',
                                            'value'         => array( 
                                                                    'true'      => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false'     => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'false',
                                            'desc'          => __( 'Display Post Tags.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Category', 'sp-blog-designer' ),
                                            'name'          => 'show_category',
                                            'value'         => array( 
                                                                    'true'      => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false'     => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Category.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Content', 'sp-blog-designer' ),
                                            'name'          => 'show_content',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Content.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'number',
                                            'heading'       => __( 'Content Word Limit', 'sp-blog-designer' ),
                                            'name'          => 'content_words_limit',
                                            'value'         => 20,
                                            'default'       => '20',
                                            'desc'          => __( 'Enter Content Word Limit.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_content',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Read More', 'sp-blog-designer' ),
                                            'name'          => 'show_read_more',
                                            'value'         => array(
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Show Read More Button.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_content',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Image Size', 'sp-blog-designer' ),
                                            'name'          => 'media_size',
                                            'value'         => array(
                                                                    'full'  => __( 'Full', 'sp-blog-designer' ),
                                                                    'thumbnail' => __( 'Thumbnail', 'sp-blog-designer' ),
                                                                    'large' => __( 'Large', 'sp-blog-designer' ),
                                                                    'medium_large'  => __( 'Medium Large', 'sp-blog-designer' ),
                                                                    'medium'    => __( 'Medium', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'full',
                                            'desc'          => __( 'Choose WordPress Registered Image Size. e.g', 'sp-blog-designer' ),
                                        ),
                                    )
            ),
            /* Data Fields */
            'query' => array(
                    'title'     => __('Query Parameters', 'sp-blog-designer'),
                    'params'    => array(       
                                        
                                        array(
                                            'type'          => 'number',
                                            'heading'       => __( 'Total Number of Post', 'sp-blog-designer' ),
                                            'name'          => 'limit',
                                            'value'         => 20,
                                            'min'           => -1,
                                            'default'       => '20',
                                            'desc'          => __( 'Enter Total Number Of Post To Be Displayed. Enter -1 To Display All.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Post Order By', 'sp-blog-designer' ),
                                            'name'          => 'orderby',
                                            'value'         =>  array(
                                                                    'date'          => __( 'Post Date', 'sp-blog-designer' ),
                                                                    'ID'            => __( 'Post ID', 'sp-blog-designer' ),
                                                                    'author'        => __( 'Post Author', 'sp-blog-designer' ),
                                                                    'title'         => __( 'Post Title', 'sp-blog-designer' ),
                                                                    'modified'      => __( 'Post Modified Date', 'sp-blog-designer' ),
                                                                    'rand'          => __( 'Random', 'sp-blog-designer' ),
                                                                ),
                                            'is_premium'    => true,
                                            'default'       => 'date',
                                            'desc'          => __( 'This is premium features', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Post Order', 'sp-blog-designer' ),
                                            'name'          => 'order',
                                            'value'         => array(
                                                                    'desc'  => __( 'Descending', 'sp-blog-designer' ),
                                                                    'asc'   =>  __( 'Ascending', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'desc',
                                            'desc'          => __( 'Select Sorting Order.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Pagination', 'sp-blog-designer' ),
                                            'name'          => 'pagination',
                                            'value'         => array( 
                                                                'true'  => __( 'True', 'sp-blog-designer' ),
                                                                'false' => __( 'False', 'sp-blog-designer' ),
                                                            ),
                                            'default'       => 'true',
                                            'dependency'    => array(
                                                                        'element'               => 'limit',
                                                                        'value_not_equal_to'    => '-1',
                                                                    ),
                                            'desc'          => __( 'Display Pagination.', 'sp-blog-designer' ),
                                        ),                          
                                    )
                ),
            
            /* Data Fields */
            'appearance' => array(
                    'title'     => __('Appearance Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Text Color', 'sp-blog-designer' ),
                                            'name'          => 'text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'desc'          => __( 'Select Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Background Color', 'sp-blog-designer' ),
                                            'name'          => 'background_color',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'desc'          => __( 'Select Background Color.', 'sp-blog-designer' ),
                                        ),
                                         array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Box Background Color', 'sp-blog-designer' ),
                                            'name'          => 'box_background_color',
                                            'value'         => '',
                                            'default'       => '',
                                            'desc'          => __( 'Select Background Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Read More Text Color', 'sp-blog-designer' ),
                                            'name'          => 'readmore_text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'desc'          => __( 'Select Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Read More Background Color', 'sp-blog-designer' ),
                                            'name'          => 'readmore_background_color',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'desc'          => __( 'Select Background Color.', 'sp-blog-designer' ),
                                        ), 
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Category Text Color', 'sp-blog-designer' ),
                                            'name'          => 'category_text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Category Background Color', 'sp-blog-designer' ),
                                            'name'          => 'category_background_color',
                                            'value'         => '#F7F7F7',
                                            'default'       => '#F7F7F7',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Tag Text Color', 'sp-blog-designer' ),
                                            'name'          => 'tag_text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Tag  Background Color', 'sp-blog-designer' ),
                                            'name'          => 'tag_background_color',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Hover Text Color', 'sp-blog-designer' ),
                                            'name'          => 'hover_readmore_text_colorpicker',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ), 
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Hover Background Color', 'sp-blog-designer' ),
                                            'name'          => 'hover_readmore_background_color',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ), 
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Date Badge Text Color', 'sp-blog-designer' ),
                                            'name'          => 'date_text_colorpicker',
                                            'value'         => '',
                                            'default'       => '',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Date Badge Background Color', 'sp-blog-designer' ),
                                            'name'          => 'date_background_color',
                                            'value'         => '',
                                            'default'       => '',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),                            
                                        
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Pagination Text Color', 'sp-blog-designer' ),
                                            'name'          => 'pagination_text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'desc'          => __( 'Select Pagination Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Pagination Background Color', 'sp-blog-designer' ),
                                            'name'          => 'pagination_background_color',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'desc'          => __( 'Select Pagination Background Color.', 'sp-blog-designer' ),
                                        ),
                                    )
                ),
            // Pro Grid Fields
            'premium' => array(
                    'title'     => __('Premium Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Text', 'sp-blog-designer' ),
                                            'name'          => 'read_more_text',
                                            'value'         => __( 'Read More', 'sp-blog-designer' ),
                                            'default'       => 'Read More',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_read_more',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'      => 'select',
                                            'heading'   => __( 'Post Link Target', 'sp-blog-designer' ),
                                            'name'      => 'link_behaviour',
                                            'is_premium'    => true,
                                            'value'     => array(
                                                                'self'  => __( 'Same Tab', 'sp-blog-designer' ),
                                                                'new'   => __( 'New Tab', 'sp-blog-designer' ),
                                                            ),
                                            'default'   => 'self',
                                            'desc'      => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Pagination Type', 'sp-blog-designer' ),
                                            'name'          => 'pagination_type',
                                            'value'         => array(
                                                                    'numeric'           => __( 'Numeric', 'sp-blog-designer' ),
                                                                    'prev-next'         => __( 'Next - Prev', 'sp-blog-designer' )
                                                                ),
                                            'is_premium'    => true,
                                            'default'       => 'numeric',
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                'element'               => 'pagination',
                                                                'value_not_equal_to'    => array( 'false' ),
                                                            ),
                                        )                          
                                    )
                )
        );
    return $fields;
}

function wpsbd_post_list_shortcode_fields( $shortcode = '' ) {
    $fields = array(
            // General Settings
            'general' => array(
                    'title'     => __('General Parameters', 'sp-blog-designer'),
                    'params'    =>  array(
                                        array(
                                            'type'      => 'select',
                                            'heading'   => __( 'Design', 'sp-blog-designer' ),
                                            'name'      => 'design',
                                            'value'     => spbd_designs_type_list(),
                                            'default'   => 'default',
                                            'desc'      => __( 'Choose Design Type.', 'sp-blog-designer' ),
                                        ),
                                       
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Date', 'sp-blog-designer' ),
                                            'name'          => 'show_date',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Date.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Author', 'sp-blog-designer' ),
                                            'name'          => 'show_author',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Author.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Comments', 'sp-blog-designer' ),
                                            'name'          => 'show_comments',
                                            'value'         => array(
                                                                    'true'      => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false'     => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Comment Count.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Category', 'sp-blog-designer' ),
                                            'name'          => 'show_category',
                                            'value'         => array( 
                                                                    'true'      => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false'     => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Category.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Content', 'sp-blog-designer' ),
                                            'name'          => 'show_content',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Content.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'number',
                                            'heading'       => __( 'Content Word Limit', 'sp-blog-designer' ),
                                            'name'          => 'content_words_limit',
                                            'value'         => 20,
                                            'default'       => '20',
                                            'desc'          => __( 'Enter Content Word Limit.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_content',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Read More', 'sp-blog-designer' ),
                                            'name'          => 'show_read_more',
                                            'value'         => array(
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Show Read More Button.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_content',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Image Size', 'sp-blog-designer' ),
                                            'name'          => 'media_size',
                                            'value'         => array(
                                                                    'full'  => __( 'Full', 'sp-blog-designer' ),
                                                                    'thumbnail' => __( 'Thumbnail', 'sp-blog-designer' ),
                                                                    'large' => __( 'Large', 'sp-blog-designer' ),
                                                                    'medium_large'  => __( 'Medium Large', 'sp-blog-designer' ),
                                                                    'medium'    => __( 'Medium', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'full',
                                            'desc'          => __( 'Choose WordPress Registered Image Size. e.g', 'sp-blog-designer' ),
                                        ),
                                    )
            ),
            /* Data Fields */
            'query' => array(
                    'title'     => __('Query Parameters', 'sp-blog-designer'),
                    'params'    => array(    
                                        array(
                                            'type'          => 'number',
                                            'heading'       => __( 'Total Number of Post', 'sp-blog-designer' ),
                                            'name'          => 'limit',
                                            'value'         => 20,
                                            'min'           => -1,
                                            'default'       => '20',
                                            'desc'          => __( 'Enter Total Number Of Post To Be Displayed. Enter -1 To Display All.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Post Order By', 'sp-blog-designer' ),
                                            'name'          => 'orderby',
                                            'value'         =>  array(
                                                                    'date'          => __( 'Post Date', 'sp-blog-designer' ),
                                                                    'ID'            => __( 'Post ID', 'sp-blog-designer' ),
                                                                    'author'        => __( 'Post Author', 'sp-blog-designer' ),
                                                                    'title'         => __( 'Post Title', 'sp-blog-designer' ),
                                                                    'modified'      => __( 'Post Modified Date', 'sp-blog-designer' ),
                                                                    'rand'          => __( 'Random', 'sp-blog-designer' ),
                                                                ),
                                            'is_premium'    => true,
                                            'default'       => 'date',
                                            'desc'          => __( 'This is premium features', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Post Order', 'sp-blog-designer' ),
                                            'name'          => 'order',
                                            'value'         => array(
                                                                    'desc'  => __( 'Descending', 'sp-blog-designer' ),
                                                                    'asc'   =>  __( 'Ascending', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'desc',
                                            'desc'          => __( 'Select Sorting Order.', 'sp-blog-designer' ),
                                        ),
                                        // array(
                                        //     'type'          => 'text',
                                        //     'heading'       => __( 'Display Specific Category', 'sp-blog-designer' ),
                                        //     'name'          => 'category',
                                        //     'value'         => '',
                                        //     'desc'          => __( 'Enter category id OR slug to display categories wise. You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'sp-blog-designer'),
                                        // ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Pagination', 'sp-blog-designer' ),
                                            'name'          => 'pagination',
                                            'value'         => array( 
                                                                'true'  => __( 'True', 'sp-blog-designer' ),
                                                                'false' => __( 'False', 'sp-blog-designer' ),
                                                            ),
                                            'default'       => 'true',
                                            'dependency'    => array(
                                                                        'element'               => 'limit',
                                                                        'value_not_equal_to'    => '-1',
                                                                    ),
                                            'desc'          => __( 'Display Pagination.', 'sp-blog-designer' ),
                                        ), 
                    
                                    )
                ),
                
            'appearance' => array(
                    'title'     => __('Appearance Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Title Color', 'sp-blog-designer' ),
                                            'name'          => 'title_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'desc'          => __( 'Select Title Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Text Color', 'sp-blog-designer' ),
                                            'name'          => 'text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'desc'          => __( 'Select Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Background Color', 'sp-blog-designer' ),
                                            'name'          => 'background_color',
                                            'value'         => '#b7d6d1',
                                            'default'       => '#b7d6d1',
                                            'desc'          => __( 'Select Background Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Box Background Color', 'sp-blog-designer' ),
                                            'name'          => 'box_background_color',
                                            'value'         => '#f5ede4',
                                            'default'       => '#f5ede4',
                                            'desc'          => __( 'Select Box Background Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Comments Text Color', 'sp-blog-designer' ),
                                            'name'          => 'comments_text_color',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Comments Background Color', 'sp-blog-designer' ),
                                            'name'          => 'comments_background_color',
                                            'value'         => '#C0C0C0',
                                            'default'       => '#C0C0C0',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Category Text Color', 'sp-blog-designer' ),
                                            'name'          => 'category_text_colorpicker',
                                            'value'         => '#111111',
                                            'default'       => '#111111',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Category Background Color', 'sp-blog-designer' ),
                                            'name'          => 'category_background_color',
                                            'value'         => '#6b90a8',
                                            'default'       => '#6b90a8',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Tag Text Color', 'sp-blog-designer' ),
                                            'name'          => 'tag_text_colorpicker',
                                            'value'         => '',
                                            'default'       => '',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Tag  Background Color', 'sp-blog-designer' ),
                                            'name'          => 'tag_background_color',
                                            'value'         => '',
                                            'default'       => '',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Read More Text Color', 'sp-blog-designer' ),
                                            'name'          => 'readmore_text_colorpicker',
                                            'value'         => '#FFFFFF',
                                            'default'       => '#FFFFFF',
                                            'desc'          => __( 'Select Read More Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Read More Background Color', 'sp-blog-designer' ),
                                            'name'          => 'readmore_background_color',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'desc'          => __( 'Select Read More Background Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Hover Text Color', 'sp-blog-designer' ),
                                            'name'          => 'hover_readmore_text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ), 
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Hover Background Color', 'sp-blog-designer' ),
                                            'name'          => 'hover_readmore_background_color',
                                            'value'         => '#FFFFFF',
                                            'default'       => '#FFFFFF',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),                             
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Date Badge Text Color', 'sp-blog-designer' ),
                                            'name'          => 'date_text_colorpicker',
                                            'value'         => '',
                                            'default'       => '',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Date Badge Background Color', 'sp-blog-designer' ),
                                            'name'          => 'date_background_color',
                                            'value'         => '',
                                            'default'       => '',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),          
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Pagination Text Color', 'sp-blog-designer' ),
                                            'name'          => 'pagination_text_colorpicker',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            'class'         => 'spk-blogpost-tags',
                                            'property'      => 'background',
                                            'desc'          => __( 'Select Pagination Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Pagination Background Color', 'sp-blog-designer' ),
                                            'name'          => 'pagination_background_color',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'desc'          => __( 'Select Pagination Background Color.', 'sp-blog-designer' ),
                                        ),
                                    )
                ),
            // Pro Grid Fields
            'premium' => array(
                    'title'     => __('Premium Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Text', 'sp-blog-designer' ),
                                            'name'          => 'read_more_text',
                                            'value'         => __( 'Read More', 'sp-blog-designer' ),
                                            'default'       => 'Read More',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_read_more',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'      => 'select',
                                            'heading'   => __( 'Post Link Target', 'sp-blog-designer' ),
                                            'name'      => 'link_behaviour',
                                            'value'     => array(
                                                                'self'  => __( 'Same Tab', 'sp-blog-designer' ),
                                                                'new'   => __( 'New Tab', 'sp-blog-designer' ),
                                                            ),
                                            'default'   => 'self',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),                                
                                    )
                )
        );
    return $fields;
}

function wpsbd_post_carousel_shortcode_fields( $shortcode = '' ) {
    $fields = array(
            // General Settings
            'general' => array(
                    'title'     => __('General Parameters', 'sp-blog-designer'),
                    'params'    =>  array(
                                        array(
                                            'type'      => 'select',
                                            'heading'   => __( 'Design', 'sp-blog-designer' ),
                                            'name'      => 'design',
                                            'value'     => array('design-1'  => __('Design 1', 'sp-blog-designer')),
                                            'default'   => 'default',
                                            'desc'      => __( 'Choose Design Type.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Date', 'sp-blog-designer' ),
                                            'name'          => 'show_date',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Date.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Author', 'sp-blog-designer' ),
                                            'name'          => 'show_author',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Author.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Comments', 'sp-blog-designer' ),
                                            'name'          => 'show_comments',
                                            'value'         => array(
                                                                    'true'      => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false'     => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Comment Count.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Category', 'sp-blog-designer' ),
                                            'name'          => 'show_category',
                                            'value'         => array( 
                                                                    'true'      => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false'     => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Category.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Content', 'sp-blog-designer' ),
                                            'name'          => 'show_content',
                                            'value'         => array( 
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Display Post Content.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'number',
                                            'heading'       => __( 'Content Word Limit', 'sp-blog-designer' ),
                                            'name'          => 'content_words_limit',
                                            'value'         => 20,
                                            'default'       => '20',
                                            'desc'          => __( 'Enter Content Word Limit.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_content',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Show Read More', 'sp-blog-designer' ),
                                            'name'          => 'show_read_more',
                                            'value'         => array(
                                                                    'true'  => __( 'Yes', 'sp-blog-designer' ),
                                                                    'false' => __( 'No', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'true',
                                            'desc'          => __( 'Show Read More Button.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_content',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Image Size', 'sp-blog-designer' ),
                                            'name'          => 'media_size',
                                            'value'         => array(
                                                                    'full'  => __( 'Full', 'sp-blog-designer' ),
                                                                    'thumbnail' => __( 'Thumbnail', 'sp-blog-designer' ),
                                                                    'large' => __( 'Large', 'sp-blog-designer' ),
                                                                    'medium_large'  => __( 'Medium Large', 'sp-blog-designer' ),
                                                                    'medium'    => __( 'Medium', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'full',
                                            'desc'          => __( 'Choose WordPress Registered Image Size. e.g', 'sp-blog-designer' ),
                                        ),
                                    )
            ),

            // Slider Fields
            'slider' => array(
                'title'     => __('Slider Parameters', 'sp-blog-designer'),
                'params'    => array(  
                                    
                                    array(
                                        'type'          => 'select',
                                        'heading'       => __( 'Show Infinite', 'sp-blog-designer' ),
                                        'name'          => 'infinite',
                                        'value'         =>  array(
                                                                'true'          => __( 'Yes', 'sp-blog-designer' ),
                                                                'false'            => __( 'No', 'sp-blog-designer' ),
                                                            ),
                                        'default'       => 'true',
                                        'desc'          => __( 'Enable Slider Loop.', 'sp-blog-designer' ),
                                    ),

                                    array(
                                        'type'          => 'select',
                                        'heading'       => __( 'Show Arrows', 'sp-blog-designer' ),
                                        'name'          => 'arrows',
                                        'value'         =>  array(
                                                                'true'          => __( 'Yes', 'sp-blog-designer' ),
                                                                'false'            => __( 'No', 'sp-blog-designer' ),
                                                            ),
                                        'default'       => 'true',
                                        'desc'          => __( 'Show Prev - Next Arrows.', 'sp-blog-designer' ),
                                    ),

                                    array(
                                        'type'          => 'select',
                                        'heading'       => __( 'Show fade', 'sp-blog-designer' ),
                                        'name'          => 'fade',
                                        'value'         =>  array(
                                                                'true'          => __( 'Yes', 'sp-blog-designer' ),
                                                                'false'            => __( 'No', 'sp-blog-designer' ),
                                                            ),
                                        'default'       => 'true',
                                        'desc'          => __( 'Show Prev - Next Fade.', 'sp-blog-designer' ),
                                    ),

                                    array(
                                        'type'          => 'select',
                                        'heading'       => __( 'Show AdaptiveHeight', 'sp-blog-designer' ),
                                        'name'          => 'adaptiveHeight',
                                        'value'         =>  array(
                                                                'true'          => __( 'Yes', 'sp-blog-designer' ),
                                                                'false'            => __( 'No', 'sp-blog-designer' ),
                                                            ),
                                        'default'       => 'true',
                                        'desc'          => __( 'Show Prev - Next AdaptiveHeight.', 'sp-blog-designer' ),
                                    ),

                                    array(
                                        'type'          => 'select',
                                        'heading'       => __( 'Show Dots', 'sp-blog-designer' ),
                                        'name'          => 'dots',
                                        'value'         =>  array(
                                                                'true'          => __( 'Yes', 'sp-blog-designer' ),
                                                                'false'            => __( 'No', 'sp-blog-designer' ),
                                                            ),
                                        'default'       => 'false',
                                        "is_premium"    => true,
                                        'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                    ),
                                    array(
                                        'type'          => 'select',
                                        'heading'       => __( 'Auto Play', 'sp-blog-designer' ),
                                        'name'          => 'autoplay',
                                        'value'         =>  array(
                                                                'true'          => __( 'Yes', 'sp-blog-designer' ),
                                                                'false'            => __( 'No', 'sp-blog-designer' ),
                                                            ),
                                        'default'       => 'true',
                                        "is_premium"    => true,
                                        'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                    ),
                                    array(
                                        'type'          => 'number',
                                        'heading'       => __( 'Autoplay Interval', 'sp-blog-designer' ),
                                        'name'          => 'autoplaySpeed',
                                        'value'         => 5000,
                                        'min'           => -1,
                                        'default'       => 5000,
                                        "is_premium"    => true,
                                        'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        'dependency'    => array(
                                                            'element'   => 'autoplay',
                                                            'value'     => array( 'true' ),
                                                        ),
                                    ),
                                    array(
                                        'type'          => 'number',
                                        'heading'       => __( 'Speed', 'sp-blog-designer' ),
                                        'name'          => 'speed',
                                        'value'         => '',
                                        'min'           => '',
                                        'default'       => '',
                                        "is_premium"    => true,
                                        'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        'dependency'    => array(
                                                            'element'   => 'autoplay',
                                                            'value'     => array( 'true' ),
                                                        ),
                                    ),
               
                                )
            ),
            'appearance' => array(
                    'title'     => __('Appearance Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Text Color', 'sp-blog-designer' ),
                                            'name'          => 'text_colorpicker',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'desc'          => __( 'Select Text Color.', 'sp-blog-designer' ),
                                        ),
                                        
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Category Text Color', 'sp-blog-designer' ),
                                            'name'          => 'category_text_colorpicker',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Category Background Color', 'sp-blog-designer' ),
                                            'name'          => 'category_background_color',
                                            'value'         => '#fb5b21',
                                            'default'       => '#fb5b21',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.',  'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'colorpicker',
                                            'heading'       => __( 'Read More Text Color', 'sp-blog-designer' ),
                                            'name'          => 'readmore_text_colorpicker',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            'desc'          => __( 'Select Read More Text Color.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Hover Read More Text Color', 'sp-blog-designer' ),
                                            'name'          => 'hover_readmore_text_colorpicker',
                                            'value'         => '#ffffff',
                                            'default'       => '#ffffff',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.',  'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Hover Read More Background Color', 'sp-blog-designer' ),
                                            'name'          => 'hover_readmore_background_color',
                                            'value'         => '#000000',
                                            'default'       => '#000000',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.',  'sp-blog-designer' ),
                                        )
                                    )
                ),
            /* Data Fields */
            'query' => array(
                    'title'     => __('Query Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'number',
                                            'heading'       => __( 'Total Number of Post', 'sp-blog-designer' ),
                                            'name'          => 'limit',
                                            'value'         => 5,
                                            'min'           => -1,
                                            'default'       => '5',
                                            "is_premium"    => true,
                                            'desc'          => __( 'Enter Total Number Of Post To Be Displayed. Enter -1 To Display All.', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Post Order By', 'sp-blog-designer' ),
                                            'name'          => 'orderby',
                                            'value'         =>  array(
                                                                    'date'          => __( 'Post Date', 'sp-blog-designer' ),
                                                                    'ID'            => __( 'Post ID', 'sp-blog-designer' ),
                                                                    'author'        => __( 'Post Author', 'sp-blog-designer' ),
                                                                    'title'         => __( 'Post Title', 'sp-blog-designer' ),
                                                                    'modified'      => __( 'Post Modified Date', 'sp-blog-designer' ),
                                                                    'rand'          => __( 'Random', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'date',
                                            'is_premium'    => true,
                                            'desc'          => __( 'This is premium features', 'sp-blog-designer' ),
                                        ),
                                        array(
                                            'type'          => 'select',
                                            'heading'       => __( 'Post Order', 'sp-blog-designer' ),
                                            'name'          => 'order',
                                            'value'         => array(
                                                                    'desc'  => __( 'Descending', 'sp-blog-designer' ),
                                                                    'asc'   =>  __( 'Ascending', 'sp-blog-designer' ),
                                                                ),
                                            'default'       => 'desc',
                                            'desc'          => __( 'Select Sorting Order.', 'sp-blog-designer' ),
                                        ),               
                                    )
                ),
            // Pro Grid Fields
            'premium' => array(
                    'title'     => __('Premium Parameters', 'sp-blog-designer'),
                    'params'    => array(
                                        array(
                                            'type'          => 'text',
                                            'heading'       => __( 'Read More Text', 'sp-blog-designer' ),
                                            'name'          => 'read_more_text',
                                            'value'         => __( 'Read More', 'sp-blog-designer' ),
                                            'default'       => 'Read More',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                            'dependency'    => array(
                                                                    'element'   => 'show_read_more',
                                                                    'value'     => array( 'true' ),
                                                                ),
                                        ),
                                        
                                        array(
                                            'type'      => 'select',
                                            'heading'   => __( 'Post Link Target', 'sp-blog-designer' ),
                                            'name'      => 'link_behaviour',
                                            'value'     => array(
                                                                'self'  => __( 'Same Tab', 'sp-blog-designer' ),
                                                                'new'   => __( 'New Tab', 'sp-blog-designer' ),
                                                            ),
                                            'default'   => 'self',
                                            "is_premium"    => true,
                                            'desc'          => __( 'This is premium features.', 'sp-blog-designer' ),
                                        )                         
                                    )
                )
        );
    return $fields;
}