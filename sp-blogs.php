<?php
/**
 * Plugin Name: SP Blog Designer
 * Plugin URI: https://softpulseinfotech.com/
 * Version: 1.0.0
 * Description: Display blog posts on your website with different layouts in few seconds!
 * Requires PHP : 5.6
 * Author: Softpulse Infotech
 * Author URI: https://softpulseinfotech.com
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Basic plugin definitions
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
if( !defined( 'SPBD_PLUGIN_BASENAME' ) ) {
	define( 'SPBD_PLUGIN_BASENAME', 'SP Blog Designer' ); // Version of plugin
}
if( !defined( 'SPBD_VERSION' ) ) {
	define( 'SPBD_VERSION', '1.0.0' ); // Version of plugin
}
if( !defined( 'SPBD_DIR' ) ) {
	define( 'SPBD_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'SPBD_URL' ) ) {
	define( 'SPBD_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'SPBD_PRO_FEATURE_URL' ) ) {
	define( 'SPBD_PRO_FEATURE_URL', 'https://wpplugins.shopiapps.in/sp-blog-designer/pro.php' ); // Plugin url
}
if( !defined( 'SPBD_STORE_URL' ) ) {
	define( 'SPBD_STORE_URL', 'https://wpplugins.shopiapps.in/sp-blog-designer/index.php' ); // Plugin url
}

if( !defined('SPBD_POST_TYPE') ) {
	define('SPBD_POST_TYPE', 'post'); // Post type name
}
if( !defined('SPBD_CATE') ) {
	define('SPBD_CATE', 'category'); // Post type name
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package SP Blog Designer
 * @since 1.0
 */
register_activation_hook( __FILE__, 'SpBlog_install' );
register_deactivation_hook( __FILE__, 'SpBlog_deactivate' );
/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
function SpBlog_install() {
	/* Intialization */
	// Deactivate pro version
	if( is_plugin_active('sp-blog-designer-pro/sp-blogs.php') ) {
		add_action( 'update_option_active_plugins', 'SpBlog_deactivate_pro_version' );
	}
	$blogusers = get_users('role=Administrator');
    foreach ($blogusers as $user) {
        $user_email = $user->user_email;
        $user_name = $user->user_login;
    }
	$params = array('action'=>'install_plugin','status' => 'installed','store_email'=> $user_email,'name' => $user_name,'version' => SPBD_VERSION);
   	
    spbd_remote_call($params);
}

function SpBlog_deactivate(){
	$params = array('action'=>'uninstall_plugin','status' => 'uninstalled');
    spbd_remote_call($params);
}
/**
 * Deactivate pro plugin
 * 
 * @package SP Blog Designer
 * @since 1.0.0
 */
function SpBlog_deactivate_pro_version() {
	deactivate_plugins('sp-blog-designer-pro/sp-blogs.php', true);
}

add_action( 'wp_ajax_nopriv_SPBD_preview_shortcode', 'SPBD_preview_shortcode' );
add_action( 'wp_ajax_SPBD_preview_shortcode', 'SPBD_preview_shortcode' );
// Functions file
require_once( SPBD_DIR . '/includes/sp-functions.php' );
// Script/ CSS Class
require_once( SPBD_DIR . '/includes/class-sp-script.php' );
require_once( SPBD_DIR . '/includes/admin/class-sp-admin.php' );
require_once( SPBD_DIR . '/includes/shortcode/wpsbd-post.php' );
require_once( SPBD_DIR . '/includes/shortcode/wpsbd-post-list.php' );
require_once( SPBD_DIR . '/includes/shortcode/wpsbd-post-carousel.php' );
require_once( SPBD_DIR . '/includes/shortcode/options-fields.php' );