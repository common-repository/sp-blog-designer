<?php
/**
 * Help guid for shortcodes
 *
 * @package SP Blog Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$tab = 'introduction';
if(isset($_GET['tab'])) $tab = spbd_sanitize($_GET['tab']);

$blogusers = get_users('role=Administrator');
foreach ($blogusers as $user) {
    $user_email = $user->user_email;
    $user_name = $user->user_login;
}
?>

<div class="spk-help-page">
	<div class="spk-cus-title">
		<h2>How Can We Help You?</h2>
		<p>Documentation, Reference Materials and Tutorials</p>
	</div>
	<div class="spk-help-div">
		<div class="spk-help-tab">
			<ul>
				<li>
					<a href="javascript:void(0)" class="<?php echo __($tab == 'introduction' ? 'active' : '')?>" data-link="spk-introduction">
						<svg id="light" height="45" width="45" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path d="m13.5 24h-3c-.7 0-1.5-.6-1.5-1.8v-2.1c0-1-.5-1.9-1.3-2.6-1.8-1.4-2.7-3.4-2.7-5.6.1-3.8 3.2-6.8 6.9-6.9 1.9 0 3.7.7 5 2s2.1 3.1 2.1 5c0 2.1-.9 4.1-2.6 5.4-.9.7-1.4 1.8-1.4 2.8v2.3c0 .8-.7 1.5-1.5 1.5zm-1.5-18c-3.2 0-5.9 2.7-6 5.9 0 1.9.8 3.7 2.3 4.8 1.1.9 1.7 2.1 1.7 3.4v2.1c0 .2 0 .8.5.8h3c.3 0 .5-.2.5-.5v-2.3c0-1.3.7-2.7 1.8-3.6 1.4-1.1 2.2-2.8 2.2-4.6 0-1.6-.6-3.1-1.8-4.3-1.1-1.1-2.6-1.7-4.2-1.7z"/></g><g><path d="m14.5 21h-5c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h5c.3 0 .5.2.5.5s-.2.5-.5.5z"/></g><g><path d="m12 3c-.3 0-.5-.2-.5-.5v-2c0-.3.2-.5.5-.5s.5.2.5.5v2c0 .3-.2.5-.5.5z"/></g><g><path d="m18.7 5.8c-.1 0-.3 0-.4-.1-.2-.2-.2-.5 0-.7l1.4-1.4c.2-.2.5-.2.7 0s.2.5 0 .7l-1.4 1.4s-.2.1-.3.1z"/></g><g><path d="m23.5 12.5h-2c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h2c.3 0 .5.2.5.5s-.2.5-.5.5z"/></g><g><path d="m20.1 20.6c-.1 0-.3 0-.4-.1l-1.4-1.4c-.2-.2-.2-.5 0-.7s.5-.2.7 0l1.4 1.4c.2.2.2.5 0 .7 0 .1-.1.1-.3.1z"/></g><g><path d="m3.9 20.6c-.1 0-.3 0-.4-.1-.2-.2-.2-.5 0-.7l1.4-1.4c.2-.2.5-.2.7 0s.2.5 0 .7l-1.4 1.4c-.1.1-.2.1-.3.1z"/></g><g><path d="m2.5 12.5h-2c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h2c.3 0 .5.2.5.5s-.2.5-.5.5z"/></g><g><path d="m5.3 5.8c-.1 0-.3 0-.4-.1l-1.4-1.5c-.2-.2-.2-.5 0-.7s.5-.2.7 0l1.4 1.4c.2.2.2.5 0 .7-.1.1-.2.2-.3.2z"/></g><g><path d="m16 12.5c-.3 0-.5-.2-.5-.5 0-1.9-1.6-3.5-3.5-3.5-.3 0-.5-.2-.5-.5s.2-.5.5-.5c2.5 0 4.5 2 4.5 4.5 0 .3-.2.5-.5.5z"/></g></svg>
						<h2>Introduction</h2>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)" class="<?php echo __($tab == 'shortcode' ? 'active' : '')?>" data-link="spk-shortcode">
						<svg height="45" viewBox="0 0 478.445 478.445" width="45" xmlns="http://www.w3.org/2000/svg"><path d="m463.151 329.813-33.51 58.042c-1.994 3.452-6.227 4.91-9.923 3.418l-49.328-19.913c-4.097-1.653-6.078-6.315-4.424-10.412 1.654-4.099 6.315-6.08 10.413-4.424l42.881 17.31 26.558-46.001-36.386-28.444c-2.612-2.042-3.693-5.482-2.72-8.651 10.078-32.808 10.463-68.968 0-103.029-.973-3.169.108-6.609 2.72-8.651l36.386-28.444-26.558-46.001-42.881 17.31c-3.075 1.243-6.595.458-8.853-1.97-24.083-25.895-54.915-43.712-89.161-51.526-3.235-.738-5.679-3.397-6.142-6.684l-6.442-45.743h-53.117l-6.442 45.741c-.463 3.286-2.907 5.945-6.142 6.684-34.247 7.814-65.078 25.632-89.161 51.526-2.258 2.428-5.778 3.213-8.853 1.97l-42.881-17.31-26.559 46.001 36.386 28.444c2.612 2.042 3.693 5.482 2.72 8.651-10.078 32.808-10.463 68.968 0 103.029.973 3.169-.108 6.609-2.72 8.651l-36.386 28.444 26.559 46.001 42.881-17.31c3.075-1.243 6.596-.458 8.853 1.97 24.083 25.895 54.915 43.712 89.161 51.526 3.235.738 5.679 3.397 6.142 6.684l6.442 45.741h53.117l6.442-45.741c.463-3.286 2.907-5.945 6.142-6.684 18.752-4.278 36.577-11.602 52.977-21.764 3.759-2.325 8.688-1.167 11.014 2.587 2.327 3.756 1.169 8.688-2.586 11.015-16.328 10.117-33.952 17.656-52.459 22.45l-6.655 47.253c-.556 3.947-3.935 6.884-7.922 6.884h-67.021c-3.987 0-7.366-2.937-7.922-6.884l-6.655-47.253c-33.458-8.658-63.725-26.149-88.106-50.919l-44.301 17.883c-3.697 1.494-7.929.035-9.923-3.418l-33.511-58.042c-1.994-3.453-1.14-7.847 2.001-10.303l37.595-29.39c-9.146-33.188-9.148-68.599 0-101.795l-37.595-29.39c-3.141-2.456-3.995-6.85-2.001-10.303l33.511-58.042c1.994-3.453 6.225-4.911 9.923-3.418l44.301 17.883c24.381-24.77 54.648-42.261 88.106-50.919l6.655-47.253c.555-3.943 3.934-6.88 7.921-6.88h67.021c3.987 0 7.366 2.937 7.922 6.884l6.655 47.253c33.458 8.658 63.725 26.149 88.106 50.919l44.302-17.883c3.697-1.491 7.93-.036 9.923 3.418l33.51 58.042c1.994 3.453 1.14 7.847-2.001 10.303l-37.595 29.39c9.146 33.188 9.148 68.599 0 101.795l37.595 29.39c3.141 2.455 3.995 6.848 2.001 10.302zm-237.033-52.534 40-68c2.24-3.809.969-8.712-2.839-10.952-3.807-2.239-8.711-.969-10.952 2.839l-40 68c-2.24 3.809-.969 8.712 2.839 10.952 3.81 2.24 8.713.968 10.952-2.839zm-31.239-68.725c-3.123-3.122-8.188-3.123-11.313 0l-25.012 25.012c-3.122 3.123-3.124 8.189 0 11.314l25.012 25.012c3.125 3.124 8.189 3.123 11.313 0 3.125-3.125 3.125-8.19 0-11.314l-19.355-19.354 19.355-19.354c3.125-3.126 3.125-8.191 0-11.316zm93.344 63.681c2.047 0 4.095-.781 5.657-2.343l25.012-25.013c3.122-3.123 3.124-8.189 0-11.314l-25.012-25.012c-3.124-3.123-8.189-3.123-11.313 0-3.125 3.125-3.125 8.19 0 11.314l19.355 19.354-19.355 19.355c-5.057 5.059-1.407 13.659 5.656 13.659zm-95.818 94.675c15.27 5.599 31.102 8.386 46.895 8.385 98.825-.005 165.058-103.194 123.314-193.261-31.533-68.036-112.54-97.736-180.58-66.204-86.499 40.09-106.111 155.354-36.93 221.612 3.191 3.057 8.256 2.947 11.311-.244 3.056-3.19 2.947-8.255-.244-11.311-61.001-58.426-43.772-160.149 32.59-195.54 60.037-27.823 131.512-1.619 159.335 58.415 27.824 60.033 1.619 131.511-58.415 159.335-29.083 13.479-61.674 14.825-91.771 3.791-4.147-1.519-8.744.61-10.265 4.757-1.519 4.149.611 8.745 4.76 10.265z"/></svg>
						<h2>Create Shortcode</h2>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)" class="<?php echo __($tab == 'faq' ? 'active' : '')?>" data-link="spk-faq">
						<svg xmlns="http://www.w3.org/2000/svg" id="Icons" viewBox="0 0 74 74" width="45" height="45"><path d="M37,72A35,35,0,1,1,72,37,35.04,35.04,0,0,1,37,72ZM37,4A33,33,0,1,0,70,37,33.037,33.037,0,0,0,37,4Z"/><path d="M37,64.667A27.667,27.667,0,1,1,64.667,37,27.7,27.7,0,0,1,37,64.667Zm0-53.333A25.667,25.667,0,1,0,62.667,37,25.7,25.7,0,0,0,37,11.333Z"/><path d="M37,47.34a1,1,0,0,1-1-1,10.707,10.707,0,0,1,5.156-8.989,7.723,7.723,0,0,0,3.617-6.8A7.868,7.868,0,0,0,37.222,23a7.776,7.776,0,0,0-8,7.773,1,1,0,0,1-2,0A9.776,9.776,0,0,1,37.276,21a9.894,9.894,0,0,1,9.5,9.5,9.709,9.709,0,0,1-4.547,8.541A8.718,8.718,0,0,0,38,46.34,1,1,0,0,1,37,47.34Z"/><path d="M37,53a1,1,0,0,1-1-1V50.853a1,1,0,0,1,2,0V52A1,1,0,0,1,37,53Z"/></svg>

						<h2>FAQ</h2>
					</a>
				</li>
				<li>
					<a href="javascript:void(0)" class="<?php echo __($tab == 'support' ? 'active' : '')?>" data-link="spk-support">
						<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 512 512"><g><circle cx="208" cy="192" r="16"/><circle cx="304" cy="192" r="16"/><path d="M406.4,360.57,320,337.83V310.35c20.29-15.67,37.55-37.47,44.6-62.35H388a28.031,28.031,0,0,0,28-28V164a28.031,28.031,0,0,0-28-28H368V120a112,112,0,0,0-224,0v16H124a28.031,28.031,0,0,0-28,28v56a28.031,28.031,0,0,0,28,28h4v32a8,8,0,0,0,8,8h32.91A142.581,142.581,0,0,0,192,310.35v27.48l-86.39,22.74A88.046,88.046,0,0,0,40,445.67V496a8,8,0,0,0,8,8H464a8,8,0,0,0,8-8V445.67A88.048,88.048,0,0,0,406.4,360.57ZM392,152.7a12.014,12.014,0,0,1,8,11.3v56a12.014,12.014,0,0,1-8,11.3Zm-24-.7h8v80h-8ZM120,231.3a12.014,12.014,0,0,1-8-11.3V164a12.014,12.014,0,0,1,8-11.3ZM334.36,358.16,301.09,421.4l-32.33-15.84,46-52.56ZM256,395.85l-48-54.86V321.1c16.38,9.48,33.46,14.9,48,14.9s31.62-5.42,48-14.9v19.89ZM160,120a96,96,0,0,1,192,0v27.31a79.215,79.215,0,0,1-41.3-31.53,8.009,8.009,0,0,0-10.76-2.37c-.61.36-59.45,35.26-139.94,37.48Zm-24,32h8v80h-8Zm8,120V248h3.4a103.55,103.55,0,0,0,10.34,24Zm46.51,16h34.87A24.031,24.031,0,0,0,248,304h16a24,24,0,0,0,0-48H248a24.031,24.031,0,0,0-22.62,16H176.62C162.55,252.32,160,234.37,160,224V166.89c70.26-1.8,123.83-26.71,141.78-36.2A93.971,93.971,0,0,0,352,163.94V224c0,13.75-4.46,40.8-34.34,67.58C298.4,308.84,274.19,320,256,320s-42.4-11.16-61.66-28.42C193.01,290.39,191.74,289.19,190.51,288ZM240,280a8.011,8.011,0,0,1,8-8h16a8,8,0,0,1,0,16H248A8.011,8.011,0,0,1,240,280Zm-42.76,73,45.92,52.48-31.73,15.86-33.31-63.31Zm28.51,135H112V456a8,8,0,0,0-16,0v32H56V445.67a72.027,72.027,0,0,1,53.68-69.62l52.56-13.84,38.68,73.51a8.011,8.011,0,0,0,10.66,3.44l5.64-2.83,14.3,28.6Zm16.5,0,4-16h19.69l4.5,16Zm24.81-32H244.94l-13.41-26.82,24.28-12.14,24.68,12.08ZM456,488H416V456a8,8,0,0,0-16,0v32H287.06l-6.52-23.19,14.32-28.65,6.17,3.02a7.882,7.882,0,0,0,3.51.82,8,8,0,0,0,7.09-4.28l38.61-73.38,52.09,13.71A72.03,72.03,0,0,1,456,445.67Z"/></g></svg>

						<h2>Contact Us</h2>
					</a>
				</li>
			</ul>
		</div>
		<div class="spk-info-show">
			<div class="spk-toggle-results" id="spk-introduction">
				<h2>Introduction</h2>
				<p>Welcome to <b><?php echo SPBD_PLUGIN_BASENAME;?></b>! The <?php echo SPBD_PLUGIN_BASENAME;?> blogs Builder is one of the most fully featured and capable WordPress based Blogs / News Builders in existence. The plugin is very simple to use. Start your blog site or news site with just few clicks!!</p>
				<p>With this Quick Start Guide, we want to help you quickly get started with your website, by listing the most esssential things you need to do to get up and running.</p>	
				
				<h3>Features:</h3>
				<p>Here you will find the main features which are included in our <?php echo SPBD_PLUGIN_BASENAME;?> Plugin.</p>
				<ul>
					<li>Post Grid <b>[wpsbd_post]</b></li>
					<li>Post List <b>[wpsbd_post_list]</b></li>
					<li>Post Slider <b>[wpsbd_post_carousel]</b></li>
					<li>All Customized Options</li>
					<li>Live Preview</li>
					<li>3 shortcodes with number of designs.</li>
					<li>Light weight and Fast - Created with ground level with WordPress Coding Standard</li>
					<li>Completely translatable both in front and back-end.</li>
					<li>Fully Responsive.</li>
					<li>Cross browsers support.</li>
					<li>Many more other features also…</li>
				</ul>
			</div>

			<div class="spk-toggle-results hide" id="spk-shortcode">
				<h2>Create Shortcode</h2>				
				<p class="weight600">Now you are ready to create shortcode!</p>
				<p>There is so many options to match your theme with created shortcodes, if you are not aware about coding then also you can do it easily!<br>
				Just change the options values from side bar settings panel and check live preview, how it'll looks like in your front site.</p>
				<ul>
					<li>Go to <a href="<?php echo add_query_arg( array( 'page' => 'SpBlogDesigner'), admin_url('admin.php') );?>">create shortcode</a> menu from side bar.</li>
					<li>Select Shortcode from dropdown.</li>
					<li>Customize from side bar settings.</li>
					<li>Select <b>design layouts </b>from side bar general options</li>
					<li>If it's grid then there's option to <b>choose grid column value</b>, you can set column values up to 4. (<a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/setup.gif">How?</a>)</li>
					<li>Enable/ Disable <i>tags, category, comments, Author, date</i> options from general parameters tab.</li>
					<li>Change blogs description related setting like <b>content words limit, read more button</b> from general paramters tab.</li>
					<li>Select image value option like <i>full, large, medium</i> etc..</li>
					<li>You can <b>change number of post to be display</b> from query parameters option with pagination (<a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/page-length.gif">How?</a>) </li>
					<li>Change order by value by date, Id, title etc.</li>
					<li>Appearance settings customization like text and background colors to match shortcode with your website theme.(<a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/appreance.gif">How?</a>) </li>
					<li>For more customization option you can <b>buy our <a href='<?php echo SPBD_PRO_FEATURE_URL;?>' target='_blank'>Pro</a></b> plugin.</li>
				</ul>
				<p>Just start customizing the layouts and copy created shotcode from textbox and paste it inside any page or post or inside any section.</p>
				<p>If you are facing any issue, drop a mail on <a href="mailto:support@shopiapps.in">support@shopiapps.in</a> we will help you.</p>
			</div>

			<div class="spk-toggle-results hide" id="spk-faq">
				<h2>FAQs for shortcode setup</h2>
				<p class="weight600">We are trying to solve your doubts by this section,</p>
				<ul class="faq_ul">
					<li><b class="faq__title"><a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/setup-shortcode.gif">How can I set shortcode in post page?</a></b>
						<ul>
							<li>Copy shortcode from plugin</li>
							<li>Open post page from side menu and edit post.</li>
							<li>Paste code in description section.</li>
							<li>Save post and view at front side.</li>
						</ul>
					</li>
					<li><b class="faq__title"><a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/grid.gif">How to set grid view in shortcode?</a></b>
						<ul>
							<li>Select <b>[wpsbd_post]</b> shortcode from dropdown.</li>
							<li>Set grid value from side bar General Parameters Panel.</li>
							<li>Copy generated shortcode and paste it in page/post. </li>
						</ul>
					</li>
					<li><b class="faq__title"><a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/list.gif">How to set list view in shortcode?</a></b>
						<ul>
							<li>Select <b>[wpsbd_post_list]</b> shortcode from dropdown.</li>
							<li>Select design layout from side bar General Parameters Panel.</li>
							<li>Copy generated shortcode and paste it in page/post. </li>
						</ul>
					</li>
					<li><b class="faq__title"><a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/slider.gif">How do I set slider in home page?</a></b>
						<ul>
							<li>Select <b>[wpsbd_post_carousel]</b> shortcode from dropdown.</li>
							<li>Customize slider options from side bar Slider Parameters Panel.</li>
							<li>Copy generated shortcode. </li>
							<li>Go to pages ->  — Front Page -> edit. </li>
							<li>Paste code where you want to display the slider.</li>
						</ul>
					</li>
					<li><b class="faq__title"><a href="javascript:void(0);" class="gif_link" gif="<?php echo SPBD_URL; ?>assets/images/appreance.gif">How to change appearance setting?</a></b>
						<ul>
							<li>In shortcode page there's a option to change Appearance Parameters.</li>
							<li>Change colors value and see live preview.</li>
							<li>Once your preview are ready to set, copy generated shortcode code and paste it in page.</li>
						</ul>
					</li>
					<li><b class="faq__title">How to change post/blogs order?</b>
						<ul>
							<li>Open <?php echo SPBD_PLUGIN_BASENAME;?> page.</li>
							<li>Find Query Parameters options, change value for Post Order By option.</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="spk-toggle-results hide" id="spk-support">
				<h2>Do you need help?</h2>
				<p class="weight600">Fill this form and submit, we will contact you soon.</p>
				<form method="post" class="contactForm" action="<?php echo add_query_arg( array( 'page' => 'sp-help'), admin_url('admin.php') );?>">
					<div>
						<label>Name</label>
						<input type="text" name="owner_name" placeholder="Owner Name" value="<?php echo $user_name; ?>">
					</div>
					<div>
						<label>Email</label>
						<input type="email" name="owner_email" placeholder="Owner Email" value="<?php echo $user_email; ?>">
					</div>
					<div>
						<label>Message</label>
						<textarea name="text_message"></textarea>
					</div>
					<div>
						<input type="submit" name="contact_us">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="spk-img-popup">
  <div class="spk-img-popbx">
    <a href="javascript:void(0)" class="spk-img-close">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.11 13.11"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><polyline points="12.58 0.53 8.7 4.41 6.56 6.56 0.53 0.53"></polyline><polyline points="0.53 12.58 4.41 8.7 6.56 6.56 12.58 12.58"></polyline></g></g></svg>
    </a>
    <div class="spk-gifImg">
    	<img src="">
    </div>
  </div>
</div>
<script type="text/javascript">
	jQuery( document ).ready(function() {
		spbdOpnTab(jQuery('.spk-help-tab li a.active'));
		
		jQuery('.spk-help-tab li a').on('click', function() {
			spbdOpnTab(jQuery(this));
		});

		jQuery(document).on('click','[name=contact_us]',function(){
			if(jQuery('[name=owner_email]').val() == ''){
				alert("Email required!");
				return false;
			}
			if(jQuery('[name=text_message]').val() == ''){
				alert('Message required!');
				return false;
			}
		});

		jQuery(document).on('click', '.gif_link, .spk-img-popup, .spk-img-close', function(){
			jQuery('.spk-img-popup').find('img').attr('src','');
			if(jQuery(this).is('.gif_link')) {
				var gif = jQuery(this).attr('gif');
				jQuery('.spk-img-popup').find('img').attr('src',gif);
				jQuery('body').addClass('spk-img-opened');
			} else {
				jQuery('body').removeClass('spk-img-opened');
			}
		});

		jQuery(document).on('click', '.spk-img-popbx', function(e){
			e.stopPropagation();
		});

	});
	function spbdOpnTab($this){
		$this.addClass('active').parent('li').siblings('li').find('a').removeClass('active');
		jQuery('#' + $this.attr('data-link')).removeClass('hide').siblings('.spk-toggle-results').addClass('hide');
	}
</script>