<?php
/**
 * Admin Customizations
 * 
 * This file handles the admin area and functions. You can use this file to 
 * make changes to the dashboard. This file is called by the functions file.
 * 
 * Adjusted by: Adam Turner {@link https://adamturner.org/}
 * Developed by: Eddie Machado {@link http://themble.com/bones/}
 * Special Thanks for code & inspiration to: @jackmcconnell 
 * {@link http://www.voltronik.co.uk/} and Digging into WP 
 * {@link http://digwp.com/2010/10/customize-wordpress-dashboard/}
 *
 * @package WordPress
 * @subpackage Grammatizator
 * @since Grammatizator 0.4
 */

/************ DASHBOARD WIDGETS ****************/
/**
 * Disable default dashboard widgets
 * 
 * Comment or uncomment below as desired to add or remove the default WordPress
 * admin Dashboard widgets. Have more plugin widgets you'd like to remove? 
 * Share them on a list of the most commonly used. :D 
 * {@link https://github.com/eddiemachado/bones/issues}
 *
 * @since Grammatizator 0.4
 */
function disable_default_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'normal');		// At a Glance/Right Now Widget
	remove_meta_box('dashboard_activity', 'dashboard', 'normal'); 		// Activity Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); 	// Comments Widget	
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');	// Incoming Links Widget
	// remove_meta_box('dashboard_plugins', 'dashboard', 'normal');			// Plugins Widget
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');		// Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal'); 	// Recent Drafts Widget
    // remove_meta_box('dashboard_primary', 'dashboard', 'normal');			// WP News Widget
    // remove_meta_box('dashboard_secondary', 'dashboard', 'normal');		// ???
	
	// Remove plugin dashboard boxes with same format
	// remove_meta_box('widget_box_id', 'dashboard', 'normal');
}

/**
 * Create custom dashboard widgets
 * 
 * Functions to create new WordPress admin Dashboard widgets. This first one 
 * generates a Nursing Clio blog-specific widget to help out users.
 *
 * @since Grammatizator 0.4
 *
 * @todo Finish up widget content based on user feedback
 */
function nursingclio_dashboard_widget() {
	// Remind users to fill out their profile info if they haven't yet.
    if ( ! get_user_meta( get_current_user_id(), 'last_name', true ) ) { ?>
 		<div class="updated">
 			<h2>Welcome to Nursing Clio!</h2>
 			<p>To get started, please fill out your Profile (accessed via Users - Your Profile), including:</p>
 			<ol>
 				<li>First and last name</li>
 				<li>How you want your name displayed</li>
 				<li>Some biographical info</li>
 				<li>Your profile picture (Gravatar)</li>
 				<li>Anything else you'd like to share</li>
 			</ol>
 		</div>
    <?php } ?>

    <p>Howdy, <?php the_author_meta( 'display_name', get_current_user_id() ); ?>.</p>

	<p>If you have technical difficulties, <a href="https://nursingclio.slack.com/" target="_blank">send Adam a message on Slack</a>.
	
	<?php if ( current_user_can( 'edit_theme_options' ) ) {
		echo "<p><strong>Dear Admin: You can edit this widget via library/admin.php (on the server).</strong></p>";
	}
}

// Call all custom dashboard widgets
function gramm_add_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'nursingclio_dashboard_widget', __( 'Nursing Clio Miscellany', 'bonestheme' ), 'nursingclio_dashboard_widget' );
	// Be sure to create a line for every created Dashboard Widgets
}

// Remove the Dashboard widgets
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );
// Add any custom widgets
add_action( 'wp_dashboard_setup', 'gramm_add_custom_dashboard_widgets' );
// Remove the "Welcome" Dashboard widget
remove_action( 'welcome_panel', 'wp_welcome_panel' );


/************* CUSTOM LOGIN PAGE ***************/
/**
 * Replace login page css
 *
 * Call our own CSS on the login page so we can style it however we
 * want. Just for fun.
 * 
 * @since Bones 1.71
 */
//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function bones_login_css() {
	wp_enqueue_style( 'bones_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function bones_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function bones_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'bones_login_css', 10 );
add_filter( 'login_headerurl', 'bones_login_url' );
add_filter( 'login_headertitle', 'bones_login_title' );



/************* CUSTOMIZE ADMIN *****************/

/**
 * Cusomtize admin
 * 
 * I don't really recommend editing the admin too much as things may get funky
 * if WordPress updates. Here are a few funtions which you can choose to use if
 * you like.
 *
 * @since Bones 1.71
 * 
 * @todo Determine whether this is what's needed for changing Publish button

// Custom Backend Footer
function bones_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.', 'bonestheme' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );
*/
?>