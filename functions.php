<?php
defined( 'ABSPATH' ) or die( 'Vulpix, use Flamethrower!' );

/**
 * Vulpix functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 */

/**
 * Constants
 *
 * @since Vulpix 1.0.0
 */
define( 'VULPIX_VERSION', wp_get_theme( basename( __DIR__ ) )->get( 'Version' ) );
define( 'VULPIX_ROOT', get_template_directory() );
define( 'VULPIX_ROOT_URI', get_template_directory_uri() );
define( 'VULPIX_INC', VULPIX_ROOT . '/inc/' );
define( 'VPX_ACF', 'advanced-custom-fields-pro/acf.php' );
define( 'VPX_WOO', 'woocommerce/woocommerce.php' );

/**
 * Required
 *
 * @since Vulpix 1.0.0
 */
require_once( VULPIX_ROOT . '/admin/theme-settings.php' );
require_once( VULPIX_INC . 'plugins.php' );
require_once( VULPIX_INC . 'shortcodes.php' );
require_once( VULPIX_INC . 'template-tags.php' );
require_once( VULPIX_INC . 'widgets.php' );

/**
 * Theme Setup
 *
 * @since Vulpix 1.0.0
 *
 * @return void
 */
function vpx_theme_setup() {

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ] );

	register_nav_menus(
		[
			'main_menu'      => 'Main Menu',
			'footer_menu'    => 'Footer Menu',
			'shop_menu'      => 'Shop Menu',
		]
	);
}
add_action( 'after_setup_theme', 'vpx_theme_setup' );

/**
 * Register sidebars for theme
 *
 * @since Vulpix 1.0.0
 *
 * @return void
 */
function vpx_register_widgets() {

    // Register sidebar for left footer
    register_sidebar(
        [
            'name'           => __( 'Left Panel', 'vulpix' ),
            'id'             => 'sidebar-footer-left',
            'description'    => __( 'Widgets in this area will be shown on all posts and pages.', 'vulpix' ),
            'before_widget'  => '<li id="%1$s" class="widget %2$s">',
            'after_widget'   => '</li>',
            'before_title'   => '<h2 class="widget--title">',
            'after_title'    => '</h2>',
        ]
    );

    // Register sidebar for center footer
    register_sidebar(
        [
            'name'           => __( 'Center Panel', 'vulpix' ),
            'id'             => 'sidebar-footer-center',
            'description'    => __( 'Widgets in this area will be shown on all posts and pages.', 'vulpix' ),
            'before_widget'  => '<li id="%1$s" class="widget %2$s">',
            'after_widget'   => '</li>',
            'before_title'   => '<h2 class="widget--title">',
            'after_title'    => '</h2>',
        ]
    );

    // Register sidebar for right footer
    register_sidebar(
        [
            'name'           => __( 'Right Panel', 'vulpix' ),
            'id'             => 'sidebar-footer-right',
            'description'    => __( 'Widgets in this area will be shown on all posts and pages.', 'vulpix' ),
            'before_widget'  => '<li id="%1$s" class="widget %2$s">',
            'after_widget'   => '</li>',
            'before_title'   => '<h2 class="widget--title">',
            'after_title'    => '</h2>',
        ]
    );
}
add_action( 'widgets_init', 'vpx_register_widgets' );

/**
 * Remove default widgets from WP
 *
 * @since Vulpix 1.0.0
 *
 * @return void
 */
function vpx_remove_default_widgets() {

    unregister_widget( 'WP_Nav_Menu_Widget' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Custom_HTML' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Media_Audio' );
    unregister_widget( 'WP_Widget_Media_Image' );
    unregister_widget( 'WP_Widget_Media_Gallery' );
    unregister_widget( 'WP_Widget_Media_Video' );
	unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
}
add_action( 'widgets_init', 'vpx_remove_default_widgets', 11 );

/**
 * Enqueues style and script files
 *
 * @since Vulpix 1.0.0
 *
 * @return void
 */
function vpx_theme_scripts() {

	// CSS
	// If singular (post/page)
	if ( is_singular() ) {
		wp_enqueue_style( 'vulpix-singular', get_theme_file_uri( '/assets/css/singular.css' ), null, VULPIX_VERSION );
	}

	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap' );
	wp_enqueue_style( 'reflex', get_theme_file_uri( '/assets/css/reflex.min.css' ), null, '2.0.4' );
	wp_enqueue_style( 'vulpix-imports', get_theme_file_uri( '/assets/css/imports.css' ), null, VULPIX_VERSION );
	wp_enqueue_style( 'vulpix-global', get_theme_file_uri( '/assets/css/global.css' ), [ 'vulpix-imports' ], VULPIX_VERSION );

	// JS
	wp_enqueue_script( 'html5shiv', get_theme_file_uri( '/assets/js/html5shiv.js' ), [ 'jquery' ], VULPIX_VERSION, true );
	wp_enqueue_script( 'vulpix-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), [ 'jquery' ], VULPIX_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'vpx_theme_scripts' );

/**
 * Enqueue admin styles and scripts
 *
 * @since Vulpix 1.0.0
 *
 * @return void
 */
function vpx_admin_scripts() {

	// If not in admin template don't load scripts
	if ( ! is_admin() ) {
		return;
	}

	// If admin page is theme options
	if ( 'vpx-admin-options' === $_GET['page'] ) {

		// Enqueue admin scripts
		wp_enqueue_script( 'vpx-admin-scripts', VULPIX_ROOT_URI . '/admin/assets/js/admin-scripts.js', [ 'jquery' ], VULPIX_VERSION, true );

		// Get WordPress Core components to enable media upload
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		} else {
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'vpx_admin_scripts' );
