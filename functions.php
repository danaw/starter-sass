<?php
// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Starter Sass by Dana Werpny' );
define( 'CHILD_THEME_URL', 'http://www.danawerpny.com' );

// Activate the child theme
add_action('genesis_setup','gregr_theme_setup', 15);

/**
 * HTML5 DOCTYPE
 * removes the default Genesis doctype, adds new html5 doctype with IE8 detection
*/

function mb_html5_doctype() {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="lt-ie9" <?php language_attributes( 'html' ); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes( 'html' ); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
}

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'mb_html5_doctype' );


/***** THIS FIRES OFF ALL CHILD THEME SETUP - FUNCTIONS LOCATED IN /LIB/GREGR_CHILD_FUNCTIONS.PHP *****/
function gregr_theme_setup() {

// Start the engine
// Holds all of the funtions called from this main file
// View /lib/gregr_child_functions.php for details
include_once( get_stylesheet_directory() . '/lib/gregr_child_functions.php' ); /* <-- THIS FILE IS REQUIRED!! DO NOT REMOVE --> */

// Add a custom post types with or without custom taxonomy
// View /lib/custom_post_types for details
//include_once( get_stylesheet_directory() . '/lib/custom_post_types.php' );

// Add some custom options to the admin panel
// View /lib/admin_funtions.php for details
include_once( get_stylesheet_directory() . '/lib/admin_functions.php' );

// Custom metabox options
//include_once( get_stylesheet_directory() . '/lib/custom_metabox.php' );

// Add additional theme options
include_once( get_stylesheet_directory() . '/lib/custom_theme_options.php' );


/***** CLEAN UP THE <HEAD> *****/

// Remove rsd link
remove_action( 'wp_head', 'rsd_link' );
// Remove Windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link' );
// Index link
remove_action( 'wp_head', 'index_rel_link' );
// Previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// Remove WP version
remove_action( 'wp_head', 'wp_generator' );
//* Remove the header right widget area
unregister_sidebar( 'header-right' );
//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav', 12 );


/***** OTHER <HEAD> ELEMENTS *****/

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'gregr_viewport_meta_tag' );

//* Add viewport meta tag for mobile browsers GENESIS 2.0 FEATURE
// Disable the action above if you want to use what Genesis adds for viewport. Use one or the other
//add_theme_support( 'genesis-responsive-viewport' );

// Change favicon location
//add_filter( 'genesis_pre_load_favicon', 'gregr_favicon_filter' );

// Add scripts & styles
add_action( 'wp_enqueue_scripts', 'gregr_load_custom_scripts', 999 );

// IE conditional wrapper
add_filter( 'style_loader_tag', 'gregr_ie_conditional', 10, 2 );

// Remove version number from js and css
if (!is_admin() || !is_admin_bar_showing()){
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
}
/***** STRUCTURE & REPOSITIONING *****/

// Add HTML5 functions
add_theme_support( 'html5' );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

// Adds custom microdata depending on post type - can me modified in gregr_child_functions file
// KEEP DISABLED UNLESS YOU DO SOMETHING IN "gregr_child_functions.php" FILE
// add_filter( 'genesis_attr_entry', 'gregr_custom_entry_attributes', 20 );


// Reposition nav menus
//remove_action('genesis_after_header','genesis_do_nav');
//remove_action('genesis_after_header','genesis_do_subnav');

//add_action('genesis_header_right','genesis_do_subnav');
//add_action('genesis_header_right','genesis_do_nav');

// Remove Genesis layout settings
// remove_theme_support( 'genesis-inpost-layouts' );


/***** CUSTOMIZING TITLES & DESCRIPTION & BREADCRUMBS *****/

// Remove and/or add custom site title
//remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
//add_action( 'genesis_site_title', 'gregr_custom_seo_site_title' );

// Remove and/or add custom post title
//remove_action('genesis_entry_header','genesis_do_post_title');
//add_action('genesis_entry_header','gregr_do_custom_post_title');

// Remove and/or add custom site description
//remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
//add_action( 'genesis_site_description', 'gregr_custom_seo_site_description' );

