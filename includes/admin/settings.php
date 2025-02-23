<?php
/**
 * Featured and Trending Post Pro Shortcode Mapper Page 
 *
 * @package SP Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$valid					= true;
$shortcodes_arr 		= spbd_registered_shortcodes( false );
$preview_shortcode 		= !empty($_GET['shortcode']) ? spbd_sanitize($_GET['shortcode']) : 'wpsbd_post' ;
$preview_url 			= add_query_arg( array( 'page' => 'sp-shortcode-preview', 'shortcode' => $preview_shortcode), admin_url('admin.php') );
$appreanceObj = spbd_theme_colors($preview_shortcode);
$sliderObj = spbd_slider_options('design-1');
$shrt_url   = add_query_arg( array('page' => 'SpBlogDesigner'), admin_url('admin.php') );
$shortcode_sanitize = str_replace('-', '_', $preview_shortcode);
?>
<script type="text/javascript">
	var apperanceObj = '<?php echo json_encode($appreanceObj);?>';
	var sliderObj = '<?php echo json_encode($sliderObj);?>';
</script>
<div class="spk-admin-settings">
	
	<?php
	// If invalid shortcode is passed then simply return
	if( !empty($_GET['shortcode']) && !isset( $shortcodes_arr[ spbd_sanitize($_GET['shortcode']) ] ) ) {
		
		$valid = false;
		echo '<div id="message" class="error notice">
				<p><strong>'.__('Sorry, Something happened wrong.', 'sp-blog-designer').'</strong></p>
			 </div>';
	}
	?>
	<?php if( $valid ) : ?>
	<div class="spk-admin-strow">
		
		<div class="spk-admin-slidebar">
			<h2 class="spk-sidebar-title">Shortcode Parameters</h2>
			<?php
			if ( function_exists( $shortcode_sanitize.'_shortcode_fields' ) ) {
				$fields = call_user_func( $shortcode_sanitize.'_shortcode_fields', $preview_shortcode );
			}
			if( !empty( $fields ) ) : 
				spbd_options_create( $fields );
			endif; ?>
		</div>
		<div class="spk-admin-previewbar">
			<div class="spk-preview-block">
				<div class="spktitle-option">
					<h2> 
						<div class="spk-tooltip-ic">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 23.625 23.625"><path d="M11.812,0C5.289,0,0,5.289,0,11.812s5.289,11.813,11.812,11.813s11.813-5.29,11.813-11.813   S18.335,0,11.812,0z M14.271,18.307c-0.608,0.24-1.092,0.422-1.455,0.548c-0.362,0.126-0.783,0.189-1.262,0.189   c-0.736,0-1.309-0.18-1.717-0.539s-0.611-0.814-0.611-1.367c0-0.215,0.015-0.435,0.045-0.659c0.031-0.224,0.08-0.476,0.147-0.759   l0.761-2.688c0.067-0.258,0.125-0.503,0.171-0.731c0.046-0.23,0.068-0.441,0.068-0.633c0-0.342-0.071-0.582-0.212-0.717   c-0.143-0.135-0.412-0.201-0.813-0.201c-0.196,0-0.398,0.029-0.605,0.09c-0.205,0.063-0.383,0.12-0.529,0.176l0.201-0.828   c0.498-0.203,0.975-0.377,1.43-0.521c0.455-0.146,0.885-0.218,1.29-0.218c0.731,0,1.295,0.178,1.692,0.53   c0.395,0.353,0.594,0.812,0.594,1.376c0,0.117-0.014,0.323-0.041,0.617c-0.027,0.295-0.078,0.564-0.152,0.811l-0.757,2.68   c-0.062,0.215-0.117,0.461-0.167,0.736c-0.049,0.275-0.073,0.485-0.073,0.626c0,0.356,0.079,0.599,0.239,0.728   c0.158,0.129,0.435,0.194,0.827,0.194c0.185,0,0.392-0.033,0.626-0.097c0.232-0.064,0.4-0.121,0.506-0.17L14.271,18.307z    M14.137,7.429c-0.353,0.328-0.778,0.492-1.275,0.492c-0.496,0-0.924-0.164-1.28-0.492c-0.354-0.328-0.533-0.727-0.533-1.193   c0-0.465,0.18-0.865,0.533-1.196c0.356-0.332,0.784-0.497,1.28-0.497c0.497,0,0.923,0.165,1.275,0.497   c0.353,0.331,0.53,0.731,0.53,1.196C14.667,6.703,14.49,7.101,14.137,7.429z"/></svg>
							<div class="spk-tooltip-txt">You can choose your desired shortcode from the dropdown and check various parameters from left panel and see preview in right panel.</div>
						</div>Shortcode
						
					</h2>
					<?php if( !empty( $shortcodes_arr ) ) { ?>
						<div class="spk-select-field">
							<select name="shrtcodesDrop" data-default="default">
								<option value=""><?php _e('-- Choose Shortcode --', 'sp-blog-designer'); ?></option>
								<?php foreach ($shortcodes_arr as $shrt_grp_key => $shrt_grp_val) {
								$shrt_val 		= !empty($shrt_grp_val) ? $shrt_grp_val : $shrt_grp_key;
								$shortcode_url 	= add_query_arg( array('shortcode' => $shrt_grp_key, 'tmpl_id' => $tmpl_id), $shrt_url );
								?>
								<option value="<?php echo $shrt_grp_key; ?>" <?php echo __($preview_shortcode == $shrt_grp_key ? 'selected' : '')?> data-url="<?php echo esc_url( $shortcode_url ); ?>"><?php echo $shrt_grp_val; ?></option>
								<?php  } ?>
							</select>
						</div>
					<?php } ?>
				</div>
				<div class="spk-option-field">
					<form action="<?php echo esc_url($preview_url); ?>" method="post" class="spbd-customizer-form" id="spbd-customizer-form" target="spbd_preview_frame">
					<textarea name="spbd_custom_shortcode" preview="<?php echo __($preview_shortcode);?>" class="spbd_custom_shortcode" id="spbd_custom_shortcode" placeholder="<?php _e('Copy or Paste Shortcode', 'sp-blog-designer'); ?>">[<?php echo $preview_shortcode;?>]</textarea>
					</form>
				</div>
				<div class="spk-error-msg">* Kindly copy the above shortcode and paste it inside any page or post or inside any section.</div>
			</div>
			<div class="spk-preview-block spk-prv-div">
				<div class="spk-loaderPrv"><img src="<?php echo SPBD_URL; ?>assets/images/ajax-loader.gif"></div>
				<h2> 
					Preview Window<div class="spk-tooltip-ic">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 23.625 23.625"><path d="M11.812,0C5.289,0,0,5.289,0,11.812s5.289,11.813,11.812,11.813s11.813-5.29,11.813-11.813   S18.335,0,11.812,0z M14.271,18.307c-0.608,0.24-1.092,0.422-1.455,0.548c-0.362,0.126-0.783,0.189-1.262,0.189   c-0.736,0-1.309-0.18-1.717-0.539s-0.611-0.814-0.611-1.367c0-0.215,0.015-0.435,0.045-0.659c0.031-0.224,0.08-0.476,0.147-0.759   l0.761-2.688c0.067-0.258,0.125-0.503,0.171-0.731c0.046-0.23,0.068-0.441,0.068-0.633c0-0.342-0.071-0.582-0.212-0.717   c-0.143-0.135-0.412-0.201-0.813-0.201c-0.196,0-0.398,0.029-0.605,0.09c-0.205,0.063-0.383,0.12-0.529,0.176l0.201-0.828   c0.498-0.203,0.975-0.377,1.43-0.521c0.455-0.146,0.885-0.218,1.29-0.218c0.731,0,1.295,0.178,1.692,0.53   c0.395,0.353,0.594,0.812,0.594,1.376c0,0.117-0.014,0.323-0.041,0.617c-0.027,0.295-0.078,0.564-0.152,0.811l-0.757,2.68   c-0.062,0.215-0.117,0.461-0.167,0.736c-0.049,0.275-0.073,0.485-0.073,0.626c0,0.356,0.079,0.599,0.239,0.728   c0.158,0.129,0.435,0.194,0.827,0.194c0.185,0,0.392-0.033,0.626-0.097c0.232-0.064,0.4-0.121,0.506-0.17L14.271,18.307z    M14.137,7.429c-0.353,0.328-0.778,0.492-1.275,0.492c-0.496,0-0.924-0.164-1.28-0.492c-0.354-0.328-0.533-0.727-0.533-1.193   c0-0.465,0.18-0.865,0.533-1.196c0.356-0.332,0.784-0.497,1.28-0.497c0.497,0,0.923,0.165,1.275,0.497   c0.353,0.331,0.53,0.731,0.53,1.196C14.667,6.703,14.49,7.101,14.137,7.429z"/></svg>
						<div class="spk-tooltip-txt">Live preview of shortcode to check how it'll looks like.</div>
					</div>
				</h2>
				<div class="spk-preview-panel">
					<div id="spbd-preview-container" class="spbd-preview-container">
						<?php if( $preview_shortcode ) {
							echo do_shortcode( '['. $preview_shortcode .']' );
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>