<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package SP Blog Designer
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Spbd_Admin {
	function __construct() {
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'sp_register_menu'), 9 );
		// Action to add admin message
	}
	/**
	 * Function to register admin menus
	 * 
	 * @package SP Blog Designer
	 * @since 1.0.0
	 */
	function sp_register_menu() {
		// Getting Started Page
		add_menu_page(__(SPBD_PLUGIN_BASENAME),SPBD_PLUGIN_BASENAME, 'edit_pages','SpBlogDesigner', array($this, 'SpBlogDesigner'));
		add_submenu_page('SpBlogDesigner', 'Create Shortcode', 'Create Shortcode', 'edit_pages', 'SpBlogDesigner', array($this, 'SpBlogDesigner'));
		add_submenu_page('SpBlogDesigner', 'Help', 'Help', 'edit_pages', 'sp-help', array($this, 'SpBlogAboutUs'));
		add_submenu_page('SpBlogDesigner', 'FAQ', 'FAQ', 'edit_pages', 'sp-help&tab=faq', array($this, 'SpBlogAboutUs'));
		add_submenu_page('SpBlogDesigner', 'Contact Us', 'Contact Us', 'edit_pages', 'sp-help&tab=support', array($this, 'SpBlogAboutUs'));
	}

	function SpBlogDesigner(){ 
		include_once( SPBD_DIR . '/includes/admin/settings.php' );
	}

	function SpBlogAboutUs(){
		if(isset($_POST['contact_us'])){
			$params = array('action'=>'spbd_contact_us','name' => sanitize_text_field($_POST['owner_name']),'email' => sanitize_email($_POST['owner_email']),'message' => sanitize_text_field($_POST['text_message']));
    		spbd_remote_call($params);
		}
		include_once( SPBD_DIR . '/includes/admin/help.php' );
	}
}
$spbd_admin = new Spbd_Admin();