// Reposition breadcrumbs
//remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
//add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs' );


/***** FOOTER *****/

// Footer creds
// add_filter('genesis_footer_creds_text', 'gregr_footer_creds_text');
// add_filter('genesis_footer_backtotop_text', 'gregr_footer_backtotop_text');

function remove_footer_admin () {
echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> and the <a href="http://my.studiopress.com/themes/genesis/" target="_blank">Genesis Framework</a> | Child Theme by <a href="http://www.danawerpny.com" target="_blank">Dana Werpny</a> | WordPress Tutorials: <a href="http://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Add support for footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


/***** OTHER GENESIS CLEANUP OPTIONS *****/

// Remove Genesis widgets
//add_action( 'widgets_init', 'gregr_remove_genesis_widgets', 20 );

// Remove unused Genesis profile options
remove_action( 'show_user_profile', 'genesis_user_options_fields' );
remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
remove_action( 'show_user_profile', 'genesis_user_seo_fields' );
remove_action( 'edit_user_profile', 'genesis_user_seo_fields' );
remove_action( 'show_user_profile', 'genesis_user_layout_fields' );
remove_action( 'edit_user_profile', 'genesis_user_layout_fields' );

// Remove Genesis layout options
//genesis_unregister_layout( 'sidebar-content' );
//genesis_unregister_layout( 'content-sidebar-sidebar' );
//genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'sidebar-content-sidebar' );
//genesis_unregister_layout( 'content-sidebar' );
//genesis_unregister_layout( 'full-width-content' );

// Remove Genesis menu link
//remove_theme_support( 'genesis-admin-menu' );


/***** SIDEBARS & WIDGETS *****/

// Remove the header right widget area
//unregister_sidebar( 'header-right' );
//unregister_sidebar( 'sidebar-alt' );

// Home page widgets
genesis_register_sidebar( array(
	'id'			=> 'home-featured-full',
	'name'			=> __( 'Home Featured Full', 'gregshtml5starter' ),
	'description'	=> __( 'This is the featured section if you want full width.', 'gregshtml5starter' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-left',
	'name'			=> __( 'Home Featured Left', 'gregshtml5starter' ),
	'description'	=> __( 'This is the featured section left side.', 'gregshtml5starter' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-right',
	'name'			=> __( 'Home Featured Right', 'gregshtml5starter' ),
	'description'	=> __( 'This is the featured section right side.', 'gregshtml5starter' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle 1', 'gregshtml5starter' ),
	'description'	=> __( 'This is the home middle left section.', 'gregshtml5starter' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle 2', 'gregshtml5starter' ),
	'description'	=> __( 'This is the home middle center section.', 'gregshtml5starter' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle 3', 'gregshtml5starter' ),
	'description'	=> __( 'This is the home middle right section.', 'gregshtml5starter' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom',
	'name'			=> __( 'Home Bottom', 'gregshtml5starter' ),
	'description'	=> __( 'This is the home bottom section.', 'gregshtml5starter' ),
) );

// Register responsive menu script
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );

function prefix_enqueue_scripts() {

	wp_enqueue_script( 'prefix-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true ); // Change 'prefix' to your theme's prefix

}

// Change column count for WooCommerce Thumbnails


// Remove Sidebar from WooCommerce Pages
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
    ?>
    <p>&copy; <?php echo date("Y")?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
    <?php
}

/**
 * Remove Genesis child theme style sheet
 * @uses  genesis_meta  <genesis/lib/css/load-styles.php>
*/
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

/**
 * Enqueue Genesis child theme style sheet at higher priority
 * @uses wp_enqueue_scripts <http://codex.wordpress.org/Function_Reference/wp_enqueue_style>
 */
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 15 );

/***** OTHER *****/

add_filter( 'http_request_args', 'gregr_prevent_theme_update', 5, 2 );

//add_image_size( 'custom-thumb', 220, 180 );

add_theme_support( 'genesis-connect-woocommerce' );

// Below is the closing bracket of theme setup. It's kinda important.
} // <-- DO NOT REMOVE THIS
?>