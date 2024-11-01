<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package SP Blog Designer
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Wpsp_Script {
	
	function __construct() {
		
		// Action for admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'sp_admin_script_style' ) );
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'sp_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'sp_front_script') );
        /*add_action( 'admin_enqueue_scripts', array($this, 'sp_enqueue_color_picker') );*/
	}
	
	
	/**
	 * Registring and enqueing admin sctipts and styles
	 *
	 * @package SP Blog Designer
 	 * @since 1.0
	 */
	function  sp_admin_script_style($hook_suffix) {
		// Front End Page JS
		if( function_exists('vc_is_frontend_editor') && vc_is_frontend_editor() ) {
			wp_register_script( 'sp-frontend', SPBD_URL . 'assets/js/sp-frontend.min.js', array(), SPBD_VERSION, true );
			wp_enqueue_script( 'sp-frontend' );
		}
		
		// Include required CSS
		wp_register_style( 'sp-admin-style', SPBD_URL . 'assets/css/sp-admin.css', array(), SPBD_VERSION );
		wp_enqueue_style( 'sp-admin-style' );
		wp_register_style( 'sp-front-style', SPBD_URL . 'assets/css/sp-blogs.css', array(), SPBD_VERSION );
		wp_enqueue_style( 'sp-front-style' );
		wp_register_style( 'sp-admin-style', 'https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;600;700&display=swap', array(), SPBD_VERSION );
		wp_enqueue_style( 'sp-admin-style' );
        wp_register_style( 'slick-style', SPBD_URL.'assets/css/slick.css', array(), SPBD_VERSION );
           
        wp_register_script( 'jquery-slick', SPBD_URL. 'assets/js/slick.min.js', array('jquery'), SPBD_VERSION, true);
		
		wp_register_script( 'sp-short-generator', SPBD_URL . 'assets/js/sp-shortcode.min.js', array( 'jquery' ), SPBD_VERSION, true );
		wp_register_script( 'spbd-frontend', SPBD_URL. 'assets/js/sp-frontend.min.js', array('jquery'), SPBD_VERSION, true );
		wp_localize_script( 'sp-short-generator', 'sp_Short_Generator', array(
																'shortcode_err' => esc_html__('Sorry, Something happened wrong. Kindly please be sure that you have choosen relevant shortcode from the dropdown.', 'sp-blog-designer'),
															));
		
        wp_enqueue_script( 'sp-color-picker', SPBD_URL . 'assets/js/sp-color-picker.js', array( 'wp-color-picker' ), false, true );

        $Param = array(
		  	'doShortCode' => admin_url( 'admin-ajax.php?action=SPBD_preview_shortcode' ),
		);
		wp_localize_script('SPBD_preview_shortcode','Param', $Param);
														
		// Shortcode Builder
		wp_enqueue_style( 'sp-admin-style' );
        wp_enqueue_style( 'slick-style' );
		wp_enqueue_script( 'shortcode' );	
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-slick' );
		wp_enqueue_script( 'sp-short-generator' );
        wp_enqueue_script( 'spbd-frontend' );
	}	
	/**
	 * Function to add style at front side
	 * 
	 * @package SP Blog Designer
	 * @since 1.0.0
	 */
	function sp_front_style() {
		wp_register_style( 'spbd-front-style', SPBD_URL . 'assets/css/sp-blogs.css', array(), SPBD_VERSION );
		wp_enqueue_style( 'spbd-front-style' );
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'slick-style', 'registered' ) ) {
			wp_register_style( 'slick-style', SPBD_URL.'assets/css/slick.css', array(), SPBD_VERSION );
			wp_enqueue_style( 'slick-style' );
		}
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package SP Blog Designer
	 * @since 1.0.0
	 */
	function sp_front_script() {
		
		global $post;
		// Taking post id 
		$post_id = isset($post->ID) ? $post->ID : '';
		// Registring slick slider script
		if( !wp_script_is( 'sp-slick-carousel', 'registered' ) ) {
			wp_register_script( 'sp-slick-carousel', SPBD_URL. 'assets/js/slick.min.js', array('jquery'), SPBD_VERSION, true);
		}	
        wp_register_script( 'spbd-frontend', SPBD_URL. 'assets/js/sp-frontend.min.js', array('jquery'), SPBD_VERSION, true );
        wp_enqueue_script( 'sp-slick-carousel' );
        wp_enqueue_script( 'spbd-frontend' );
	}
}
$sp_script = new Wpsp_Script();